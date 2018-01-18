@include('layouts.header')
<h1 id="welcome-h1">Hello Filmcritic007!</h1>
<!-- Tab links -->
<div class="tab">
   <button class="tablinks" id="default-tab">Home</button>
   <button class="tablinks">Lists</button>
   <button class="tablinks">Reviews</button>
   <button class="tablinks">Settings</button>
</div>
<!-- Tab content -->
<!--Home -->
<div id="Home" class="tabcontent">
   <!-- Latest Reviews -->
   <div id="latest-reviews">
      <h1 id="latest-title">Latest Reviews</h1>
      <!-- Review 1 -->
      <article class="message is-primary">
         <div class="message-header">
            <p>My favorite movie by far</p>
            <button class="delete" aria-label="delete"></button>
         </div>
         <div class="message-body">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
         </div>
      </article>
      <!-- Review 2 -->
      <article class="message is-primary">
         <div class="message-header">
            <p>Kind of dissapointed..</p>
            <button class="delete" aria-label="delete"></button>
         </div>
         <div class="message-body">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
         </div>
      </article>
   </div>
   <!-- Watch-list-->
   <div class="watchlist-container">
      <h1 id="watchlist-title">My Watchlist</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>

<!-- List Tab -->
<div id="Lists" class="tabcontent">
   <div class="list-container"> <!-- List Container -->
      <h1 class="list-title">Planning to Review</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="list-container"> <!-- List Container -->
      <h1 class="list-title">Have Reviewed</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="list-container"> <!-- List Container -->
      <h1 class="list-title">Currently Reviewing</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="list-container"> <!-- List Container -->
      <h1 class="list-title">Romantic</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="list-container"> <!-- List Container -->
      <h1 class="list-title">Crime</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="list-container"> <!-- List Container -->
      <h1 class="list-title">Crime</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="list-container"> <!-- List Container -->
      <h1 class="list-title">Crime</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="Reviews" class="tabcontent">
    <div class="text-container">
        <h1 class="my-reviews">Game of Thrones (2011)</h1>
        <article class="message is-primary">
            <div class="message-header">
                <p>My favorite movie by far</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
            </div>
         </article>
    </div>
    <div class="text-container">
        <h1 class="my-reviews">Black Mirror (2011)</h1>
        <article class="message is-primary">
            <div class="message-header">
                <p>My favorite movie by far</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
            </div>
         </article>
    </div>
    <div class="text-container">
        <h1 class="my-reviews">Westworld</h1>
        <article class="message is-primary">
            <div class="message-header">
                <p>My favorite movie by far</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
            </div>
         </article>
    </div>
    <div class="text-container">
        <h1 class="my-reviews">Black Mirror</h1>
        <article class="message is-primary">
            <div class="message-header">
                <p>My favorite movie by far</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.

            Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
            </div>
         </article>
    </div>
    <div class="text-container">
        <h1 class="my-reviews">Black Mirror</h1>
        <article class="message is-primary">
            <div class="message-header">
                <p>My favorite movie by far</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
            </div>
         </article>
    </div>
    <div class="text-container">
        <h1 class="my-reviews">Black Mirror</h1>
        <article class="message is-primary">
            <div class="message-header">
                <p>My favorite movie by far</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
            </div>
         </article>
    </div>
    <div class="text-container">
        <h1 class="my-reviews">Black Mirror</h1>
        <article class="message is-primary">
            <div class="message-header">
                <p>My favorite movie by far</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
            </div>
         </article>
    </div>
</div>    

<div id="Settings" class="tabcontent"></div>
@include('layouts.footer')