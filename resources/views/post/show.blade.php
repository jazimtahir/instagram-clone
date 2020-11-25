@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3">
                    <div>
                        <div class="d-flex align-items-center">
                            <div class="pr-3">
                                <img src="{{ $post->user->profile->profileImage() }}" style="max-height: 45px; max-width: 45px" class="rounded-circle img-fluid">
                            </div>
                            <div>
                                <div class="font-weight-bold ">
                                    <a href="{{ URL::to('/') }}/{{$post->user->username}}"><span class="text-dark">{{ $post->user->username }}</span> </a>
                                </div>
                            </div>
                            <div>
                                @if(auth()->user() == NULL)
                                    <follow-button user-id="{{ $post->user->id }}" follow="{{ $follow }}"></follow-button>
                                @else
                                    @if(auth()->user()->id != $post->user->id)
                                        <follow-button user-id="{{ $post->user->id }}" follow="{{ $follow }}"></follow-button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p>
                        <span class="font-weight-bold">
                            <a href="{{ URL::to('/') }}/{{$post->user->username}}">
                                <span class="text-dark">{{ $post->user->username }} </span>
                            </a>
                        </span>
                        {{ $post->caption }}
                    </p>
                </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2  col-md-6 offset-md-3">
                <img src="{{ asset('storage/' . $post->image) }}" class="w-100">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 pt-2">
                @can('update', $post->user->profile)
                    <hr>
                        <div class="d-flex justify-content-start">
                            <div>
                                <a href="{{ $post->id }}/edit" class="btn btn-sm btn-outline-dark mr-2">Edit</a>
                            </div>
                            <div>
                                <form action="{{ $post->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger mr-2">Delete</button>
                                </form>
                            </div>
                        </div>
                @endcan
            </div>
        </div>
    </div>
@endsection














{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row">--}}
{{--        <div class="col-5 offset-1">--}}
{{--            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid">--}}
{{--        </div>--}}
{{--        <div class="col-6 d-flex">--}}
{{--            <div>--}}
{{--                <img src="../image/default.png" style="max-height: 50px;" class="rounded-circle img-fluid">--}}
{{--            </div>--}}
{{--            <div class="p-2">--}}
{{--                <a href="{{URL::to('/')}}">--}}
{{--                    <p><strong>{{ $post->user->username }}</strong></p>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
