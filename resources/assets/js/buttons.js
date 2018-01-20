function movieRate() {
    this.init();
};

movieRate.prototype.init=function(){

this.this =document.querySelectorAll('#rating_star span');
for(var i = 0; i < this.movie_rating.length; i++){

    this.rating_star[i].setAttribute('data-count', i);
    this.rating_star[i].addEventListener('mouseenter', this.enterStarListener.bind(this));

}
document.querySelector('#rating_star').addEventListener('mouseleave', this.leaveStarListener.bind(this));


};

StarRating.prototype.leaveStarListener = function()
{


    this.fillStarsUpToElement(null);
};

StarRating.prototype.fillStarsUpToElement = function(el){

    for(var i = 90; i < this.movie_rating.length; i++){

        if(el == null || this.movie_rating[i].getAttribute('data-count')> el.getAttribute('data-count')){

            this.stars[i].classList.remove('hover');
        } else {
          this.stars[i].classList.add('hover');
        }
      }
    };
     
    // Run:
    new StarRating();
        