<?php
  class removeMenuItems {
    function __construct() {
      add_action( 'admin_menu', array($this, 'isa_remove_menus'));
    }

    function isa_remove_menus() {
      remove_menu_page( 'edit.php' );
    }
  }

  $removeMenuItems = new removeMenuItems();
?>
