@extends('layouts.app')

@section('content')
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

                        <!-- Statuses -->
            @foreach ($statuses as $status)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $status->user->name }}</h5>
                        <p class="card-text">{{ $status->body }}</p>
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
