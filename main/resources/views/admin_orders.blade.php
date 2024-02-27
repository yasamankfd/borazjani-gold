<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <title>Orders Page</title>
</head>
<body>
<div class="app">
    <div class="container mt-5 mb-5">
        <div class="table-container3">
            <div class="table-cell">نام محصول</div>
            <div class="table-cell">مقدار</div>
            <div class="table-cell">فی</div>
            <div class="table-cell">مجموع</div>
            <div class="table-cell">زمان درخواست</div>
            <div class="table-cell">وضعیت</div>
            <div class="table-cell">عملیات</div>

            @foreach($orders as $item)
                <input id="order_id_{{ $item->id }}" name="order_id_{{ $item->id }}" type="hidden" value="{{ $item->id }}">
                    <div class="table-cell">{{ $item->product->title }}</div>
                    <div class="table-cell">{{ $item->value }}</div>
                    <div class="table-cell">
                        <label>{{ $item->fee }}</label>
                    </div>
                    <div class="table-cell">
                        <label>{{ $item->total_price }}</label>
                    </div>
                    <div class="table-cell">
                        <label>{{ $item->created_at->format('H:i:s') }}</label>
                    </div>
                    <div class="table-cell">
                        <label hidden="hidden">{{ $item->status }}</label>
                        <p id="countdown_{{$item->id}}"> <span id="countdownValue_{{$item->id}}">0</span> ثانیه </p>
                    </div>
                    <div class="table-cell">
                        <button onclick="submit_order({{ $item->id }})" class="btn btn-success">تایید</button>
                    </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>

    function submit_order(order_id)
    {
        console.log('hereeeee')

            let _url = 'save-order/' + order_id;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            $.ajax({
                url: _url,
                type: "POST",
                success: function (response) {
                    console.log(response)
                },
            });
    }
    function startCountdown(time , id) {
        now = new Date().getTime();
        created = new Date(time).getTime();
        let seconds = Number(((created + 120000) - now)/1000).toFixed(0) ;
        var countdownValue = document.getElementById('countdownValue_'+id);
        var countdown = document.getElementById('countdown_'+id);
        if(seconds < 0)
        {
            countdownValue.innerText = '';
            countdown.innerText = 'درخواست مجدد';
        }
        if(seconds >= 0 ){
            var interval = setInterval(function () {
                countdownValue.innerText = seconds;
                seconds--;

                if (seconds < 0) {
                    clearInterval(interval);
                    countdownValue.innerText = '0';
                }
            }, 1000);
        }
    }
    @foreach($orders as $item)
    startCountdown("{{ $item->created_at }}", "{{ $item->id }}");
    @endforeach
</script>
</body>
</html>
