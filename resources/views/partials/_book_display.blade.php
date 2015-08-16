<div class="container" id ="container_main">

    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-none">
                @if(isset($status))
                    {{ $status }} Books <small>Library wide</small>
                @else
                    Search Results
                @endif
            </h2>
            <p>{{ sizeof($books) }} result(s) returned</p>
            @if(sizeof($books) == 0  && !isset($status))
                <a class="mb-xs mt-xs btn btn-default" href="{{ URL::previous() }}">
                    <i class="fa fa-chevron-left"></i> Back
                </a>
            @endif
        </div>
    </div>

    @forelse(array_chunk($books, 4) as $row)

        <div class="row mb-xlg">

            @foreach($row as $book)

                <div class="col-md-3">
                    @if(auth()->user()->role == 1)
                        <a class="thumb-info thumb-info-lighten" href="{{ url('admin/'.$book->id.'/show') }}">
                    @else
                        <a class="thumb-info thumb-info-lighten" href="{{ url('student/'.$book->id.'/show') }}">
                    @endif
                        <span class="thumb-info-wrapper">
                            <img src="{{ !empty($book->image) ? url($book->image) : asset('img/projects/project-1.jpg')}}" class="img-responsive" alt="{{ $book->title }}">
                            <span class="thumb-info-title">
                                <span class="thumb-info-inner">{{ $book->title }}</span>
                                <span class="thumb-info-type">{{ $book->getAuthor() }}</span>
                            </span>
                        </span>
                    </a>
                </div>

            @endforeach

        </div>

    @empty
        @if(isset($status))
            <div class="alert alert-warning alert-lg">
                No books returned
            </div>
        @endif
    @endforelse


</div>