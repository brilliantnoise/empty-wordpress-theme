<?php
  // Helpers
  // - build_tree - constructs a tree structure
  // - tree_nav_menu - uses build_tree to rebuild the menu endpoint into a tree
  function build_tree( array &$elements, $parentId = 0 ) {
    $branch = array();
    foreach ( $elements as &$element )
    {
        if ( $element->menu_item_parent == $parentId )
        {
            $children = build_tree( $elements, $element->ID );

            if ( $children )
                $element->menu_children = $children;

            $branch[] = $element;

            unset( $element );
        }
    }
    return $branch;
  }

  function tree_nav_menu( $menu_id ) {
    $items = wp_get_nav_menu_items( $menu_id );
    return  $items ? build_tree( $items, 0 ) : null;
  }

  // Provide menu REST API endpoint
  function get_menu() {
    return tree_nav_menu('Side Menu');
  }

  //Customise the page REST API endpoint to add menu ID associated with page
  // function my_rest_prepare_post( $data, $post, $request ) {
	//   $_data = $data->data;
	//   $thumbnail_id = get_post_thumbnail_id( $post->ID );
	//   $thumbnail = wp_get_attachment_image_src( $thumbnail_id );
	//   $_data['featured_image_thumbnail_url'] = $thumbnail[0];
	//   $data->data = $_data;
	//   return $data;
  // }
  //
  // add_filter( 'rest_prepare_post', 'my_rest_prepare_post', 10, 3 );

  add_action(
    'rest_api_init', function () {
      register_rest_route( 'playbook', '/menu', array(
        'methods' => 'GET',
        'callback' => 'get_menu',
        'permission_callback' => function () {
          return current_user_can( 'read' );
        }
      )
    );
  });
?>
