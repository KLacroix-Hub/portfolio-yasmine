$(document).on('scroll', function(){

    if(window.scrollY >= 1000 && window.scrollY < 1500){
        console.log(scrollY)
        const movingText = $('#talent-tranform')
        movingText.css("tranform","translateX(-" + 35 + "vw)")
    }

})