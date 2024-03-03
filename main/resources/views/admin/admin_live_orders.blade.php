@extends("layout.admin")
@include("includes.header")
@section("title")
    معاملات جاری
@endsection
@section("content")
<div class="w-full flex justify-start bg-white border border-slate-200 rounded-2xl p-1 mt-3">
                    <span class=" py-2 px-2 text-colorprimary text-lg w-full">
                        <span class="relative flex gap-2">
                            <img src="{{ url("/img/product-icon.svg")}}" alt="">
                            <span class="text-sm md:text-base">لیست سفارشات</span>

                            <span class="bg-colorprimary w-40 md:w-52 h-[1px] absolute -bottom-2"></span>
                            <span class="bg-colorsecondry1 w-10 h-[3px] absolute -bottom-2"></span>
                        </span>
                        <div class="gap-2 rounded-xl mt-5 pb-10">
                            <!-- ---------------------- جدول سفارشات جاری  ---------------------  -->
                              <table id="products_datatable" x-data="{ detailrow:false }" class="space-y-3 block overflow-x-auto pb-5">
                                  <thead class="w-full flex">
                                      <tr class="flex justify-between items-center w-fit xl:w-full bg-colorprimary text-white font-normal px-1 md:px-5 py-3 rounded-lg hover:shadow-gray-200/50 hover:shadow-lg text-xs lg:text-sm">
                                          <td class="border-l xl:w-[15%] text-center w-36 min-w-fit">کاربر</td>
                                          <td class="border-l xl:w-[15%] text-center w-36 min-w-fit">نام محصول</td>
                                          <td class="w-36 xl:w-[10%] text-center border-l min-w-fit">
                                            <span>مقدار</span>
                                          </td>
                                          <td class="w-36 xl:w-[10%] text-center border-l min-w-fit">
                                            <span>فی</span>
                                            <span class="text-gray-400 font-extralight">(ریال)</span>
                                          </td>
                                          <td class="w-36 xl:w-[10%] text-center">
                                            <span>مجموع</span>
                                            <span class="text-gray-400 font-extralight">(ریال)</span>
                                          </td>
                                          <td class="w-36 xl:w-[10%] text-center border-r">
                                            <span>وضعیت</span>
                                          </td>
                                          <td class="w-36 xl:w-[10%] text-center border-r">
                                            <span>ساعت</span>
                                          </td>
                                          <td class="flex w-36 xl:w-[10%]  justify-center items-center gap-2 border-r pr-1">
                                            <span class="w-full text-center">معامله</span>
                                        </td>
                                          <td class="flex w-36 xl:w-[10%]  justify-center items-center gap-2 border-r pr-1">
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
<!-- ----------مودال تاییدیه  ------------------  -->
<div id="modal_submit" x-transition.duration.500ms class="bg-black/50  hidden backdrop-blur-sm fixed pb-10 top-0 w-full h-screen flex items-center px-5 z-10">
    <div class="bg-white w-full sm:max-w-lg max-h-[70vh] sm:max-h-full mx-auto p-5 rounded-lg flex flex-col gap-3 overflow-y-auto">
            <span class="flex flex-row justify-between items-center border-b pb-2">
                 <span>تاییدیه نهایی</span>
                 <span x-on:click="modal1 = false" class="bg-gray-100 p-1 sm:p-2 rounded-md cursor-pointer">
                    <svg onclick="close_modal()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                 </span>
            </span>

        <!-- ردیف اول  -->
        <span class="flex flex-col justify-center items-center sm:flex-row gap-2">
                <h2 class="font-light text-center">این سفارش مورد تایید می باشد؟</h2>
            </span>

        <div class="flex flex-col sm:flex-row justify-center gap-2 mt-3 w-full">
            <button onclick="submit_order()" class="min-w-[100px] text-center bg-colorsecondry1 text-white sm:hover:-translate-y-1 transition-transform duration-200 py-3 px-5 rounded-full cursor-pointer text-xs sm:text-sm">بله</button>
            <button onclick="close_modal()" class="min-w-[100px] bg-colorprimary text-white sm:hover:-translate-y-1 transition-transform duration-200 py-3 px-5 rounded-full cursor-pointer text-xs sm:text-sm text-center">خیر</button>
        </div>
    </div>
</div>
@endsection
@section("scripts")
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
{{--    <script src="{{ url("/js/select-searchable.js")}}"></script>--}}
    <script src="{{ url("/js/menutoggle.js")}}"></script>
    <script src="{{ url("/js/menu-toggle.js")}}"></script>
    <script src="{{url('/js/jquery.dataTables.min.js')}}"></script>

    <script>


        $(document).ready(function() {
            let laravel_datatable;
            filterList();
        });

        function open_create_modal(id)
        {
            $('#modal_submit').removeClass('hidden');
            $('#order_id').val(id);
        }
        function close_modal() {
            $("#modal_submit").addClass("hidden");

        }

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
                    url : 'admin-list-orders',
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
                    {data: 'status', name: 'status', orderable: true, searchable: false},
                    {data: 'type', name: 'type', orderable: true, searchable: false},
                    {data: 'time', name: 'time', orderable: true, searchable: false},
                    {data: 'action', name: 'action', orderable: true, searchable: false},

                ],
                "createdRow": function (row, data, dataIndex) {
                    // Call your JavaScript function with arguments here
                    yourJavaScriptFunction(row, data, dataIndex);
                },
                "columnDefs": [
                    { className: "border-l xl:w-[20%] text-center w-36 min-w-fit font-normal tracking-tight text-sm", "targets": [ 0 ] },
                    { className: "border-l xl:w-[15%] text-center w-36 min-w-fit font-normal tracking-tight text-sm flex flex-col", "targets": [ 1 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[10%] text-center border-l font-normal tracking-tight text-base", "targets": [ 2 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[10%] text-center border-l font-normal tracking-tight text-sm", "targets": [ 3 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[10%] text-center border-l font-normal tracking-tight text-sm", "targets": [ 4 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[10%] text-center border-l font-light tracking-tight text-sm flex gap-1 justify-center", "targets": [ 5 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[10%] text-center border-l font-light tracking-tight text-sm flex gap-1 justify-center", "targets": [ 6 ] },
                    { className: "oneLine text-lengh w-36 xl:w-[10%] text-center border-l font-light tracking-tight text-sm flex gap-1 justify-center", "targets": [ 7 ] },
                    { className: "oneLine w-36 xl:w-[10%] flex gap-1 justify-center", "targets": [ 8 ] },

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

        function submit_order() {

            let _url        = 'admin-save-order';
            let formData    = new FormData($("#save_order_form")[0]);

            $.ajax({
                type:'POST',
                url: _url,
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.code === 200) {
                        if (response.id != null) {
                            console.log('warning');
                        } else {
                            console.log('success');
                        }
                        laravel_datatable.ajax.reload(null, false);
                        close_modal();
                    }
                },
                error: function (response) {
                    handleErrorResponse(response);
                }
            });
        }

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
            let _url = 'admin-liveorder-market-status/' + status;

            $.ajax({
                url: _url,
                type: "GET",
                success: function (response) {
                    console.log(response)
                }
            });
        }
        function live_order_notification()
        {

        }

    </script>
@endsection
