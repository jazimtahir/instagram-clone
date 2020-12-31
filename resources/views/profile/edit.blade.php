@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <div class="row d-flex justify-content-center">
            <h1>Edit Profile</h1>
        </div>
        <hr>
        <div class="d-flex justify-content-center">
            <img src="{{ $user->profile->profileImage() }}" style="max-height: 150px;" class="rounded-circle img-fluid">
        </div>
        <div class="d-flex justify-content-center">
            <a href="#" data-toggle="modal" data-target="#profilepic">Change Profile Picture</a>
            <!---->
            <div class="modal fade" id="profilepic">
                <div class="modal-dialog  modal-sm">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title align-items-center">Update Profile Pic</h5>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="d-flex justify-content-center">
                                <a href="#">Change Profile Pic</a>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-center">
                                <a href="" class="text-danger" data-dismiss="modal" data-toggle="modal" data-target="#confirm-delete">Remove Profile Pic</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---->
            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            Are You Sure ?
                        </div>
                        <div class="modal-body d-flex justify-content-around">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <form action="{{ url('/') . "/" . $user->id }}/pic/delete" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-ok">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!---->
        </div>
    </div>
    <form action="{{URL::to('/')}}/{{ $user->username }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 offset-2">
                <div class="form-group row">

                    <label for="title" class="col-md-4 col-form-label">{{ __('Title') }}</label>
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}"  autocomplete="title" autofocus>
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">

                    <label for="description" class="col-md-4 col-form-label">{{ __('Description') }}</label>
                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description')  ?? $user->profile->description }}"  autocomplete="description" autofocus>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">

                    <label for="url" class="col-md-4 col-form-label">{{ __('URL') }}</label>
                    <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url')  ?? $user->profile->url }}"  autocomplete="url" autofocus>
                    @error('url')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">{{ __('Update Profile Image') }}</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    @error('image')

                    <strong>{{ $message }}</strong>

                    @enderror
                </div>
                <div class="row pt-4">
                    <button class="btn btn-primary" type="submit" >Save Profile</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
