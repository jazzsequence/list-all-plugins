<?php
/**
 * Plugin Name: List All Plugins
 * Description: Lists all the plugins installed on an admin page.
 * Plugin URI: http://jazzsequence.com
 * Author: Chris Reynolds
 * Author URI: http://jazzsequence.com
 * Version: 1.0
 * License: GPL2
 * @package JS_List_All_Plugins
 */

/*
Copyright (C) 2016  Chris Reynolds  me@chrisreynolds.io

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'plugins_loaded', array( 'JS_List_All_Plugins', 'get_instance' ) );

class JS_List_All_Plugins {

	private static $instance = null;

	public static function get_instance() {
		if ( ! isset( self::$instance ) )
			self::$instance = new self;

		return self::$instance;
	}

	private function __construct() {
		add_action( 'admin_menu', array( $this, 'all_plugin_list' ) );
	}

	public function all_plugin_list() {
		add_menu_page( __( 'All Plugins', 'list-all-plugins' ), __( 'All Plugins', 'list-all-plugins' ), 'manage_options', 'list_all_plugins', array( $this, 'do_plugin_list' ), 'dashicons-portfolio', 999 );
	}

	public function do_plugin_list() {
		$plugins = get_plugins();
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<ul class="plugin-list">
				<?php
				foreach ( $plugins as $plugin => $plugin_details ) {
					echo '<li>' . esc_html( $plugin_details['Title'] ) . ' - ' . esc_html( $plugin_details['Author'] ) . '</li>';
				}
				?>
			</ul>
		</div>
		<?php
	}
}
