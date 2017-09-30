@extends('layouts.main')
@section('body')
    <div class="container addTopMargin">
        <div class="row">
                <h2 class="main-title">Check all your uploaded cases here.</h2>
                <?php
                $users = App\hackModel::where('userid',Auth::user()->id)->get();
                foreach($users as $case) { ?>
            <div class="col-md-6 addBottomMargin">
                <div class="latestnews">
                    <img src="https://i.imgur.com/R9J2bFi.png" class="img-small">
                    <p class="name">@if($case->anonymous == 1) {{'Anonymous'}} @else {{ Auth::user()->name}}@endif</p>
                    <p class="place">&mdash; {{$case->place}}, {{$case->created_at}}</p>
                    <p class="culprit"><strong>{{'Report submitted against: '}}</strong><strong style="color: #ff1a1a">{{$case->officer}}</strong></p>
                    <p class="service"><strong>Service: </strong><strong style="color: #ff1a1a0;">{{$case->service}}</strong></p>
                    <p class="category"><strong>Category: {{$case->category}}</strong></p>
                    <p class="subcat"><strong>Sub-Category: {{$case->subcat}}</strong></p>
                    <p class="proof">
                        <strong>Proof uploaded:</strong>
                            @if($case->proof == 0)
                                {{'No'}}
                            @else
                                {{'Yes'}}
                            @endif
                    </p>
                    <p class="case" style="display: block">Case: {{$case->case}}</p>
                </div>
            </div>
                <?php
                } ?>
    </div>
    </div>
@endsection