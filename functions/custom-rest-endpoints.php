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

  // TODO: Encase in a class and get to work
  function get_menu() {
    # Change 'menu' to your own navigation slug.
    return wp_get_nav_menu_items('Side Menu');
  }

  add_action(
    'rest_api_init', function () {
      register_rest_route( 'myroutes', '/menu', array(
        'methods' => 'GET',
        'callback' => 'get_menu',
        'permission_callback' => function () {
          return current_user_can( 'read' );
        }
      )
    );
  });
?>
