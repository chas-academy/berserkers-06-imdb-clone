const minItems = document.querySelectorAll(".min-item");
const index = document.querySelectorAll("#chart-carousel-index figure");

let itemCounter = 0;
let startX = 0;

const nextItem = function(e) {

  if (window.innerWidth <= 800) {

    if (e.type === 'touchstart') {

      startX = e.touches[0].clientX;

    } else if (e.type === 'touchend') {

      let endX = e.changedTouches[0].clientX;
      
      index[itemCounter].style.backgroundColor = "rgba(242, 242, 242, 0.39)";

      if (startX > endX) {

        if (itemCounter >= minItems.length-1) {
          
          itemCounter = 0;
  
        } else {

          itemCounter++;
        }

      } else if (startX < endX) {

        if (itemCounter <= 0) {
          
          itemCounter = minItems.length-1;

        } else {

          itemCounter--;
        }
      }

      this.style.display = "none";
      minItems[itemCounter].style.display = "block";
      index[itemCounter].style.backgroundColor = "#0D7070";

    }
  }
}  

minItems.forEach(item => {
  item.addEventListener('touchstart', nextItem);
  item.addEventListener('touchend', nextItem);
});