@extends('layout.admin')
@section("title")
    اطلاعات پایه
@endsection
@section('content')
<span class="flex items-center justify-center gap-2 border-t mt-5 pt-2 w-fit">
                    <a href="" class="flex justify-center bg-colorsecondry1 text-white w-full rounded-xl py-3 px-5">افزودن</a>
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
                                    <table x-data="{ detailrow:false }" class="space-y-3 block overflow-x-auto pb-5 mt-5">
                                        <thead class="w-full flex">
                                            <tr class="flex justify-between items-center w-fit md:w-full bg-colorprimary text-white font-normal px-1 md:px-5 py-3 rounded-lg hover:shadow-gray-200/50 hover:shadow-lg text-xs lg:text-sm">
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
                                        @foreach($users as $user)
                                            <tr class="flex flex-row justify-between items-center bg-slate-100 w-fit md:w-full rounded-lg text-xs lg:text-sm font-light px-1 md:px-5 py-3 relative text-colorprimary/70">
                                                <td class="border-l md:w-[30%] text-center w-36 min-w-fit font-normal tracking-tight">{{ $user->name }} {{ $user->lasttname }}</td>
                                                <td class="oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight">{{ $user->phone }}</td>
                                                <td class="oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight">??</td>
                                                <td class="oneLine text-lengh w-36 md:w-[20%] text-center border-l font-normal tracking-tight flex gap-1 justify-center">
                                                   <span class="bg-colorfourth1 text-white px-3 py-1 rounded-full font-light">@if($user->status == 1) فعال @else غیرفعال @endif</span>
                                                </td>

                                                <td class="oneLine w-36 md:w-[10%] flex gap-1 justify-center font-normal tracking-tight">
                                                    <a href="" class="bg-colorprimary p-2 rounded-xl">
                                                        <img src="{{ url("/img/edit-icon.svg")}}" alt="" class="w-4">
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                        </div>
                    </span>
</div>
<!-- ----------مودال افزودن مشتری   ------------------  -->
<div  x-transition.duration.500ms class="bg-black/50  backdrop-blur-sm fixed pb-10 top-0 w-full h-screen flex items-center px-5 z-10">
    <div class="bg-white w-full sm:max-w-3xl max-h-[70vh] sm:max-h-full mx-auto p-5 rounded-lg flex flex-col gap-3 overflow-y-auto">
            <span class="flex flex-row justify-between items-center border-b pb-2">
                 <span>اطلاعات کاربران</span>
                 <span x-on:click="modal1 = false" class="bg-gray-100 p-1 sm:p-2 rounded-md cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                 </span>
            </span>

        <!-- ردیف اول  -->
        <span class="flex flex-col items-center sm:flex-row gap-2">
                <span class="w-full flex flex-col lg:flex-row gap-2">
                    <span class="w-full lg:w-1/2">
                        <span class="pr-5 font-light text-sm">نام و نام خانوادگی</span>
                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                            <input type="text" name="name" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام مشتری را وارد کنید">
                        </span>
                    </span>
                    <span class="w-full lg:w-1/2">
                        <span class="pr-5 font-light text-sm">نام کاربری</span>
                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                            <input type="text" name="name" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام کاربری را وارد کنید">
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
                            <input type="number" name="phonenumber" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="شماره تماس را وارد کنید">
                        </span>
                    </span>
                    <span class="w-full lg:w-1/2 flex flex-col justify-center items-center jus lg:flex-row gap-2">
                        <label class="flex gap-2 items-center justify-center cursor-pointer">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">فعال</span>
                            <input type="checkbox" value="" class="sr-only peer">
                            <div class="relative w-11 h-6 bg-colorthird1 peer-focus:outline-none peer-focus:ring-4 dark:peer-focus:ring-colorthird1 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-colorfourth1"></div>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">غیرفعال</span>
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
                                    <input type="text" name="password" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="پسورد را وارد کنید">
                                </span>
                            </span>
                            <span class="w-full lg:w-1/2">
                                <span class="pr-5 font-light text-sm">تکرار رمز عبور</span>
                                <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                    <input type="text" name="re-password" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="تکرار پسورد را وارد کنید">
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
                                        id="sender1"
                                        class="selectpicker" style="width: 100%"
                                        data-placeholder="وضعیت"
                                        data-allow-clear="false"
                                        title="Select city...">
                                    <option></option>
                                    <option>فعال</option>
                                    <option>غیرعفال</option>
                                    </select>
                                </span>
                            </span>
                </span>


        <div class="flex flex-col sm:flex-row justify-end gap-2 mt-3 w-full">
            <a class="min-w-[100px] text-center bg-colorsecondry1 text-white sm:hover:-translate-y-1 transition-transform duration-200 py-3 px-5 rounded-full cursor-pointer text-xs sm:text-sm">ثبت</a>
            <a class="min-w-[100px] bg-colorprimary text-white sm:hover:-translate-y-1 transition-transform duration-200 py-3 px-5 rounded-full cursor-pointer text-xs sm:text-sm text-center">بازگشت</a>
        </div>
    </div>
</div>
@endsection
@section("scripts")
    <script src="{{ url("/js/select-searchable.js")}}"></script>
    <script src="{{ url("/js/menutoggle.js")}}"></script>
    <script src="{{ url("/js/menu-toggle.js")}}"></script>
    <script src="{{ url("/js/menu-toggle.js")}}"></script>
@endsection
</body>
</html>
