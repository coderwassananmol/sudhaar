@extends('layouts.main')
@section('body')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <div class="popup">
        <div class="success"></div>
        <div class="a1">
            <div class="a2">
                <div class="a3">
                    <div class="a4">
                        <div class="a5">
                            <!-- Image credits: Pedro luis romani ruiz -->
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/7d/Pedro_luis_romani_ruiz.gif">
                            <p class="title1">Your case is uploading. <br />Please wait...</p>
                            <p class="person"></p>
                            <p class="content"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container addTopMargin">
        <div class="row">
            <h2 class="main-title">
                @if(session('language') == 'hi') {{'प्रमाण के साथ अपलोड किए गए मामलों को यहाँ देखें। '}} @else {{'Check all your cases here with proof uploaded. Please note that you can only request for petitions for cases where proof is uploaded.'}} @endif</h2>
            <?php
            $users = App\hackModel::where([
                ['userid','=',Auth::user()->id],
                ['proof','=','1'],
                ['officer','<>',NULL]
                ])->get();
            foreach($users as $case) { ?>
            <form action="/generatepetition" method="POST">
                <div class="col-md-6 addBottomMargin">
                    {{csrf_field()}}
                    <div class="latestnews petition{{$case->id}}">
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
            </form>
            <script>
                var genderuser;
                var gendercul;
                $.ajax({
                    url: 'https://gender-api.com/get?name={{strstr(Auth::user()->name,' ',true)}}&key=cMKgYMcyUuoFvHFNYF',
                    dataType:'json',
                    type: 'get',
                    encode: true
                })
                    .done(function (data) {
                        genderuser = data.gender;
                        console.log(genderuser);
                    })
                    .fail(function (data) {
                        console.log(data);
                    });
                $.ajax({
                    url: 'https://gender-api.com/get?name={{strstr($case->officer,' ',true)}}&key=cMKgYMcyUuoFvHFNYF',
                    dataType:'json',
                    type: 'get',
                    encode: true
                })
                    .done(function (data) {
                        gendercul = data.gender;
                        console.log(gendercul);
                    })
                    .fail(function (data) {
                        console.log(data);
                    });
                $('.petition{{$case->id}}').on('mouseover',function () {
                    $(this).addClass('petition');
                });
                $('.petition{{$case->id}}').on('click',function(){
                    var formData = {
                        'name' : '@if($case->anonymous == 1) {{'Anonymous'}} @else {{ Auth::user()->name}} @endif',
                        'place': '{{$case->place}}',
                        'culprit' : '{{$case->officer}}',
                        'service' : '{{$case->service}}',
                        'date' : '{{$case->created_at}}',
                        'category': '{{$case->category}}',
                        'subcat' : '{{$case->subcat}}',
                        'case' : '{{$case->case}}',
                        'genderuser' : genderuser,
                        'gendercul' :  gendercul,
                        '_token': $('input[name="_token"]').val()
                    };
                    $('.popup').fadeIn();
                    $.ajax({
                        url : '/generatepetition',
                        data: formData,
                        type: 'POST',
                        dataType: 'json',
                        encode: 'true'
                    })
                        .done(function (data) {
                            $('.a5 img').attr('src','https://thumbs.gfycat.com/ShyCautiousAfricanpiedkingfisher-max-1mb.gif');
                            $('.a5 p.title1').html('Please download the PDF file generated.');
                            console.log(data);

                            var doc = new jsPDF();

                            doc.text('Petition!', 10, 10);
                            doc.text('Title: ' + data[0], 10, 40);
                            doc.text('Person: ' + data[1], 10, 70);
                            doc.text('Case: ' + data[2],10,90);
                            doc.save('petition.pdf');
                        })
                        .fail(function (data) {
                            console.log(data);
                        });
                });
            </script>
            <?php
            } ?>
        </div>
    </div>
@endsection