var RebootHelper = {
    selectText: function (el) {
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

    copy: function (el) {
        document.execCommand("copy");
    },

    selectAndCopy: function (el) {
        this.selectText(el);
        this.copy();
    },

    __: function (text) {
        console.log(text, window.reboot_javascript_translations);
        return window.reboot_javascript_translations ? (window.reboot_javascript_translations[text] || text) : text
    },

    basename: function (path) {
        return path.replace(/\\/g, '/').replace(/.*\//, '');
    },

    dirname: function (path) {
        return path.replace(/\\/g, '/').replace(/\/[^\/]*$/, '');
    },

    ellipsisMiddle: function (str, max, sep, half) {
        max = max || 28;
        if (str.length > max) {
            sep = sep || '[...]';
            half = Math.floor((max - sep.length) / 2);
            return str.substr(0, half) + sep + str.substr(-half);
        }
        return str;
    }
};

(function ($) {

    'use strict';

    var $doc = $(document);

    $doc.on('click', '.js-select-and-copy, .js-select-and-copy-wrapper > *', function () {
        var $this = $(this);

        RebootHelper.selectAndCopy(this);

        setTimeout(function () {

            $this.pointer({
                content: 'Kopyalandı!',
                position: 'top',
                close: function () {
                    // This function is fired when you click the close button
                }
            }).pointer('open');

        });
    });

    $doc.ready(function () {
        // stuff
    });

})(jQuery);