<div class="row">
    <div class="form-group">
        <div class="col-md-6">
            <label>Author's First Name</label>
            {{--<input type="text" name="first_name" class="form-control" placeholder="Muhammad" required>--}}
            {!! Form::text('author[first_name]', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="col-md-6">
            <label>Author's Last Name </label>
            {{--<input type="text" name="last_name" class="form-control" placeholder="Abubakar" required>--}}
            {!! Form::text('author[last_name]', null, ['class'=>'form-control', 'required']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-md-6">
            <label>Publisher's Name</label>
            {{--<input type="text" name="publishers_name" class="form-control" placeholder="MacMillan Publishers" required>--}}
            {!! Form::text('publisher[name]', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="col-md-6">
            <label>Book ISBN </label>
            {{--<input type="text" name="isbn" class="form-control" placeholder="007SD6R554991" required>--}}
            {!! Form::text('isbn', null, ['class'=>'form-control', $disabled, 'required']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-md-6">
            <label>Year Published </label>
            {{--<input type="date" name="year" class="form-control" required>--}}
            {!! Form::input('date', 'year', $book->year, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="col-md-6">
            <label>Edition Number </label>
            {{--<input type="text" name="edition" class="form-control" placeholder="4th" required>--}}
            {!! Form::text('edition', null, ['class'=>'form-control', 'required']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-md-6">
            <label>Quantity </label>
            {{--<input type="text" name="quantity" class="form-control" placeholder="10" required>--}}
            {!! Form::text('quantity', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="col-md-6">
            <label>Upload Picture</label>
            {{--<input type="file" name="attachment" id="attachment">--}}
            {!! Form::file('attachment', ['id'=>'attachment']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-md-12">
            <label>Title </label>
            {{--<input type="text" name="title" class="form-control" required placeholder="Book Title">--}}
            {!! Form::text('title', null, ['class'=>'form-control', 'required']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-md-12">
            <label>Summary </label>
            {{--<textarea name="summary" rows="3" class="form-control" required placeholder="Enter summary of book here."></textarea>--}}
            {!! Form::textarea('summary', null, ['class'=>'form-control', 'required']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <input type="submit" value="Submit" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">
    </div>
</div>



