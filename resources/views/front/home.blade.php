@extends('layouts.blog-home')

@section('content')

    <div class="row">
            <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- First Blog Post -->
            @if($posts)
                @foreach($posts as $post)
            <h2>
                <a href="{{route('home.post',$post->slug)}}">{{$post->title}}</a>
            </h2>
            <p class="lead">
                by <code>{{$post->user->name}}</code>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
            <hr>
            <img class="img" height="300" width="700" src="{{$post->image_placeholder()}}" alt="">
            <hr>
            <p>{!! str_limit($post->body,50) !!}</p>
            <a class="btn btn-primary" href="{{route('home.post',$post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
                @endforeach
            
            <!-- Pagination -->
            <div class="row">
                <div class="col-sm-6 col-sm-offset-8">
                    {{$posts->links()}}
                </div>
            </div>

            @endif
        </div>

            <!-- Sidebar -->
         @include('front.home_sidebar_nav')

    </div>
        <!-- /.row -->

    <hr>














<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
