<?php
  // class customRestEndpoints {
  //   function __construct() {
  //     add_action('rest_api_init', function () {
  //       register_rest_route( 'myroutes', '/menu',
  //         array(
  //           'methods' => 'GET',
  //           'callback' => 'get_menu',
  //         )
  //       );
  //     });
  //   }
  //
  //   function get_menu() {
  //     # Change 'menu' to your own navigation slug.
  //     return wp_get_nav_menu_items('Side menu');
  //   }
  // }
  //
  // $customRestEndpoints = new customRestEndpoints();

  function build_tree( array &$elements, $parentId = 0 ) {
    $branch = array();
    foreach ( $elements as &$element )
    {
        if ( $element->menu_item_parent == $parentId )
        {
            $children = build_tree( $elements, $element->ID );
            if ( $children )
                $element->menu_children = $children;

            $branch[$element->ID] = $element;
            unset( $element );
        }
    }
    return $branch;
  }

  function tree_nav_menu( $menu_id ) {
    $items = wp_get_nav_menu_items( $menu_id );
    return  $items ? build_tree( $items, 0 ) : null;
  }

  function get_menu() {
    # Change 'menu' to your own navigation slug.
    return tree_nav_menu('Side Menu');
  }

  add_action(
    'rest_api_init', function () {
      register_rest_route( 'playbook', '/menu', array(
        'methods' => 'GET',
        'callback' => 'get_menu'//,
        // 'permission_callback' => function () {
        //   return current_user_can( 'read' );
        // }
      )
    );
  });
?>
