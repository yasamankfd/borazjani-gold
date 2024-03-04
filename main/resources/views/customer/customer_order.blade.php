@extends('layout.customer')
@include("alert.alert-error")
@section('page_title')
    ثبت سفارش
@endsection
@section('content')
    <div id="app">
        <div class="mt-5">
            <!-- ------------------- نمایش وضعیت بازار -----------------------  -->
            <div class="w-full flex justify-center border-b pb-3">
                <span id="market_status_span_color" class="@if($market=="open") bg-colorfourth1 @else bg-colorthird1 @endif py-2 px-5 rounded-lg text-white relative animate-pulse text-lg">
                        <span class="font-extralight">وضعیت بازار:</span>
                        <span id="market_status_span">@if($market=="open") باز@else بسته @endif</span>
                    </span>
            </div>

            <div  class="w-full flex justify-start bg-white border border-slate-200 rounded-2xl p-1 mt-3">
                    <span class=" py-2 px-2 text-colorprimary text-lg w-full">
                        <span class="relative flex gap-2">
                            <img src="{{ url("/img/product-icon.svg")}}" alt="">
                            <span class="text-sm md:text-base">فرایند ثبت سفارش</span>

                            <span class="bg-colorprimary w-40 md:w-48 h-[1px] absolute -bottom-2"></span>
                            <span class="bg-colorsecondry1 w-10 h-[3px] absolute -bottom-2"></span>
                        </span>
                        <div x-data="{buy:true, sell:false}" class="gap-2 rounded-xl mt-5 pb-10">
                            <div class="flex justify-center gap-2">
                                <button id="change_to_sell" onclick="change_operation('sell',{{ $product->buy_price }},{{ $product->sell_price }})" @click="buy=true, sell=false" class="bg-colorthird1 text-white rounded-full px-5 py-2 font-light w-24 text-center cursor-pointer hover:scale-105 transition-all">فروش</button>
                                <button id="change_to_buy" onclick="change_operation('buy',{{ $product->buy_price }},{{ $product->sell_price }})" @click="buy=false, sell=true" class="bg-colorfourth1 text-white rounded-full px-5 py-2 font-light w-24 text-center cursor-pointer hover:scale-105 transition-all">خرید</button>
                            </div>
                            <!-- -------------------------- نمایش اطلاعیه ---------------------------  -->

                            <div id="operation_type_div" x-show="buy" class="w-full max-w-sm mx-auto flex justify-center @if($type == "buy") bg-colorfourth1/70 @else bg-colorthird1/70 @endif  text-white border border-[#5fbb85] rounded-md p-1 mt-3">
                                    <span class=" py-1 px-2 text-lg text-center">
                                        <p class="font-light animate-pulse text-sm md:text-lg leading-6 md:leading-7 text-center">
                                            شما در حال انجام عملیات
                                        </p>
                                        @if($type == "buy")
                                            <p id="operation_label" class="font-light animate-pulse text-sm md:text-lg leading-6 md:leading-7 text-center">خرید</p>
                                        @else
                                            <p id="operation_label" class="font-light animate-pulse text-sm md:text-lg leading-6 md:leading-7 text-center">فروش</p>
                                        @endif
                                        <p class="font-light animate-pulse text-sm md:text-lg leading-6 md:leading-7 text-center">
                                             هستید
                                        </p>
                                    </span>
                            </div>
                            <!-- -------------------------- نمایش اطلاعیه ---------------------------  -->

                            <form id="create_order_form" x-show="buy" class="mt-5">
                                @csrf
                                <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" id="product_fee" name="product_fee" value="@if($type=="buy") {{ $product->buy_price }} @else {{ $product->sell_price }} @endif">
                                <input type="hidden" id="operation_type" name="operation_type" value="{{ $type }}">
                                <input type="hidden" id="user_id" name="user_id" value="{{ $user_id }}">                                <input type="hidden" id="user_id" name="user_id" value="{{ $user_id }}">
                                <input type="hidden" id="product_buy_status" name="product_buy_status" value="{{ $product->buy_status }}">
                                <input type="hidden" id="product_sell_status" name="product_sell_status" value="{{ $product->sell_status }}">

                                <span class="w-full flex flex-col lg:flex-row gap-2">
                                    <span class="w-full lg:w-1/3">
                                        <span class="pr-5 font-light text-sm">محصول</span>
                                        <select
                                            id="sender1"
                                            class="selectpicker" style="width: 100%"
                                            data-placeholder="وضعیت"
                                            data-allow-clear="false"
                                            title="Select city...">
                                        <option></option>
                                        <option>فعال</option>
                                        <option>غیرعفال</option>
                                        </select>
                                    </span>
                                    <span class="w-full lg:w-1/3">
                                        <span class="pr-5 font-light text-sm">مبلغ</span>
                                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200 px-2">
                                            <input id="input_price" name="input_price" onkeyup="cal_price_by_price()" type="text" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-0 placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="مبلغ خرید مورد نظر را وارد کنید">
                                            <span class="font-light text-sm border-r pr-1 w-10 text-center">تومان</span>
                                        </span>
                                    </span>

                                    <span class="w-full lg:w-1/3">
                                        <span class="pr-5 font-light text-sm">مقدار خرید</span>
                                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200 px-2">
                                            <input id="amount" name="amount" onkeyup="cal_price_by_amount()" type="text" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-0 text-center placeholder:font-thin placeholder:text-sm px-5 py-3" placeholder="مقدار خرید مورد نظر را وارد کنید">
                                            <span class="font-light text-sm border-r pr-1 w-10 text-center">گرم</span>
                                        </span>
                                    </span>
                                </span>

                                <span class="w-full  max-w-xl mx-auto flex items-center gap-2 border-t mt-10 pt-2">
                                    <span class="w-full flex mx-auto justify-between items-center">
                                        <span class="pr-5 font-light text-sm">فی</span>
                                        <span @if($type == 'sell') hidden  @endif id="buy_section">
                                            <span id="buy_price" class="font-bold text-sm">{{ $product->buy_price }}</span>
                                            <span class="font-light text-sm">تومان</span>
                                        </span>
                                        <span @if($type == 'buy') hidden  @endif id="sell_section">
                                            <span id="sell_price" class="font-bold text-sm">{{ $product->sell_price }}</span>
                                            <span class="font-light text-sm">تومان</span>
                                        </span>
                                    </span>
                                </span>

                                <span class="w-full  max-w-xl mx-auto flex items-center gap-2 border-t mt-5 pt-2">
                                    <span class="w-full flex mx-auto justify-between items-center">
                                        <span class="pr-5 font-light text-sm">مجموع معامله</span>
                                        <span>
                                            <span id="total_price" class="font-bold text-sm"></span>
                                            <span class="font-light text-sm">تومان</span>
                                        </span>
                                    </span>
                                </span>
                            </form>
                            <span class="w-full  max-w-xl mx-auto flex items-center justify-center gap-2 border-t mt-5 pt-2">
                                <button onclick="create_order()" name="submit_buy_order" id="submit_buy_order" @if($market == "closed" || $product->buy_status == 0) disabled @endif  class="flex justify-center bg-colorfourth1 text-white w-full rounded-xl py-3 @if($type == "sell") hidden @endif "> ثبت خرید</button>
                                <button onclick="create_order()" name="submit_sell_order" id="submit_sell_order" @if($market == "closed" || $product->sell_status == 0) disabled @endif class="flex justify-center bg-colorthird1 text-white w-full rounded-xl py-3 @if($type == "buy") hidden @endif">ثبت فروش</button>
                            </span>
                        </div>
                    </span>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ url("/js/menutoggle.js")}}"></script>
