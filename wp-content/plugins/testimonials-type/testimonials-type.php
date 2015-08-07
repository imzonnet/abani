<?php
/**
 * Plugin Name: Testimonials custom post type
 * Plugin URI: #
 * Description: Adding Testimonials custom post type
 * Author: KYSBAG
 * Version: 1.0
**/

if ( ! class_exists( 'Testimonials_Type' ) ) {
    class Testimonials_Type {
        function __construct( ) {
            
            $this->setup_plugin();
        }
        
        /**
         * Add custom post type
         **/
        private function setup_plugin() {
            add_action('init', array($this, "testimonials_register"));
            add_action('init', array($this, "testimonials_taxonomy"));
            add_filter("manage_edit-brand_columns", array($this, "brand_edit_columns"));
        }
        
        public function testimonials_taxonomy() {
            $args = array(
                "label" 						=> _x('Testimonials Categories', 'category label', 'kysbag'),
                "singular_label" 				=> _x('Testimonials Category', 'category singular label', 'kysbag'),
                'public'                        => true,
                'hierarchical'                  => true,
                'show_ui'                       => true,
                'show_in_nav_menus'             => true,
                'args'                          => array( 'orderby' => 'term_order' ),
                'rewrite'                       => false,
                'query_var'                     => true
            );
            
            register_taxonomy( 'testimonials-category', 'testimonials', $args );
            
        }
        
        public function testimonials_register() {
            
            $labels = array(
                'name' => _x('Testimonials', 'post type general name', 'kysbag'),
                'singular_name' => _x('Testimonials Member', 'post type singular name', 'kysbag'),
                'add_new' => _x('Add New', 'Testimonials member', 'kysbag'),
                'add_new_item' => __('Add New Testimonials Member', 'kysbag'),
                'edit_item' => __('Edit Testimonials Member', 'kysbag'),
                'new_item' => __('New Testimonials Member', 'kysbag'),
                'view_item' => __('View Testimonials Member', 'kysbag'),
                'search_items' => __('Search Testimonials Members', 'kysbag'),
                'not_found' =>  __('No Testimonials members have been added yet', 'kysbag'),
                'not_found_in_trash' => __('Nothing found in Trash', 'kysbag'),
                'parent_item_colon' => ''
            );
        
            $args = array(
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'show_in_nav_menus' => false,
                'rewrite' => false,
                'supports' => array('title', 'editor', 'thumbnail'),
                'has_archive' => true,
                'taxonomies' => array('testimonials-category')
            );
        
            register_post_type( 'testimonials' , $args );
        }
            
        public function brand_edit_columns($columns) {
            $columns = array(
                "cb" => "<input type=\"checkbox\" />",
                "thumbnail" => "",
                "title" => __("Testimonials", 'kysbag'),
                "description" => __("Description", 'kysbag'),
                "testimonials-category" => __("Categories", 'kysbag')
            );
        
            return $columns;
        }
    }
}
new Testimonials_Type();
?>