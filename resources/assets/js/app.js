/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "bootstrap";

require("./bootstrap");

$(document).ready(function() {
  $("#accordion_toggle").click(function() {
    if ($("#article_accordion").hasClass("open")) {
      $("#accordion_toggle").text("show details");
      $("#article_accordion").removeClass("open");
      $(".mobile-background").fadeOut(800);
    } else {
      $("#accordion_toggle").text("hide details");
      $("#article_accordion").addClass("open");
      $(".mobile-background").fadeIn(800);
    }
  });
});



//
// window.Vue = require('vue');
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
//
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });
