$(function () {
    var width = 900;
    var speed = 500;
    var currentSlide = 1;
    var $slider = $('#slider');
    var $sliderAnimation = $slider.find('.slides');
    var $slides = $sliderAnimation.find('.slide');
    $("#nextButton").on('click', function () {
        $sliderAnimation.animate({'margin-left': '-=' + width}, speed, function () {
            currentSlide++;
            console.log(currentSlide);
            if (currentSlide === $slides.length) {
                $sliderAnimation.css('margin-left', '0px');
                currentSlide = 1;
            }
        });
    });

    $("#prevButton").on('click', function () {
        currentSlide--;
        if (currentSlide === 0) {
            $sliderAnimation.css('margin-left', '-4500px');
            currentSlide = $slides.length - 1;
        }
        $sliderAnimation.animate({'margin-left': '+=' + width}, speed, function () {
            console.log(currentSlide);
        });
    });
});