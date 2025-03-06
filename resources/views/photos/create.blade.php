@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-1">
            <a href="{{route('photos.index')}}" class="btn btn-block">Back</a>
        </div>
        <div class="col-md-11">
            <h3>Add Photo</h3>
        </div>
    </div>
    <div class="row">
        <form action="{{route('photos.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="filename">Upload Photo</label>
                <input name="filename" class="form-control" type="file">
            </div>
            <button class="btn btn-primary">Add</button>
        </form>
    </div>
</div>
@endsection