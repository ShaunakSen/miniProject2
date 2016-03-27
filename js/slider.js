$(document).ready(function(){
    var speed=500;
    var autoswitch=true;
    var autoswitch_speed=4000;
    //add initial active class

    $('.slide').first().addClass('active');

    //hide all slides
    $('.slide').hide();
    //show 1st slide
    $('.active').show();
    if(autoswitch==true)
    {
        setInterval(nextSlide,autoswitch_speed);
    }
    $('#next').on('click',nextSlide);
    $('#prev').on('click',prevSlide);



    //switch to next slide
    function nextSlide()
    {
        $('.active').removeClass('active').addClass('oldActive');
        if($('.oldActive').is(':last-child'))
        {
            $('.slide').first().addClass('active');
        }
        else
        {
            $('.oldActive').next().addClass('active');
        }
        $('.oldActive').removeClass('oldActive');
        $('.slide').fadeOut(speed);
        $('.active').fadeIn(speed);
    }

    function prevSlide()
    {
        $('.active').removeClass('active').addClass('oldActive');
        if($('.oldActive').is(':first-child'))
        {
            $('.slide').last().addClass('active');
        }
        else
        {
            $('.oldActive').prev().addClass('active');
        }
        $('.oldActive').removeClass('oldActive');
        $('.slide').fadeOut(speed);
        $('.active').fadeIn(speed);
    }
});