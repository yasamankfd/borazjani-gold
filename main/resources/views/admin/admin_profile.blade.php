@extends("layout.admin")
@include("includes.header")
@section("title")
    پروفایل
@endsection

@section("content")
    <div id="app">
        <div class="mt-5">
            <!-- ------------------- نمایش وضعیت بازار -----------------------  -->
{{--            <div class="w-full flex justify-center border-b pb-3">--}}
{{--                    <span id="market_status_span_color" class="@if($market=="open") bg-colorfourth1 @else bg-colorthird1 @endif py-2 px-5 rounded-lg text-white relative animate-pulse text-lg">--}}
{{--                            <span class="font-extralight">وضعیت بازار:</span>--}}
{{--                            <span id="market_status_span">@if($market=="open") باز@else بسته @endif</span>--}}
{{--                        </span>--}}
{{--            </div>--}}

            <div class="w-full flex justify-start bg-white border border-slate-200 rounded-2xl p-1 mt-3 pb-14">
                    <span class=" py-2 px-2 text-colorprimary text-lg w-full">
                        <form id="edit-profile_form" method="POST" enctype="multipart/form-data" class="mt-5 space-y-5">
                            @csrf
                            <input id="user_id" name="user_id" value="{{ $user->id }}" class="hidden">
                            <span class="relative flex gap-2">
                                <img src="{{ url("/img/user-icon2.svg")}}" alt="">
                                <span class="text-sm md:text-base">پروفایل کاربری</span>

                                <span class="bg-colorprimary w-40 md:w-36 h-[1px] absolute -bottom-2"></span>
                                <span class="bg-colorsecondry1 w-10 h-[3px] absolute -bottom-2"></span>
                            </span>
                            <span class="w-full flex flex-col lg:flex-row gap-2">
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">نام</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" name="name" id="name" value="{{ $user->name }}" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام خود را وارد کنید">
                                    </span>
                                </span>
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">نام خانوادگی</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" name="lastname" id="lastname" value="{{ $user->lastname }}" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام خود را وارد کنید">
                                    </span>
                                </span>
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">نام کاربری</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" id="username" name="username" value="{{ $user->username }}" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام کاربری را وارد کنید">
                                    </span>
                                </span>
                            </span>
                            <span class="w-full flex flex-col lg:flex-row gap-2">
                                <span class="w-full lg:w-1/4">
                                    <span class="pr-5 font-light text-sm">شماره تماس</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="number" name="phone" id="phone" value="{{ $user->phone }}" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="شماره تماس را وارد کنید">
                                    </span>
                                </span>
                                <span class="w-full lg:w-1/4">
                                    <span class="pr-5 font-light text-sm">نقش</span>
                                    <select id="sender1" class="selectpicker select2-hidden-accessible" style="width: 100%" data-placeholder="وضعیت" data-allow-clear="false" title="Select city..." data-select2-id="select2-data-sender1" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="select2-data-2-fg9z"></option>
                                    <option>فعال</option>
                                    <option>غیرفعال</option>
                                    </select><span class="select2 select2-container select2-container--default" dir="rtl" data-select2-id="select2-data-1-jwtc" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" title="Select city..." tabindex="0" aria-disabled="false" aria-labelledby="select2-sender1-container"><span class="select2-selection__rendered" id="select2-sender1-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">وضعیت</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </span>
                                <span class="w-full lg:w-1/4">
                                    <span class="pr-5 font-light text-sm">رمز عبور</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" name="password" id="password" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="رمز عبور را وارد کنید">
                                    </span>
                                </span>
                                <span class="w-full lg:w-1/4">
                                    <span class="pr-5 font-light text-sm">تکرار رمز عبور</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" name="re-password" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="تکرار رمز عبور را وارد کنید">
                                    </span>
                                </span>
                            </span>
                            <span class="w-full flex flex-col lg:flex-row gap-2">
                                <span class="w-full lg:w-1/3 flex flex-col justify-center items-center jus lg:flex-row gap-2">
                                    <label class="flex gap-2 items-center justify-center cursor-pointer">
                                        <input id="status" name="status" class="hidden" value="{{ $user->status }}">
                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-300">غیرفعال</span>
                                        <input id="product_status" @if($user->status == 1) checked @endif type="checkbox" value="" class="sr-only peer">
                                        <div class="relative w-11 h-6 bg-colorthird1 peer-focus:outline-none peer-focus:ring-4 dark:peer-focus:ring-colorthird1 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-colorfourth1"></div>
                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-300">فعال</span>
                                    </label>
                                </span>
                            </span>
                        </form>
                        <span class="w-full flex items-center justify-end gap-2 mt-5 pt-2">
                                <button onclick="edit_profile()"  class="flex justify-center bg-colorsecondry1 focus:outline-none text-white w-full md:w-fit rounded-xl px-5 py-3 font-light">ثبت اطلاعات</button>
                            </span>
                    </span>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ url("/js/menutoggle.js")}}"></script>
    <script src="{{ url("/js/menu-toggle.js")}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function edit_profile() {

            let _url        = 'admin-edit-profile';
            let formData    = new FormData($("#edit-profile_form")[0]);

            var status_checkbox = document.getElementById("product_status");
            var status = status_checkbox.checked === true ? 1 : 0 ;
            formData.append('status', status);

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
                    }
                },
                error: function (response) {
                    console.log(response);
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
    </script>
@endsection




