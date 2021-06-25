<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli
 * @since      1.0.0
 *
 * @package    Property_Manager
 * @subpackage Property_Manager/admin/partials
 */
//Enqueue CSS for the page
// wp_enqueue_script( 'main-dashboard-js', plugin_dir_url( __FILE__ ) . '../js/add-edit-delete-properties.js', array( 'jquery' ), $this->version, false );

$admin_url = get_admin_url();
?>

<script>
window.onload = function() {
    // similar behavior as clicking on a link
    var admin_url = '<?php echo $admin_url?>';
    var new_url = admin_url + '/edit.php?post_type=property';
    window.location.href = new_url;
}
</script>