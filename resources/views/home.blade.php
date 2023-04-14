@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                



                

                    <div class="card-deck">
                        
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Home</h5>
                                <p class="card-text">Browse to the home page.</p>
                                <a href="{{ route('newsfeed') }}" class="btn btn-primary">Go to Home</a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">User Profile</h5>
                                <p class="card-text">Browse to the user profile page.</p>
                                <a href="{{ route('showProfile') }}" class="btn btn-primary">Go to Profile</a>
                            </div>
                        </div>
                    </div>    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
