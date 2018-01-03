const minItems = document.querySelectorAll(".min-item");

let itemCounter = 0;
let startX = 0;
const nextItem = function(e) {


  if (e.type === 'touchstart') {

    startX = e.touches[0].clientX;

  } else if (e.type === 'touchend') {

    let endX = e.changedTouches[0].clientX;
    
    if (startX > endX) {

      itemCounter++;

    } else if (startX < endX) {

      itemCounter--;
    }

    if (itemCounter > minItems.length-1) {

      itemCounter = 0;

    } else if (itemCounter < 0) {

      itemCounter = minItems.length-1;
    }

    this.style.display = "none";
    minItems[itemCounter].style.display = "block";
  
  }
}  


minItems.forEach(item => {
  item.addEventListener('touchstart', nextItem);
  item.addEventListener('touchend', nextItem);
});

