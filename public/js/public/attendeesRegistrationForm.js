const body = document.querySelector('body');
const swiperBlock = document.getElementById('swiper-block');
const btnParticipate = document.getElementById('btn-participate');
const formRegistration = document.getElementById('attendees_registration_form');

btnParticipate.addEventListener('click', (event) => {
    swiperBlock.style.display = 'none';
    body.style.backgroundColor = '#343434';
    formRegistration.style.display = 'block';
});