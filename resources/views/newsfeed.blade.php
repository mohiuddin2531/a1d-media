@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/newsfeedStyle.css') }}">
</head>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar -->
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Sidebar</h5>
                    <p class="card-text">This is the sidebar.</p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <!-- News Feed -->
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">News Feed</h5>
                    <p class="card-text">This is the news feed.</p>

                    <form method="POST" action="{{ route('postStatus') }}">
                        @csrf
                        <div class="form-group">
                            <textarea name="status" class="form-control" placeholder="What's on your mind?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                                        
                </div>
            </div>


            @foreach ($statuses as $status)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('profile_pictures/'.$status->user->profile_picture) }}" class="rounded-circle" width="50" height="50">
                            <h5 class="card-title"> &nbsp;&nbsp;&nbsp;{{ $status->user->name }}</h5>
                            <br>
                            <br>
                        </div>

                        
                        <p class="card-text">{{ $status->body }}</p>

                        <!-- <small class="text-muted">{{ $status->created_at->diffForHumans() }}</small> -->
                        <small class="text-muted">{{ $status->created_at->format('H:i d/m/Y') }}</small>
                        <form method="post" action="{{ route('react_status', $status->status_id) }}">
                            @csrf
                            @php $user_react = $user_reactions->get($status->id) @endphp
                            <button type="submit" name="reaction" value="like" class="btn btn-outline-primary">Like</button>
                            <button type="submit" name="reaction" value="love" class="btn btn-outline-primary">Love</button>
                            <button type="submit" name="reaction" value="haha" class="btn btn-outline-primary">Haha</button>
                            <button type="submit" name="reaction" value="wow" class="btn btn-outline-primary">Wow</button>
                            <button type="submit" name="reaction" value="sad" class="btn btn-outline-primary">Sad</button>
                            <button type="submit" name="reaction" value="angry" class="btn btn-outline-primary">Angry</button>
                        </form>
                    </div>
                </div>
            @endforeach




                <!-- Load more button -->
            @if ($statuses->hasMorePages())
                <div class="d-flex justify-content-center">
                    <div class="mt-3">
                        <a href="{{ $statuses->nextPageUrl() }}" class="btn btn-primary">Load More</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
