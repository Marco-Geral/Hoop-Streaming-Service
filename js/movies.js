
//--------------------Functionality for arrow scroll-----------------//
const arrows = document.querySelectorAll(".arrow")
const moviesrow = document.querySelectorAll(".row_posters")

arrows.forEach((arrow, i)=>{
    const itemNumber = moviesrow[i].querySelectorAll("img").length;
    let clickCounter= 0;
    arrow.addEventListener("click",()=>{
        clickCounter++;
        if(itemNumber - (4+clickCounter) >= 0) {
            moviesrow[i].style.transform = `translateX(${
                moviesrow[i].computedStyleMap().get("transform")[0].x.value - 400}px)`;
        } else{
            moviesrow[i].style.transform = "translateX(0)";
            clickCounter = 0;
        }
    });
    console.log(moviesrow[i].querySelectorAll("img").length)
});

//-----------------Admin add movie button form-----------------//
document.getElementById('addMovieButton').addEventListener('click', function() {
    var form = document.getElementById('movieForm');
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
});
 //for the add movie button form, there is no functionality implemented. so the form wont do much, thats on yall tho, hmu if you get confused

 //---------------filter functionality---------------//
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.button-value');
    const rows = document.querySelectorAll('[data-genre]');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const genre = this.textContent.toLowerCase();
            rows.forEach(row => {
                if (row.dataset.genre!== genre) {
                    row.style.display = 'none';
                } else {
                    row.style.display = '';
                }
            });
        });
    });
});