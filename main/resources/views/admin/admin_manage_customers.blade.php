@extends('layout.admin')
@include("modals.add_customer_modal")
@include("alert.alert-error")
@section("title")
    اطلاعات پایه
@endsection
@section('content')
<span class="flex items-center justify-center gap-2 border-t mt-5 pt-2 w-fit">
                    <button onclick="open_create_modal()" class="flex justify-center bg-colorsecondry1 text-white w-full rounded-xl py-3 px-5">افزودن</button>
                </span>

<div class="w-full flex justify-start bg-white border border-slate-200 rounded-2xl p-1 mt-3">
                    <span class=" py-2 px-2 text-colorprimary text-lg w-full">
                        <span class="relative flex gap-2">
                            <img src="{{ url("/img/product-icon.svg")}}" alt="">
                            <span class="text-sm md:text-base">لیست مشتریان</span>

                            <span class="bg-colorprimary w-40 md:w-52 h-[1px] absolute -bottom-2"></span>
                            <span class="bg-colorsecondry1 w-10 h-[3px] absolute -bottom-2"></span>
                        </span>
                        <div class="gap-2 rounded-xl mt-5 pb-10">
                                    <!-- ---------------------- جدول معاملات خرید  ---------------------  -->
                                    <table id="customers_datatable" x-data="{ detailrow:false }" class="space-y-3 block overflow-x-auto pb-5 mt-5">
                                        <thead class="w-full flex">
                                            <tr class="flex justify-between items-center w-fit md:w-full bg-colorprimary text-white font-normal px-1 md:px-5 py-3 rounded-lg hover:shadow-gray-200/50 hover:shadow-lg text-xs lg:text-sm">
                                                <td>ردیف</td>
                                                <td class="border-l md:w-[30%] text-center w-36 min-w-fit">نام مشتری</td>
                                                <td class="w-36 md:w-[30%] text-center border-l min-w-fit">
                                                  <span>شماره تماس</span>
                                                </td>
                                                <td class="w-36 md:w-[20%] text-center border-r">
                                                  <span>وضعیت</span>
                                                </td>
                                                <td class="flex w-36 md:w-[20%]  justify-center items-center gap-2 border-r pr-1">
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
<!-- ----------مودال افزودن مشتری   ------------------  -->
@endsection
@section("scripts")
    <script src="{{ url("/js/select-searchable.js")}}"></script>
    <script src="{{ url("/js/menutoggle.js")}}"></script>
    <script src="{{ url("/js/menu-toggle.js")}}"></script>
    <script src="{{ url("/js/menu-toggle.js")}}"></script>
    <script src="{{url('/js/jquery.dataTables.min.js')}}"></script>
    <script>
        function change_modal_status_value(id)
        {
            console.log("here baby")
            $check_box = document.getElementById(id);
            $check_box.value = $check_box.checked ? 1 : 0 ;
        }
        let laravel_datatable;
        $(document).ready(function() {
            // $('.select2').select2();
            filterList()
        });
        function filterList() {
            console.log("filter list")
            laravel_datatable = $('#customers_datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                responsive: true,
                paging: true,
                autoWidth: false,
                "order": [[1, "desc"]],
                ajax:({
                    url : 'admin-list-customers',
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
                    {data: 'phone', name: 'phone', orderable: true, searchable: false},
                    {data: 'status', name: 'status', orderable: true, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],

                "columnDefs": [
                    { className: "border-l md:w-[30%] text-center w-36 min-w-fit font-normal tracking-tight", "targets": [ 0 ] },
                    { className: "oneLine text-lengh w-36 md:w-[30%] text-center border-l font-normal tracking-tight", "targets": [ 1 ] },
                    { className: "oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight flex gap-1 justify-center", "targets": [ 2 ] },
                    { className: "oneLine w-36 md:w-[20%] flex gap-1 justify-center font-normal tracking-tight", "targets": [ 3 ] },
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

        function open_create_modal()
        {
            reset_form("customer_form");
            $('#edit_user_modal').removeClass('hidden');
        }
        function open_edit_modal(customer_id)
        {
            reset_form("customer_form");
            console.log("editttttttt");
            let _url = 'find-customer/' + customer_id;
            $.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    console.log(response)
                    if(response) {
                        if(Object.keys(response).length > 0)
                        {
                            $('#modal_customer_name').val(response.name);
                            $('#modal_customer_lname').val(response.lastname);
                            $('#modal_customer_username').val(response.username);
                            $('#modal_customer_phone').val(response.phone);
                            $('#modal_customer_pass').val(response.password);
                            $('#modal_customer_repass').val(response.password);
                            $('#modal_customer_status').val(response.status);
                            $('#modal_customer_code').val(response.code);
                            $('#modal_customer_serial').val(response.nid_serial);
                            $('#modal_customer_certificate').attr('src', response.certificate_img);
                            $('#modal_customer_national_card').attr('src', response.national_card_img);
                            $('#modal_customer_certificate_img').attr('src', response.licence_img);
                            $('#modal_customer_national_card_img').attr('src', response.card_img);
                            $('#modal_customer_id').val(customer_id)
                            $('#modal_customer_nid').val(response.nid);

                            user_status = response.status;

                            status_checkbox = document.getElementById('modal_customer_status_checkbox');
                            status_checkbox.checked = user_status === 1 ? true: false;

                            $('#edit_user_modal').removeClass('hidden');
                        }else alert('محصول یافت نشد!')
                    }
                }
            });
        }
        function create_user()
        {
            console.log("heerererre");
            let _url        = 'customer-create';
            let formData    = new FormData($("#customer_form")[0]);

            $.ajax({
                type: 'POST',
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


        function change_market_status() {
            console.log('blade')
            let status = "";
            var checkbox = document.getElementById("market_status");
            if (checkbox.checked) {
                status = "open";
            } else {
                status = "closed";
            }
            let _url = 'admin-customers-market-status/' + status;

            $.ajax({
                url: _url,
                type: "GET",
                success: function (response) {
                    console.log(response)
                }
            });
        }

        function close_modal() {
            $("#edit_user_modal").addClass("hidden");
            reset_form("customer_form");
        }

        function reset_form(id) {
            $('#'+id)[0].reset();
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
</body>
</html>
