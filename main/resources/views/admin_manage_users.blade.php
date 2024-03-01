@extends("layout.admin")
@include("includes.header")
@section("title")
    لیست کاربران
@endsection
@section("content")
    <span class="flex items-center justify-center gap-2 border-t mt-5 pt-2 w-fit">
                    <button onclick="open_create_modal()" class="flex justify-center bg-colorsecondry1 text-white w-full rounded-xl py-3 px-5">افزودن</button>
                </span>

    <div class="w-full flex justify-start bg-white border border-slate-200 rounded-2xl p-1 mt-3">
                    <span class=" py-2 px-2 text-colorprimary text-lg w-full">
                        <span class="relative flex gap-2">
                            <img src="{{ url("/img/product-icon.svg")}}" alt="">
                            <span class="text-sm md:text-base">لیست کاربران</span>

                            <span class="bg-colorprimary w-40 md:w-52 h-[1px] absolute -bottom-2"></span>
                            <span class="bg-colorsecondry1 w-10 h-[3px] absolute -bottom-2"></span>
                        </span>
                        <div class="gap-2 rounded-xl mt-5 pb-10">
                                    <!-- ---------------------- جدول معاملات خرید  ---------------------  -->
                                    <table id="users_datatable" x-data="{ detailrow:false }" class="space-y-3 block overflow-x-auto pb-5 mt-5">
                                        <thead class="w-full flex">
                                            <tr class="flex justify-between items-center w-fit md:w-full bg-colorprimary text-white font-normal px-1 md:px-5 py-3 rounded-lg hover:shadow-gray-200/50 hover:shadow-lg text-xs lg:text-sm">
                                                <td class="border-l md:w-[30%] text-center w-36 min-w-fit">ردیف</td>
                                                <td class="border-l md:w-[30%] text-center w-36 min-w-fit">نام کاربر</td>
                                                <td class="w-36 md:w-[20%] text-center border-l min-w-fit">
                                                  <span>شماره تماس</span>
                                                </td>
                                                <td class="w-36 md:w-[20%] text-center border-l min-w-fit">
                                                    <span>نقش</span>
                                                  </td>
                                                <td class="w-36 md:w-[20%] text-center">
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
    <!-- ----------مودال افزودن مشتری   ------------------  -->

    <div id="edit_user_modal" x-transition.duration.500ms class="bg-black/50 hidden backdrop-blur-sm fixed pb-10 top-0 w-full h-screen flex items-center px-5 z-10">
        <div class="bg-white w-full sm:max-w-3xl max-h-[70vh] sm:max-h-full mx-auto p-5 rounded-lg flex flex-col gap-3 overflow-y-auto">
            <span class="flex flex-row justify-between items-center border-b pb-2">
                 <span>اطلاعات کاربران</span>
                 <span x-on:click="modal1 = false" class="bg-gray-100 p-1 sm:p-2 rounded-md cursor-pointer">
                    <svg onclick="close_modal('edit_user_modal')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                 </span>
            </span>

            <!-- ردیف اول  -->
            <form id="user_form" action="{{ route("user-create") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="hidden" name="modal_user_id" id="modal_user_id">
                <span class="flex flex-col items-center sm:flex-row gap-2">
                <span class="w-full flex flex-col lg:flex-row gap-2">
                    <span class="w-full lg:w-2/3">
                        <span class="pr-5 font-light text-sm">نام</span>
                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                            <input type="text" name="modal_user_name" id="modal_user_name" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام مشتری را وارد کنید">
                        </span>
                    </span>
                    <span class="w-full lg:w-2/3">
                        <span class="pr-5 font-light text-sm">نام خانوادگی</span>
                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                            <input type="text" name="modal_user_lname" id="modal_user_lname" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام مشتری را وارد کنید">
                        </span>
                    </span>
                    <span class="w-full lg:w-2/3">
                        <span class="pr-5 font-light text-sm">نام کاربری</span>
                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                            <input type="text" name="modal_user_username" id="modal_user_username" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام کاربری را وارد کنید">
                        </span>
                    </span>
                </span>
            </span>

                <!-- ردیف دوم  -->
                <span class="flex flex-col items-center sm:flex-row gap-2">
                <span class="w-full flex flex-col lg:flex-row gap-2">
                    <span class="w-full lg:w-1/2">
                        <span class="pr-5 font-light text-sm">شماره تماس</span>
                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                            <input type="number" name="modal_user_phone" id="modal_user_phone" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="شماره تماس را وارد کنید">
                        </span>
                    </span>
                    <span class="w-full lg:w-1/2 flex flex-col justify-center items-center jus lg:flex-row gap-2">
                        <input name="modal_user_status" id="modal_user_status" class="hidden" value="1">
                        <label class="flex gap-2 items-center justify-center cursor-pointer">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">غیرفعال</span>
                            <input onclick="change_modal_status_value('modal_user_status')" name="modal_user_status_checkbox" id="modal_user_status_checkbox" type="checkbox" value="" class="sr-only peer">
                            <div class="relative w-11 h-6 bg-colorthird1 peer-focus:outline-none peer-focus:ring-4 dark:peer-focus:ring-colorthird1 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-colorfourth1"></div>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">فعال</span>
                        </label>
                    </span>
                </span>
            </span>

                <!-- ردیف سوم  -->
                <span class="flex flex-col items-center sm:flex-row gap-2">
                        <span class="w-full flex flex-col lg:flex-row gap-2">
                            <span class="w-full lg:w-1/2">
                                <span class="pr-5 font-light text-sm">رمز عبور</span>
                                <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                    <input  type="text" name="modal_user_pass" id="modal_user_pass" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="پسورد را وارد کنید">
                                </span>
                            </span>
                            <span class="w-full lg:w-1/2">
                                <span class="pr-5 font-light text-sm">تکرار رمز عبور</span>
                                <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                    <input type="text" name="modal_user_repass" id="modal_user_repass" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="تکرار پسورد را وارد کنید">
                                </span>
                            </span>
                        </span>
            </span>
                <!-- ردیف چهارم  -->
                <span class="flex flex-col items-center sm:flex-row gap-2">
                            <span class="w-full flex flex-col lg:flex-row gap-2">
                                <span class="w-full lg:w-1/2">
                                    <span class="pr-5 font-light text-sm">نقش</span>
                                    <select
                                        name="modal_user_role" id="modal_user_role"
                                        class="selectpicker" style="width: 100%"
                                        data-placeholder="وضعیت"
                                        data-allow-clear="false"
                                        title="Select city...">
                                    <option></option>
                                    <option>مدیر</option>
                                    <option>کاربر</option>
                                    </select>
                                </span>
                            </span>
                </span>
                <div class="flex flex-col sm:flex-row justify-end gap-2 mt-3 w-full">
                    <button type="submit" class="min-w-[100px] text-center bg-colorsecondry1 text-white sm:hover:-translate-y-1 transition-transform duration-200 py-3 px-5 rounded-full cursor-pointer text-xs sm:text-sm">ثبت</button>
                    <button onclick="close_modal()" class="min-w-[100px] bg-colorprimary text-white sm:hover:-translate-y-1 transition-transform duration-200 py-3 px-5 rounded-full cursor-pointer text-xs sm:text-sm text-center">بازگشت</button>
                </div>
            </form>


        </div>
    </div>
