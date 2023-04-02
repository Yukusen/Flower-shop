let hamburgerMenu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn');

hamburgerMenu.addEventListener('click', function(){
    let nav = document.querySelector('.navbar');
    nav.classList.toggle('active');
});
userBtn.addEventListener('click', function(){
    let userBox = document.querySelector('.user-box');
    userBox.classList.toggle('active');
});
const closeBtn = document.querySelector('#close-edit');

closeBtn.addEventListener('click',() => {
    document.querySelector('.update-container').style.display = 'none';
})
/*---------testimonial---------*/
let slides = document.querySelectorAll('.testimonial_item');
let index = 0;
console.log(slides);
function nextSlide(){
	slides[index].classList.remove('.active');
	index = (index + 1) % slides.length;
	slides[index].classList.add('.active');
}

function prevSlide(){
	slides[index].classList.remove('.active');
	index = (index - 1 + slides.length) % slides.length;
	slides[index].classList.add('.active');
}