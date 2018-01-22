//User tabs

var tabcontent = document.getElementsByClassName("tabcontent");
var tablinks = document.getElementsByClassName("tablinks");

const SetHashedTab = function(){

    let regExp, tabName;

    for (var i = 0; i < tabcontent.length; i++) {

        tabName = tablinks[i].innerText.toLocaleLowerCase();
        regExp = RegExp(tabName + '*');

        if (window.location.pathname.length > 10) {
         
            if(regExp.test(window.location.pathname)) {
         
                tabcontent[i].style.display = "flex";
                tablinks[i].className += " active";
            
            } else {
              
                tabcontent[i].style.display = "none";
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
        } else {

            if (tablinks[i].innerText == 'Home') {

                tabcontent[i].style.display = "flex";
                tablinks[i].className += " active";
            } else {

                tabcontent[i].style.display = "none";
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
        }

    }
}

SetHashedTab();


