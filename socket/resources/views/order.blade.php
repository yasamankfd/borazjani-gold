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
<body>
<div id="app">
    <div class="container mt-5 mb-5">
        <button onclick="change_operation('buy',{{ $product->buy_price }},{{ $product->sell_price }})" style="width: 400px" class="btn btn-success">Buy</button>
        <button onclick="change_operation('sell',{{ $product->buy_price }},{{ $product->sell_price }})" style="width: 400px" class="btn btn-danger">Sell</button>
        <div>
            <label style="background-color: lightblue" id="operation_label">@if($type == "buy") عملیات خرید @else عملیات فروش @endif</label>
        </div>
        <form action="{{ route('save-temp-order') }}" method="POST">
            @csrf
            @method("POST")
            <div>
                <div class="mt-5">
                    <label disabled="" for="dropdown"> محصول را انتخاب کنید:</label>
                    <select disabled name="dropdown" class="form-control" >
                        @foreach($products as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                <input type="hidden" id="product_fee" name="product_fee" value="@if($type=="buy") {{ $product->buy_price }} @else {{ $product->sell_price }} @endif">
                <input type="hidden" id="operation_type" name="operation_type" value="{{ $type }}">

                <div class="m-lg-2">
                    <label> مبلغ:</label>
                    <input onchange="cal_price_by_price()" id="input_price" name="input_price">
                    <label>تومان</label>
                </div>
                <div class="m-lg-2">
                    <label>مقدار:</label>
                    <input onchange="cal_price_by_amount()" id="amount" name="amount" >
                    <label>گرم</label>
                </div>
                <div>
                    <div>
                        <label id="price">@if($type=="buy") {{ $product->buy_price }} @else {{ $product->sell_price }} @endif : </label>
                        <label>فی</label>
                    </div>
                    <div>
                        <label id="total_price"></label>
                        <label> : مجموع معامله</label>
                    </div>
                </div>
            </div>
            <div>
                <button name="submit_temp_order" id="submit_temp_order" style="width: 300px" class="btn btn-success">@if($type == "buy")  خرید @else  فروش @endif</button>
            </div>
        </form>
    </div>


</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/order_page.js') }}"></script>
</body>
</html>
