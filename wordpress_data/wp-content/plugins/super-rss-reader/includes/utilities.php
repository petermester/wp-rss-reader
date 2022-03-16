<?php
/**
* Common utilities for the plugin
*
*/

if( ! defined( 'ABSPATH' ) ) exit;

class SRR_Utilities{

    public static function init(){

        add_filter( 'the_excerpt_rss', array( __CLASS__, 'insert_featured_image_rss_feed' ) );
        add_filter( 'the_content_feed', array( __CLASS__, 'insert_featured_image_rss_feed' ) );

    }

    public static function insert_featured_image_rss_feed( $content ){

        global $post;

        preg_match_all( '~<img.*?src=["\']+(.*?)["\']+~', $content, $image_urls );

        if( empty( $image_urls[1] ) && has_post_thumbnail( $post->ID ) ) {
            $content = '<p>' . get_the_post_thumbnail( $post->ID ) . '</p>' . $content;
        }

        return $content;

    }

}

SRR_Utilities::init();

?>