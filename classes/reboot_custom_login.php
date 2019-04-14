<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!class_exists('reboot_custom_login')) {

    class reboot_custom_login {

        /**
         * @var array
         */
        var $custom_login;
        var $menu_slug;

        /**
         * clickcarrot_custom_sidebars constructor.
         */
        function __construct()
        {
            $this->menu_slug = sprintf('%s-custom-login', REBOOT_AGENCY_SLUG);

            add_action('acf/init', [$this, 'acf_init'], 30);
            add_action('login_enqueue_scripts', array($this, 'print_styles'));
            add_filter('login_headerurl', array($this, 'login_headerurl'));
            add_filter('login_headertitle', array($this, 'login_headertitle'));
        }

        function acf_init(){
            $this->add_sub_page();
            $this->add_local_field_group();
        }

        function add_sub_page(){
            acf_add_options_sub_page(array(
                'page_title' 	=> __('Custom Login', REBOOT_TEXT_DOMAIN),
                'menu_title'	=> __('Custom Login', REBOOT_TEXT_DOMAIN),
                'menu_slug'	=> $this->menu_slug,
                'parent_slug'	=> REBOOT_AGENCY_SLUG,
            ));
        }

        function add_local_field_group(){
            acf_add_local_field_group(array(
                'key' => 'group_custom_login',
                'title' => 'Custom Login',
                'fields' => array(
                    array(
                        'key' => 'field_custom_login',
                        'label' => 'Custom Login',
                        'name' => 'custom_login',
                        'type' => 'group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_custom_login_primary_color',
                                'label' => 'Primary Color',
                                'name' => 'primary_color',
                                'type' => 'group',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'layout' => 'table',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_custom_login_primary_color_color',
                                        'label' => 'Color',
                                        'name' => 'color',
                                        'type' => 'color_picker',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => array(
                                            'width' => '',
                                            'class' => '',
                                            'id' => '',
                                        ),
                                        'default_value' => '',
                                    ),
                                    array(
                                        'key' => 'field_custom_login_primary_color_opacity',
                                        'label' => 'Opacity',
                                        'name' => 'opacity',
                                        'type' => 'range',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => array(
                                            'width' => '',
                                            'class' => '',
                                            'id' => '',
                                        ),
                                        'default_value' => 100,
                                        'min' => '',
                                        'max' => '',
                                        'step' => '',
                                        'prepend' => '',
                                        'append' => '',
                                    ),
                                ),
                            ),
                            array(
                                'key' => 'field_custom_login_background_overlay',
                                'label' => 'Background Overlay',
                                'name' => 'background_overlay',
                                'type' => 'group',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'layout' => 'table',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_custom_login_background_overlay_color',
                                        'label' => 'Color',
                                        'name' => 'color',
                                        'type' => 'color_picker',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => array(
                                            'width' => '',
                                            'class' => '',
                                            'id' => '',
                                        ),
                                        'default_value' => '',
                                    ),
                                    array(
                                        'key' => 'field_custom_login_background_overlay_opacity',
                                        'label' => 'Opacity',
                                        'name' => 'opacity',
                                        'type' => 'range',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => array(
                                            'width' => '',
                                            'class' => '',
                                            'id' => '',
                                        ),
                                        'default_value' => 50,
                                        'min' => '',
                                        'max' => '',
                                        'step' => '',
                                        'prepend' => '',
                                        'append' => '',
                                    ),
                                ),
                            ),
                            array(
                                'key' => 'field_custom_login_images',
                                'label' => 'Images',
                                'name' => 'images',
                                'type' => 'group',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'layout' => 'table',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_custom_login_images_logo',
                                        'label' => 'Logo',
                                        'name' => 'logo',
                                        'type' => 'image',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => array(
                                            'width' => '',
                                            'class' => '',
                                            'id' => '',
                                        ),
                                        'return_format' => 'array',
                                        'preview_size' => 'full',
                                        'library' => 'all',
                                        'min_width' => '',
                                        'min_height' => '',
                                        'min_size' => '',
                                        'max_width' => '',
                                        'max_height' => '',
                                        'max_size' => '',
                                        'mime_types' => '',
                                    ),
                                    array(
                                        'key' => 'field_custom_login_images_background_image',
                                        'label' => 'Background Image',
                                        'name' => 'background_image',
                                        'type' => 'image',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => array(
                                            'width' => '',
                                            'class' => '',
                                            'id' => '',
                                        ),
                                        'return_format' => 'array',
                                        'preview_size' => 'large',
                                        'library' => 'all',
                                        'min_width' => '',
                                        'min_height' => '',
                                        'min_size' => '',
                                        'max_width' => '',
                                        'max_height' => '',
                                        'max_size' => '',
                                        'mime_types' => '',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => $this->menu_slug,
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'seamless',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => 1,
                'description' => '',
            ));
        }

        /**
         * @return string
         */
        function print_styles()
        {
            if(!function_exists('get_field')) {
                return;
            }

            $this->custom_login = get_field('custom_login', 'option');

            if(empty($this->custom_login)) {
                return;
            }

            $background_overlay = $this->custom_login['background_overlay']['color'];
            $background_overlay_alpha = $this->hex2rgba( $background_overlay, ((float) $this->custom_login['background_overlay']['opacity']) / 100 );
            if(!$this->custom_login['background_overlay']['opacity']) {
                $background_overlay_alpha = null;
            }

            $primary_color = $this->custom_login['primary_color']['color'];
            $primary_color_alpha = $this->hex2rgba( $primary_color, ((float) $this->custom_login['primary_color']['opacity']) / 100 );

            $hover_color = $primary_color_alpha;

            $logo = $this->custom_login['images']['logo']['url'];
            $logo_width = $this->custom_login['images']['logo']['width'];
            $logo_height = $this->custom_login['images']['logo']['height'];

            $background = $this->custom_login['images']['background_image']['url'];

            ?>
            <!--
        <?= var_export($this->custom_login, true); ?>
        -->
            <style>

                html,
                body {
                    background: <?php echo $background_overlay; ?> !important;
                }

                #backtoblog {
                    display: none !important;
                }

                #login #nav,
                .login #nav {
                    text-align: center !important;
                }

                #login .button-primary {
                    border-width: 0 !important;
                    text-shadow: none !important;
                    box-shadow: none !important;
                }

                <?php if(!empty($primary_color)) : ?>

                .login .message {
                    border-left-color: <?php echo $primary_color; ?> !important;
                }

                <?php if($primary_color == '#fff' || $primary_color == '#ffffff') { ?>
                ::selection {
                    background: #fff !important;
                    color: #333 !important; /* WebKit/Blink Browsers */
                }
                ::-moz-selection {
                    background: #fff !important;
                    color: #333 !important; /* Gecko Browsers */
                }
                <?php } else { ?>
                ::selection {
                    color: #fff !important;
                    background: <?php echo $primary_color_alpha; ?> !important; /* WebKit/Blink Browsers */
                }
                ::-moz-selection {
                    color: #fff !important;
                    background: <?php echo $primary_color_alpha; ?> !important; /* Gecko Browsers */
                }
                <?php } ?>

                #login a,
                .login a {
                    color: <?php echo $primary_color_alpha; ?> !important;
                    text-decoration: none; !important;
                }

                #login .button-primary {
                    background-color: <?php echo $primary_color_alpha; ?> !important;
                }

                input[type=text]:focus,
                input[type=search]:focus,
                input[type=radio]:focus,
                input[type=tel]:focus,
                input[type=time]:focus,
                input[type=url]:focus,
                input[type=week]:focus,
                input[type=password]:focus,
                input[type=checkbox]:focus,
                input[type=color]:focus,
                input[type=date]:focus,
                input[type=datetime]:focus,
                input[type=datetime-local]:focus,
                input[type=email]:focus,
                input[type=month]:focus,
                input[type=number]:focus,
                select:focus,
                textarea:focus {
                    border-color: <?php echo $primary_color_alpha; ?> !important;
                    -webkit-box-shadow: 0 0 2px <?php echo $primary_color_alpha; ?> !important;
                    box-shadow: 0 0 2px <?php echo $primary_color_alpha; ?> !important;
                }

                input[type=checkbox]:checked:before {
                    color: <?php echo $primary_color_alpha; ?> !important;
                }
                <?php endif; ?>

                <?php if(!empty($hover_color)) : ?>
                #login a:hover,
                .login a:hover {
                    color: <?php echo $hover_color; ?> !important;
                }

                #login .button-primary:hover {
                    background-color: <?php echo $hover_color; ?> !important;
                }
                <?php endif; ?>

                <?php if( !empty($background) ) : ?>
                body {
                    background: url(<?php echo $background; ?>) scroll no-repeat center center !important;
                    background-size: cover !important;
                }
                <?php endif; ?>

                <?php if (!empty($background_overlay_alpha)) : ?>
                body:before {
                    position: absolute;
                    z-index: 1;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    left: 0;

                    content: "";
                    display: block;
                    background-color: <?php echo $background_overlay_alpha ?>;
                }

                #login {
                    position: relative;
                    z-index: 2;
                }
                <?php endif; ?>

                <?php if( !empty($logo) ) : ?>
                #login h1,
                .login h1 {
                    position: relative !important;
                    margin-bottom: 25px !important;
                    padding: 0 !important;
                    padding-bottom: <?php echo round(9/16, 6) * 100; ?>% !important;
                <?php if(!empty($logo_width) && $logo_height) : ?>
                    padding-bottom: <?php echo round($logo_height/$logo_width, 6) * 100; ?>% !important;
                <?php endif; ?>
                }

                #login h1 a,
                .login h1 a {
                    position: absolute;

                    width: 100%;
                    height: 100%;

                    background-image: url(<?php echo $logo; ?>) !important;
                    background-size: contain !important;
                    background-position: center center !important;
                }

                .login .privacy-policy-page-link {
                    margin-top: 1em !important;
                }

                <?php endif; ?>
            </style>
            <?php
        }

        /**
         * Convert hexdec color string to rgb(a) string
         *
         * @param $color
         * @param bool $opacity
         * @return string
         */
        function hex2rgba($color, $opacity = false) {

            $default = 'rgb(0,0,0)';

            //Return default if no color provided
            if(empty($color))
                return $default;

            //Sanitize $color if "#" is provided
            if ($color[0] == '#' ) {
                $color = substr( $color, 1 );
            }

            //Check if color has 6 or 3 characters and get values
            if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
            } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
            } else {
                return $default;
            }

            //Convert hexadec to rgb
            $rgb =  array_map('hexdec', $hex);

            //Check if opacity is set(rgba or rgb)
            if($opacity){
                if(abs($opacity) > 1)
                    $opacity = 1.0;
                $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
            } else {
                $output = 'rgb('.implode(",",$rgb).')';
            }

            //Return rgb(a) color string
            return $output;
        }

        /**
         * @return string
         */
        function login_headerurl()
        {
            return home_url();
        }

        /**
         * @return string
         */
        function login_headertitle()
        {
            return get_bloginfo('name');
        }
    }

    new reboot_custom_login();

}

