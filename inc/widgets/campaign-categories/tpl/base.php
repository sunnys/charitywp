<?php

	$current_category = null;

	// Get the term id first
	if (is_single()) {
		global $post;
		$term = get_the_terms( $post->ID, 'dn_campaign_cat' );
		$current_category = $term[0]->term_taxonomy_id;
	}else{
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
		$current_category = isset($term->term_taxonomy_id) && $term->term_taxonomy_id ? $term->term_taxonomy_id : '';
	}

	$show_option_all 	= (isset($instance['show_all']) && $instance['show_all'] === 'show') ? esc_html__('All', 'charitywp') : '';
	$title_li			= (isset($instance['title']) && $instance['title'] != '') ? '<h3 class="widget-title"><span>'.esc_attr($instance['title']).'</span></h3>' : '';
	$show_count 		= (isset($instance['show_count']) && $instance['show_count'] === 'show') ? 1 : 0;

   	$campaign_categories_args = array(
		'show_option_all'    => $show_option_all,
		'orderby'            => 'name',
		'order'              => 'ASC',
		'style'              => 'list',
		'show_count'         => $show_count,
		'hide_empty'         => 1,
		'use_desc_for_title' => 1,
		'child_of'           => 0,
		'feed'               => '',
		'feed_type'          => '',
		'feed_image'         => '',
		'exclude'            => '',
		'exclude_tree'       => '',
		'include'            => '',
		'hierarchical'       => 1,
		'title_li'           => $title_li,
		'show_option_none'   => '',
		'number'             => null,
		'echo'               => 1,
		'depth'              => 0,
		'current_category'   => $current_category,
		'pad_counts'         => 0,
		'taxonomy'           => 'dn_campaign_cat',
		'walker'             => null
    );

    wp_list_categories( $campaign_categories_args ); 