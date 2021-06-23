@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 col-lg-3 mb-3 left_sidebar">
            <div class="card" style="position:sticky;top:0">
                <div class="card-body">
                    <div class="mr-2 d-flex align-items-center">
                        <img class="rounded-circle mr-1" width="50" height="50" src="{{ asset('images/user.JPG') }}" alt="">
                        <div class="h5 ">&#64;{{Auth::user()->username}}</div>
                    </div>
                    <hr style="border: 1px solid #000">
                    <div class="h7 text-muted">Fullname : {{Auth::user()->name}}</div>
                    <div class="h7">Developer of web applications, JavaScript, PHP, Python,
                    etc.
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="h6 text-muted">Followers</div>
                        <div class="h5">52342</div>
                    </li>
                    <li class="list-group-item">
                        <div class="h6 text-muted">Following</div>
                        <div class="h5">4000</div>
                    </li>
                    @if ($posts ->count())
                        <li class="list-group-item">
                            <div class="h6 text-muted">Total Posts</div>
                            <div class="h5">{{$posts ->count()}} {{ Str::plural('post', $posts->count())}}</div>
                        </li>
                    @endif
                    <li class="list-group-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm font-weight-bold btn-default">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="mb-3">
                <form action="{{ route('post') }}" method="POST">
                    @csrf
                    <textarea name="body" id="body" rows="3" class="form-control @error('body') is-invalid @enderror" placeholder="What's in your mind?" autofocus></textarea>
                    @error('body')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="mt-2">
                        <input type="submit" value="Publish" class=" btn btn-info text-white">
                    </div>
                </form>
            </div>
            @if ($posts ->count())
                @foreach ($posts as $post)
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('profile', $post->user->username) }}" class="ml-2" style="display:flex; justify-content:center;align-items:center;text-decoration:none;cursor:pointer">
                                        <img src="{{ asset('images/user.JPG') }}" style="width:50px; height:50px; border-radius:50%" alt="profile">
                                        <div class="h5 ml-2">{{ $post->user->name }} <span class="text-muted" style="color:grey; font-size:16px">&#64;{{ $post->user->username}} - <i class="fa fa-clock-o"></i><span style="color:darkorange;font-size:14px">{{ $post->created_at->diffForHumans() }}</span></span></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <a class="card-link" style="text-decoration:none; color:black" href="#">
                                <p class="card-text">
                                    {{ $post->body }}
                                </p>
                            </a>
                        </div>
                        <div class="card-footer" style="display: flex;">
                        @auth 
                            @if (!$post->likedBy(auth()->user()))
                                <form action="{{ route('posts.likes', $post) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-sm text-info font-weight-bold ">Like</button>
                                </form>
                            @else
                                <form action="{{ route('posts.likes', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-default btn-sm font-weight-bold" style="color:darkviolet">Unlike</button>
                                </form>
                            @endif
                            @can('delete', $post)
                                <form action="{{ route('post.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-default btn-sm text-danger font-weight-bold ">Delete</button>
                                </form>
                            @endcan
                        @endauth
                            <span class="btn btn-default btn-sm text-success"> {{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count())}}</span>
                        </div>
                    </div>
                @endforeach

                {{ $posts->links() }}
            @else
                <p>There are no posts!!!</p>
            @endif
        </div>
        <div class="col-md-3 col-lg-3 right_sidebar">
            <div class="card" style="position:sticky;top:0">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up thebulk of the
                    card's content.</p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
