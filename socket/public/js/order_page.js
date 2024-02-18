function cal_price_by_price()
{
    console.log("onChange");
    var total_price_label = document.getElementById("total_price");
    var amount_input = document.getElementById("amount");
    var price_input = document.getElementById("input_price").value;
    var operation = document.getElementById("operation_type").value;
    var s_fee = document.getElementById("sell_price").textContent;
    var b_fee = document.getElementById("buy_price").textContent;
    var fee = operation === 'sell' ? s_fee : b_fee ;
    console.log(typeof price_input, typeof fee);
    fee !== '0' ? amount_input.value = (parseFloat(price_input)/ parseFloat(fee)  ) : amount_input.value = 0 ;
    total_price_label.textContent = price_input.toString();

}
function cal_price_by_amount()
{
    var total_price_label = document.getElementById("total_price");
    var amount_input = document.getElementById("amount").value;

    var operation = document.getElementById("operation_type").value;
    var s_fee = document.getElementById("sell_price").textContent;
    var b_fee = document.getElementById("buy_price").textContent;
    var fee = operation === 'sell' ? s_fee : b_fee ;

    var price_input = document.getElementById("input_price");
    // var fee = document.getElementById("price").textContent;
    price_input.value = (parseFloat(amount_input) * parseFloat(fee)) ;
    total_price_label.textContent = price_input.value.toString();

}

function change_operation(type,buy_price,sell_price) {
    // console.log('change')
    var operation_label = document.getElementById("operation_label");
    var operation_type_input = document.getElementById("operation_type");
    var buy_section = document.getElementById("buy_section");
    var sell_section = document.getElementById("sell_section");

    var submit_order = document.getElementById("submit_temp_order");
    var product_fee = document.getElementById("product_fee");

    document.getElementById("input_price").reset;
    document.getElementById("amount").reset;


    var s = operation_label.textContent;
    console.log(s);
    console.log(operation_label)
    if(s.includes("خرید"))
    {
        if(type === 'sell')
        {
            product_fee.value = sell_price;
            submit_order.textContent = "فروش";
            buy_section.hidden = true;
            sell_section.hidden = false;
            operation_type_input.value = "sell";
            operation_label.textContent = "عملیات فروش";
        }else ;

    }else {
        if(type === 'buy')
        {
            product_fee.value = buy_price;
            submit_order.textContent = "خرید";
            buy_section.hidden = false;
            sell_section.hidden = true;
            operation_type_input.value = "buy";
            operation_label.textContent = "عملیات خرید";
        }else ;
    }
}

// function change_fee()
// {
//     console.log('lll');
//     operation = document.getElementById("operation_type").value;
//     console.log(operation)
//     var fee_label = document.getElementById("price");
//     if(operation==='sell')
//     {
//
//         var new_fee = document.getElementById("product_sell_price").value;
//         fee_label.textContent = new_fee;
//     }else{
//         var new_fee = document.getElementById("product_buy_price").value;
//         console.log('kkkkkkkk');
//         console.log(new_fee)
//         fee_label.textContent = 'pppppp';
//     }
//
// }
