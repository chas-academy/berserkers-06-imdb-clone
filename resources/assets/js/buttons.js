

function rate(rating) {

    document.rating.star.value = rating;
    document.rating.submit();
    return true;
}

function star(rating){

if(!(rating>=1 && rating<=5)) return;

for (var i=1;i<=rating;i++)
document.getElementById("star" +rating);

} //kolla upp id