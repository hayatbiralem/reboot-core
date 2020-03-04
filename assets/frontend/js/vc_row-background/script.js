(function($){

    $(document).ready(function(){

        $('.vc_row > .c-brainwork-shape').each(function(){
            var $this = $(this);
            var $parent = $this.parent();
            var $bg = $parent.find('> .upb_row_bg');
            if($bg.length > 0) {
                $this.appendTo($bg);
            }
        });

    });

})(jQuery);