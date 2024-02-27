@extends('layout.customer')
@section('page_title')
    معاملات انجام شده
@endsection

@section('content')
    <div id="app">
        <!-- ------------------- نمایش وضعیت بازار -----------------------  -->
        <div class="w-full flex justify-center border-b pb-3">
                <span id="market_status_span_color" class="@if($market=="open") bg-colorfourth1 @else bg-colorthird1 @endif py-2 px-5 rounded-lg text-white relative animate-pulse text-lg">
                        <span class="font-extralight">وضعیت بازار:</span>
                        <span id="market_status_span">@if($market=="open") باز@else بسته @endif</span>
                    </span>
        </div>

        <div x-data="{buy:true, sell:false}" class="w-full flex justify-start bg-white border border-slate-200 rounded-2xl p-1 mt-3">
                    <span class=" py-2 px-2 text-colorprimary text-lg w-full">
                         <div>
                            <div class="flex justify-center gap-2">
                                <a onclick="change_list('buy')" @click="buy=true, sell=false" :class="buy ? 'border-2 border-colorsecondry1' : 'border' " class="relative flex flex-col gap-2 rounded-2xl py-1 px-4 md:px-5 cursor-pointer">
                                    <img src="{{ url("/img/buy-icon.svg")}}" alt="" class="w-20 md:w-28">
                                    <span class="text-xs md:text-sm">معاملات خرید</span>

                                    <span class="bg-colorprimary w-20 md:w-28 h-[1px] absolute bottom-7 md:bottom-7"></span>
                                    <span :class="buy ? 'border-2 border-colorfourth1 w-20  md:w-28' : 'w-10' " class="bg-colorfourth1 h-[3px] absolute bottom-7"></span>
                                </a>
                                <a onclick="change_list('sell')" @click="buy=false, sell=true" :class="sell ? 'border-2 border-colorsecondry1' : 'border' " class="relative flex flex-col gap-2 rounded-2xl py-1 px-4 md:px-5 cursor-pointer">
                                    <img src="{{ url("/img/sell-icon.svg")}}" alt="" class="w-20 md:w-28">
                                    <span class="text-xs md:text-sm">معاملات فروش</span>

                                    <span class="bg-colorprimary w-20 md:w-28 h-[1px] absolute bottom-7"></span>
                                    <span  :class="sell ? 'border-2 border-colorthird1 w-20  md:w-28' : 'w-10' " class="bg-colorthird1 h-[3px] absolute bottom-7"></span>
                                </a>
                            </div>
                        </div>

                        <div  class="gap-2 rounded-xl mt-5 pb-10 ">
                            <div id="buy_section" x-show="buy" class="hidden">
                                <span class="relative flex gap-2">
                                    <img src="{{ url("/img/product-icon.svg")}}" alt="">
                                    <span class="text-sm md:text-base">لیست معاملات خرید</span>

                                    <span class="bg-colorprimary w-40 md:w-48 h-[1px] absolute -bottom-2"></span>
                                    <span class="bg-colorfourth1 w-10 h-[3px] absolute -bottom-2"></span>
                                </span>
                                <!-- ---------------------- جدول معاملات خرید  ---------------------  -->
                              <table x-data="{ detailrow:false }" class="space-y-3 block overflow-x-auto pb-5 mt-5">
                                <thead class="w-full flex">
                                    <tr class="flex justify-between items-center w-fit md:w-full bg-slate-100 font-normal px-1 md:px-5 py-3 rounded-lg hover:shadow-gray-200/50 hover:shadow-lg text-xs lg:text-sm">
                                        <td class="border-l pl-5  md:w-[20%] text-center w-36 min-w-fit">نام محصول</td>
                                        <td class="w-36 md:w-[15%] text-center border-l min-w-fit">
                                          <span>مقدار</span>
                                        <td class="w-36 md:w-[20%] text-center border-l min-w-fit">
                                          <span>فی</span>
                                          <span class="text-gray-400 font-extralight">(ریال)</span>
                                        </td>
                                        <td class="w-36 md:w-[20%] text-center">
                                          <span>مجموع</span>
                                          <span class="text-gray-400 font-extralight">(ریال)</span>
                                        </td>
                                        <td class="w-36 md:w-[15%] text-center border-r">
                                          <span>زمان</span>
                                        </td>
                                        <td class="flex w-36 md:w-[10%]  justify-center items-center gap-2 border-r pr-1">
                                            <span class="w-full text-center">کدسفارش</span>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody x-data="{ detailrow:false }" class="space-y-1 w-full flex flex-col ">
                                @foreach( $transactions as $transaction)
                                    @if($transaction->type == "buy")
                                        <tr class="flex flex-row justify-between items-center bg-slate-100 w-fit md:w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative text-colorprimary/70">
                                        <td class="border-l pl-5  md:w-[20%] text-center w-36 min-w-fit font-normal tracking-tight">{{ $transaction->product->title }}</td>
                                        <td class="oneLine text-lengh w-36 md:w-[15%] text-center border-l font-normal">
                                          <span class="font-normal tracking-tight">{{ $transaction->value }}</span>
                                          <span class="text-gray-400 font-extralight tracking-tight">گرم</span>
                                        </td>
                                        <td class="oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight">{{ $transaction->fee }}</td>
                                        <td class="oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight">{{ $transaction->total_price }}</td>
                                        <td class="oneLine text-lengh w-36 md:w-[15%] text-center border-l font-normal tracking-tight flex gap-1 justify-center">
                                            <span>{{ $transaction->created_at->toDateString() }}</span>
                                            <span>{{ $transaction->created_at->format('H:i:s') }}</span>
                                        </td>
                                        <td class="oneLine w-36 md:w-[10%] flex gap-1 justify-center font-normal tracking-tight">
                                            <span>{{ $transaction->number }}</span>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach

                                </tbody>
                            </table>
                            </div>

                            <div id="sell_section" >
                                <span class="relative flex gap-2">
                                    <img src="{{ url("/img/product-icon.svg")}}" alt="">
                                    <span class="text-sm md:text-base">لیست معاملات فروش</span>

                                    <span class="bg-colorprimary w-40 md:w-48 h-[1px] absolute -bottom-2"></span>
                                    <span class="bg-colorthird1 w-10 h-[3px] absolute -bottom-2"></span>
                                </span>
                                <!-- ---------------------- جدول معاملات فروش  ---------------------  -->
                              <table x-data="{ detailrow:false }" class="space-y-3 block overflow-x-auto pb-5 mt-5">
                                <thead class="w-full flex">
                                    <tr class="flex justify-between items-center w-fit md:w-full bg-slate-100 font-normal px-1 md:px-5 py-3 rounded-lg hover:shadow-gray-200/50 hover:shadow-lg text-xs lg:text-sm">
                                        <td class="border-l pl-5  md:w-[20%] text-center w-36 min-w-fit">نام محصول</td>
                                        <td class="w-36 md:w-[15%] text-center border-l min-w-fit">
                                          <span>مقدار</span>
                                        <td class="w-36 md:w-[20%] text-center border-l min-w-fit">
                                          <span>فی</span>
                                          <span class="text-gray-400 font-extralight">(ریال)</span>
                                        </td>
                                        <td class="w-36 md:w-[20%] text-center">
                                          <span>مجموع</span>
                                          <span class="text-gray-400 font-extralight">(ریال)</span>
                                        </td>
                                        <td class="w-36 md:w-[15%] text-center border-r">
                                          <span>زمان</span>
                                        </td>
                                        <td class="flex w-36 md:w-[10%]  justify-center items-center gap-2 border-r pr-1">
                                            <span class="w-full text-center">کدسفارش</span>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody x-data="{ detailrow:false }" class="space-y-1 w-full flex flex-col ">

                                @foreach( $transactions as $transaction)
                                    @if($transaction->type == "sell")
                                        <tr class="flex flex-row justify-between items-center bg-slate-100 w-fit md:w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative text-colorprimary/70">
                                        <td class="border-l pl-5  md:w-[20%] text-center w-36 min-w-fit font-normal tracking-tight">{{ $transaction->product->title }}</td>
                                        <td class="oneLine text-lengh w-36 md:w-[15%] text-center border-l font-normal">
                                          <span class="font-normal tracking-tight">{{ $transaction->value }}</span>
                                          <span class="text-gray-400 font-extralight tracking-tight">گرم</span>
                                        </td>
                                        <td class="oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight">{{ $transaction->fee }}</td>
                                        <td class="oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight">{{ $transaction->total_price }}</td>
                                        <td class="oneLine text-lengh w-36 md:w-[15%] text-center border-l font-normal tracking-tight flex gap-1 justify-center">
                                            <span>{{ $transaction->created_at->toDateString() }}</span>
                                            <span>{{ $transaction->created_at->format('H:i:s') }}</span>
                                        </td>

                                        <td class="oneLine w-36 md:w-[10%] flex gap-1 justify-center font-normal tracking-tight">
                                            <span>{{ $transaction->number }}</span>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            </div>

                        </div>
                    </span>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function change_list(type)
        {
            buy_section = document.getElementById("buy_section");
            sell_section = document.getElementById("sell_section");

            if(type === "sell")
            {
                console.log("pppppppppppppppppppppppppppp")
                buy_section.classList.add("hidden")
                sell_section.classList.remove("hidden")
            }else{
                buy_section.classList.remove("hidden")
                sell_section.classList.add("hidden")
            }

        }
    </script>
    <script src="{{ url("/js/select-searchable.js")}}"></script>
    <script src="{{ url("/js/menutoggle.js")}}"></script>
    <script src="{{ url("/js/menu-toggle.js")}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

@endsection
