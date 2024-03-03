@include("includes.header")
@extends("layout.admin")
@section("title")
    معاملات ثبت شده
@endsection

@section("content")
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

                        <div class="gap-2 rounded-xl mt-5 pb-10">
                            <div id="buy_section" x-show="buy">
                                <span class="relative flex gap-2">
                                    <img src="{{ url("/img/product-icon.svg")}}" alt="">
                                    <span class="text-sm md:text-base">لیست معاملات خرید</span>

                                    <span class="bg-colorprimary w-40 md:w-48 h-[1px] absolute -bottom-2"></span>
                                    <span class="bg-colorfourth1 w-10 h-[3px] absolute -bottom-2"></span>
                                </span>
                                <!-- ---------------------- جدول  معاملات خرید  ---------------------  -->
                               <table id="transaction_datatable_buy" x-data="{ detailrow:false }" class="space-y-3 block overflow-x-auto pb-5 mt-5">
                                <thead class="w-full flex">
                                    <tr class="flex justify-between items-center w-fit xl:w-full bg-colorprimary text-white font-normal px-1 md:px-5 py-3 rounded-lg hover:shadow-gray-200/50 hover:shadow-lg text-xs lg:text-sm">
                                        <td class="border-l xl:w-[5%] text-center w-36 min-w-fit">ردیف</td>
                                        <td class="border-l xl:w-[15%] text-center w-36 min-w-fit">کاربر</td>
                                        <td class="border-l xl:w-[15%] text-center w-36 min-w-fit">نام محصول</td>
                                        <td class="w-36 xl:w-[10%] text-center border-l min-w-fit">
                                            <span>مقدار</span>
                                        </td>
                                        <td class="w-36 xl:w-[10%] text-center border-l min-w-fit">
                                          <span>فی</span>
                                          <span class="text-gray-400 font-extralight">(ریال)</span>
                                        </td>
                                        <td class="w-36 xl:w-[15%] text-center">
                                          <span>مجموع</span>
                                          <span class="text-gray-400 font-extralight">(ریال)</span>
                                        </td>
                                        <td class="w-36 xl:w-[20%] text-center border-r">
                                          <span>زمان</span>
                                        </td>
                                        <td class="w-36 xl:w-[10%] text-center border-r">
                                            <span>کد</span>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody x-data="{ detailrow:false }" class="space-y-1 w-full flex flex-col ">
                                </tbody>
                                </table>
                            </div>

                            <div id="sell_section" x-show="sell">
                                <span class="relative flex gap-2">
                                    <img src="{{ url("/img/product-icon.svg")}}" alt="">
                                    <span class="text-sm md:text-base">لیست معاملات فروش</span>
                                    <span class="bg-colorprimary w-40 md:w-48 h-[1px] absolute -bottom-2"></span>
                                    <span class="bg-colorthird1 w-10 h-[3px] absolute -bottom-2"></span>
                                </span>
                                <!-- ---------------------- جدول معاملات فروش  ---------------------  -->
                                <!-- ---------------------- جدول  معاملات خرید  ---------------------  -->
                           <table id="transaction_datatable_sell" x-data="{ detailrow:false }" class="space-y-3 block overflow-x-auto pb-5 mt-5">
                            <thead class="w-full flex">
                                <tr class="flex justify-between items-center w-fit xl:w-full bg-colorprimary text-white font-normal px-1 md:px-5 py-3 rounded-lg hover:shadow-gray-200/50 hover:shadow-lg text-xs lg:text-sm">
                                    <td class="border-l xl:w-[5%] text-center w-36 min-w-fit">ردیف</td>
                                    <td class="border-l xl:w-[15%] text-center w-36 min-w-fit">کاربر</td>
                                    <td class="border-l xl:w-[15%] text-center w-36 min-w-fit">نام محصول</td>
                                    <td class="w-36 xl:w-[10%] text-center border-l min-w-fit">
                                      <span>مقدار</span>
                                    </td>
                                    <td class="w-36 xl:w-[10%] text-center border-l min-w-fit">
                                      <span>فی</span>
                                      <span class="text-gray-400 font-extralight">(ریال)</span>
                                    </td>
                                    <td class="w-36 xl:w-[15%] text-center">
                                      <span>مجموع</span>
                                      <span class="text-gray-400 font-extralight">(ریال)</span>
                                    </td>
                                    <td class="w-36 xl:w-[20%] text-center border-r">
                                      <span>زمان</span>
                                    </td>
                                    <td class="w-36 xl:w-[10%] text-center border-r">
                                      <span>کد</span>
                                    </td>
                                </tr>
                            </thead>
                            <tbody x-data="{ detailrow:false }" class="space-y-1 w-full flex flex-col ">

                            </tbody>
                            </table>
                            </div>

                        </div>
                    </span>
    </div>

