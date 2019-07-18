(function($){

    $(document).ready(function(){

        /**
         * Fancy file inputs
         */

        $('.wpcf7-form input[type=file]').each(function () {
            var $this = $(this);
            var $parent = $this.parent();

            // continue if already set
            if ($parent.is('.c-fancy-upload')) {
                return true;
            }

            $parent.addClass('c-fancy-upload');

            var defaultText = RebootHelper.__('No files selected');

            var $fileName = $('<span class="c-fancy-upload__file-name">' + defaultText + '</span>');
            $parent.append($fileName);

            $this.on('change', function () {
                var filename = $this.val();

                if (filename) {
                    $fileName.text( RebootHelper.ellipsisMiddle( RebootHelper.basename(filename) ) );
                } else {
                    $fileName.text(defaultText);
                }
            });
        });

    });

})(jQuery);