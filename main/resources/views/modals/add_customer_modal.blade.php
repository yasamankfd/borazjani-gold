<!-- ----------مودال افزودن مشتری   ------------------  -->

<div id="edit_user_modal" x-transition.duration.500ms class="bg-black/50 hidden backdrop-blur-sm fixed pb-10 top-0 w-full h-screen flex items-center px-5 z-10">
    <div class="bg-white w-full sm:max-w-3xl max-h-[70vh] sm:max-h-full mx-auto p-5 rounded-lg flex flex-col gap-3 overflow-y-auto">
            <span class="flex flex-row justify-between items-center border-b pb-2">
                 <span>اطلاعات مشتری</span>
                 <span x-on:click="modal1 = false" class="bg-gray-100 p-1 sm:p-2 rounded-md cursor-pointer">
                    <svg onclick="close_modal('edit_user_modal')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                 </span>
            </span>

        <form id="customer_form" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- ردیف اول  -->
            <span class="flex flex-col items-center sm:flex-row gap-2">
                <span class="w-full flex flex-col lg:flex-row gap-2">
                    <input name="modal_customer_id" id="modal_customer_id" class="hidden">
                    <span class="w-full lg:w-2/3">
                        <span class="pr-5 font-light text-sm">نام</span>
                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                            <input type="text" name="modal_customer_name" id="modal_customer_name" value="" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام مشتری را وارد کنید">
                        </span>
                    </span>
                    <span class="w-full lg:w-2/3">
                        <span class="pr-5 font-light text-sm">نام خانوادگی</span>
                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                            <input type="text" name="modal_customer_lname" id="modal_customer_lname" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام مشتری را وارد کنید">
                        </span>
                    </span>
                    <span class="w-full lg:w-2/3">
                        <span class="pr-5 font-light text-sm">نام کاربری</span>
                        <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                            <input name="modal_customer_username" id="modal_customer_username" type="text"  class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="نام کاربری را وارد کنید">
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
                            <input name="modal_customer_phone" id="modal_customer_phone" type="text" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="شماره تماس را وارد کنید">
                        </span>
                    </span>
                    <span class="w-full lg:w-1/2 flex flex-col justify-center items-center jus lg:flex-row gap-2">
                        <input name="modal_customer_status" id="modal_customer_status" class="hidden" value="1">
                        <label class="flex gap-2 items-center justify-center cursor-pointer">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">غیرفعال</span>
                            <input onclick="change_modal_status_value('modal_customer_status')" name="modal_customer_status_checkbox" id="modal_customer_status_checkbox" type="checkbox" value="" class="sr-only peer">
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
                                    <input type="text" name="modal_customer_pass" id="modal_customer_pass" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="پسورد را وارد کنید">
                                </span>
                            </span>
                            <span class="w-full lg:w-1/2">
                                <span class="pr-5 font-light text-sm">تکرار رمز عبور</span>
                                <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                    <input type="text" name="modal_customer_repass" id="modal_customer_repass" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="تکرار پسورد را وارد کنید">
                                </span>
                            </span>
                        </span>
            </span>
            <!-- ردیف چهارم  -->
            <span class="flex flex-col items-center sm:flex-row gap-2">
                            <span class="w-full flex flex-col lg:flex-row gap-2">
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">کد اقتصادی</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" name="modal_customer_code" id="modal_customer_code" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="کداقتصادی را وارد کنید">
                                    </span>
                                </span>
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">کد ملی</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" name="modal_customer_nid" id="modal_customer_nid" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="سریال کارت ملی  را وارد کنید">
                                    </span>
                                </span>
                                <span class="w-full lg:w-1/3">
                                    <span class="pr-5 font-light text-sm">سریال کارت ملی</span>
                                    <span class="flex items-center gap-2 rounded-full w-full border border-gray-200">
                                        <input type="text" name="modal_customer_serial" id="modal_customer_serial" class="text-sm font-extralight border-none flex-1 bg-transparent focus:ring-colorsecondry1 rounded-full placeholder:font-thin text-center placeholder:text-sm px-5 py-3" placeholder="سریال کارت ملی  را وارد کنید">
                                    </span>
                                </span>
                            </span>
                </span>

            <!-- ردیف پنجم  -->
            <span class="flex flex-col sm:flex-row justify-between gap-2">
                      <!-- ---------------- فایل اول ---------------------  -->
                      <div class="upload flex items-center gap-2 border w-64 p-5 rounded-3xl">
                        <!-- آیتم انتخاب عکس  -->
                        <div class="image-new flex-1 w-fit" id="drag-area1">
                            <div class="icon flex flex-col items-center" id="image-area-select1">
                                <span class="font-light text-sm">کارت ملی</span>
                                <span class="bg-colorprimary text-white font-light text-sm rounded-full p-2 cursor-pointer w-full text-center">انتخاب فایل</span>
                            </div>
                            <input type="file" name="modal_customer_national_card" id="modal_customer_national_card" accept="image/*">
                        </div>

                        <div class="container-uploaded" id="container1">
                            <div class="image-uploaded">
                            <img id="modal_customer_national_card_img" src="{{ url("/img/prw-empty.svg")}}" alt="" class="image-uploaded">
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
                             <input type="file" name="modal_customer_certificate" id="modal_customer_certificate" accept="image/*">
                         </div>

                         <div class="container-uploaded" id="container2">
                             <div class="image-uploaded">
                             <img id="modal_customer_certificate_img" src="{{ url("/img/prw-empty.svg")}}" alt="" class="image-uploaded">
                             <svg onclick="delImage2(0)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="trash"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                             </svg></div></div>
                     </div>
                </span>
        </form>
        <div class="flex flex-col sm:flex-row justify-end gap-2 mt-3 w-full">
            <button onclick="create_user()" class="min-w-[100px] text-center bg-colorsecondry1 text-white sm:hover:-translate-y-1 transition-transform duration-200 py-3 px-5 rounded-full cursor-pointer text-xs sm:text-sm">ثبت</button>
            <button onclick="close_modal()" class="min-w-[100px] bg-colorprimary text-white sm:hover:-translate-y-1 transition-transform duration-200 py-3 px-5 rounded-full cursor-pointer text-xs sm:text-sm text-center">بازگشت</button>
        </div>

    </div>
</div>
