<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Comment;
use App\Http\Requests\AddBookRequest;
use App\Publisher;

use App\Http\Requests;
use App\User;
use Carbon\Carbon;
use Exception;
use File;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use SearchIndex;
use View;

class AdminController extends Controller
{

    /**
     * Contructor to kick out non-admin from here
     *
     */
    function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display options for searching for books/students.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Receive a book from a student
     *
     * @return Response
     */
    public function receive()
    {
        return view('admin.receive');
    }

    /**
     * Loan a book to a student
     *
     * @return Response
     */
    public function loan()
    {
        return view('admin.loan');
    }

    /**
     * View library-wide list overdue books
     * @return Response
     */
    public function overdue()
    {
        $all = Book::overdue()->all();
        $book = $this->paginate($all, 3);
        $total = count($all);
        return view('admin.overdue', compact('book', 'total'));
    }

    /**
     * View library-wide list reserved books
     * @return Response
     */
    public function reserved()
    {
        $all = Book::reserved()->all();
        $book = $this->paginate($all, 3);
        $total = count($all);
        return view('admin.reserved', compact('book', 'total'));
    }

    /**
     * Add a book to the library
     *
     * @return Response
     */
    public function add()
    {
        return view('admin.add');
    }

    /**
     * return profile of admin
     *
     * @return Response
     */
    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    /**
     * Store a book to the library
     *
     * @param AddBookRequest $request
     * @return Response
     */
    public function store(AddBookRequest $request)
    {
        $author = $this->getAuthor(Input::get('author')['first_name'], Input::get('author')['last_name']);
        $publisher = $this->getPublisher(Input::get('publisher')['name']);
        $path = $this->imageUpload($request);

        $book = Book::create(['title' => $request->title, 'author_id' => $author->id, 'publisher_id' => $publisher->id,
                        'isbn' => $request->isbn, 'image' => $path, 'summary' => $request->summary,
                        'year' => $request->year, 'edition' => $request->edition, 'quantity'=> $request->quantity
            ]);

        SearchIndex::upsertToIndex($book);

        flash()->success('Book successfully added!');

        return redirect('admin/add');

    }

    /**
     * Edit a book already in library
     *
     * @param $id
     * @param AddBookRequest $request
     * @return Response
     */
    public function editbook($id, AddBookRequest $request)
    {
        try
        {
            $book = Book::findOrFail($id);
        }catch (Exception $exception) {
            abort(403);
        }finally{
            if(!is_null($book->image) && $request->hasFile('attachment'))
            {
                $this->deleteImage($book);
            }
            $author = $this->getAuthor(Input::get('author')['first_name'], Input::get('author')['last_name']);
            $publisher = $this->getPublisher(Input::get('publisher')['name']);
            $request['isbn'] = $book->isbn;
            if($request->hasFile('attachment'))
            {
                $request['image'] = $this->imageUpload($request);
            }

            $book->update($request->except(['author', 'publisher', 'isbn', 'attachment']));

            $book->author()->associate($author);
            $book->publisher()->associate($publisher);

            $book->save();

            SearchIndex::upsertToIndex($book);

            flash()->success('Book successfully Edited!');

            return redirect('admin/'.$book->id.'/edit');
        }
    }

    /**
     * Check if author exists: If yes, return else create new and return
     * @param $first
     * @param $last
     * @return Author
     */
    private function getAuthor($first, $last)
    {
        return Author::firstOrCreate(['first_name' => $first, 'last_name' => $last]);
    }

    /**
     * Check if Publisher exists, if yes, return else create new and return
     * @param $publishers_name
     * @return static
     */
    private function getPublisher($publishers_name)
    {
        return Publisher::firstOrCreate(['name' => $publishers_name]);
    }

    /**
     * Return book to edit from id passed to edit
     * @param $book_id
     * @return \Illuminate\View\View
     */
    public function edit($book_id)
    {
        try
        {
            $book = Book::findOrFail($book_id);
        }catch (Exception $exception){
            abort('403');
        }finally{
            $book->load('author', 'publisher');
            return view('admin.edit', compact('book'));
        }
    }

    /**
     * Display details of a book
     * @param $book_id
     * @return View
     */
    public function show($book_id){
        try
        {
            $book = Book::findOrFail($book_id);
        }catch (Exception $exception){
            abort(403);
        }finally{
            $comment = $book->comment;
            return view('admin.book_details', compact('book', 'comment'));
        }
    }

    /**
     * Display search results
     * @param string $book_id
     * @param string $queryString
     * @return View
     */
    public function show_results($queryString = '', $book_id = null)
    {
        if(isset($book_id))
        {
            try
            {
                $results = array('hits' => [Book::findOrFail($book_id)]);
                $paginate = $this->paginate($results['hits'], 3);
            }catch (Exception $exception){
                abort(403);
            }finally{
                return view('admin/search', array('results' => $paginate, 'total'=>1));
            }
        }
        $queryString = str_replace('+', ' ', $queryString);
        $results = $this->handleElasticSearch($queryString, 'book');
        $paginate = $this->paginate($results['hits'], 3);
        return view('admin/search', array('results' => $paginate, 'total'=>count($results['hits'])));
    }

