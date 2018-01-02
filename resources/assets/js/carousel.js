const minItems = document.querySelectorAll(".min-item");

let itemCounter = 0;

const nextItem = function(e) {

  let points = []; 

  for ( let i = 0; i < e.changedTouches.length; i++ ) {
    points.push(e.changedTouches[i].clientX);
  }

  console.log(points);

  if (points[0] < points[points.length-1]) {
    itemCounter++;
  } else {
    itemCounter--;
  }

  this.style.display = "none";


  if (itemCounter > minItems.length-1) {
    itemCounter = 0;
  } else if (itemCounter < 0) {
    itemCounter = minItems.length-1;
  }
  console.log(itemCounter);
  minItems[itemCounter].style.display = "block";

}  


minItems.forEach(item => {
  item.addEventListener('touchend', nextItem);
});

