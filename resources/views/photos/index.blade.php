@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-3">
        <div class="col-md-1">
            <a href="{{route('photos.create')}}" class="btn btn-dark btn-block">+</a>
        </div>
        <div class="col-11">
            <h3>Galery</h3>
        </div>
    </div>
    @foreach ($user->photos as $key => $photos)
    <div class="row">
        <h5>{{$key}}</h5>
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
    @endforeach
</div>
@endsection