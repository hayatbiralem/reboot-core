<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if(!class_exists('REBOOT_Widget_Post_List')) {

    class REBOOT_Widget_Post_List extends WP_Widget {

        /**
         * Sets up the widgets name etc
         */
        public function __construct() {
            $widget_ops = array(
                'classname' => 'reboot_widget_post_list',
                'description' => __('Simple post list from any post type with optional taxonomy terms', REBOOT_CORE_TEXT_DOMAIN),
            );
            parent::__construct( 'reboot_widget_post_list', sprintf(__('%s Post List', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY), $widget_ops );
        }

        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget( $args, $instance ) {
            extract($args, EXTR_SKIP);

            $widget_id = $args['widget_id'];

            $reboot_post_list = get_field('reboot_post_list', 'widget_' . $widget_id);

            // before widget
            if(isset($before_widget) && !empty($before_widget)) {
                echo $before_widget;
            }

            // before & after title
            if ( !empty( $instance['title'] ) ) {

                if(isset($before_title) && !empty($before_title)) {
                    echo $before_title;
                }

                echo $instance['title'];

                if(isset($after_title) && !empty($after_title)) {
                    echo $after_title;
                }
            };

            echo '<div class="c-widget__body">';
            // content
            if(empty($reboot_post_list) || empty(implode('', (array) $reboot_post_list))) {
                echo __('You need to set the data settings of your widget!' , REBOOT_CORE_TEXT_DOMAIN);
                return;
            } else {
                echo do_shortcode( sprintf('[reboot_post_list post_type="%s" count="%s" taxonomy="%s" terms="%s"]', $reboot_post_list['post_type'], $reboot_post_list['count'], $reboot_post_list['taxonomy'], $reboot_post_list['terms']) );
            }
            echo '</div>';

            if(isset($after_widget) && !empty($after_widget)) {
                // after widget
                echo $after_widget;
            }
        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         *
         * @return void
         */
        public function form( $instance ) {
            if (isset($instance['title'])) {
                $title = $instance['title'];
            } else {
                $title = '';
            }

            // Widget admin form
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                       name="<?php echo $this->get_field_name('title'); ?>" type="text"
                       value="<?php echo esc_attr($title); ?>"/>
            </p>
            <?php
        }

        /**
         * Processing widget options on save
         *
         * @param array $new_instance The new options
         * @param array $old_instance The previous options
         *
         * @return array
         */
        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
            return $instance;
        }
    }

}

