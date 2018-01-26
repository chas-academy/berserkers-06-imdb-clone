
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
      html.classList.remove("is-clipped");
    });
  });
}


//Trailer

function showTrailer() {
  var triggerButton = document.querySelector(".modal-button2");
  var videoContainer = document.querySelector(".video-container");

  triggerButton.onclick = function () {
    videoContainer.style.display = "flex";
    triggerButton.style.display = "none";
  }
}

showTrailer();

//Review container and Comment container

function showContent() {

  //Unfinished, only works with 1 button atm
  //cancel and submit-comment buttons uses Id selector for now

  var commentButton = document.getElementsByClassName("comment-button");
  var commentContainer = document.querySelector(".create-comment");
  var cancelButton = document.querySelector("#cancel-comment");
  var submitButton = document.querySelector("#submit-comment");
  var reviewButton = document.querySelector("#review-button");
  var reviewContainer = document.querySelector(".make-review");
  var cancelReview = document.querySelector("#cancel-review");
  var submitReview = document.querySelector("#submit-review");

  for (var i = 0; i < commentButton.length; i++) {
    commentButton[i].onclick = function (e) {
      e.target;
      commentContainer.style.display = "block";
    }
  }
if (submitButton) {

  cancelButton.onclick = function () {
    commentContainer.style.display = "none";
  }

  submitButton.onclick = function () {
    commentContainer.style.display = "none";
  }

}
 

  reviewButton.onclick = function () {
    reviewContainer.style.display = "block";
  }

  cancelReview.onclick = function () {
    reviewContainer.style.display = "none";
  }

  submitReview.onclick = function () {
    reviewContainer.style.display = "none";
  }
}

showContent();