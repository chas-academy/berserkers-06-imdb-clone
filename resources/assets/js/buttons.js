function dropDown() {

document.getElementById("dropdown-menu")classList.toggle("show");



}

window.onClick = function(event){

if(!event.target.matches("dropdown-menu")){

    var dropdowns = document.getElementsByClassName("dropDowncontent");

    var i;
    for(i = 0; i < dropdowns.length; i++){

        var openDropDown = dropdowns[i];
        if(openDropdown.classList.contains('show')) {

            openDropdown.classlist.remove('show');
        }
    }
}

}

