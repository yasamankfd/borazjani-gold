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
        <div class="mt-5">
            <label id="market_label" class="market_label">  وضعیت بازار:  @if($market=="open") باز@else بسته @endif</label>
        </div>
        <table id="tableData" class="table align-middle border-bottom">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Buy Price</th>
                <th>Sell Price</th>
                <th>trade</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            @foreach($products as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td id={{"buy_price_".$item->id}}>{{ $item->buy_price }}</td>
                    <td id={{"sell_price_".$item->id}}>{{ $item->sell_price }}</td>
                    <td>
                        <button id={{"button_price_".$item->id}} onclick="open_buy_page({{ $item->id }},'buy')" class="btn btn-success btn-status @if($market=="closed" || $item->status=='0') disabled @endif ">خرید</button>
                        <button id={{"button_price_".$item->id}} onclick="open_buy_page({{ $item->id }},'sell')" class="btn btn-danger btn-status @if($market=="closed" || $item->status=='0') disabled @endif ">فروش</button>
                        <label id={{"label_price_".$item->id}} class="product_status_label"> @if($item->status=='1')داریم@else فعلا نداریم @endif</label>
                    </td>
                </tr>
                @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    function open_buy_page(product_id,type)
    {
        window.open('order/'+product_id+"/"+type);
    }
</script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
