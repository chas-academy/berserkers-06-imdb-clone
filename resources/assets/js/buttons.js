//global declarations
var rating = 3;
var stars = null;

//initial setup
document.addEventListener('DOMContentLoaded', function(){
  stars = document.querySelectorAll('#stars');
  addListeners();
  setRating(); //based on global rating variable value
});

function addListeners(){
  [].forEach.call(stars, function(star, index){
    star.addEventListener('click', (function(idx){
      console.log('adding listener', index);
      return function(){
        rating = idx + 1;  
        console.log('Rating is now', rating)
        setRating();
      }
    })(index));
  });
  
}

function setRating(){
  [].forEach.call(stars, function(star, index){
    if(rating > index){
      star.classList.add('rated');
      console.log('added rated on', index );
    }else{
      star.classList.remove('rated');
      console.log('removed rated on', index );
    }
  });
}