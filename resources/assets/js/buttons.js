function movieRate() {
    var rating = document.forms[0];
    var txt = "";
    var i;
    for (i = 0; i < rating.length; i++) {
        if (rating[i].checked) {
            txt = txt + rating[i].value + " ";
        } 
    }
    document.getElementById('user_rating').style.display = 'none';
    document.getElementById('movie_rating').style.display = 'block';
    document.getElementById("description").textContent = txt;
    }