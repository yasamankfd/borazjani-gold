@extends('layout.admin')
@section("title")
    اطلاعات پایه
@endsection
@section('content')
    <span class="flex items-center justify-center gap-2 border-t mt-5 pt-2 w-fit">
                    <a onclick="open_create_modal()" class="flex justify-center bg-colorsecondry1 text-white w-full rounded-xl py-3 px-5">افزودن محصول</a>
                </span>

    <div class="w-full flex justify-start bg-white border border-slate-200 rounded-2xl p-1 mt-3">
                    <span class=" py-2 px-2 text-colorprimary text-lg w-full">
                        <span class="relative flex gap-2">
                            <img src="{{ url("/img/product-icon.svg")}}" alt="">
                            <span class="text-sm md:text-base">لیست محصولات</span>

                            <span class="bg-colorprimary w-40 md:w-52 h-[1px] absolute -bottom-2"></span>
                            <span class="bg-colorsecondry1 w-10 h-[3px] absolute -bottom-2"></span>
                        </span>
                        <div class="gap-2 rounded-xl mt-5 pb-10">
                                    <!-- ---------------------- جدول معاملات خرید  ---------------------  -->
                                    <table id="products_datatable" x-data="{ detailrow:false }" class="space-y-3 block overflow-x-auto pb-5 mt-5">
                                        <thead class="w-full flex">
                                            <tr class="flex justify-between items-center w-fit md:w-full bg-colorprimary text-white font-normal px-1 md:px-5 py-3 rounded-lg hover:shadow-gray-200/50 hover:shadow-lg text-xs lg:text-sm">
                                                <td class="border-l pl-5  md:w-[20%] text-center w-36 min-w-fit">ردیف</td>
                                                <td class="border-l pl-5  md:w-[20%] text-center w-36 min-w-fit">نام محصول</td>
                                                <td class="w-36 md:w-[15%] text-center border-l min-w-fit">
                                                  <span>واحد</span>
                                                <td class="w-36 md:w-[20%] text-center border-l min-w-fit">
                                                  <span>نرخ خرید</span>
                                                  <span class="text-gray-400 font-extralight">(ریال)</span>
                                                </td>
                                                <td class="w-36 md:w-[20%] text-center">
                                                  <span>نرخ فروش</span>
                                                  <span class="text-gray-400 font-extralight">(ریال)</span>
                                                </td>
                                                <td class="w-36 md:w-[15%] text-center border-r">
                                                  <span>وضعیت</span>
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
    <!-- ----------مودال اطلاعات محصول  ------------------  -->
    <div id="create_product_modal"  x-transition.duration.500ms class="bg-black/50 hidden backdrop-blur-sm fixed pb-10 top-0 w-full h-screen flex items-center px-5 z-10">
        <div class="bg-white w-full sm:max-w-3xl max-h-[70vh] sm:max-h-full mx-auto p-5 rounded-lg flex flex-col gap-3 overflow-y-auto">
            <span class="flex flex-row justify-between items-center border-b pb-2">
                 <span>اطلاعات محصول</span>
                 <span   class="bg-gray-100 p-1 sm:p-2 rounded-md cursor-pointer">
                    <svg onclick="close_modal()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                 </span>
            </span>
            <!-- ردیف اول  -->
            <form id="create_product_form" method="POST" id="create_product_form">
                @csrf
                <span class="flex flex-col items-center sm:flex-row gap-2">
                <span class="w-full flex flex-col lg:flex-row gap-2">
                    <span class="w-full lg:w-1/2">
                        <span class="pr-5 font-light text-sm">نام محصول</span>
                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                            <input type="text" id="modal_product_title" name="modal_product_title" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام محصول را وارد کنید">
                        </span>
                    </span>
                    <span class="w-full lg:w-1/2">
                        <span class="pr-5 font-light text-sm">واحد</span>
                        <select
                            id="modal_product_unit"
                            name="modal_product_unit"
                            class="selectpicker" style="width: 100%"
                            data-placeholder="انتخاب کنید"
                            data-allow-clear="false"
                            title="Select unit...">
                        <option>گرم</option>
                        <option>تعداد</option>
                        </select>
                    </span>
                </span>
            </span>

            <!-- ردیف دوم  -->
            <span class="flex flex-col items-center sm:flex-row gap-2">
                <span class="w-full flex flex-col lg:flex-row gap-2">
                    <span class="w-full lg:w-1/2">
                        <span class="pr-5 font-light text-sm">قیمت خرید</span>
                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                            <input type="text" id="modal_product_buy_price" name="modal_product_buy_price" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="قیمت خرید را وارد کنید">
                        </span>
                    </span>
                    <span class="w-full lg:w-1/2">
                        <span class="pr-5 font-light text-sm">قیمت فروش</span>
                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                            <input type="text" id="modal_product_sell_price" name="modal_product_sell_price" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="قیمت فروش را وارد کنید">
                        </span>
                    </span>
                </span>
            </span>

            <!-- ردیف دوم  -->
            <span class="flex flex-col sm:flex-row gap-2">
                    <span class="w-full flex flex-col justify-center items-center jus lg:flex-row gap-2">
                        <label class="flex gap-2 items-center justify-center cursor-pointer">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">غیرفعال</span>
                            <input onclick="change_modal_status_value('modal_product_status')" name="modal_product_status" id="modal_product_status" type="checkbox" value="" class="sr-only peer">
                            <div class="relative w-11 h-6 bg-colorthird1 peer-focus:outline-none peer-focus:ring-4 dark:peer-focus:ring-colorthird1 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-colorfourth1"></div>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">فعال</span>
                        </label>
                    </span>
                </span>
            <input name="modal_product_id" id="modal_product_id" class="hidden">
            </form>
            <div class="flex flex-col sm:flex-row justify-end gap-2 mt-3 w-full">
                <button onclick="create_product()" class="min-w-[100px] text-center bg-colorsecondry1 text-white sm:hover:-translate-y-1 transition-transform duration-200 py-3 px-5 rounded-full cursor-pointer text-xs sm:text-sm">ثبت</button>
                <button onclick="close_modal()" class="min-w-[100px] bg-colorprimary text-white sm:hover:-translate-y-1 transition-transform duration-200 py-3 px-5 rounded-full cursor-pointer text-xs sm:text-sm text-center">بازگشت</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script src="{{ url("/js/select-searchable.js")}}"></script>
