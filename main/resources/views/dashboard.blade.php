@extends('layout.customer')
@section('page_title')
    داشبورد
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
        <!-- -------------------------- نمایش اطلاعیه ---------------------------  -->
        <div class="w-full flex justify-start bg-[#FFE9E9] border border-[#FF7B7B] rounded-2xl p-1 mt-3">
                    <span class=" py-2 px-2 text-colorprimary text-lg">
                        <span class="relative flex gap-2">
                            <img src="{{ url("/img/notify-icon.svg")}}" alt="">
                            <span class="text-sm md:text-base">اطلاعیه</span>

                            <span class="bg-colorprimary w-40 md:w-52  h-[1px] absolute -bottom-2"></span>
                            <span class="bg-colorsecondry1 w-10 h-[3px] absolute -bottom-2"></span>
                        </span>
                        <p class="mt-3 font-extralight text-sm md:text-lg leading-6 md:leading-7 text-justify">
                            همکاران محترم جا به جایی معاملات طلا و سکه به صورت نقدی می باشد و تمامی جا به جای ها روز چهار شنبه انجام میشود مشتریان موظف به جابجایی پول و طلا می باشند. در صورت بروز هرگونه مشکلی میتوانید با شماره های 09177880020 و 09382332648 تماس بگیرید .
                        </p>
                    </span>
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
                            <!-- ---------------------- جدول قیمت محصولات ---------------------  -->
                              <table x-data="{ detailrow:false }" class="space-y-3 block pb-5">
                                  <thead class="w-full flex">
                                      <tr class="flex justify-between items-center w-full bg-slate-100 font-normal px-1 md:px-5 py-3 rounded-lg hover:shadow-gray-200/50 hover:shadow-lg text-xs lg:text-sm">
                                          <td class="border-l sm:w-[30%] text-center w-24 break-words">نام محصول</td>
                                          <td class="w-24 sm:w-[25%] text-center  border-l min-w-fit flex justify-center">
                                            <span>قیمت خرید</span>
                                            <span class="text-gray-400 font-extralight hidden md:block">(ریال)</span>
                                          </td>
                                          <td class="w-24 sm:w-[25%] text-center flex justify-center">
                                            <span>قیمت فروش</span>
                                            <span class="text-gray-400 font-extralight hidden md:block ">(ریال)</span>
                                          </td>
                                          <td class="hidden md:flex w-36 sm:w-[20%]  justify-center items-center gap-2 border-r pr-1">
                                              <span class="w-full text-center">عملیات</span>
                                          </td>
                                      </tr>
                                  </thead>
                                  <tbody x-data="{ detailrow:false }" class="space-y-1 w-full flex flex-col ">
                                          @foreach($products as $product)
                                              @if($product->status == 1)
                                                  <tr class="flex flex-row justify-between items-center bg-slate-100 w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative">

                                              <td class="border-l sm:w-[30%] text-center w-24 break-words">{{ $product->title }}</td>
                                              <td class="oneLine text-lengh w-24 sm:w-[25%] text-center border-l font-bold text-xs xl:text-base text-colorfourth1 flex flex-col items-center">
                                            <span id={{"buy_price_".$product->id}}>{{ $product->buy_price }}</span>
                                            <a class="bg-colorfourth1 px-4 py-1 w-full text-white rounded-full flex md:hidden max-w-fit cursor-pointer hover:scale-105 transition-transform">
                                                خرید
                                              </a>
                                          </td>
                                              <td class="oneLine text-lengh w-24 sm:w-[25%] text-center md:border-l font-bold text-xs xl:text-base text-colorthird1 flex flex-col items-center">
                                            <span id={{"sell_price_".$product->id}}>{{ $product->sell_price }}</span>
                                            <a class="bg-colorthird1 px-4 py-1 w-full text-white rounded-full flex md:hidden max-w-fit cursor-pointer hover:scale-105 transition-transform">
                                                فروش
                                              </a>
                                          </td>

                                              <td class="hidden md:flex xl:flex-row flex-col items-center justify-center oneLine w-36 sm:w-[20%] gap-1">
                                              <button id={{"button_buy_price_".$product->id}} onclick="open_trade_page({{ $product->id }},'buy')" class="bg-colorfourth1 disable_btn px-5 py-2 w-full text-white rounded-full flex max-w-fit cursor-pointer hover:scale-105  transition-transform" @if($market=="closed" || $product->buy_status=='0') disabled @endif  >
                                                خرید
                                              </button>
                                              <button id={{"button_sell_price_".$product->id}} onclick="open_trade_page({{ $product->id }},'sell')" class="bg-colorthird1 px-5 py-2 w-full text-white rounded-full flex max-w-fit cursor-pointer hover:scale-105 transition-transform" @if($market=="closed" || $product->sell_status=='0') disabled @endif  >
                                                فروش
                                              </button>
                                          </td>
                                      </tr>
                                              @endif

                                          @endforeach
                                  </tbody>
                                </table>
                            </div>
                    </span>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script>
        function open_trade_page(product_id,type)
        {
            window.open('user-order/'+product_id+"/"+type);
        }
    </script>
    <script src="{{ url("/js/menutoggle.js")}}"></script>
    <script src="{{ url("/js/menu-toggle.js")}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
