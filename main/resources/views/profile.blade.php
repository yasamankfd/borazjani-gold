
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="./build/app.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src=""></script>
    <link rel="stylesheet" href="./build/tailwind.css">
    <link rel="stylesheet" href="../src/css/font.css">
    <link rel="stylesheet" href="../src/css/dashboard.css">
</head>
<body class="font-yekan bg-gray-100 sm:bg-transparent">
<!-- ------------------sidebar------------------- -->
<div x-data="{ toggle:true }" :class="!toggle ? 'w-20' : 'w-72' " class="hidden sm:block navigation text-white bg-colorprimary py-5">
    <span x-show="toggle" class="flex flex-col items-center justify-center border-b pb-2 border-[#676767]">
        <span class="font-extralight">سامانه مدیریت خرید و فروش</span>
        <span class="text-xl text-colorsecondry1">علی برازجانی</span>
    </span>
    <ul x-data="{dashboard:true, orders:false,transaction:false, profile:false}" class="mt-5 space-y-3 relative font-light">
        <li :class="dashboard ? 'bg-colorsecondry1' : 'bg-transparent'" class="pr-5 relative group">
            <a @click="dashboard=true, orders=false,transaction=false, profile=false" class="cursor-pointer flex justify-start gap-7 items-center relative w-full p-2 rounded-r-full">
                <span class="icon relative block text-center">
                    <img src="./img/home-icon.svg" alt="" class="">

                </span>
                <span x-show="toggle" x-transition.duration.300ms class="relative block text-start whitespace-nowrap font-yekan text-sm hover:scale-105 transition-all">داشبورد</span>
            </a>
        </li>
        <li :class="orders ? 'bg-colorsecondry1' : 'bg-transparent'" class="pr-5 relative group">
            <a @click="dashboard=false,orders=true,transaction=false,profile=false" class="cursor-pointer flex justify-start gap-7 items-center relative w-full p-2 rounded-r-full">
                <span class="icon relative block text-center">
                    <img src="./img/orders-icon.svg" alt="" class="">

                </span>
                <span x-show="toggle" x-transition.duration.300ms class="relative block text-start whitespace-nowrap font-yekan text-sm hover:scale-105 transition-all">سفارشات جاری</span>
            </a>
        </li>
        <li :class="transaction ? 'bg-colorsecondry1' : 'bg-transparent'" class="pr-5 relative group">
            <a @click="dashboard=false, orders=false,transaction=true, profile=false" class="cursor-pointer flex justify-start gap-7 items-center relative w-full p-2 rounded-r-full">
                <span class="icon relative block text-center">
                    <img src="./img/transaction-icon.svg" alt="" class="">
                </span>
                <span x-show="toggle" x-transition.duration.300ms class="relative block text-start whitespace-nowrap font-yekan text-sm hover:scale-105 transition-all">گزارشات معامله</span>
            </a>
        </li>
        <li :class="profile ? 'bg-colorsecondry1' : 'bg-transparent'" class="pr-5 relative group">
            <a  @click="dashboard=false, orders=false,transaction=false, profile=true" class="cursor-pointer flex justify-start gap-7 items-center relative w-full p-2 rounded-r-full">
                <span class="icon relative block text-center">
                    <img src="./img/user-icon.svg" alt="" class="">
                </span>
                <span x-show="toggle" x-transition.duration.300ms class="relative block text-start whitespace-nowrap font-yekan text-sm hover:scale-105 transition-all">پروفایل کاربری</span>
            </a>
        </li>
        <li class="pr-5 relative group">
            <a href="" class="flex justify-start gap-7 items-center relative w-full p-2 rounded-r-full">
                <span class="icon relative block text-center">
                    <img src="./img/exit-icon.svg" alt="">
                </span>
                <span x-show="toggle" x-transition.duration.300ms class="relative block text-start whitespace-nowrap font-yekan text-sm">خروج</span>
            </a>
        </li>

    </ul>
    <div x-on:click="toggle = !toggle" class="toggle absolute bottom-4 left-5 bg-white rounded-full cursor-pointer p-2 flex justify-center items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-800">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
        </svg>
    </div>
</div>


<!-- ------------------nav------------------- -->
<div class="bg-gray-100 px-2 pt-5 block sm:hidden">

    <div class="bg-colorsecondry1 rounded-xl px-4 py-4 flex justify-between items-center">
        <a class="navbar-toggle bg-colorprimary p-2 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </a>
        <span class="text-white font-thin text-sm">محمدجواد عبدالهی</span>
        <div class="flex items-center gap-5">

                    <span class="bg-colorprimary p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1012.728 0M12 3v9" />
                          </svg>
                    </span>
        </div>


    </div>


