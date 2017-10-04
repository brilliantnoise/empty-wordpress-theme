<?php
  class nav {
    function __construct() {
      add_action('after_setup_theme', array($this, 'init'));
      // Register action/filter callbacks here...
    }

    function init() {
      // All theme initialization code goes here...
      register_nav_menus(
        array(
        'side-menu' => __( 'Side Menu', 'empty-wordpress-theme' )
        )
      );
    }
  }

  $nav = new nav();
?>
