/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import jQuery from 'jquery';
window.$ = jQuery;
require('./bootstrap');
const {getElement} = require("bootstrap/js/src/util");

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Vue from 'vue';
import axios from 'axios';
const app = new Vue({
    el: '#app',
    created(){
        let a = 1;


        Echo.channel('notification').listen('MessageNotification', (e) => {

                if(e.type === "market_price"){
                    if(window.location.href.includes('order'))
                    {

                        var product_id = document.getElementById("product_id").value;
                        console.log(product_id)
                        var x = document.getElementById("price");

                        var fee_buy = document.getElementById("buy_price");
                        var fee_sell = document.getElementById("sell_price");

                        var p = e.products.original.find(p => p.id.toString() === product_id);

                        fee_sell.textContent = p.sell_price;
                        fee_buy.textContent = p.buy_price;
                        x.value = p.buy_price;

                    }else{
                        e.products.original.forEach(function(product){
                            console.log(product);
                            document.getElementById('buy_price_'+product.id).innerText = product.buy_price;
                            document.getElementById('sell_price_'+product.id).innerText = product.sell_price;

                            let label_status = document.getElementById("label_price_"+product.id);
                            label_status.textContent = product.status === 1 ?  "داریم" : "فعلا نداریم" ;


                            let button_status = document.getElementById("button_price_"+product.id);
                            console.log(button_status)
                            // button_status.disabled = (product.status === 1) || (e.market_status==="open") ?  false : true ;
                            console.log(e.market_status.original)
                            console.log(product.status)
                            if(e.market_status.original === "open")
                            {
                                if(product.status === 1)
                                {
                                    button_status.disabled = false;
                                }else button_status.disabled = true;

                            }else button_status.disabled = true;

                        });
                    }

                }else {

                    if(window.location.href.includes('order'))
                    {
                        var temp_order_submit_button = document.getElementById("submit_temp_order");
                        let market_status = e.market_status.original !== "open";
                        temp_order_submit_button.disabled = market_status;
                    }else{
                        var buttonList = document.getElementsByClassName("btn-status");
                        var market_status_label = document.getElementById("market_label");


                        let status = e.market_status.original !== "open"
                        let label_status = e.market_status.original === "open" ? "وضعیت بازار : باز" : "وضعیت بازار : بسته"

                        console.log(e.market_status);
                        // console.log(status)

                        Array.from(buttonList).forEach(function(button) {
                            button.disabled = status;
                        });
                        market_status_label.textContent = label_status;
                    }

                }
            });


    }

});

