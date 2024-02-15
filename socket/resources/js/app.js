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


        Echo.channel('notification')
            .listen('MessageNotification', (e) => {
                if(e.type === "market_price"){
                    e.products.original.forEach(function(product){
                        console.log(product);
                        document.getElementById('buy_price_'+product.id).innerText = product.buy_price;
                        document.getElementById('sell_price_'+product.id).innerText = product.sell_price;
                        let label_status = document.getElementsByClassName("product_status_label");
                        label_status.textContent = product.status === 1 ?  "داریم" : "فعلا نداریم" ;

                    });
                }else {
                    var buttonList = document.getElementsByClassName("btn-status");
                    var market_status_label = document.getElementById("market_label");

                    let status = e.market_status.original !== "open"
                    let label_status = e.market_status.original === "open" ? "وضعیت بازار : باز" : "وضعیت بازار : بسته"

                    // console.log(e.market_status);
                    // console.log(status)

                    Array.from(buttonList).forEach(function(button) {
                        button.disabled = status;
                    });
                    market_status_label.textContent = label_status;


                }
            });


    }
});
