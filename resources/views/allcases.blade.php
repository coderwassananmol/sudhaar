@extends('layouts.main')
@section('body')
    <div class="popup">
        <div class="success"></div>
        <div class="a1">
            <a href="#"><img src="https://digiday.com/wp-content/themes/digiday/static/images/icon_close-white.svg" height="50px" width="50px" style="float: right"></a>
            <div class="a2">
                <div class="a3">
                    <div class="a4">
                        <div class="a5">
                            <!-- Image credits: Pedro luis romani ruiz -->
                            <p class="name"></p>
                            <p class="place"></p>
                            <p class="date"></p>
                            <p class="culprit"></p>
                            <p class="service"></p>
                            <p class="type"></p>
                            <p class="category"></p>
                            <p class="case"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function rating(caseid)
        {
            function getRate()
            {
                $.ajax({
                    url : '/getRate',
                    type : 'GET',
                    data : {'caseid' : caseid},
                    dataType : 'JSON',
                    encode : true
                })
                    .done(function (data) {
                        console.log(data[0].total_rating);
                        $('#rateYo'+caseid).tooltip({
                            trigger : 'manual',
                            title : data[0].total_rating,
                            placement : 'left'
                        });
                        $('#rateYo'+caseid).tooltip("show");
                    })
                    .fail(function (data) {
                        console.log(data);
                    });
            }
            function checkRate()
            {
                        @if(!Auth::guest())
                var data = {
                        'id' : {{Auth::user()->id}},
                        '_token'  : $('input[name="_token"]').val()
                    };
                $.ajax({
                    url : '/checkRate',
                    data : data,
                    type : 'GET',
                    dataType : 'JSON',
                    encode: true
                })
                    .done(function (data) {
                        console.log(data);
                        $.each(data,function (key,value) {
                            var rateyo = $('#rateYo'+value);
                            rateyo.rateYo('option','rating',5);
                            rateyo.rateYo('option','readOnly',5);
                        });
                    })
                    .fail(function (data) {
                        console.log(data);
                    });
                @endif
            }
            getRate();
            checkRate();
            var rateYo = $('#rateYo'+caseid).rateYo({
                starWidth: "40px",
                numStars: 1,
                fullStar: true
            });
            $(rateYo).on('click',function () {
                var rating = rateYo.rateYo("rating");
                var formData = {
                    'rating' : rating,
                    '_token'  : $('input[name="_token"]').val(),
                    'caseid'  : caseid
                };
                $.ajax({
                    url : '/rate',
                    type: 'POST',
                    data: formData,
                    dataType : 'JSON',
                    encode: true
                })
                    .done(function (data,statusText,xhr) {
                        console.log(data);
                        if(data.error)
                            alert(data.error);
                        else
                            $('#rateYo'+caseid).attr('title',data.success).tooltip('fixTitle').tooltip('show');


                    })
                    .fail(function (data,statusText,xhr) {
                        if(xhr == 'Unauthorized')
                            window.location.href= '/login';
                        console.log(data);
                    });
            });
        }
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-push-1">
                <div class="col-md-12">
                    <input type="text" id="search" class="form-control form-input-text" placeholder="Search for any case here..">
                </div>
            </div>
        </div>
        <br /><br />
        <div class="row">
            <div class="cases">

                <!-- Getting all the data from database and printing it -->
                <?php
                use App\hackModel;
                use App\User;
                $hackmodel = new hackModel;
                $usermodel = new User;
                $i = -1;
                $users = $hackmodel->orderBy('id','desc')->get();
                foreach($users as $case) {
                    $i++;
                $name = $usermodel->where('id',$case->userid)->get(['name']);
                ?>
                @if($i%2==0)
                    <div class="row">
                        @endif
                        <div class="col-md-6">
                            <div class="latestnews" id="case{{$case->id}}">
                                <img src="https://i.imgur.com/R9J2bFi.png" class="img-small">
                                <p class="name">@if($case->anonymous == 1) @if(session('language') == 'hi') {{'गुमनाम'}} @else {{'Anonymous'}} @endif @else {{$name[0]['name']}}@endif</p>
                                <div id="rateYo{{$case->id}}"></div>
                                {{csrf_field()}}
                                <p class="place">&mdash; {{$case->place}}, {{$case->created_at}}</p>
                                <div class="col-md-6">
                                    <p class="type"><strong> @if(session('language') == 'hi') {{'श्रेणी:'}} @else {{'Category:'}} @endif {{$case->category}}</strong></p>
                                </div>
                                <button type="button" onclick="showPopup('@if($case->anonymous == 1) @if(session('language') == 'hi') {{'गुमनाम'}} @else {{'Anonymous'}} @endif @else {{$name[0]['name']}}@endif','{{$case->place}}','{{$case->created_at}}','{{$case->officer}}','{{$case->service}}','{{$case->category}}','{{$case->subcat}}','{{$case->case}}')" class="create-button" style="float: right; display: inline;">@if(session('language') == 'hi') {{'अधिक पढ़ें..'}} @else {{'Read more..'}} @endif</button>
                            </div>
                        </div>
                        <script>rating({{$case->id}});</script>
                        @if($i%2 != 0)
                    </div>
                @endif
                <?php
                } ?>
            </div>
        </div>
    </div>
    <script>
        $('#search').on('change paste keyup',function () {
            var data = {
                'value' : $(this).val()
            };
            $.ajax({
                url : '/allcases/search',
                type : 'GET',
                data : data,
                dataType: 'JSON',
                encode: true
            })
                .done(function (data) {
                    $('.latestnews').hide();
                    $(data).each(function() {
                        if($('#case'+this.id).attr('id').substring(4) == this.id)
                            $('#case'+this.id).show();
                    });
                })
                .fail(function (data) {
                    console.log(data);
                });
        });
    </script>
    <script>
        function showPopup(name,place,date,culprit,service,category,subcategory,case1) {
            $('.a1 .a2 .a3 .a4 .a5 .name').html('@if(session('language') == 'hi') {{'नाम:'}} @else {{'Name:'}} @endif <strong style="color: #ff1a1a">' + name + "</strong>");
            $('.a1 .a2 .a3 .a4 .a5 .place').html('@if(session('language') == 'hi') {{'जगह:'}} @else {{'Place:'}} @endif <strong style="color: #ff1a1a">' + place + "</strong>");
            $('.a1 .a2 .a3 .a4 .a5 .date').html('@if(session('language') == 'hi') {{'तारीख:'}} @else {{'Date:'}} @endif <strong style="color: #ff1a1a">' + date + "</strong>");
            $('.a1 .a2 .a3 .a4 .a5 .culprit').html('@if(session('language') == 'hi') {{'किसके खिलाफ:'}} @else {{'Report submitted against:'}} @endif <strong style="color: #ff1a1a">' + culprit + "</strong>");
            $('.a1 .a2 .a3 .a4 .a5 .service').html('@if(session('language') == 'hi') {{'सेवा:'}} @else {{'Service:'}} @endif <strong style="color: #ff1a1a">' + service + "</strong>");
            $('.a1 .a2 .a3 .a4 .a5 .type').html('@if(session('language') == 'hi') {{'श्रेणी:'}} @else {{'Category:'}} @endif <strong style="color: #ff1a1a">' + category + "</strong>");
            $('.a1 .a2 .a3 .a4 .a5 .category').html('@if(session('language') == 'hi') {{'उप-श्रेणी:'}} @else {{'Sub-Category:'}} @endif <strong style="color: #ff1a1a">' + subcategory + "</strong>");
            $('.a1 .a2 .a3 .a4 .a5 .case').html('@if(session('language') == 'hi') {{'घटना:'}} @else {{'Case:'}} @endif <strong style="color: #ff1a1a">' + case1 + "</strong>");
            $('.popup').show();
            $('.a1 a').on('click', function () {
                $('.popup').fadeOut();
            });
            $(document).keypress(function (event) {
                if (event.keyCode === 27)
                    $('.popup').fadeOut();
            });
        }
    </script>
@endsection