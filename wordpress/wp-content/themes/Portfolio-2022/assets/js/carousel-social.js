$(document).ready(function(){
    // Carousel homepage
    var owlHome = $(".owl-home");
    owlHome.owlCarousel({
        loop: true,
        dots:false,
        margin: 60,
        nav:false,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                margin:30,
                loop:true,
            },

            700:{
                items:2,
            },

            1024:{
                items:2,
            },

            1280:{
                items:3,
            },

            1440:{
                items:3,
            },

            1920:{
                items:4,
            }
        },
    });

    $('#ctaPrev').click(function(){
        owlHome.trigger('prev.owl.carousel');
    });

    $('#ctaNext').click(function(){
        owlHome.trigger('next.owl.carousel');
    });

    // Carousel sur la page Talents
    const owlTalents = $('.owl-talents')

    owlTalents.owlCarousel({
        loop: true,
        dots:false,
        margin: 30,
        nav:false,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                margin:30,
                loop:true,
            },

            700:{
                items:2,
            },

            1024:{
                items:2,
            },

            1280:{
                items:3,
            },

            1440:{
                items:3,
            },

            1920:{
                items:4,
            }
        },
    });
    
    $('#ctaPrev').click(function(){
        owlTalents.trigger('prev.owl.carousel');
    });

    $('#ctaNext').click(function(){
        owlTalents.trigger('next.owl.carousel');
    });

    //Carousel sur la page talent / section cocktail de talent
    const owlCocktail = $('.owl-cocktail')

    owlCocktail.owlCarousel({
        loop: true,
        dots:false,
        margin: 30,
        nav:false,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                margin:30,
                loop:true,
            },

            700:{
                items:2,
            },

            1024:{
                items:3,
            },

            1280:{
                items:4,
            },

            1440:{
                items:4,
            },

            1920:{
                items:4,
            }
        },
    })

    $('#ctaPrevCocktail').click(function() {
        owlCocktail.trigger('prev.owl.carousel');
    })

    $('#ctaNextCocktail').click(function(){
        owlCocktail.trigger('next.owl.carousel');
    });

});