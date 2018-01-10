/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/*require("./bootstrap");

window.Vue = require("vue");*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*Vue.component(
  "example-component",
  require("./components/ExampleComponent.vue")
);*/

//Hamburger

document.addEventListener("DOMContentLoaded", function () {
  // Get all "navbar-burger" elements
  var $navbarBurgers = Array.prototype.slice.call(
    document.querySelectorAll(".navbar-burger"),
    0
  );

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {
    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener("click", function () {
        // Get the target from the "data-target" attribute
        var target = $el.dataset.target;
        var $target = document.getElementById(target);

        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle("is-active");
        $target.classList.toggle("is-active");
      });
    });
  }
});

//Toggle active modal

var modalButton = document.getElementsByClassName('modal-button');
for (var i = 0; i < modalButton.length; i++) {
  modalButton[i].addEventListener("click", function (event) {
    event.preventDefault();
    var modal = document.querySelector(".modal");
    var html = document.querySelector("html");
    modal.classList.add("is-active");
    html.classList.add("is-clipped");

    modal.querySelector(".modal-background").addEventListener("click", function (e) {
      e.preventDefault();
      modal.classList.remove("is-active");
      html.classList.remove("is-clipped");
    });

    document.querySelector(".is-danger").addEventListener("click", function (eventtwo) {
      eventtwo.preventDefault();
      modal.classList.remove("is-active");
      html.classList.remove("is-active");
    });
  });
}

