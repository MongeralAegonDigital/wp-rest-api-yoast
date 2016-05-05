<?php

namespace MAD\Controller;

class YoastSiteMapController
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
        register_rest_route('wp/v2', '/sitemap', array(
          'methods' => 'GET',
          'callback' => array($this, 'showUrl'),
        ));
    }

    public function showUrl()
    {
        $postTypes = get_post_types(array('show_in_rest' => true));
        unset($postTypes['attachment']);
        unset($postTypes['page']);
        foreach ($postTypes as  $postType) {
            $count_posts = wp_count_posts($postType);
            $count_posts = $count_posts->publish;
            if ($count_posts !== 0) {
                $result = new \Wp_Query(['post_type' => $postType, 'post_status' => 'publish']);
                foreach ($result->posts as $post) {
                    $uris[$postType][] = $post->post_name;
                }
            }
        }

        return $uris;
    }
}
