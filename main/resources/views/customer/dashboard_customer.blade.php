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
                              <table id="products_datatable" x-data="{ detailrow:false }" class="space-y-3 block pb-5">
                                  <thead class="w-full flex">
                                      <tr class="flex justify-between items-center w-full bg-slate-100 font-normal px-1 md:px-5 py-3 rounded-lg hover:shadow-gray-200/50 hover:shadow-lg text-xs lg:text-sm">
                                          <td class="border-l sm:w-[30%] text-center w-24 break-words">ردیف</td>
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


                                  </tbody>
                                </table>
                            </div>
                    </span>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url("/js/menutoggle.js")}}"></script>
    <script src="{{ url("/js/menu-toggle.js")}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{url('/js/jquery.dataTables.min.js')}}"></script>
    <script>
        let laravel_datatable;
        function open_trade_page(product_id,type)
        {
            console.log("here")
            window.open('customer-order/'+product_id+"/"+type);
        }
        $(document).ready(function() {
            // $('.select2').select2();

            filterList();
        });

        function filterList() {
            console.log("filter list")
            laravel_datatable = $('#products_datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                responsive: true,
                paging: true,
                autoWidth: false,
                "order": [[1, "desc"]],
                ajax:({
                    url : 'customer-list-products',
                    type : 'GET',
                }),
                columns: [
                    {
                        "data": null, "sortable": false, searchable: false, orderable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'title', name: 'title', orderable: true, searchable: true},
                    {data: 'buy_price', name: 'buy_price', orderable: true, searchable: false},
                    {data: 'sell_price', name: 'sell_price', orderable: true, searchable: false},
                    {data: 'action', name: 'action', orderable: true, searchable: false},
                ],
                "columnDefs": [
                    { className: "border-l sm:w-[30%] text-center w-24 break-words", "targets": [ 0 ] },
                    { className: "oneLine text-lengh w-24 sm:w-[25%] text-center border-l font-bold text-xs xl:text-base text-colorfourth1 flex flex-col items-center", "targets": [ 1 ] },
                    { className: "oneLine text-lengh w-24 sm:w-[25%] text-center md:border-l font-bold text-xs xl:text-base text-colorthird1 flex flex-col items-center", "targets": [ 2 ] },
                    { className: "hidden md:flex xl:flex-row flex-col items-center justify-center oneLine w-36 sm:w-[20%] gap-1" , "targets": [ 3 ] },
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
    </script>


@endsection
