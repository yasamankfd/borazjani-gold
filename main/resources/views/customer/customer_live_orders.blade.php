@include("includes.header")
@extends('layout.customer')
@section('page_title')
    سفارشات
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
    <!-- -------------------------- نمایش اطلاعیه ---------------------------  -->
    <div class="w-full flex justify-start bg-[#FFE9E9] border border-[#FF7B7B] rounded-2xl p-1 mt-3">
                    <span class=" py-2 px-5 text-colorprimary text-lg">
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
                    <span class=" py-2 px-5 text-colorprimary text-lg w-full">
                        <span class="relative flex gap-2">
                            <img src="{{ url("/img/product-icon.svg")}}" alt="">
                            <span class="text-sm md:text-base">لیست سفارشات جاری </span>

                            <span class="bg-colorprimary w-40 md:w-52 h-[1px] absolute -bottom-2"></span>
                            <span class="bg-colorsecondry1 w-10 h-[3px] absolute -bottom-2"></span>
                        </span>
                        <div class="gap-2 rounded-xl mt-5 pb-10">
                            <!-- ---------------------- جدول سفارشات جاری  ---------------------  -->
                            <input class="hidden" id="user_id" value="{{ $user_id }}">
                              <table id="products_datatable" x-data="{ detailrow:false }" class="space-y-3 block overflow-x-auto pb-5">
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
                                            <span>نوع معامله</span>
                                          </td>
                                          <td class="w-36 md:w-[15%] text-center border-r">
                                            <span>ساعت</span>
                                          </td>
                                          <td class="flex w-36 md:w-[10%]  justify-center items-center gap-2 border-r pr-1">
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
@endsection

@section('scripts')
<script src="{{ url("/js/menutoggle.js")}}"></script>
<script src="{{ url("/js/menu-toggle.js")}}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{url('/js/jquery.dataTables.min.js')}}"></script>

<script>
    function startCountdown(time , id ) {
        now = new Date().getTime();
        created = new Date(time).getTime();
        let seconds = Number(((created + 120000) - now)/1000).toFixed(0) ;

        var countdownValue = $('#countdownValue_' + id);
        var countdown = $('#countdown_' + id);
        if(seconds < 0)
        {

            countdownValue.text('');
            countdown.text('درخواست مجدد');
        }
        if(seconds >= 0 ){
            console.log(seconds)

            var interval = setInterval(function () {
                countdownValue.text(seconds);
                seconds--;

                if (seconds < 0) {
                    clearInterval(interval);
                    countdownValue.text('0');
                }
            }, 1000);
        }
    }
    function yourJavaScriptFunction(row, data, dataIndex) {
        startCountdown(data.created_at, data.id);
    }
    $(document).ready(function() {
        // $('.select2').select2();
        let laravel_datatable;
        let id = document.getElementById("user_id").value;

        filterList(id);
    });

    function filterList(id) {
        console.log("filter list")
        console.log(id)
        laravel_datatable = $('#products_datatable').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            responsive: true,
            paging: true,
            autoWidth: false,
            "order": [[1, "desc"]],
            ajax:({
                url : 'customer-list-orders',
                type : 'GET',
            }),
            columns: [
                {
                    "data": null, "sortable": false, searchable: false, orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'title', name: 'title', orderable: true, searchable: false},
                {data: 'value', name: 'value', orderable: true, searchable: false},
                {data: 'fee', name: 'fee', orderable: true, searchable: false},
                {data: 'totalPrice', name: 'totalPrice', orderable: false, searchable: false},
                {data: 'type', name: 'type', orderable: true, searchable: false},
                {data: 'time', name: 'time', orderable: true, searchable: false},
                {data: 'status', name: 'status', orderable: true, searchable: false},
            ],
            "createdRow": function (row, data, dataIndex) {
                // Call your JavaScript function with arguments here
                yourJavaScriptFunction(row, data, dataIndex);
            },
            "columnDefs": [
                { className: "border-l pl-5  md:w-[20%] text-center w-36 min-w-fit font-normal tracking-tight text-sm", "targets": [ 0 ] },
                { className: "oneLine text-lengh w-36 md:w-[15%] text-center border-l font-normal tracking-tight text-base", "targets": [ 1 ] },
                { className: "oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight text-sm", "targets": [ 2 ] },
                { className: "oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight text-sm", "targets": [ 3 ] },
                { className: "oneLine text-lengh w-36 md:w-[15%] text-center border-l font-light tracking-tight text-sm flex gap-1 justify-center", "targets": [ 4 ] },
                { className: "oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight text-sm", "targets": [ 5 ] },
                { className: "oneLine w-36 xl:w-[10%] flex gap-1 justify-center", "targets": [ 6 ] },

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
    // function startCountdown2(time , id) {
    //     now = new Date().getTime();
    //     created = new Date(time).getTime();
    //     let seconds = Number(((created + 120000) - now)/1000).toFixed(0) ;
    //     // console.log(seconds)
    //     // console.log(id)
    //     var countdownValue = document.getElementById('countdownValue_'+id);
    //     var countdown = document.getElementById('countdown_'+id);
    //     if(seconds < 0)
    //     {
    //         countdownValue.innerText = '';
    //         countdown.innerText = 'درخواست مجدد';
    //     }
    //     if(seconds >= 0 ){
    //         var interval = setInterval(function () {
    //             countdownValue.innerText = seconds;
    //             seconds--;
    //
    //             if (seconds < 0) {
    //                 clearInterval(interval);
    //                 countdownValue.innerText = '0';
    //             }
    //         }, 1000);
    //     }
    // }
{{--    @foreach($orders as $item)--}}
{{--    startCountdown("{{ $item->created_at }}", "{{ $item->id }}");--}}
{{--    @endforeach--}}
</script>
@endsection

