@extends('layouts.main')
@section('title') DOCUMENT YOUR CASE | SHARE IT GLOBALLY | SPREAD THE WORD | LET THE GOVT HEAR
    @endsection
@section('body')
    <script src="{{asset('js/tooltip.min.js')}}" type="text/javascript"></script>
    <div class="popup">
        <div class="success"></div>
        <div class="a1">
            <div class="a2">
                <div class="a3">
                    <div class="a4">
                        <div class="a5">
                            <!-- Image credits: Pedro luis romani ruiz -->
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/7d/Pedro_luis_romani_ruiz.gif">
                            <p>Your case is uploading. <br />Please wait...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container addTopMargin" id="second">
        <div class="row">
                <form method="POST" action="/document" name="documentForm" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <h3 class="form-element-text">@if(session('language') != 'hi') {{'Choose a category'}} @else {{'कोई श्रेणी चुनें'}} @endif</h3>
                    <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <button type="button" class="create-button ns" value="Administrative" name="category1" title="It includes all the cases that come under authority level like police,political etc.">@if(session('language') != 'hi') {{'ADMINISTRATIVE'}} @else {{'प्रशासनिक'}} @endif</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="create-button ns" value="Private sector" title="It includes all the content that come under the private sector such as matters involving private companies,hospitals etc." name="category2">@if(session('language') != 'hi') {{'PRIVATE SECTOR'}} @else {{'निजी क्षेत्र'}} @endif</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="create-button ns" value="Education" name="category3" title="It involves all the matters that involves corruption in education.">@if(session('language') != 'hi') {{'EDUCATION'}} @else {{'शिक्षा'}} @endif</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="create-button ns" value="Media" name="category4" title="Category4">@if(session('language') != 'hi') {{'MEDIA'}} @else {{'मीडिया'}} @endif</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="create-button ns" value="Religious" name="category5" title="Includes all the cases that came under exploiting someone's faith for private gain.">@if(session('language') != 'hi') {{'RELIGIOUS'}} @else {{'धार्मिक'}} @endif</button>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="category1">
                            <h3 class="form-element-text">@if(session('language') != 'hi') {{'Choose a sub-category'}} @else {{'उप-श्रेणी चुनें'}} @endif</h3>
                            <button type="button" title="Misuse of power, Use of falsified evidence, Soliciting or accepting bribes, Evidence/investigation hiding" class="create-button sc" value="Police">@if(session('language') != 'hi') {{'POLICE'}} @else {{'पुलिस'}} @endif</button>
                            <button type="button" title="Soliciting and accepting bribes, Extortion,Nepotism, Influence peddling to make decision in favour of etc." class="create-button sc" value="Political">@if(session('language') != 'hi') {{'POLITICAL'}} @else {{'राजनीतिक'}} @endif</button>
                            <button type="button" class="create-button sc" value="Judicial">@if(session('language') != 'hi') {{'JUDICIAL'}} @else {{'न्यायिक'}} @endif</button>
                            <button type="button" class="create-button sc" value="Sports">@if(session('language') != 'hi') {{'SPORTS'}} @else {{'खेल'}} @endif</button>
                            <button type="button" class="create-button sc" value="Scams">@if(session('language') != 'hi') {{'SCAMS'}} @else {{'घोटाले'}} @endif</button>
                            <button type="button" class="create-button sc" value="Health">@if(session('language') != 'hi') {{'HEALTH'}} @else {{'स्वास्थ्य'}} @endif</button>
                            <button type="button" class="create-button sc" value="Gender">@if(session('language') != 'hi') {{'GENDER'}} @else {{'लिंग'}} @endif</button>
                            <button type="button" class="create-button sc" value="Govt. Officials">@if(session('language') != 'hi') {{'GOVT. OFFICIALS'}} @else {{'सरकारी अधिकारी'}} @endif</button>
                            <button type="button" class="create-button sc" value="Defence and Security">@if(session('language') != 'hi') {{'DEFENCE AND SECURITY'}} @else {{'रक्षा और सुरक्षा'}} @endif</button>
                            <button type="button" class="create-button sc" value="Water">@if(session('language') != 'hi') {{'WATER'}} @else {{'जल'}} @endif</button>
                            <button type="button" class="create-button sc" value="Information Hiding">@if(session('language') != 'hi') {{'INFORMATION HIDING'}} @else {{'जानकारी छिपाना'}} @endif</button>
                        </div>
                    <div class="category2">
                        <h3 class="form-element-text">@if(session('language') != 'hi') {{'Choose a sub-category'}} @else {{'उप-श्रेणी चुनें'}} @endif</h3>
                        <button type="button" class="create-button sc" value="Private Companies">@if(session('language') != 'hi') {{'PRIVATE COMPANIES'}} @else {{'निजी कंपनियां'}} @endif</button>
                        <button type="button" class="create-button sc" value="Health">@if(session('language') != 'hi') {{'HEALTH'}} @else {{'स्वास्थ्य'}} @endif</button>
                    </div>
                        <div class="category5">
                            <h3 class="form-element-text">Choose a sub-category:</h3>
                            <button type="button" class="create-button sc" value="Exorcism">@if(session('language') != 'hi') {{'EXORCISM'}} @else {{'झाड़-फूंक'}} @endif</button>
                            <button type="button" class="create-button sc" value="Change of religion/case">@if(session('language') != 'hi') {{'CHANGE OF RELIGION/CASTE'}} @else {{'धर्म / जाति में बदलाव'}} @endif</button>
                            <button type="button" class="create-button sc" value="Fraud">@if(session('language') != 'hi') {{'FRAUD'}} @else {{'धोखा'}} @endif</button>
                            <button type="button" class="create-button sc" value="Extortion">@if(session('language') != 'hi') {{'EXTORTION'}} @else {{'जबरन वसूली'}} @endif</button>
                        </div>

                    <h3 class="form-element-text">@if(session('language') != 'hi') {{'Where did it happen?'}} @else {{'यह कहाँ हुआ?'}} @endif</h3>
                    <input id="pac-input" class="controls form-control form-input-text" type="text" placeholder="Search Box" name="place" required>
                    <h3 class="form-element-text-nr">@if(session('language') != 'hi') {{'Name of the officer:'}} @else {{'अधिकारी का नाम:'}} @endif</h3>
                    <input type="text" class="form-input-text form-control" name="officer">
                    <h3 class="form-element-text">@if(session('language') != 'hi') {{'What service you wanted?'}} @else {{'आप क्या सेवा चाहते थे?'}} @endif</h3>
                    <input type="text" class="form-control form-input-text" name="service" required>
                    <h3 class="form-element-text">@if(session('language') != 'hi') {{'Tell us about your case..'}} @else {{'अपने मामले के बारे में हमें बताएं..'}} @endif</h3>
                    <textarea class="form-input-text form-control" name="case" required></textarea>
                    <h3 class="form-element-text-nr">@if(session('language') != 'hi') {{'Do you have a proof'}} @else {{'क्या आपके पास सबूत है?'}} @endif</h3>
                    <input type="checkbox" name="proof" value="1"><strong class="form-element-text-nr">@if(session('language') != 'hi') {{'Yes'}} @else {{'हाँ'}} @endif</strong>
                    <br />
                    <div class="proof">
                        <h3 class="form-element-text">@if(session('language') != 'hi') {{'Please upload'}} @else {{'कृपया अपलोड करें'}} @endif</h3>
                        <input type="file" class="fileupload" name="fileupload">
                    </div>
                    <h3 class="form-element-text-nr">@if(session('language') != 'hi') {{'Post Anonymously'}} @else {{'अनाम रूप से पोस्ट करें'}} @endif</h3>
                    <input type="checkbox" name="anonymous" value="1" class="form-checkbox"><strong class="form-element-text-nr">@if(session('language') != 'hi') {{'Yes'}} @else {{'हाँ'}} @endif</strong>
                    <br /><br />
                    <button type="submit" id="submit" class="create-button">@if(session('language') != 'hi') {{'SUBMIT THE CASE'}} @else {{'केस सबमिट करें'}} @endif</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container addTopMargin" id="first">
        <div class="row">
            <div class="col-md-6">
                <h1 class="main-title">@if(session('language') != 'hi') {{'DOCUMENT YOUR CASE.'}} @else {{'अपना केस दर्ज़ करें|'}} @endif</h1>
            </div>
            <div class="col-md-6">
                <h1 class="main-title">@if(session('language') != 'hi') {{'SHARE IT GLOBALLY.'}} @else {{'विश्व स्तर पर इसे साझा करें|'}} @endif</h1>
            </div>
            <div class="col-md-6">
                <h1 class="main-title">@if(session('language') != 'hi') {{'SPREAD THE WORD.'}} @else {{'प्रचार कीजिये|'}} @endif</h1>
            </div>
            <div class="col-md-6">
                <h1 class="main-title">@if(session('language') != 'hi') {{'SPREAD THE WORD.'}} @else {{'सरकार तक बात पहुंचाएं|'}} @endif</h1>
            </div>
        </div>
        <div class="col-md-6 col-md-push-5 addTopMargin">
            <button class="create-button">@if(session('language') != 'hi') {{'BEGIN!'}} @else {{'आरंभ करें!'}} @endif</button>
        </div>
    </div>
    <script>
        $('#second').hide();
        $('.ns').on('click',function () {
            if($('.ns').hasClass('selected'))
            {
                $('.ns').removeClass('selected');
                $(this).addClass('selected');
            }
            else
            {
                $(this).addClass('selected');
            }
            switch($(this).val())
            {
                case 'Administrative':
                    $('.category2').hide();
                    $('.category3').hide();
                    $('.category4').hide();
                    $('.category5').hide();
                    $('.category1').fadeIn();
                    $('.sc').on('click',function(){
                        if($('.sc').hasClass('selected-sub'))
                        {
                            $('.sc').removeClass('selected-sub');
                            $(this).addClass('selected-sub');
                        }
                        else
                        {
                            $(this).addClass('selected-sub');
                        }
                    });
                    break;
                case 'Private sector':
                    $('.category1').hide();
                    $('.category3').hide();
                    $('.category4').hide();
                    $('.category5').hide();
                    $('.category2').fadeIn();
                    $('.sc').on('click',function(){
                        if($('.sc').hasClass('selected-sub'))
                        {
                            $('.sc').removeClass('selected-sub');
                            $(this).addClass('selected-sub');
                        }
                        else
                        {
                            $(this).addClass('selected-sub');
                        }
                    });
                    break;
                case 'Religious':
                    $('.category1').hide();
                    $('.category2').hide();
                    $('.category3').hide();
                    $('.category4').hide();
                    $('.category5').fadeIn();
                    $('.sc').on('click',function(){
                        if($('.sc').hasClass('selected-sub'))
                        {
                            $('.sc').removeClass('selected-sub');
                            $(this).addClass('selected-sub');
                        }
                        else
                        {
                            $(this).addClass('selected-sub');
                        }
                    });
                    break;
                default:
                    $('.category1').fadeOut();
                    $('.category2').fadeOut();
            }
        });
        $('input[name="proof"]').on('click',function () {
            var proof = $('.proof');
            if($(this).is(':checked'))
            {
                proof.fadeIn();
                proof.attr('required','required');
            }
            else
            {
                $('.proof').fadeOut();
                proof.removeAttr('required');
            }
        });
        $('form[name="documentForm"]').submit(function (event) {
            var category = $('.selected').val();
            var subcategory = $('.selected-sub').val();
            $('.popup').fadeIn();
            var proof;
            var anonymous;
            if($('input[name="proof"]').is(':checked'))
                proof = 1;
            else
                proof = 0;
            if($('input[name="anonymous"]').is(':checked'))
                anonymous = 1;
            else
                anonymous = 0;
            /*var formData = {
                'category'  : category,
                'place'     : $('input[name="place"]').val(),
                'officer'   : $('input[name="officer"]').val(),
                'service'   : $('input[name="service"]').val(),
                'case'      : $('textarea[name="case"]').val(),
                'fileupload': $('input[name="fileupload"]'),
                'proof'     : proof,
                'anonymous' : anonymous,
                '_token'    : $('input[name="_token"]').val()
            };*/
            var form = document.forms.namedItem('documentForm');
            var formData = new FormData(form);
            formData.append('category',category);
            formData.append('anonymous',anonymous);
            formData.append('subcat',subcategory);
            $.ajax({
                data : formData,
                url  : '/document',
                type : 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false
            })
                .done(function (data) {
                    $('.a5 img').attr('src','https://thumbs.gfycat.com/ShyCautiousAfricanpiedkingfisher-max-1mb.gif');
                    console.log(data);
                    $('.a5 p').html('Your case has been uploaded successfully! <br /> Redirecting you to the home page....');
                    setTimeout(function () {
                        window.location.href = '/';
                    },3000);
                })
                .fail(function (data) {
                    $('.a5 img').attr('src','https://images.vexels.com/media/users/3/134741/isolated/preview/07cfd1b48c4855217b811ddc85b5bf97-sad-emoji-emoticon-by-vexels.png');
                    console.log(data);
                    $('.a5 p').html('There was some error processing your request. <br /> Redirecting you to the home page....');
                    setTimeout(function () {
                        window.location.href = '/';
                    },3000);
                });
            event.preventDefault();
        });
        $('.create-button').on('click',function () {
            $('#first').fadeOut();
            $('#second').fadeIn();
        });
        function initAutocomplete() {
            // Create the search box and link it to the UI element.
            var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
        }
    </script>
    <script type="text/javascript">
        $('button[name^="category"]').tooltipsy({
            offset: [10, 0],
            css: {
                'padding': '10px',
                'max-width': '150px',
                'color': '#4286f4',
                'font-family':'Open Sans',
                'background-color': '#fff',
                'border': '1px solid #deca7e',
                '-moz-box-shadow': '0 0 10px rgba(0, 0, 0, .5)',
                '-webkit-box-shadow': '0 0 10px rgba(0, 0, 0, .5)',
                'box-shadow': '0 0 10px rgba(0, 0, 0, .5)',
                'text-shadow': 'none'
            }
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATshlsUHZYvVVsFKM9LRGZKYPcPpJzAn0&libraries=places&callback=initAutocomplete" async defer></script>

@endsection