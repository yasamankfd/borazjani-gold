<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <title>Admin Page</title>
</head>
<body>
<div class="container mt-5 mb-5">
    <div class="container">
        <div>
            <label class="mt-5">change market status :</label>
        </div>
        <div>
            <label class="switch mb-1">
                    <input name="market_status" id="market_status" type="checkbox" @if($market=="open") checked @endif onclick="change_market_status()">
                <span class="slider round"></span>
            </label>
        </div>

    </div>

    <form action="{{ route('admin') }}" method="post">
        <div class="table-container">
            <div class="table-cell">ID</div>
            <div class="table-cell">Name</div>
            <div class="table-cell">Prices</div>
            @foreach($products as $item)
                <div class="table-cell">{{ $item->id }}</div>
                <div class="table-cell">{{ $item->title }}</div>
                    @csrf
                    @method('PATCH')
                    <div class="table-cell">
                        <label>buy</label>
                        <input name="buy_price_{{ $item->id }}" value="{{ $item->buy_price }}">
                        <br>
                        <label>sell</label>
                        <input name="sell_price_{{ $item->id }}" value="{{ $item->sell_price }}">
                        <div>
                            <label class="switch mb-1">
                                <input name="product_status_{{ $item->id }}" id="product_status_{{ $item->id }}" type="checkbox" @if($item->status=='1') checked @endif onclick="change_product_status({{ $item->id }})">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
            @endforeach
                <button class="btn btn-dark">Edit</button>
        </div>
    </form>

</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function change_product_status(product_id){
        let status = "";
        var checkbox = document.getElementById("product_status_"+product_id);
        // Perform actions based on the checkbox state
        if (checkbox.checked) {
            status = 1;
            // Add your custom logic for when the switch is ON
        } else {
            status = 0;
            // Add your custom logic for when the switch is OFF
        }
        let _url = 'product-status/' + product_id + "/" + status;

        $.ajax({
            url: _url,
            type: "GET",
            success: function (response) {
                console.log(response)
            }
        });
    }
    function change_market_status() {
        console.log('blade')
        let status = "";
        var checkbox = document.getElementById("market_status");
        // Perform actions based on the checkbox state
        if (checkbox.checked) {
            status = "open";
            // Add your custom logic for when the switch is ON
        } else {
            status = "closed";
            // Add your custom logic for when the switch is OFF
        }
        let _url = 'market-status/' + status;

        $.ajax({
            url: _url,
            type: "GET",
            success: function (response) {
                console.log(response)
            }
        });
    }
</script>
</body>
</html>