<script src="{{ url("/js/menu-toggle.js")}}"></script>
<script src="{{ asset('js/order_page.js') }}"></script>


<script>
    function create_order()
    {

        // let formData = new FormData(document.getElementById('create_product_form'));
        base_url = document.getElementById("base_url").value;
        let _url        = base_url+'/save-temp-order';
        let formData    = new FormData($("#create_order_form")[0]);
        console.log(formData)

        $.ajax({
            type:'POST',
            url: _url,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.code === 200) {
                    if (response.id != null) {
                        console.log("warning");
                    } else {
                        console.log("success");
                    }
                    window.location.href = '{{ route("customer-liveorders") }}';
                }
            },
            error: function (response) {
                console.log(response);
                if (response.status === 422) {
                    var response = JSON.parse(response.responseText);
                    var errorString = '<ul>';
                    $.each(response.errors, function (key, value) {
                        errorString += '<li>' + value + '</li>';
                    });
                    errorString += '</ul>';
                    showAlert(errorString, 'error');
                }
                if (response.status == 500) {
                    var response = JSON.parse(response.responseText);
                    showAlert(response.responseText, 'error');
                }
                if (response.status == 400) {
                    showAlert('خطا در برقراری ارتباط', 'error');
                }
            }
        });
    }

    function showAlert(text, type) {
        $('#alert_content_' + type).html(text);
        $('#alert-' + type).removeClass("hidden");
        setTimeout(function () {
            $('#alert-' + type).addClass("hidden");
        }, 3000);
    }

</script>
@endsection

