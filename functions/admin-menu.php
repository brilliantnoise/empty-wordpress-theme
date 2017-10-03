<?php
  class removeMenuItems {
    function __construct() {
      add_action( 'admin_menu', array($this, 'isa_remove_menus'));
    }

    function isa_remove_menus() {
      // Remove for everyone
      remove_menu_page( 'edit.php' ); // Posts
      remove_menu_page( 'edit-comments.php' ); // Comments

      // Remove for everyone but Administrators
      if ( ! current_user_can('manage_options') ) {
        remove_menu_page( 'themes.php' ); // Appearance
        remove_menu_page( 'plugins.php' ); // Plugins
        remove_menu_page( 'users.php' ); // Users
        remove_menu_page( 'tools.php' ); // Tools
        remove_menu_page( 'options-general.php' ); // Settings
      }
    }
  }

  $removeMenuItems = new removeMenuItems();
?>
