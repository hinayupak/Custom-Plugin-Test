<?php
/**
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Plugin Test
 * Plugin URI:        https://github.com/hinayupak/Custom-Plugin-Test
 * Description:       Test plugin only
 * Version:           1.0.0
 * Author:            Joshua Hernandez
 * Text Domain:       custom-plugin
 */

// Load style
function cp_styles() {

    wp_register_style('custom-plugin', plugin_dir_url( __FILE__ ) . 'assets/custom-plugin.css');
    wp_enqueue_style( 'custom-plugin' );

}
add_action('wp_enqueue_scripts', 'cp_styles');

// Call custom_plugin_menu function to load plugin menu in dashboard
add_action( 'admin_menu', 'custom_plugin_menu' );

// Create WordPress admin menu
function custom_plugin_menu() {

  $page_title = 'Custom Plugin by Joshua';
  $menu_title = 'Custom Plugin';
  $capability = 'manage_options';
  $menu_slug  = 'custom-plugin';
  $function   = 'custom_plugin_page';
  $icon_url   = 'dashicons-visibility';
  $position   = 4.01; // Use decimal places to avoid position conflicts

  add_menu_page( $page_title,
                 $menu_title,
                 $capability,
                 $menu_slug,
                 $function,
                 $icon_url,
                 $position );

  // Call update_custom_plugin function to update database
  add_action( 'admin_init', 'update_custom_plugin' );

}

// Create function to register plugin settings in the database
function update_custom_plugin() {

  register_setting( 'custom-plugin-settings', 'custom_plugin_full_name' );

}

// Create Dashboard plugin page
function custom_plugin_page() {
?>

  <h1>Custom Plugin Settings</h1>
  <form method="post" action="options.php">
    <?php settings_fields( 'custom-plugin-settings' ); ?>
    <?php do_settings_sections( 'custom-plugin-settings' ); ?>
    <table class="form-table">
      <tr valign="top">
      <th scope="row">Full name:</th>
      <td><input type="text" name="custom_plugin_full_name" pattern="[a-zA-Z][a-zA-Z\s]*" placeholder="Full name" value="<?php echo get_option('custom_plugin_full_name'); ?>" required/></td>
      </tr>
    </table>
  <?php submit_button(); ?>
  </form>
  
<?php
}


// Shortcode
function custom_plugin_shortcode() {

    $result = '';
    $result = '<span class="cp-fullname">' . get_option('custom_plugin_full_name') . '</span>';

    return $result;     

}
add_shortcode( 'custom-plugin-shortcode', 'custom_plugin_shortcode' );