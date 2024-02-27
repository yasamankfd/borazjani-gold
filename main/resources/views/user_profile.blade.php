@extends("layout.customer")
@include("includes.header")
@section("title")
    پروفایل
@endsection

@section("content")
    <div class="mt-5">
        <!-- ------------------- نمایش وضعیت بازار -----------------------  -->
        <div class="w-full flex justify-center border-b pb-3">
                <span id="market_status_span_color" class="@if($market=="open") bg-colorfourth1 @else bg-colorthird1 @endif py-2 px-5 rounded-lg text-white relative animate-pulse text-lg">
                        <span class="font-extralight">وضعیت بازار:</span>
                        <span id="market_status_span">@if($market=="open") باز@else بسته @endif</span>
                    </span>
        </div>

        <div  class="w-full flex justify-start bg-white border border-slate-200 rounded-2xl p-1 mt-3 pb-14">
                    <span class=" py-2 px-2 text-colorprimary text-lg w-full">
                        <form x-show="buy" class="mt-5 space-y-5">
                            <span class="relative flex gap-2">
                                <img src="./img/user-icon2.svg" alt="">
                                <span class="text-sm md:text-base">پروفایل کاربری</span>

                                <span class="bg-colorprimary w-40 md:w-36 h-[1px] absolute -bottom-2"></span>
                                <span class="bg-colorsecondry1 w-10 h-[3px] absolute -bottom-2"></span>
                            </span>
                            <span class="w-full flex flex-col lg:flex-row gap-2">
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">نام</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" name="name" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام خود را وارد کنید">
                                    </span>
                                </span>
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">نام خانوادگی</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" name="lastname" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام خانوادگی را وارد کنید">
                                    </span>
                                </span>
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">نام کاربری</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" name="username" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام کاربری را وارد کنید">
                                    </span>
                                </span>
                            </span>
                            <span class="w-full flex flex-col lg:flex-row gap-2">
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">شماره تماس</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="number" name="phonenumber" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="شماره تماس را وارد کنید">
                                    </span>
                                </span>
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">رمز عبور</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" name="password" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="رمز عبور را وارد کنید">
                                    </span>
                                </span>
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">تکرار رمز عبور</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" name="re-password" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="تکرار رمز عبور را وارد کنید">
                                    </span>
                                </span>
                            </span>
                            <span class="w-full flex flex-col lg:flex-row gap-2">
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">کداقتصادی</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="number" name="taxcode" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="شماره تماس را وارد کنید">
                                    </span>
                                </span>
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">سریال کارت ملی</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" name="idserial" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="رمز عبور را وارد کنید">
                                    </span>
                                </span>
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">تکرار رمز عبور</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" name="re-password" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="تکرار رمز عبور را وارد کنید">
                                    </span>
                                </span>
                            </span>
                            <span class="relative flex gap-2">
                                <img src="./img/user-icon2.svg" alt="">
                                <span class="text-sm md:text-base">بارگذاری مدارک</span>

                                <span class="bg-colorprimary w-40 md:w-36 h-[1px] absolute -bottom-2"></span>
                                <span class="bg-colorsecondry1 w-10 h-[3px] absolute -bottom-2"></span>
                            </span>
                            <span>
                                                    <!-- بارگذاری فایل -->
                                <span class="flex flex-col sm:flex-row gap-2 mt-5">
                                    <!-- ---------------- فایل اول ---------------------  -->
                                    <div class="upload flex items-center gap-2 border w-64 p-5 rounded-3xl">
                                    <!-- آیتم انتخاب عکس  -->
                                    <div class="image-new flex-1 w-fit" id="drag-area1">
                                        <div class="icon flex flex-col items-center" id="image-area-select1">
                                            <span class="font-light text-sm">کارت ملی</span>
                                            <span class="bg-colorprimary text-white font-light text-sm rounded-full p-2 cursor-pointer w-full text-center">انتخاب فایل</span>
                                        </div>
                                        <input type="file" name="file1" id="file1" style="display: none" accept="image/*">
                                    </div>

                                    <div class="container-uploaded" id="container1">
                                        <div class="image-uploaded">
                                        <img src="./img/prw-empty.svg" alt="" class="image-uploaded">
                                        <svg onclick="delImage1(0)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="trash"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                        </svg></div></div>
                                </div>
                                    <!-- ---------------- فایل دوم ---------------------  -->
                                    <div class="upload flex items-center gap-2 border w-64 p-5 rounded-3xl">
                                    <!-- آیتم انتخاب عکس  -->
                                    <div class="image-new flex-1 w-fit" id="drag-area1">
                                        <div class="icon flex flex-col items-center" id="image-area-select2">
                                            <span class="font-light text-sm">مجوز فعالیت</span>
                                            <span class="bg-colorprimary text-white font-light text-sm rounded-full p-2 cursor-pointer w-full text-center">انتخاب فایل</span>
                                        </div>
                                        <input type="file" name="file2" id="file2" style="display: none" accept="image/*">
                                    </div>

                                    <div class="container-uploaded" id="container2">
                                        <div class="image-uploaded">
                                        <img src="./img/prw-empty.svg" alt="" class="image-uploaded">
                                        <svg onclick="delImage2(0)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="trash"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                        </svg></div></div>
                                </div>
                            </span>
                            </span>
                            <span class="w-full flex items-center justify-end gap-2 mt-5 pt-2">
                                <a href="" class="flex justify-center bg-colorsecondry1 focus:outline-none text-white w-full md:w-fit rounded-xl px-5 py-3 font-light">ثبت اطلاعات</a>
                            </span>
                        </form>
                    </span>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ url("/js/select-searchable.js")}}"></script>
    <script src="{{ url("/js/menutoggle.js")}}"></script>
    <script src="{{ url("/js/menu-toggle.js")}}"></script>
@endsection




