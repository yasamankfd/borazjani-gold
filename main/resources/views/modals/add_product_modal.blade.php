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
