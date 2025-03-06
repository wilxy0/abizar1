@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-1">
            <a href="{{route('photos.create')}}" class="btn btn-dark btn-block">+</a>
        </div>
        <div class="col-11">
            <h3>Galery</h3>
        </div>
    </div>
    <div class="row">
    @forelse ($photos as $photo)
        <div class="col-md-2">
            <div class="card">
                <img src="{{asset('photo/'. $photo->filename)}}" alt="">
                <div class="card-body">
                    <form action="{{route('photos.destroy',$photo->id)}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        
    @endforelse
    </div>
</div>
@endsection