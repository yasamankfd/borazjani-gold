
@include('includes.header')
<body class="font-yekan bg-gray-100 sm:bg-transparent">
<!-- ------------------sidebar------------------- -->
<div x-data="{ toggle:true }" :class="!toggle ? 'w-20' : 'w-72' " class="hidden sm:block navigation text-white bg-colorprimary py-5">
    <span x-show="toggle" class="flex flex-col items-center justify-center border-b pb-2 border-[#676767]">
        <span class="font-extralight">سامانه مدیریت خرید و فروش</span>
        <span class="text-xl text-colorsecondry1">علی برازجانی</span>
    </span>
    <ul x-data="{dashboard:true, orders:false,transaction:false, profile:false}" class="mt-5 space-y-3 relative font-light">
        <li :class="dashboard ? 'bg-colorsecondry1' : 'bg-transparent'" class="pr-5 relative group">
            <a href="{{ route('customer-dashboard') }}" @click="dashboard=true, orders=false,transaction=false, profile=false" class="cursor-pointer flex justify-start gap-7 items-center relative w-full p-2 rounded-r-full">
                <span class="icon relative block text-center">
                    <img src="{{ url("/img/home-icon.svg")}}" alt="" class="">

                </span>
                <span x-show="toggle" x-transition.duration.300ms class="relative block text-start whitespace-nowrap font-yekan text-sm hover:scale-105 transition-all">داشبورد</span>
            </a>
        </li>
        <li :class="orders ? 'bg-colorsecondry1' : 'bg-transparent'" class="pr-5 relative group">
            <a href="{{ route('customer-liveorders') }}" @click="dashboard=false,orders=true,transaction=false,profile=false" class="cursor-pointer flex justify-start gap-7 items-center relative w-full p-2 rounded-r-full">
                <span class="icon relative block text-center">
                    <img src="{{ url("/img/orders-icon.svg")}}" alt="" class="">

                </span>
                <span x-show="toggle" x-transition.duration.300ms class="relative block text-start whitespace-nowrap font-yekan text-sm hover:scale-105 transition-all">سفارشات جاری</span>
            </a>
        </li>
        <li :class="transaction ? 'bg-colorsecondry1' : 'bg-transparent'" class="pr-5 relative group">
            <a href="{{ route('customer-transactions') }}" @click="dashboard=false, orders=false,transaction=true, profile=false" class="cursor-pointer flex justify-start gap-7 items-center relative w-full p-2 rounded-r-full">
                <span class="icon relative block text-center">
                    <img src="{{ url("/img/transaction-icon.svg")}}" alt="" class="">
                </span>
                <span x-show="toggle" x-transition.duration.300ms class="relative block text-start whitespace-nowrap font-yekan text-sm hover:scale-105 transition-all">گزارشات معامله</span>
            </a>
        </li>
        <li :class="profile ? 'bg-colorsecondry1' : 'bg-transparent'" class="pr-5 relative group">
            <a href="{{ route("customer-profile") }}" @click="dashboard=false, orders=false,transaction=false, profile=true" class="cursor-pointer flex justify-start gap-7 items-center relative w-full p-2 rounded-r-full">
                <span class="icon relative block text-center">
                    <img src="{{ url("/img/user-icon.svg")}}" alt="" class="">
                </span>
                <span x-show="toggle" x-transition.duration.300ms class="relative block text-start whitespace-nowrap font-yekan text-sm hover:scale-105 transition-all">پروفایل کاربری</span>
            </a>
        </li>
        <li class="pr-5 relative group">
            <a href="" class="flex justify-start gap-7 items-center relative w-full p-2 rounded-r-full">
                <span class="icon relative block text-center">
                    <img src="{{ url("/img/exit-icon.svg")}}" alt="">
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
            <img src="{{ url("/img/orders-icon.svg")}}" alt="">
            <span class="text-xs">سفارشات</span>
        </a>
        <a href="" class="flex flex-col items-center text-white gap-2 px-4 py-2">
            <img src="{{ url("/img/home-icon.svg")}}" alt="">
            <span class="text-xs">داشبورد</span>
        </a>
        <a href="" class="flex flex-col items-center text-white gap-2 px-4 py-2">
            <img src="{{ url("/img/transaction-icon.svg")}}" alt="">
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
        <img src="{{ url("/img/home-icon.svg")}}" alt="">
        <span class="font-light text-sm">داشبورد</span>
    </a>

    <a href="#"  class="flex gap-2 items-center">
        <img src="{{ url("/img/orders-icon.svg")}}" alt="">
        <span class="font-light text-sm">سفارشات جاری</span>
    </a>

    <a href="#"  class="flex gap-2 items-center">
        <img src="{{ url("/img/transaction-icon.svg")}}" alt="">
        <span class="font-light text-sm">گزارشات معامله</span>
    </a>

    <a href="#"  class="flex gap-2 items-center">
        <img src="{{ url("/img/user-icon.svg")}}" alt="">
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
                       <img src="{{ url("/img/exit-icon2.svg")}}" alt="">
                    </span>
            </div>
        </div>

        @yield('content')

    </div>
</div>

@yield('scripts')
</body>
</html>