<script src="{{ url("/js/menutoggle.js")}}"></script>
<script src="{{ url("/js/menu-toggle.js")}}"></script>
<script src="{{url('/js/jquery.dataTables.min.js')}}"></script>
<script>
    let laravel_datatable;
    $(document).ready(function() {
        // $('.select2').select2();

        filterList();
    });

    function create_product()
    {
        console.log("heerererre");
        // let formData = new FormData(document.getElementById('create_product_form'));
        let _url        = 'product-create';
        let formData    = new FormData($("#create_product_form")[0]);
        console.log(formData)

        // var status_checkbox = document.getElementById("modal_product_status");
        // var title = document.getElementById("modal_product_title").value;
        // var unit = document.getElementById("modal_product_unit").value;
        // var buy_price = document.getElementById("modal_product_buy_price").value;
        // var sell_price = document.getElementById("modal_product_sell_price").value;
        // var modal_product_id = document.getElementById("modal_product_id").value;
        //
        // var status = status_checkbox.checked === true ? 1 : 0 ;
        //
        // formData.append('title', title);
        // formData.append('unit', unit);
        // formData.append('status', status);
        // formData.append('buy_price', buy_price);
        // formData.append('sell_price', sell_price);
        // formData.append('id', modal_product_id);

        // Make an Ajax request using Fetch API

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
                    laravel_datatable.ajax.reload(null, false);
                    close_modal();
                }
            },
            error: function (response) {
                handleErrorResponse(response);
            }
        });
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
                url : 'admin-list-products',
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
                {data: 'unit', name: 'unit', orderable: true, searchable: false},
                {data: 'buy_price', name: 'buy_price', orderable: true, searchable: false},
                {data: 'sell_price', name: 'sell_price', orderable: true, searchable: false},
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: true, searchable: false},
            ],
            "columnDefs": [
                { className: "border-l pl-5  md:w-[20%] text-center w-36 min-w-fit font-normal tracking-tight", "targets": [ 0 ] },
                { className: "oneLine text-lengh w-36 md:w-[15%] text-center border-l font-normal", "targets": [ 1 ] },
                { className: "oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight", "targets": [ 2 ] },
                { className: "oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight" , "targets": [ 3 ] },
                { className: "oneLine text-lengh w-36 md:w-[15%] text-center border-l font-normal tracking-tight flex gap-1 justify-center" , "targets": [ 4 ] },
                { className: "oneLine w-36 md:w-[10%] flex gap-1 justify-center font-normal tracking-tight", "targets": [ 5 ] },
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

    function change_modal_status_value(id)
    {
        console.log("here baby")
        $check_box = document.getElementById(id);
        $check_box.value = $check_box.checked ? 1 : 0 ;
    }
    function open_create_modal()
    {
        $('#create_product_modal').removeClass('hidden');
    }
    function open_edit_modal(product_id)
    {
        console.log("editttttttt");
        let _url = 'find-product/' + product_id;
        $.ajax({
            url: _url,
            type: "GET",
            success: function(response) {
                console.log(response)
                if(response) {
                    if(Object.keys(response).length > 0)
                    {
                        $('#modal_product_title').val(response.title);
                        $('#modal_product_buy_price').val(response.buy_price);
                        $('#modal_product_sell_price').val(response.sell_price);
                        $('#modal_product_id').val(product_id);

                        unit_select = document.getElementById("modal_product_unit");
                        console.log(unit_select)
                        product_status = response.status;
                        unit = response.unit;
                        console.log(unit)
                        if(unit.includes("gram"))
                        {
                            unit_select.selectedIndex = 0;
                        }else {
                            unit_select.selectedIndex = 1;
                        }
                        status_checkbox = document.getElementById('modal_product_status');
                        status_checkbox.checked = product_status === 1 ? true: false;

                        $('#create_product_modal').removeClass('hidden');
                    }else alert('محصول یافت نشد!');
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
        let _url = 'admin-products-market-status/' + status;

        $.ajax({
            url: _url,
            type: "GET",
            success: function (response) {
                console.log(response)
            }
        });
    }
    function close_modal() {
        $("#create_product_modal").addClass("hidden");
        reset_form("product_form");
    }
    function reset_form(id) {
        $('#'+id)[0].reset();
    }


</script>
@endsection

