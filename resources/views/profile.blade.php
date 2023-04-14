@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-4">
    <!-- Profile Picture -->
    <div class="card mb-3">
        <div class="card-body">
            @if (auth()->user()->profile_picture)
                <img src="{{ asset('profile_pictures/' . auth()->user()->profile_picture) }}" class="rounded-circle mx-auto d-block img-fluid" alt="Profile Picture">
            @else
                <img src="{{ asset('storage/profile_pictures/default.png') }}" class="rounded-circle mx-auto d-block img-fluid" alt="Default Profile Picture">
            @endif
            <h5 class="card-title">Welcome! <strong>{{ auth()->user()->name }}</strong></h5>
            <p class="card-text"><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Edit Profile</a>
        </div>
    </div>
</div>


        <div class="col-md-8">
            <!-- User Info -->
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"> <strong>Post you have shared until now!</strong></h5>
                </div>
            </div>
            <!-- User Posts -->
                        <!-- Statuses -->
            @if($statuses->isEmpty())
                <div class="card mb-3">
                    <div class="card-body">
                        <p>No status shared yet</p>
                    </div>
                </div>

            @else 
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

                            <small class="text-muted">{{ $status->created_at->format('H:i d/m/Y') }}</small>
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

            @endif
        </div>
    </div>
</div>
@endsection
