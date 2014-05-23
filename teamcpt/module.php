<?php

require_once get_template_directory() . '/lib/module.php';

class Teamcpt extends OneModule{
  public $version = "1.0";
  public $level = "normal";
  public $priority = "1";

  public function init() {
    add_action( 'init', array( $this, 'custom_post_type' ), 0 );
    add_filter( 'enter_title_here', array( $this, 'teamcpt_change_title' ) );
    add_action( 'init', array( $this, 'add_custom_taxonomies' ), 0 );


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
  		'taxonomies'          => array( 'team_member_category' ),
  		'hierarchical'        => false,
  		'public'              => true,
  		'show_ui'             => true,
  		'show_in_menu'        => true,
  		'show_in_nav_menus'   => true,
  		'show_in_admin_bar'   => true,
  		'menu_position'       => 5,
  		'menu_icon'           => 'dashicons-groups',
  		'can_export'          => true,
  		'has_archive'         => true,
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

  public function add_custom_taxonomies() {
    // Add new "Locations" taxonomy to Posts
    register_taxonomy('team_member_category', 'team', array(
      // Hierarchical taxonomy (like categories)
      'hierarchical' => true,
      // This array of options controls the labels displayed in the WordPress Admin UI
      'labels' => array(
        'name' => _x( 'Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Categories' ),
        'all_items' => __( 'All Categories' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add New Category' ),
        'new_item_name' => __( 'New Category Name' ),
        'menu_name' => __( 'Categories' ),
      ),
      // Control the slugs used for this taxonomy
      'rewrite' => array(
        'slug' => 'team_member_category', // This controls the base slug that will display before each term
        'with_front' => false, // Don't display the category base before "/locations/"
        'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
      ),
    ));
  }

}
