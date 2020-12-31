@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-4 col-xs-6 col-sm-5 col-md-2 offset-md-2">
            <img src="{{ $user->profile->profileImage() }}" style="max-height: 150px;" class="rounded-circle img-fluid">
        </div>
        <div class="col-8 col-xs-6 col-sm-7 col-md-8">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-2">
                    <div class="h4">{{ $user->username }}</div>
                    @if(auth()->user() == NULL)
                        <follow-button user-id="{{ $user->id }}" follow="{{ $follow }}" url="{{ url('/') }}"></follow-button>
                    @else
                        @if(auth()->user()->id != $user->id)
                            <follow-button user-id="{{ $user->id }}" follow="{{ $follow }}" url="{{ url('/') }}"></follow-button>
                        @endif
                    @endif
                </div>
                @can('update', $user->profile)
                    <a class="btn btn-outline-primary" href="p/create">Add Post</a>
                @endcan
            </div>
            @can('update', $user->profile)
                <div class="pb-1">
                    <a class="text-primary" href="{{ $user->username }}/edit">Edit Profile</a>
                </div>
            @endcan
            <div class="d-flex">
                <div class="pr-4"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="pr-4" data-toggle="modal" data-target="#followers"><strong>{{ $user->profile->followers->count() }}</strong> followers</div>
                <div class="pr-4" data-toggle="modal" data-target="#following"><strong>{{ $user->following->count() }}</strong> following</div>

                <!-- Following Modal Start -->
                <div class="modal fade" id="following">
                    <div class="modal-dialog modal-dialog-scrollable modal-sm">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title align-items-center">Following</h5>
                                <button type="button" class="close" data-dismiss="modal">×</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                @foreach($user->following as $following)
                                    <div>
                                        <div class="row align-items-baseline">
                                            <div class="col">
                                                <a class="d-flex align-items-baseline" href="{{ $following->user->username }}">
                                                    <div class="pr-2">
                                                        <img src="{{ $following->profileImage() }}" style="max-height: 40px;" class="rounded-circle img-fluid">
                                                    </div>
                                                    <div class="text-dark font-weight-bold">
                                                        {{ $following->user->username }}
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col d-flex justify-content-end">
                                                @if(auth()->user() == NULL)
                                                    <follow-button user-id="{{ $following->user->id }}" follow="{{ $follow }}" url="{{ url('/') }}"></follow-button>
                                                @else
                                                    @if(auth()->user()->id != $following->user->id)
                                                        <follow-button user-id="{{ $following->user->id }}" follow="{{ (auth()->user()) ? auth()->user()->following->contains($following->user->id) : false }}" url="{{ url('/') }}"></follow-button>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Following Modal End -->
                <!-- Followers Modal Start -->
                <div class="modal fade" id="followers">
                    <div class="modal-dialog modal-dialog-scrollable modal-sm">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title align-items-center">Followers</h5>
                                <button type="button" class="close" data-dismiss="modal">×</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                @foreach($user->profile->followers as $follower)
                                    <div>
                                        <div class="row align-items-baseline">
                                            <div class="col">
                                                <a class="d-flex align-items-baseline" href="{{ $follower->username }}">
                                                    <div class="pr-2">
                                                        <img src="{{ $follower->profile->profileImage() }}" style="max-height: 40px;" class="rounded-circle img-fluid">
                                                    </div>
                                                    <div class="text-dark font-weight-bold">
                                                        {{ $follower->username }}
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col d-flex justify-content-end">
                                                @if(auth()->user() == NULL)
                                                    <follow-button user-id="{{ $follower->id }}" follow="{{ $follow }}" url="{{ url('/') }}"></follow-button>
                                                @else
                                                    @if(auth()->user()->id != $follower->id)
                                                        <follow-button user-id="{{ $follower->id }}" follow="{{ (auth()->user()) ? auth()->user()->following->contains($follower->id) : false }}" url="{{ url('/') }}"></follow-button>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Followers Modal End -->

            </div>
            <div class="pt-4"><strong>{{ $user->profile->title }}</strong></div>
            <div class="pt-2">{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>
    <div class="row p-2">
        @foreach($user->posts as $post)
            <div class="col-4">
                <a href="p/{{ $post->id }}">
                    <img src="storage/{{ $post->image }}" class="w-100 pt-4">
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
