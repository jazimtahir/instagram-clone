@extends('layouts.app')

@section('content')
    <div id="app" class="container">
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
                                    <follow-button user-id="{{ $post->user->id }}" follow="{{ $follow }} " url="{{ url('/') }}"></follow-button>
                                @else
                                    @if(auth()->user()->id != $post->user->id)
                                        <follow-button user-id="{{ $post->user->id }}" follow="{{ $follow }}" url="{{ url('/') }}"></follow-button>
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
        <div class="row mt-2">
            <div class="col-12 col-sm-8 offset-sm-2  col-md-6 offset-md-3 d-flex">
                <div>
                    <like-button url="{{ url('/') }}" post-id="{{ $post->id }}" like="{{ (auth()->user()) ? auth()->user()->liked->contains($post->id) : false }}"></like-button>
                </div>
                <div class="ml-2 font-weight-bold">
                    {{ $post->likes->count() }} Likes
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 col-sm-8 offset-sm-2  col-md-6 offset-md-3">
                <comments url="{{ url('/') }}" post-id="{{ $post->id }}" user-api="{{ auth()->check() ? auth()->user()->api_token : 'NULL' }}" img-path="{{ $post->user->profile->profileImage() }}"></comments>
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

<!-- @section('scripts')
<script>

    const app = new Vue({
        el: '#app',
        data: {
            commentBox: '',
            comments: {},
            post: {!! $post->toJson() !!},
            user{!! auth()->check() ? auth()->user()->toJson() : 'NULL' !!}
        },

        mounted() {
            alert('mounted');
          this.getComments();
        },

        methods: {
            getComments() {
                axios.get('http://localhost/insta/api/posts/' + this.post.id + '/comments')
                .then((response) => {
                    this.comments = response.data
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            postComment() {
                axios.post('http://localhost/insta/api/post/' + this.post.id + '/comment', {
                    api_token : this.user.api_token,
                    body: this.commentBox
                })
                .then((response) => {
                    this.comments.unshift(response.data);
                    this.commentBox = '';
                })
                .catch(function (error) {
                    console.log(error);
                })
            }
        }
    })

</script>
@endsection -->
