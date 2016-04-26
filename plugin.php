<?php
/**
 * Plugin Name: JSON REST API Yoast routes
 * Description: Adds Yoast fields to page and post metadata
 * Author: Alan Gomes<alanhr2@gmail.com>
 * Author URI: *
 * Version: 1.0.0
 * Plugin URI:https://github.com/MongeralAegonDigital/wp-rest-api-yoast.
 */
if (!class_exists('Yoast_To_REST_API')) {
    class Yoast_To_REST_API
    {
        public static function init()
        {
            self::hookStart();
        }

        private static function hookStart()
        {
            add_action('rest_api_init', array(__CLASS__, 'yoastStart'), 10);
        }

        public function yoastStart()
        {
            $type = get_post_types(array('show_in_rest' => true));
            foreach ($type as  $value) {
                add_filter("rest_prepare_{$value}", array(__CLASS__, 'wp_api_encode_yoast'), 10, 3);
            };
        }

        public static function wp_api_encode_yoast($request, $post = null, $object = null)
        {
            $yoastMeta = array(
              'yoast_focuskw' => get_post_meta($post->ID, '_yoast_wpseo_focuskw', true),
              'yoast_title' => get_post_meta($post->ID, '_yoast_wpseo_title', true),
              'yoast_metadesc' => get_post_meta($post->ID, '_yoast_wpseo_metadesc', true),
              'yoast_linkdex' => get_post_meta($post->ID, '_yoast_wpseo_linkdex', true),
              'yoast_metakeywords' => get_post_meta($post->ID, '_yoast_wpseo_metakeywords', true),
              'yoast_meta_robots_noindex' => get_post_meta($post->ID, '_yoast_wpseo_meta-robots-noindex', true),
              'yoast_meta_robots_nofollow' => get_post_meta($post->ID, '_yoast_wpseo_meta-robots-nofollow', true),
              'yoast_meta_robots_adv' => get_post_meta($post->ID, '_yoast_wpseo_meta-robots-adv', true),
              'yoast_canonical' => get_post_meta($post->ID, '_yoast_wpseo_canonical', true),
              'yoast_redirect' => get_post_meta($post->ID, '_yoast_wpseo_redirect', true),
              'yoast_opengraph_title' => get_post_meta($post->ID, '_yoast_wpseo_opengraph-title', true),
              'yoast_opengraph_description' => get_post_meta($post->ID, '_yoast_wpseo_opengraph-description', true),
              'yoast_opengraph_image' => get_post_meta($post->ID, '_yoast_wpseo_opengraph-image', true),
              'yoast_twitter-title' => get_post_meta($post->ID, '_yoast_wpseo_twitter-title', true),
              'yoast_twitter_description' => get_post_meta($post->ID, '_yoast_wpseo_twitter-description', true),
              'yoast_twitter_image' => get_post_meta($post->ID, '_yoast_wpseo_twitter-image', true),
          );

            $request->data['yoast_meta'] = $yoastMeta;

            return $request;
        }
    }
    add_action('plugins_loaded', array('Yoast_To_REST_API', 'init'));
}
