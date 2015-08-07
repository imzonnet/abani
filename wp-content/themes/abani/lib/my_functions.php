<?php
/**
 * Custom title
**/
global $osvn_opt;

if( !function_exists( 'kysbag_wp_title' ) ) {

	function kysbag_wp_title($title, $sep) {
	    if(!is_front_page()) {
	        $title .= " $sep ".get_bloginfo( 'description', 'display' );
	    }

		return $title;
	}
	add_filter('wp_title', 'kysbag_wp_title', 10, 2);

}

if( !function_exists( 'kysbag_favicon' ) ) {

	/*
	 * favicon
	*/
	function  kysbag_favicon()
	{
		global $osvn_opt;
		$favicon = $osvn_opt['favicon']['url'];
		if ($favicon) {
			echo '<link rel="shortcut icon" href="'.$favicon.'" />',"\n";
		}
	}
	add_action('wp_head','kysbag_favicon',2);

}


if(!function_exists('kysbag_load_custom_style')){

	/*
	 * get css custom
	*/
	function kysbag_load_custom_style()
	{

		global $osvn_opt;

		$return ='';
		if(isset($osvn_opt['custom-css'])){
			$custom_css = $osvn_opt['custom-css'];
		} else {
			$custom_css = '';
		}
		$return.= $custom_css;

		wp_add_inline_style( 'kysbag-style', $return );
	}
	add_action( 'wp_enqueue_scripts', 'kysbag_load_custom_style' );


}



if( !function_exists( 'kysbag_get_breadcrumbs' ) ) {

    /*
     * breadcrumbs
    */
    function kysbag_get_breadcrumbs()
    {
		$delimiter = '<span class="delimiter">/</span>';
		$home   = __('Home', TEXTDOMAIN); // text for the 'Home' link
		$before = '<span class="current">'; // tag before the current crumb
		$after  = '</span>'; // tag after the current crumb
		$return ='';
		$return .= '<section id="breadcrumb" class="breadcrumb"><nav class="container">';

		global $post;
		$homeLink = get_home_url();
		$return .= '<a class="root" href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) $return .=(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			$return .= $before .  single_cat_title('', false) . $after;
		} elseif ( is_day() ) {
			$return .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			$return .= '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			$return .= $before . get_the_time('d') . $after;
		} elseif ( is_month() ) {
			$return .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			$return .= $before . get_the_time('F') . $after;
		} elseif ( is_year() ) {
			$return .= $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				$return .= '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				$return .= $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$return .= '' . get_category_parents($cat, TRUE, ' ' . $delimiter . ' ') . '</li>';
				$return .= $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			$return .= $before . 'search' . $after;
		} elseif ( is_attachment() ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id    = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) $return .= ' ' . $crumb . ' ' . $delimiter . ' ';
			$return .= $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) {
			$return .= $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id    = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) $return .= ' ' . $crumb . ' ' . $delimiter . ' ';
			$return .= $before . get_the_title() . $after;
		} elseif ( is_search() ) {
			$return .= $before . 'Search results for "' . get_search_query() . '"' . $after;
		} elseif ( is_tag() ) {
			$return .= $before . 'Archive by tag "' . single_tag_title('', false) . '"' . $after;
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			$return .= $before . 'Articles posted by "' . $userdata->display_name . '"' . $after;
		} elseif ( is_404() ) {
			$return .= $before . 'You got it "' . 'Error 404 not Found' . '"&nbsp;' . $after;
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $return .= ' (';
			$return .= ('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $return .= ')';
		}
		$return .= '</nav></section>';

		echo $return;
    }


}