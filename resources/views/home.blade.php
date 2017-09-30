@extends('layouts.main')

@section('body')
<div class="container addTopMargin">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center fileupload">Welcome, {{Auth::user()->name}}!</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="main-title">What would you like to do today?</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <a href="/document">
                        <button class="create-button addBottomMargin">Report a new person/organization</button>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/report">
                        <button class="create-button addBottomMargin">View your existing case(s)</button>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/generatepetition">
                        <button class="create-button">Generate a petition (under construction)</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