@endsection
@section("scripts")

    <script src="{{ url("/js/select-searchable.js")}}"></script>
    <script src="{{ url("/js/menutoggle.js")}}"></script>
    <script src="{{ url("/js/menu-toggle.js")}}"></script>
    <script src="{{url('/js/jquery.dataTables.min.js')}}"></script>
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
        $(document).ready(function() {
            // $('.select2').select2();
            let laravel_datatable;
            filterListBuy();
            filterListSell()
        });

        function filterListBuy() {
            console.log("filter list")
            laravel_datatable = $('#transaction_datatable_buy').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                responsive: true,
                paging: true,
                autoWidth: false,
                "order": [[1, "desc"]],
                ajax:({
                    url : 'admin-list-transactions-buy',
                    type : 'GET',
                }),
                columns: [
                    {
                        "data": null, "sortable": false, searchable: false, orderable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'user', name: 'user', orderable: true, searchable: true},
                    {data: 'title', name: 'title', orderable: true, searchable: false},
                    {data: 'value', name: 'value', orderable: true, searchable: false},
                    {data: 'fee', name: 'fee', orderable: true, searchable: false},
                    {data: 'totalPrice', name: 'totalPrice', orderable: false, searchable: false},
                    {data: 'time', name: 'time', orderable: true, searchable: false},
                    {data: 'number', name: 'number', orderable: true, searchable: false},
                ],

                "columnDefs": [
                    { className: "border-l xl:w-[20%] text-center w-36 min-w-fit font-normal tracking-tight text-sm", "targets": [ 0 ] },
                    { className: "border-l xl:w-[15%] text-center w-36 min-w-fit font-normal tracking-tight text-sm flex flex-col", "targets": [ 1 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[10%] text-center border-l font-normal tracking-tight text-base", "targets": [ 2 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[10%] text-center border-l font-normal tracking-tight text-base", "targets": [ 3 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[15%] text-center border-l font-normal tracking-tight text-sm", "targets": [ 4 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[20%] text-center font-normal tracking-tight text-sm flex gap-2 justify-center", "targets": [ 5 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[10%] text-center font-normal tracking-tight text-sm flex gap-2 justify-center", "targets": [ 6 ] },

                ],
                language: {
                    "sEmptyTable": "هیچ داده ای در جدول وجود ندارد",
                    "sInfo": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                    "sInfoEmpty": "نمایش 0 تا 0 از 0 رکورد",
                    "sInfoFiltered": "(فیلتر شده از _MAX_ رکورد)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ",",
                    "sLengthMenu": "نمایش _MENU_ رکورد",
                    "sLoadingRecords": "در حال بارگزاری...",
                    "sProcessing": "در حال پردازش...",
                    "sSearch": "جستجو:",
                    "sZeroRecords": "رکوردی با این مشخصات پیدا نشد",
                    "oPaginate": {
                        "sFirst": "ابتدا",
                        "sLast": "انتها",
                        "sNext": "بعدی",
                        "sPrevious": "قبلی"
                    },
                    "oAria": {
                        "sSortAscending": ": فعال سازی نمایش به صورت صعودی",
                        "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
                    }
                }
            });

        }

        function filterListSell() {
            console.log("filter list")
            laravel_datatable = $('#transaction_datatable_sell').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                responsive: true,
                paging: true,
                autoWidth: false,
                "order": [[1, "desc"]],
                ajax:({
                    url : 'admin-list-transactions-sell',
                    type : 'GET',
                }),
                columns: [
                    {
                        "data": null, "sortable": false, searchable: false, orderable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'user', name: 'user', orderable: true, searchable: true},
                    {data: 'title', name: 'title', orderable: true, searchable: false},
                    {data: 'value', name: 'value', orderable: true, searchable: false},
                    {data: 'fee', name: 'fee', orderable: true, searchable: false},
                    {data: 'totalPrice', name: 'totalPrice', orderable: false, searchable: false},
                    {data: 'time', name: 'time', orderable: true, searchable: false},
                    {data: 'number', name: 'number', orderable: true, searchable: false},
                ],

                "columnDefs": [
                    { className: "border-l xl:w-[20%] text-center w-36 min-w-fit font-normal tracking-tight text-sm flex flex-col", "targets": [ 0 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[15%] text-center border-l font-normal tracking-tight text-base", "targets": [ 1 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[10%] text-center border-l font-normal tracking-tight text-base", "targets": [ 2 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[10%] text-center border-l font-normal tracking-tight text-base", "targets": [ 3 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[15%] text-center border-l font-normal tracking-tight text-sm", "targets": [ 4 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[20%] text-center font-normal tracking-tight text-sm flex gap-2 justify-center", "targets": [ 5 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[10%] text-center font-normal tracking-tight text-sm flex gap-2 justify-center", "targets": [ 6 ] },

                ],
                language: {
                    "sEmptyTable": "هیچ داده ای در جدول وجود ندارد",
                    "sInfo": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                    "sInfoEmpty": "نمایش 0 تا 0 از 0 رکورد",
                    "sInfoFiltered": "(فیلتر شده از _MAX_ رکورد)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ",",
                    "sLengthMenu": "نمایش _MENU_ رکورد",
                    "sLoadingRecords": "در حال بارگزاری...",
                    "sProcessing": "در حال پردازش...",
                    "sSearch": "جستجو:",
                    "sZeroRecords": "رکوردی با این مشخصات پیدا نشد",
                    "oPaginate": {
                        "sFirst": "ابتدا",
                        "sLast": "انتها",
                        "sNext": "بعدی",
                        "sPrevious": "قبلی"
                    },
                    "oAria": {
                        "sSortAscending": ": فعال سازی نمایش به صورت صعودی",
                        "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
                    }
                }
            });

        }

        function change_market_status() {
            console.log('blade')
            let status = "";
            var checkbox = document.getElementById("market_status");
            if (checkbox.checked) {
                status = "open";
            } else {
                status = "closed";
            }
            let _url = 'admin-transaction-market-status/' + status;

            $.ajax({
                url: _url,
                type: "GET",
                success: function (response) {
                    console.log(response)
                }
            });
        }
    </script>

@endsection

