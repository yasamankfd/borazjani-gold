function cal_price_by_price()
{
    console.log("onChange");
    var total_price_label = document.getElementById("total_price");
    var amount_input = document.getElementById("amount");
    var price_input = document.getElementById("input_price").value;
    var fee = document.getElementById("price").textContent;
    console.log(typeof price_input, typeof fee);
    fee !== 0 ? amount_input.value = (parseFloat(price_input)/ parseFloat(fee)  ) : amount_input.value = 0 ;
    total_price_label.textContent = price_input.toString();

}
function cal_price_by_amount()
{
    console.log("onChange");
    var total_price_label = document.getElementById("total_price");
    var amount_input = document.getElementById("amount").value;
    var price_input = document.getElementById("input_price");
    var fee = document.getElementById("price").textContent;
    price_input.value = (parseFloat(amount_input) * parseFloat(fee)) ;
    total_price_label.textContent = price_input.value.toString();

}

function change_operation(type,buy_price,sell_price) {
    // console.log('change')
    var operation_label = document.getElementById("operation_label");
    var operation_type_input = document.getElementById("operation_type");
    var price_input = document.getElementById("price");
    var submit_order = document.getElementById("submit_temp_order");
    var product_fee = document.getElementById("product_fee");



    var s = operation_label.textContent;
    console.log(s);
    console.log(operation_label)
    if(s.includes("خرید"))
    {
        if(type === 'sell')
        {
            product_fee.value = sell_price;
            submit_order.textContent = "فروش";
            price_input.textContent = sell_price;
            operation_type_input.value = "sell";
            operation_label.textContent = "عملیات فروش";
        }else ;

    }else {
        if(type === 'buy')
        {
            product_fee.value = buy_price;
            submit_order.textContent = "خرید";
            price_input.textContent = buy_price;
            operation_type_input.value = "buy";
            operation_label.textContent = "عملیات خرید";
        }else ;
    }
}
