<?php

require_once get_template_directory() . '/lib/module.php';

class Teamcpt extends OneModule{
  public $version = "1.0";
  public $level = "normal";
  public $priority = "1";

  public function init() {
    add_action( 'init', array( $this, 'custom_post_type' ), 0 );
    add_filter( 'enter_title_here', array( $this, 'teamcpt_change_title' ) );

  }

  public function custom_post_type() {
  	$labels = array(
  		'name'                => _x( 'Team Members', 'Team Member', 'text_domain' ),
  		'singular_name'       => _x( 'Team Member', 'Team Member', 'text_domain' ),
  		'menu_name'           => __( 'Team Members', 'text_domain' ),
  		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
  		'all_items'           => __( 'All Team Members', 'text_domain' ),
  		'view_item'           => __( 'View Item', 'text_domain' ),
  		'add_new_item'        => __( 'Add Team Member', 'text_domain' ),
  		'add_new'             => __( 'Add New Team Member', 'text_domain' ),
  		'edit_item'           => __( 'Edit Team Member', 'text_domain' ),
  		'update_item'         => __( 'Update Team Member', 'text_domain' ),
  		'search_items'        => __( 'Search Team Member', 'text_domain' ),
  		'not_found'           => __( 'Not found', 'text_domain' ),
  		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
  	);
  	$args = array(
  		'label'               => __( 'team', 'text_domain' ),
  		'description'         => __( 'Team Members', 'text_domain' ),
  		'labels'              => $labels,
  		'supports'            => array( ),
  		'taxonomies'          => array( 'category', 'post_tag' ),
  		'hierarchical'        => false,
  		'public'              => true,
  		'show_ui'             => true,
  		'show_in_menu'        => true,
  		'show_in_nav_menus'   => true,
  		'show_in_admin_bar'   => true,
  		'menu_position'       => 5,
  		'menu_icon'           => 'dashicons-groups',
  		'can_export'          => true,
  		'has_archive'         => false,
  		'exclude_from_search' => false,
  		'publicly_queryable'  => true,
  		'capability_type'     => 'page',
  	);
  	register_post_type( 'team', $args );
  }

  public function teamcpt_change_title( $title ){
    $screen = get_current_screen();
    if ( $screen->post_type == 'team' ) {
        $title = 'Team Member Name';
    }
    return $title;
  }

}
