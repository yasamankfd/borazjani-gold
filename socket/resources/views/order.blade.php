<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Customer</title>
</head>
<body onload="init_market({{ $market }})">
<div id="app">
    <div class="container mt-5 mb-5">
        <button class="btn btn-success btn-status">Buy</button>
        <button class="btn btn-danger btn-status">Sell</button>
        <div>
            <div class="mt-5">
                <label for="dropdown"> محصول را انتخاب کنید:</label>
                <select name="dropdown" class="form-control">
                    @foreach($products as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="m-lg-2">
                <label> مبلغ:</label>
                <input id="price" name="price">
                <label>تومان</label>

            </div>
            <div class="m-lg-2">
                <label>مقدار:</label>
                <input id="amount" name="amount">
                <label>گرم</label>

            </div>
            <div>
                <label>گرم</label>
                <label>گرم</label>

            </div>

        </div>
    </div>
</div>
<script>
    function init_market(status) {

        var buttonList = document.getElementsByClassName("btn-status");
        let s = null;
        if(status==="open")
        {
            s = false;
        }else s = true;
        Array.from(buttonList).forEach(function(button) {
            button.disabled = s;
        });
    }


</script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    function init_market(status) {

        var buttonList = document.getElementsById("btn-status");
        let s = null;
        if(status==="open")
        {
            s = false;
        }else s = true;
        Array.from(buttonList).forEach(function(button) {
            button.disabled = s;
        });
    }
</script>
</body>
</html>
