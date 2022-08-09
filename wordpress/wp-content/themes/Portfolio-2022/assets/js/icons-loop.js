$(document).ready(function(e) {

    let delay = 250, // in ms, change to whatever you want
        current_icon_index = 0,
        icon_urls = [
            'assets/img/icons-loop/icon-1.svg',
            'assets/img/icons-loop/icon-2.svg',
            'assets/img/icons-loop/icon-3.svg',
            'assets/img/icons-loop/icon-4.svg',
        ];


    const step_through = () => {
        $('.icon').css({
            'background-image': 'url(' + icon_urls[current_icon_index] +')'
        });

        current_icon_index++;
        if (current_icon_index === icon_urls.length-1) {
            current_icon_index = 0;
        }
        setTimeout(step_through, delay);
    };

    step_through();

});