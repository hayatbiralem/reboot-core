(function($){

    var alreadyInit = false;
    var responsiveImagesReady = function(){
        if(!alreadyInit) {
            alreadyInit = true;
            $('html').addClass('is-responsive-images-ready');
        }
    };

    $(window).on('load', function(){
        setTimeout(function(){
            responsiveImagesReady();
        }, 16);
    });

    // fallback
    $(document).ready(function(){
        setTimeout(function(){
            responsiveImagesReady();
        }, 2000);
    });

})(jQuery);