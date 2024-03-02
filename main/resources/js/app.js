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

            console.log(e.type)
                if(e.type === "market_price"){

                    if(window.location.href.includes('order') || window.location.href.includes('user-order'))
                    {
                        var product_id = document.getElementById("product_id").value;
                        var p = e.products.original.find(p => p.id.toString() === product_id);

                        var submit_buy_order = document.getElementById("submit_buy_order");
                        var submit_sell_order = document.getElementById("submit_sell_order");

                        submit_buy_order.disabled = p.buy_status === 0 ? true : false;
                        submit_sell_order.disabled = p.sell_status === 0 ? true : false;
                        var fee_buy = document.getElementById("buy_price");
                        var fee_sell = document.getElementById("sell_price");

                        fee_sell.textContent = p.sell_price;
                        fee_buy.textContent = p.buy_price;
                    }else{
                        e.products.original.forEach(function(product){
                            if(window.location.href.includes('dashboard')){
                                console.log('buy_price_'+product.id)
                                console.log('sell_price_'+product.id)
                                document.getElementById('buy_price_'+product.id).textContent = product.buy_price;
                                document.getElementById('sell_price_'+product.id).textContent = product.sell_price;


                                let button_buy_status = document.getElementById("button_buy_price_"+product.id);
                                let button_sell_status = document.getElementById("button_sell_price_"+product.id);

                                if(e.market_status.original === "open")
                                {
                                    button_buy_status.disabled = product.buy_status === 1 ? false : true;
                                    button_sell_status.disabled = product.sell_status === 1 ? false : true;
                                }else{
                                    button_buy_status.disabled = true;
                                    button_sell_status.disabled = true;
                                }

                            }else if(window.location.href.includes('customer')){
                                document.getElementById('buy_price_'+product.id).innerText = product.buy_price;
                                document.getElementById('sell_price_'+product.id).innerText = product.sell_price;

                                let button_buy_status = document.getElementById("button_buy_price_"+product.id);
                                let button_sell_status = document.getElementById("button_sell_price_"+product.id);

                                if(e.market_status.original === "open")
                                {
                                    button_buy_status.disabled = product.buy_status === 1 ? false : true;
                                    button_sell_status.disabled = product.sell_status === 1 ? false : true;
                                }else{
                                    button_buy_status.disabled = true;
                                    button_sell_status.disabled = true;
                                }
                            }
                        });
                    }
                }else {
                    if(window.location.href.includes('dashboard'))
                    {
                        console.log("reached")
                        var market_status_span_color = document.getElementById('market_status_span_color');
                        var market_status_span = document.getElementById('market_status_span');
                        let market_status = e.market_status.original !== "open" ;


                        if(!market_status)
                        {
                            market_status_span_color.classList.remove("bg-colorthird1");
                            market_status_span_color.classList.add("bg-colorfourth1");
                            market_status_span.innerText = "باز";
                        }else{
                            market_status_span_color.classList.remove("bg-colorfourth1");
                            market_status_span_color.classList.add("bg-colorthird1");
                            market_status_span.innerText = "بسته";
                        }
                        console.log(e.products)
                        e.products.original.forEach(function(product){
                            let button_buy_status = document.getElementById("button_buy_price_"+product.id);
                            let button_sell_status = document.getElementById("button_sell_price_"+product.id);

                            if(e.market_status.original === "open")
                            {
                                button_buy_status.disabled = product.buy_status === 1 ? false : true;
                                button_sell_status.disabled = product.sell_status === 1 ? false : true;
                            }else{
                                button_buy_status.disabled = true;
                                button_sell_status.disabled = true;
                            }
                        });

                    }else if(window.location.href.includes('user-order'))
                    {
                        console.log("market change listener")


                        var change_to_buy_button = document.getElementById("change_to_buy");
                        var change_to_sell_button = document.getElementById("change_to_sell");
                        var market_status_span = document.getElementById("market_status_span");
                        var market_status_span_color = document.getElementById('market_status_span_color');
                        var submit_buy_order = document.getElementById("submit_buy_order");
                        var submit_sell_order = document.getElementById("submit_sell_order");


                        let market_status = e.market_status.original === "open";

                        submit_buy_order.disabled = !market_status ? true : false;
                        submit_sell_order.disabled = !market_status ? true : false;

                        change_to_buy_button.disabled = market_status;
                        change_to_sell_button.disabled = market_status;

                        if(market_status)
                        {
                            market_status_span_color.classList.remove("bg-colorthird1");
                            market_status_span_color.classList.add("bg-colorfourth1");
                            market_status_span.innerText = "باز";
                        }else{
                            market_status_span_color.classList.remove("bg-colorfourth1");
                            market_status_span_color.classList.add("bg-colorthird1");
                            market_status_span.innerText = "بسته";
                        }

                    }else if(window.location.href.includes('user-liveorders') || window.location.href.includes('user-transactions'))
                    {
                        console.log("here");
                        var market_status_span = document.getElementById("market_status_span");
                        var market_status_span_color = document.getElementById('market_status_span_color');

                        let market_status = e.market_status.original !== "open";


                        if(!market_status)
                        {
                            market_status_span_color.classList.remove("bg-colorthird1");
                            market_status_span_color.classList.add("bg-colorfourth1");
                            market_status_span.innerText = "باز";
                        }else{
                            market_status_span_color.classList.remove("bg-colorfourth1");
                            market_status_span_color.classList.add("bg-colorthird1");
                            market_status_span.innerText = "بسته";
                        }
                    }
                }
            });
    }
});