</div>


<!-- ------------------nav fixed------------------- -->
<div class="fixed w-full bottom-0 sm:hidden z-20">

    <div class="bg-colorprimary px-4 flex justify-around items-center">

        <a href="" class="flex flex-col items-center text-white gap-2 px-4 py-2">
            <img src="./img/orders-icon.svg" alt="">
            <span class="text-xs">سفارشات</span>
        </a>
        <a href="" class="flex flex-col items-center text-white gap-2 px-4 py-2">
            <img src="./img/home-icon.svg" alt="">
            <span class="text-xs">داشبورد</span>
        </a>
        <a href="" class="flex flex-col items-center text-white gap-2 px-4 py-2">
            <img src="./img/transaction-icon.svg" alt="">
            <span class="text-xs">گزارشات</span>
        </a>
    </div>


</div>

<!-- فیلتر  -->
<div class="navbar-menu w-full h-screen bg-colorprimary/70 backdrop-blur-md text-white fixed top-0 z-50 font-alibaba p-5 flex flex-col gap-5">

    <div class="flex justify-between items-center border-b pb-3">
        <span>منو سایت</span>
        <button class="navbar-close bg-colorprimary p-1 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <a href="#" class="flex gap-2 items-center">
        <img src="./img/home-icon.svg" alt="">
        <span class="font-light text-sm">داشبورد</span>
    </a>

    <a href="#"  class="flex gap-2 items-center">
        <img src="./img/orders-icon.svg" alt="">
        <span class="font-light text-sm">سفارشات جاری</span>
    </a>

    <a href="#"  class="flex gap-2 items-center">
        <img src="./img/transaction-icon.svg" alt="">
        <span class="font-light text-sm">گزارشات معامله</span>
    </a>

    <a href="#"  class="flex gap-2 items-center">
        <img src="./img/user-icon.svg" alt="">
        <span class="font-light text-sm">پروفایل</span>
    </a>


    <a href="#"  class="flex gap-2 items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1012.728 0M12 3v9" />
        </svg>
        <span class="font-light text-sm">خروج</span>
    </a>

</div>
<!-- --------------main-------------- -->

<div dir="ltr" class=" w-full h-full sm:h-screen px-0 sm:px-5  sm:py-5">

    <div dir="rtl" class="bg-gray-100 rounded-none sm:rounded-3xl main h-full py-5 px-5 overflow-y-auto scrollbar">

        <div class="bg-colorsecondry1 w-full rounded-full px-5 py-3  hidden sm:flex justify-between items-center">
            <span class="font-light">محمدجواد عبدالهی عزیز خوش امدید</span>
            <div class="flex items-center gap-2">
                    <span class=" font-extralight text-sm">
                        <span>دوشنبه</span>
                        <span>1402/04/15</span>
                        <span>_</span>
                        <span>14:00</span>
                    </span>
                <span class="bg-colorprimary rounded-full p-3 cursor-pointer hover:ring hover:ring-red-200  duration-100 transition-all">
                       <img src="./img/exit-icon2.svg" alt="">
                    </span>
            </div>

        </div>

        <div class="mt-5">
            <!-- ------------------- نمایش وضعیت بازار -----------------------  -->
            <div class="w-full flex justify-center border-b pb-3">
                    <span class="bg-colorfourth1 py-2 px-5 rounded-lg text-white relative animate-pulse text-lg hidden">
                        <span class="font-extralight">وضعیت بازار:</span>
                        <span>بـــاز</span>
                    </span>
                <span class="bg-colorthird1 py-2 px-5 rounded-lg text-white relative animate-pulse text-lg">
                        <span class="font-extralight">وضعیت بازار:</span>
                        <span>بسته</span>
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
                                <!-- -------------------- آیتم های بارگذاری رو اینجا بذار ----------------------  -->
                            </span>
                            <span class="w-full flex items-center justify-end gap-2 mt-5 pt-2">
                                <a href="" class="flex justify-center bg-colorsecondry1 focus:outline-none text-white w-full md:w-fit rounded-xl px-5 py-3 font-light">ثبت اطلاعات</a>
                            </span>
                        </form>
                    </span>
            </div>
        </div>


    </div>
</div>

<script src="../src/js/select-searchable.js"></script>
<script src="../src/js/menutoggle.js"></script>
<script src="../src/js/menu-toggle.js"></script>
</body>
</html>
