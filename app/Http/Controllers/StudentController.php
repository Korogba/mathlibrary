<?php

namespace App\Http\Controllers;

use App\Book;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Input;
use Response;
use SearchIndex;

class StudentController extends Controller
{

    /**
     * Contructor to kick out non-students from here
     *
     */
    function __construct()
    {
        $this->middleware('student');
    }

    /**
     * Display options for searching for books.
     *
     * @return Response
     */
    public function index()
    {
        return view('student.index');
    }

    /**
     * Display records of student
     *
     * @return Response
     */
    public function records()
    {
        $loaned = auth()->user()->getLoan();
        $overdue = auth()->user()->getOverdue();
        $reservation = auth()->user()->getReservations();
        return view('student.records', compact('loaned', 'overdue', 'reservation'));
    }

    /**
     * return profile of student
     *
     * @return Response
     */
    public function profile()
    {
        $user = auth()->user();
        return view('student.profile', compact('user'));
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
            }catch (Exception $exception) {
                abort(403);
            } finally {
                return view('student/search', array('results' => $paginate, 'total' => 1));
            }
        }
        $queryString = str_replace('+', ' ', $queryString);
        $results = $this->handleElasticSearch($queryString, 'book');
        $paginate = $this->paginate($results['hits'], 3);
        return view('student/search', array('results' => $paginate, 'total' => count($results['hits'])));
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
     * Handle search
     * @param Request $request
     * @return Response
     */
    public function search(Request $request)
    {
        if($request->input('form') == 'basic_search')
        {
            $this->validate($request, ['key_words'=>'required']);
            $queryString = str_replace(' ', '+', $request->input('key_words'));
            return redirect()->route('studentResults', [$queryString]);
        }
        if($request->input('form') == 'refined_search')
        {
            $isbn = $request->input('isbn', null);
            $pub = $request->input('publisher', null);
            $title = $request->input('title', null);
            $author = $request->input('author', null);
            if (!is_null($isbn)) {
                $book = Book::where('isbn', $isbn)->first();
                if (is_null($book)) {
                    $keywords = trim($pub . ' ' . $title . ' ' . $author);
                    $queryString = str_replace(' ', '+', $keywords);
                    return redirect()->route('studentResults', [$queryString]);
                } else {
                    return redirect()->route('studentResults', ['found', $book->id]);
                }
            }
        }
    }

    /**
     * Return details of a book
     *
     * @param $book_id
     * @return Response
     */
    public function show_book($book_id)
    {
        try
        {
            $book = Book::findOrFail($book_id);
        }catch (Exception $exception) {
            abort(403);
        } finally {
            $status = auth()->user()->getStatus($book->id);
            return view('student.book_details', compact('book', 'status'));
        }

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
        return redirect('/student');
    }

    /**
     * Update database and send results
     *
     * @param $book_id
     * @return Response
     */
    public function reservation($book_id)
    {
        if(auth()->user()->transact->get($book_id) != null)
        {
            auth()->user()->transact()->detach($book_id);
            flash()->success('Reservation Cancelled');
            return redirect()->back();
        }
        auth()->user()->transact()->attach($book_id, ['type' => 'reservation', 'expires' => Carbon::now()->addDays(2), 'status' => 1]);
        flash()->success('Reservation Cancelled');
        return redirect()->back();
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
        return $this->getObjAndTotal($searchResults);
    }

    /**
     * Return a well-generated elasticsearch query
     * If query is search parameters is empty, return query to
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
                                                            'fuzziness' => 0.5,
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
     * @return array
     */
    private function getObjAndTotal($searchResults)
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
}
