(function() {

    tinymce.PluginManager.add( 'reboot_core_shortcodes', function( editor, url ) {

        editor.addButton( 'reboot_core_shortcodes_plugin', {

            type: 'menubutton',

            text: 'Simple',
            tooltip: 'Simple shortcodes',

            icon: false,

            menu:
                [
                    // Divider
                    {
                        text: 'Divider',
                        onclick: function() {
                            editor.insertContent( '<hr>' );
                        }
                    },

                    // Divider with style
                    {
                        text: 'Divider with style',
                        menu:
                            [
                                {
                                    text: 'thin',
                                    onclick: function() {
                                        editor.insertContent( '<hr class="thin">' );
                                    }
                                },

                                {
                                    text: 'thick',
                                    onclick: function() {
                                        editor.insertContent( '<hr class="thick">' );
                                    }
                                }
                            ]
                    }
                ]

        } );

    });

})();