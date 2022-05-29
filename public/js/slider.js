$(function() {
    
    var header = $(".header");
    var headerFixedBg = $(".headerFixedBg");
    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();
    
        if (scroll >= 400) {
            header.removeClass('header').addClass("headerFixed animate__animated animate__slideInDown");
            headerFixedBg.removeClass('hidden').addClass("animate__animated animate__slideInDown");
        } else {
            header.removeClass("headerFixed animate__animated animate__slideInDown").addClass('header');
            headerFixedBg.removeClass("animate__animated animate__slideInDown").addClass('hidden');
        }
    });

    $( "#openNavMenu" ).click(function() {
        header.addClass("h-full");
    });

    $( "#closeNavMenu" ).click(function() {
        setTimeout(function() {
            header.removeClass("h-full");
        },500);
    });

    

});

function Slider() {
    const carouselSlides = document.querySelectorAll('.slide');
    const btnPrev = document.querySelector('.prev');
    const btnNext = document.querySelector('.next');
    const dotsSlide = document.querySelector('.dots-container');
    let currentSlide = 0;
  
    const activeDot = function (slide) {
        document.querySelectorAll('.dot').forEach(dot => dot.classList.remove('active'));
        document.querySelector(`.dot[data-slide="${slide}"]`).classList.add('active');
    };
    activeDot(currentSlide);

    const changeSlide = function (slides) {
        // console.log(carouselSlides)
        carouselSlides.forEach((slide, index) => (slide.style.transform = `translateX(${100 * (index - slides)}%)`));
    };
    changeSlide(currentSlide);

    btnNext.addEventListener('click', function () {
        currentSlide++; 
        if (carouselSlides.length - 1 < currentSlide) {
            currentSlide = 0;
        };
        changeSlide(currentSlide);
        activeDot(currentSlide);
    });
    btnPrev.addEventListener('click', function () {
        currentSlide--;
        if (0 >= currentSlide) {
            currentSlide = 0;
        }; 
        changeSlide(currentSlide);
        activeDot(currentSlide);
    });

    dotsSlide.addEventListener('click', function (e) {
        if (e.target.classList.contains('dot')) {
            const slide = e.target.dataset.slide;
            changeSlide(slide);
            activeDot(slide);
        }
    });

    setInterval(function() {
        currentSlide++; 
        if (carouselSlides.length - 1 < currentSlide) {
            currentSlide = 0;
        };
        changeSlide(currentSlide);
        activeDot(currentSlide);
    },4000)
  };
Slider();

// testimonials

function Testimonial() {
    const carouselSlides = document.querySelectorAll('.testimonial-slide');
    const dotsSlide = document.querySelector('.dots-container');
    let currentSlide = 0;
  
    const activeDot = function (slide) {
        document.querySelectorAll('.dot').forEach(dot => dot.classList.remove('active'));
        document.querySelector(`.dot[data-slide="${slide}"]`).classList.add('active');
    };
    activeDot(currentSlide);

    const changeSlide = function (slides) {
        carouselSlides.forEach((slide, index) => (slide.style.transform = `translateX(${500 * (index - slides)}%)`));
    };
    changeSlide(currentSlide);

    setInterval(function() {
        currentSlide++; 
        if (carouselSlides.length - 1 < currentSlide) {
            currentSlide = 0;
        };
        changeSlide(currentSlide);
        activeDot(currentSlide);
    },6000)
  };
Testimonial();