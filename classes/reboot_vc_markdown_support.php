<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

require_once REBOOT_CORE_PATH . 'lib/parsedown/Parsedown.php';

if (!class_exists('reboot_vc_markdown_support')) {

  class reboot_vc_markdown_support
  {

      static $shortcodes = [
          'vc_custom_heading' => ['text'],
          'ultimate_heading' => false,
      ];

    public function __construct()
    {
        foreach (self::$shortcodes as $shortcode => $atts) {
            if($atts) {
                add_filter( "shortcode_atts_{$shortcode}", array($this, 'filter_atts'), 20, 4 );
            }
        }

        // Some "clever" coders forget the $shortcode part of shortcode_atts function
        // so we need to filter final output of that shortcode by assigning false to their atts.
        add_filter( "do_shortcode_tag", array($this, 'filter_final_output'), 20, 4 );
    }

    public function filter_atts($out, $pairs, $atts, $shortcode){
        foreach (self::$shortcodes[$shortcode] as $att) {
            $out[$att] = Parsedown::instance()->line( $out[$att] );
        }
        return $out;
    }

      public function filter_final_output($output, $tag, $attr, $m){
          if(array_key_exists($tag, self::$shortcodes) && self::$shortcodes[$tag] === false) {
              return Parsedown::instance()->line( $output );
          }
          return $output;
      }

  }

  new reboot_vc_markdown_support();

}
