const chart = document.querySelectorAll(".min-item");
const dailyPics = document.querySelectorAll(".unit");
const chartIndex = document.querySelectorAll("#chart-carousel-index span");
const dailyPicsIndex = document.querySelectorAll("#daily-pics-carousel-index span");

const Carousel = function (index, items,displayValue) {

  this.counter = 0;
  this.index = index;
  this.items = items;
  this.startX = 0;
  this.displayValue = displayValue;

  this.addEventListenersForItems = function() {
    this.items.forEach(item => {
      item.addEventListener('touchstart', nextItem);
      item.addEventListener('touchend', nextItem);
  });
}

  const nextItem = (e) => {

    if (window.innerWidth <= 800) {

      if (e.type === 'touchstart') {

        this.startX = e.touches[0].clientX;

      } else if (e.type === 'touchend') {

        let endX = e.changedTouches[0].clientX;
        
        this.index[this.counter].style.backgroundColor = "rgba(242, 242, 242, 0.39)";
        this.items[this.counter].style.display = "none";

        if (this.startX > endX) {
          
          if (this.counter >= this.index.length-1) {
            
            this.counter = 0;
    
          } else {

            this.counter++;
          }

        } else if (this.startX < endX) {

          if (this.counter <= 0) {
            
            this.counter = this.index.length-1;

          } else {

            this.counter--;
          }
        }

     
        this.items[this.counter].style.display = this.displayValue;
        this.index[this.counter].style.backgroundColor = "#0D7070";

      }
    }
  }
  
}

const chartCarousel = new Carousel(chartIndex,chart, 'block');
chartCarousel.addEventListenersForItems();
const DailyPicsCarousel = new Carousel(dailyPicsIndex, dailyPics, 'flex');
DailyPicsCarousel.addEventListenersForItems();