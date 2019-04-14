var RebootHelper = {
    selectText: function(el){
        if (document.selection) { // IE
            var range = document.body.createTextRange();
            range.moveToElementText(el);
            range.select();
        } else if (window.getSelection) {
            var range = document.createRange();
            range.selectNode(el);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
        }
    },

    copy: function(el){
        document.execCommand("copy");
    },

    selectAndCopy: function(el){
        this.selectText(el);
        this.copy();
    }
};

(function($){

    'use strict';

    var $doc = $(document);

    $doc.on('click', '.js-select-and-copy, .js-select-and-copy-wrapper > *', function(){
        var $this = $(this);

        RebootHelper.selectAndCopy(this);

        setTimeout(function(){

            $this.pointer({
                content: 'Kopyalandı!',
                position: 'top',
                close: function() {
                    // This function is fired when you click the close button
                }
            }).pointer('open');

        });
    });

    $doc.ready(function(){
        // stuff
    });

})(jQuery);