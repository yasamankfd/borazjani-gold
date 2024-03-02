function cal_price_by_price()
{
    console.log("cal_price_by_price");
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
    console.log('cal_price_by_amount')
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
    console.log('change')
    var operation_label = document.getElementById("operation_label");
    var operation_type_input = document.getElementById("operation_type");
    var market_status_input = document.getElementById("market_status_span").textContent;

    var buy_section = document.getElementById("buy_section");
    var sell_section = document.getElementById("sell_section");

    var product_fee = document.getElementById("product_fee");

    var submit_buy_order = document.getElementById("submit_buy_order");
    var submit_sell_order = document.getElementById("submit_sell_order");

    var operation_type_div = document.getElementById("operation_type_div");

    document.getElementById("input_price").reset;
    document.getElementById("amount").reset;


    var s = operation_label.textContent;
    console.log("last op : " + operation_type_input.value);
    console.log("type : "+type);



    if(operation_type_input.value.includes("buy"))
    {
        if(type === 'sell')
        {
            status = document.getElementById("product_sell_status");
            console.log("1")
            console.log(status)
            product_fee.value = sell_price;
            operation_type_div.classList.add("bg-colorthird1/70");
            operation_type_div.classList.remove("bg-colorfourth1/70");
            submit_buy_order.classList.add("hidden") ;
            submit_sell_order.classList.remove("hidden");
            buy_section.hidden = true;
            sell_section.hidden = false;
            operation_type_input.value = "sell";
            operation_label.textContent = "عملیات فروش";

        }

    }else {
        if(type === 'buy')
        {
            console.log("2")
            status = document.getElementById("product_buy_status");
            operation_type_div.classList.add("bg-colorfourth1/70");
            operation_type_div.classList.remove("bg-colorthird1/70");
            console.log(status)
            product_fee.value = buy_price;
            submit_sell_order.classList.add("hidden") ;
            submit_buy_order.classList.remove("hidden");
            buy_section.hidden = false;
            sell_section.hidden = true;
            operation_type_input.value = "buy";
            operation_label.textContent = "عملیات خرید";
        }
    }
}


