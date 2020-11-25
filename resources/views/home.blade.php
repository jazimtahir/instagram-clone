@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4 col-xs-6 col-sm-5 col-md-2 offset-md-2">
            <img src="image/default.png" style="max-height: 150px;" class="rounded-circle img-fluid">
        </div>
        <div class="col-8 col-xs-6 col-sm-7 col-md-8">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username }}</h1>
                <a class="btn btn-outline-primary" href="p/create">Add Post</a>
            </div>
            <div class="d-flex">
                    <div class="pr-4"><strong>12</strong> posts</div>
                    <div class="pr-4"><strong>34</strong> followers</div>
                    <div class="pr-4"><strong>87</strong> following</div>
            </div>
            <div class="pt-4"><strong>{{ $user->profile->title }}</strong></div>
            <div class="pt-2">{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <img src="https://www.macworld.co.uk/cmsdata/features/3681000/how-to-upload-full-size-photos-instagram-iphone-main_thumb1200_4-3.png" class="w-100 pt-4">
        </div>
        <div class="col-4">
            <img src="https://www.macworld.co.uk/cmsdata/features/3681000/how-to-upload-full-size-photos-instagram-iphone-main_thumb1200_4-3.png" class="w-100 pt-4">
        </div>
        <div class="col-4">
            <img src="https://www.macworld.co.uk/cmsdata/features/3681000/how-to-upload-full-size-photos-instagram-iphone-main_thumb1200_4-3.png" class="w-100 pt-4">
        </div>
        <div class="col-4">
            <img src="https://www.macworld.co.uk/cmsdata/features/3681000/how-to-upload-full-size-photos-instagram-iphone-main_thumb1200_4-3.png" class="w-100 pt-4">
        </div>
    </div>
</div>
@endsection
