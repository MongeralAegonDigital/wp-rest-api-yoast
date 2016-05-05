<?php

namespace MAD\Controller;

class YoastMetaController
{
    public function __construct()
    {
        add_action('plugins_loaded', array($this, 'hook'));
    }

    public function hook()
    {
        add_action('rest_api_init', array($this, 'start'), 10);
    }

    public function start()
    {
        $type = get_post_types(array('show_in_rest' => true));
        foreach ($type as  $value) {
            add_filter("rest_prepare_{$value}", array($this, 'setMeta'), 10, 3);
        };
    }

    public function setMeta($request, $post = null, $object = null)
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