    /**
     * @param $array
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    private function paginate($array, $perPage = 3)
    {
        $page = Input::get('page', 1);
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true),
            count($array), $perPage, $page, ['path' => Paginator::resolveCurrentPath()]);
    }

    /**
     * Display student search results
     * @return View
     */
    public function show_students()
    {
        $queryString = str_replace('+', ' ', Input::get('query', ''));
        $results = $this->handleElasticSearch($queryString, 'user');
        $paginate = $this->paginate($results['hits'], 3);
        return view('admin/search_student', array('students' => $paginate, 'total'=>count($results['hits'])));
    }

    /**
     * Display student search results
     * @return View
     */
    public function student_details()
    {
        $email = Input::get('email');
        $student = User::where('email', $email)->first();
        if(is_null($student))
        {
            abort(403);
        }
        $loaned = $student->getLoan();
        $overdue = $student->getOverdue();
        $reservation = $student->getReservations();
        return view('admin.student_details', compact('student', 'loaned', 'overdue', 'reservation'));
    }

    /**
     * Update profile and return home
     * @param Request $request
     * @return View
     */
    public function update_profile(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed'
        ]);
        $user = auth()->user();
        $user->password = bcrypt($request->input('password'));
        $user->save();
        flash()->success('Successfully Changed Password');
        return redirect('/admin');
    }

    /**
     * Handle POST request for search
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        if($request->input('form') == 'basic_search')
        {
            $this->validate($request, ['key_words'=>'required']);
            $queryString = str_replace(' ', '+', $request->input('key_words'));
            return redirect()->route('searchResults', [$queryString]);
        }
        if($request->input('form') == 'refined_search')
        {
            $isbn = $request->input('isbn', null);
            $pub = $request->input('publisher', null);
            $title = $request->input('title', null);
            $author = $request->input('author', null);
            if(!is_null($isbn))
            {
                $book = Book::where('isbn', $isbn)->first();
                if(is_null($book))
                {
                    $keywords = trim( $pub .' '. $title .' '. $author );
                    $queryString = str_replace(' ', '+', $keywords);
                    return redirect()->route('searchResults', [$queryString]);
                }
                else
                {
                    return redirect()->route('searchResults', ['found', $book->id]);
                }
            }
            else
            {
                $keywords = trim( $pub .' '. $title .' '. $author );
                $queryString = str_replace(' ', '+', $keywords);
                return redirect()->route('searchResults', [$queryString]);
            }
        }

        if($request->input('form') == 'student_search')
        {
            $this->validate($request, [
                'student_mail' => 'required_without:student_name',
                'student_name' => 'required_without:student_mail'
            ]);

            $student_mail = $request->input('student_mail', null);
            $student_name = $request->input('student_name', null);

            $keywords = trim( $student_name.' '.$student_mail );
            $queryString = str_replace(' ', '+', $keywords);
            return redirect(route('searchStudent', ['query'=>$queryString]));
        }
    }

    /**
     * Handle request to receive book from student
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function do_receive(Request $request)
    {
        $this->validate($request, ['student_number'=>'required', 'isbn'=>'required']);
        $student = User::where('email', $request->input('student_number'))->first();
        $book = Book::where('isbn', $request->input('isbn'))->first();
        if(is_null($student) || is_null($book))
        {
            return redirect()->back()->withErrors("Either the student's email or the book's isbn is incorrect");
        }
        if($student->getStatus($book->id) != 2)
        {
            return redirect()->back()->withErrors('The student is not in possession of this book');
        }
        else
        {
            $this->update_receive($student->id, $book->id);
        }
    }

    /**
     * Helper function to update database(RECEIVE)
     * @param $student_id
     * @param $book_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_receive($student_id, $book_id)
    {
        try{
            $student = User::findOrFail($student_id);
            $book = Book::findOrFail($book_id);
        }catch (Exception $exception){
            abort(403);
        }finally{
            $student->transact()->detach($book_id);
            flash()->success('The book titled "'.$book->title .'" has been received from '.$student->name);
            return redirect()->back();$student->transact()->detach($book_id);
            flash()->success('The book titled "'.$book->title .'" has been received from '.$student->name);
            return redirect()->back();
        }

    }

    /**
     * Helper function to delete comment
     * @param $comment_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete_comment($comment_id)
    {
        try{
            $comment = Comment::findOrFail($comment_id);
        }catch (Exception $exception){
            abort(403);
        }finally{
            $comment->delete();
            flash()->success('Comment deleted');
            return redirect()->back();
        }
    }

    /**
     * Handle request to give out book to student
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function do_loan(Request $request)
    {
        $this->validate($request, ['student_number'=>'required|email', 'isbn'=>'required|numeric']);
        $student = User::where('email', $request->input('student_number'))->first();
        $book = Book::where('isbn', $request->input('isbn'))->first();
        if(is_null($student) || is_null($book))
        {
             return redirect()->back()->withErrors("Either the student's email or the book's isbn is incorrect.");
        }
        if($book->getStock() < 1)
        {
            return redirect()->back()->withErrors("No available copies of this book,");
        }
        if($student->getStatus($book->id) == 2)
        {
            return redirect()->back()->withErrors('The student is already in possession this book');
        }
        else
        {
            $this->update_loan($student->id, $book->id);
        }
    }

    /**
     * Helper function to update database(LOAN)
     * @param $student_id
     * @param $book_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_loan($student_id, $book_id)
    {
        try
        {
            $student = User::findOrFail($student_id);
            $book = Book::findOrFail($book_id);
        }catch (Exception $exception){
            abort(403);
        }finally{
            $student->transact()->sync([$book->id => ['type' => 'loan', 'expires' => Carbon::now()->addDays(5), 'status' => 2]], false);
            flash()->success('The book titled "'.$book->title .'" has been loaned out to '.$student->name);
            return redirect()->back();
        }
    }

    /**
     * If image was successfully uploaded save image and return path to image, else return null.
     * @param AddBookRequest $request
     * @return string|null
     */
    private function imageUpload(AddBookRequest $request)
    {
        if ($request->hasFile('attachment')){
            if ($request->file('attachment')->isValid())
            {
                $path = public_path('uploads/'.strtolower(Input::get('author')['first_name'].'_'.strtolower(Input::get('author')['last_name'])));
                if(!File::exists($path)){
                    File::makeDirectory($path);
                }
                $name = uniqid($request->isbn, false);
                Image::make($request->file('attachment'))->fit(447, 447)->save($path.'/'.$name.'.jpg');
                return 'uploads/'.strtolower(Input::get('author')['first_name'].'_'.Input::get('author')['last_name']).'/'.$name.'.jpg';
            }
            else{
                return null;
            }
        }
        else{
            return null;
        }
    }

    /**
     * Delete the image file for this book in uploads to enable edit
     * @param $book
     */
    private function deleteImage($book)
    {
        if(File::exists($book->image))
        {
            File::delete($book->image);
        }
    }

    /**
     * Take input of keywords and return search result from elastic search
     * @param $input
     * @param $type
     * @return array
     */
    private function handleElasticSearch($input, $type)
    {
        $query = $this->getQuery($input, $type);
        $searchResults = SearchIndex::getResults($query);
        return $this->getObjAndTotal($searchResults, $type);
    }

    /**
     * Return a well-generated elasticsearch query
     * If query is search parameters is empty, return query to...
     * retrieve all values
     * @param $search
     * @param $type
     * @return array
     */
    private function getQuery($search, $type){
        if(!empty($search)) {
            return [
                'body' =>
                    [
                        'from' => 0,
                        'size' => 500,
                        'query'=>
                            [
                                'filtered' =>
                                    [
                                        'filter' =>
                                            [
                                                'type' =>
                                                    [
                                                        'value'=> $type
                                                    ]
                                            ],
                                        'query' =>
                                            [
                                                'fuzzy_like_this' =>
                                                    [
                                                        '_all' =>
                                                            [
                                                                'like_text' => $search,
                                                                'fuzziness' => 'AUTO',
                                                            ],
                                                    ],
                                            ]
                                    ]
                            ]

                    ],

            ];
        }
        else
        {
            return [
                'body' =>
                    [
                        'query' =>
                            [
                                'filtered' =>
                                    [
                                        'query' =>
                                            [
                                                'match_all' => []
                                            ],
                                        'filter' =>
                                            [
                                                'type' =>
                                                    [
                                                        'value'=> $type
                                                    ]
                                            ]
                                    ]
                            ]
                    ]
            ];
        }

    }

    /**
     * Extract total hits and Object ids from returned array
     * @param $searchResults
     * @param $type
     * @return array
     */
    private function getObjAndTotal($searchResults, $type)
    {
        if($type == 'book')
        {
            $book = array();
            foreach($searchResults['hits']['hits'] as $hit){
                try
                {
                    $book[] = Book::findOrFail($hit['_id']);
                }catch (Exception $exception){
                    abort(503);
                }
            }
            return (['hits' => $book]);
        }
        if($type == 'user')
        {
            $user = array();
            foreach($searchResults['hits']['hits'] as $hit){
                try
                {
                    $user[] = User::findOrFail($hit['_id']);
                }catch (Exception $exception){
                    abort(503);
                }
            }
            return (['hits' => $user]);
        }

    }

}
