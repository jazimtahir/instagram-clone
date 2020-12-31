@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="row">
                <div class="col-12 col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-100">
                </div>
            </div>
            <div class="row pt-2 pb-4">
                <div class="col-12 col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                    <p>
                        <span class="font-weight-bold">
                            <a href="{{ URL::to('/') }}/{{$post->user->username}}">
                                <span class="text-dark">{{ $post->user->username }} </span>
                            </a>
                         </span>
                            {{ $post->caption }}
                    </p>
                    <div class="d-flex">
                        <div>
                            <like-button url="{{ url('/') }}" post-id="{{ $post->id }}" like="{{ (auth()->user()) ? auth()->user()->liked->contains($post->id) : false }}"></like-button>
                        </div>
                        <div class="ml-2">
                            <a href="{{ url('/') }}/p/{{ $post->id }}">
                                <i class="far fa-comment" style="font-size:30px; color: black"></i>
                            </a>
                        </div>
                        <div class="ml-2 font-weight-bold">
                            {{ $post->likes->count() }} Likes
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