@endsection
@section("scripts")
<script src="{{ url("/js/upload.js")}}"></script>
{{--<script src="{{ url("/js/select-searchable.js")}}"></script>--}}
<script src="{{ url("/js/menutoggle.js")}}"></script>
<script src="{{ url("/js/menu-toggle.js")}}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="{{url('/js/jquery.dataTables.min.js')}}"></script>
<script>
    function change_modal_status_value(id)
    {
        console.log("here baby")
        $check_box = document.getElementById(id);
        $check_box.value = $check_box.checked ? 1 : 0 ;
    }
    $(document).ready(function() {
        // $('.select2').select2();
        let laravel_datatable;
        filterList()
    });
    function filterList() {
        console.log("filter list")
        laravel_datatable = $('#users_datatable').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            responsive: true,
            paging: true,
            autoWidth: false,
            "order": [[1, "desc"]],
            ajax:({
                url : 'admin-list-users',
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
                {data: 'role', name: 'role', orderable: true, searchable: false},
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],

            "columnDefs": [
                { className: "border-l md:w-[30%] text-center w-36 min-w-fit font-normal tracking-tight", "targets": [ 0 ] },
                { className: "oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight", "targets": [ 1 ] },
                { className: "oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight", "targets": [ 2 ] },
                { className: "oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight flex gap-1 justify-center", "targets": [ 3 ] },
                { className: "oneLine w-36 md:w-[10%] flex gap-1 justify-center font-normal tracking-tight", "targets": [ 3 ] },
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
        reset_form("user_form");
        $('#edit_user_modal').removeClass('hidden');
    }
    function open_edit_modal(user_id)
    {
        reset_form("user_form");
        console.log("editttttttt");
        let _url = 'find-user/' + user_id;
        $.ajax({
            url: _url,
            type: "GET",
            success: function(response) {
                console.log(response)
                if(response) {
                    if(Object.keys(response).length > 0)
                    {
                        $('#modal_user_name').val(response.name);
                        $('#modal_user_lname').val(response.lastname);
                        $('#modal_user_username').val(response.username);
                        $('#modal_user_phone').val(response.phone);
                        $('#modal_user_pass').val(response.password);
                        $('#modal_user_repass').val(response.password);
                        $('#modal_user_status').val(response.status);
                        $('#modal_user_id').val(user_id)

                        user_status = response.status;

                        status_checkbox = document.getElementById('modal_user_status_checkbox');
                        status_checkbox.checked = user_status === 1 ? true: false;

                        $('#edit_user_modal').removeClass('hidden');
                    }else alert('محصول یافت نشد!')
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
        let _url = 'market-status/' + status;

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
        reset_form("user_form");
    }
    function reset_form(id) {
        $('#'+id)[0].reset();
    }

</script>
@endsection

