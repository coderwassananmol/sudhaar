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
        '_token' : $('input[name="_token"]').val()
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