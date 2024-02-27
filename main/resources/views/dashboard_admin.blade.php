@extends("layout.admin")
@section("title")
    admin
@endsection
@section('content')
    <div class="flex justify-center gap-2 mt-5">
        <a class="relative flex flex-col justify-around gap-2 rounded-2xl py-7 px-7 cursor-pointer bg-white">
            <span class="text-5xl text-center">26</span>
            <span class="text-xs md:text-sm">تعداد معاملات</span>

            <span class="bg-colorprimary w-20 h-[1px] absolute bottom-14"></span>
            <span class="bg-colorsecondry1 h-[3px] absolute bottom-14 w-9"></span>
        </a>
        <a class="relative flex flex-col justify-around gap-2 rounded-2xl py-7 px-7 cursor-pointer bg-white">
            <span class="text-5xl text-center">26</span>
            <span class="text-xs md:text-sm">درخواست ها</span>

            <span class="bg-colorprimary w-20 h-[1px] absolute bottom-14"></span>
            <span class="bg-colorsecondry1 h-[3px] absolute bottom-14 w-9"></span>
        </a>
    </div>

    <div class="w-full flex justify-start bg-white border border-slate-200 rounded-2xl p-1 mt-3">
                    <span class=" py-2 px-2 text-colorprimary text-lg w-full">
                        <span class="relative flex gap-2">
                            <img src="{{ url("/img/product-icon.svg")}}" alt="">
                            <span class="text-sm md:text-base">لیست قیمت محصولات</span>

                            <span class="bg-colorprimary w-40 md:w-52 h-[1px] absolute -bottom-2"></span>
                            <span class="bg-colorsecondry1 w-10 h-[3px] absolute -bottom-2"></span>
                        </span>
                        <div class="gap-2 rounded-xl mt-5 pb-10">
                               <!-- ---------------------- جدول سفارشات جاری  ---------------------  -->
                               <table class="space-y-3 block overflow-x-auto pb-5">
                                <thead class="w-full flex">
                                    <tr class="flex justify-between items-center w-full bg-colorprimary text-white font-normal px-1 md:px-5 py-3 rounded-lg hover:shadow-gray-200/50 hover:shadow-lg text-xs lg:text-sm">
                                        <td class="border-l pl-5 md:w-[30%]  lg:w-[20%] text-center w-36 min-w-fit">نام محصول</td>
                                        <td class="w-36 md:w-[25%] lg:md:w-[15%] text-center border-l min-w-fit hidden md:block">
                                          <span>خرید</span>
                                          <span class="text-gray-400 font-extralight">(ریال)</span>
                                        </td>
                                        <td class="w-36 md:w-[25%] lg:md:w-[15%] text-center hidden md:block">
                                          <span>فروش</span>
                                          <span class="text-gray-400 font-extralight">(ریال)</span>
                                        </td>
                                        <td class="w-36 md:w-[20%] text-center border-r hidden lg:block">
                                          <span>خرید</span>
                                        </td>
                                        <td class="w-36 md:w-[20%] text-center border-r hidden lg:block">
                                            <span>فروش</span>
                                          </td>
                                        <td class="flex w-36 md:w-[20%] lg:w-[10%] justify-center items-center gap-2 md:border-r pr-1">
                                            <span class="w-full text-center">عملیات</span>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody x-data="{ detailrow:false }" class="space-y-1 w-full flex flex-col ">
                                @foreach($products as $product)
                                    <form action="{{ route("product-edit")}}" id="edit_product" method="POST">
                                        @csrf
                                    </form>
                                    <tr class="flex flex-row justify-between items-center bg-slate-100 w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative text-colorprimary/70">
                                        <td class="border-l pl-5 md:w-[30%] lg:w-[20%] text-center w-36 min-w-fit font-normal tracking-tight text-sm">{{ $product->title }}</td>
                                        <td class="oneLine text-lengh w-36 md:w-[25%] lg:md:w-[15%] text-center border-l font-normal tracking-tight text-sm text-colorfourth1 hidden md:block px-2">
                                            <input name="buy_price_{{ $product->id }}" id="buy_price_{{ $product->id }}" value="{{ $product->buy_price }}" type="text" class="bg-transparent w-full rounded-full text-center border-colorfourth1 focus:outline-colorsecondry1 focus:ring-0 focus:border-0 text-sm">
                                        </td>
                                        <td class="oneLine text-lengh w-36 md:w-[25%] lg:md:w-[15%] text-center border-l font-normal tracking-tight text-sm text-colorthird1 hidden md:block px-2">
                                            <input name="sell_price_{{ $product->id }}" id="sell_price_{{ $product->id }}" value="{{ $product->sell_price }}" type="text" class="bg-transparent w-full rounded-full text-center border-colorthird1 focus:outline-colorsecondry1 focus:ring-0 focus:border-0 text-sm">
                                        </td>
                                        <td class="oneLine text-lengh w-36 md:w-[20%] text-center border-l font-light tracking-tight text-sm gap-1 justify-center hidden lg:flex">
                                            <label class="flex gap-2 items-center cursor-pointer">
                                                <span class="text-sm font-medium text-gray-900 dark:text-gray-300">بسته</span>
                                                <input name="product_buy_status_{{ $product->id }}" id="product_buy_status_{{ $product->id }}" type="checkbox" @if($product->buy_status=='1') checked @endif class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-colorthird1 peer-focus:outline-none peer-focus:ring-4 dark:peer-focus:ring-colorthird1 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-colorfourth1"></div>
                                                <span class="text-sm font-medium text-gray-900 dark:text-gray-300">باز</span>
                                            </label>
                                        </td>
                                        <td class="oneLine text-lengh w-36 md:w-[20%] text-center border-l font-light tracking-tight text-sm gap-1 justify-center hidden lg:flex">
                                            <label class="flex gap-2 items-center cursor-pointer">
                                                <span class="text-sm font-medium text-gray-900 dark:text-gray-300">بسته</span>
                                                <input name="product_sell_status_{{ $product->id }}" id="product_sell_status_{{ $product->id }}" type="checkbox" @if($product->sell_status=='1') checked @endif class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-colorthird1 peer-focus:outline-none peer-focus:ring-4 dark:peer-focus:ring-colorthird1 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-colorfourth1"></div>
                                                <span class="text-sm font-medium text-gray-900 dark:text-gray-300">باز</span>
                                            </label>
                                        </td>
                                        <td class="oneLine w-36 md:w-[20%] lg:w-[10%] flex gap-1 justify-center">
                                            <button onclick="open_edit_modal({{ $product->id }})"  class="bg-colorprimary p-3 py-2 text-white rounded-full flex cursor-pointer hover:scale-105  transition-transform font-light text-xs">
                                                ویرایش
                                            </button>
                                            <button onclick="submit_form({{ $product->id }} , 1 )"  class="bg-colorprimary p-3 py-2 text-white rounded-full flex cursor-pointer hover:scale-105  transition-transform font-light text-xs">
                                                ثبت
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </span>
    </div>
    <!-- ----------مودال اطلاعات محصول  ------------------  -->
    <div id="edit_product_modal"  x-transition.duration.500ms class="bg-black/50 hidden backdrop-blur-sm fixed pb-10 top-0 w-full h-screen flex items-center px-5 z-10">
        <div class="bg-white w-full sm:max-w-3xl max-h-[70vh] sm:max-h-full mx-auto p-5 rounded-lg flex flex-col gap-3 overflow-y-auto">
            <span class="flex flex-row justify-between items-center border-b pb-2">
                 <span>اطلاعات محصول</span>
                 <span onclick="closeModal()" class="bg-gray-100 p-1 sm:p-2 rounded-md cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                 </span>
            </span>

            <!-- ردیف اول  -->
            <input class="hidden" id="modal_product_id">
                <span class="flex flex-col items-center sm:flex-row gap-2">
                <span class="w-full flex flex-col lg:flex-row gap-2">
                    <label id="title_modal" class="flex gap-2 items-center justify-center cursor-pointer"></label>
                </span>
            </span>
                <span class="flex flex-col items-center sm:flex-row gap-2">
                <span class="w-full flex flex-col lg:flex-row gap-2">
                    <span class="w-full lg:w-1/2">
                        <span class="pr-5 font-light text-sm">قیمت خرید</span>
                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                            <input id="buy_price_modal" type="text" name="buy_price_modal" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام خود را وارد کنید">
                        </span>
                    </span>
                    <label class="flex gap-2 items-center justify-center cursor-pointer">
                        <span class="text-sm font-medium text-gray-900 dark:text-gray-300">بسته</span>
                        <input id="buy_status_modal" name="buy_status_modal" type="checkbox" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-colorthird1 peer-focus:outline-none peer-focus:ring-4 dark:peer-focus:ring-colorthird1 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-colorfourth1"></div>
                        <span class="text-sm font-medium text-gray-900 dark:text-gray-300">باز</span>
                    </label>
                </span>
            </span>

                <!-- ردیف دوم  -->
                <span class="flex flex-col sm:flex-row gap-2">
                    <span class="w-full flex flex-col items-center jus lg:flex-row gap-2">
                        <span class="w-full lg:w-1/2">
                            <span class="pr-5 font-light text-sm">قیمت فروش</span>
                            <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                <input id="sell_price_modal" type="text" name="sell_price_modal" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام خود را وارد کنید">
                            </span>
                        </span>
                        <label class="flex gap-2 items-center justify-center cursor-pointer">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">بسته</span>
                            <input id="sell_status_modal" name="sell_status_modal" type="checkbox" class="sr-only peer">
                            <div class="relative w-11 h-6 bg-colorthird1 peer-focus:outline-none peer-focus:ring-4 dark:peer-focus:ring-colorthird1 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-colorfourth1"></div>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">باز</span>
                        </label>
                    </span>
                </span>

                <div class="flex flex-col sm:flex-row justify-end gap-2 mt-3 w-full">
                    <form action="{{ route("product-edit")}}" id="edit_product_modal" method="POST">
                        @csrf
                    </form>

                    <button onclick="submit_form(1 , 2)" class="min-w-[100px] text-center bg-colorsecondry1 text-white sm:hover:-translate-y-1 transition-transform duration-200 py-3 px-5 rounded-full cursor-pointer text-xs sm:text-sm">ویرایش</button>
                    <button onclick="closeModal()" class="min-w-[100px] bg-colorprimary text-white sm:hover:-translate-y-1 transition-transform duration-200 py-3 px-5 rounded-full cursor-pointer text-xs sm:text-sm text-center">بازگشت</button>
                </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function submit_form(product_id , type) {
            // Get form data
            let formData = new FormData(document.getElementById('edit_product'));
            if (type === 2)
            {
                product_id = document.getElementById("modal_product_id").value;
                console.log(product_id)
                var buy_status_checkbox = document.getElementById("buy_status_modal");
                var sell_status_checkbox = document.getElementById("sell_status_modal");
                var buy_price = document.getElementById("buy_price_modal").value;
                var sell_price = document.getElementById("sell_price_modal").value;

                var buy_status = buy_status_checkbox.checked === true ? 1 : 0 ;
                var sell_status = sell_status_checkbox.checked === true ? 1 : 0 ;

                // Append additional parameters
            }else{
                formData = new FormData(document.getElementById('edit_product'));
                var buy_status_checkbox = document.getElementById("product_buy_status_"+product_id);
                var sell_status_checkbox = document.getElementById("product_sell_status_"+product_id);
                var buy_price = document.getElementById("buy_price_"+product_id).value;
                var sell_price = document.getElementById("sell_price_"+product_id).value;


                var buy_status = buy_status_checkbox.checked === true ? 1 : 0 ;
                var sell_status = sell_status_checkbox.checked === true ? 1 : 0 ;

            }
            formData.append('buy_status', buy_status);
            formData.append('sell_status', sell_status);
            formData.append('buy_price', buy_price);
            formData.append('sell_price', sell_price);
            formData.append('product_id', product_id);

            // Make an Ajax request using Fetch API
            fetch('product-edit', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    // Handle the response data
                    console.log(JSON.stringify(data));
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }


        // function change_product_status(product_id,type)
        // {
        //     id = type === "sell" ? "product_sell_status_" : "product_buy_status_"
        //     var checkbox = document.getElementById(id+product_id);
        //     let status ;
        //
        //     // Perform actions based on the checkbox state
        //     if (checkbox.checked) {
        //         status = 1;
        //         // Add your custom logic for when the switch is ON
        //     } else {
        //         status = 0;
        //         // Add your custom logic for when the switch is OFF
        //     }
        //     let _url = 'product-status/' + product_id + "/" + status + "/" + type ;
        //
        //     console.log(_url)
        //     $.ajax({
        //         url: _url,
        //         type: "GET",
        //         success: function (response) {
        //             console.log(response)
        //         }
        //     });
        //
        // }
        function change_market_status()
        {
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
        // function change_product_price(product_id)
        // {
        //     var buy_price = document.getElementById("buy_price_"+product_id);
        //     var sell_price = document.getElementById("sell_price_"+product_id);
        //
        //     let _url = 'product-single-price/' + product_id + "/" + buy_price + "/" + sell_price ;
        //
        //     console.log(_url)
        //     $.ajax({
        //         url: _url,
        //         type: "GET",
        //         success: function (response) {
        //             console.log(response)
        //         }
        //     });
        // }

        function open_edit_modal(product_id){
            let _url            = 'find-product/' + product_id;
            $.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    console.log(response)
                    if(response) {
                        if(Object.keys(response).length > 0)
                        {
                            $('#title_modal').val(response.title);
                            $('#buy_price_modal').val(response.buy_price);
                            $('#sell_price_modal').val(response.sell_price);
                            $('#modal_product_id').val(product_id);
                            document.getElementById("title_modal").innerText = response.title

                            buy_status = response.buy_status;
                            sell_status = response.sell_status;


                            buy_status_checkbox = document.getElementById('buy_status_modal');
                            sel_status_checkbox = document.getElementById('sell_status_modal');

                            buy_status_checkbox.checked = buy_status === 1 ? true: false;
                            sel_status_checkbox.checked = sell_status === 1 ? true: false;


                            $('#edit_product_modal').removeClass('hidden');
                        }else alert('محصول یافت نشد!')
                    }
                }
            });
        }

        function closeModal() {

            $("#edit_product_modal").addClass("hidden");
        }


    </script>

    <script src="{{ url("/js/menutoggle.js")}}"></script>
    <script src="{{ url("/js/menu-toggle.js")}}"></script>
@endsection
