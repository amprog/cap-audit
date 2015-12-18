<?php
/*
Plugin Name: WP Audit Plugin
Description: A plugin to audit and track changes to WordPress pages.
Version: 1.0
Author: Lauren Orsini
*/

//avoid direct calls to this file where wp core files not present
if (!function_exists ('add_action')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

if(!class_exists('CAP_Audit')) {
	class CAP_Audit
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{

			// add a hook to set up an ajax function to display the report
			//add_action('wp_insert_post_data', array(&$this, 'page_audit'));

			error_log("Test");

			add_action('transition_post_status', array(&$this, 'page_audit'), 10, 3);

		} // END public function __construct

		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			global $wpdb;


			$tpp_table_name = 'cap_audit';

			if ($wpdb->get_var("SHOW TABLES LIKE '$tpp_table_name'") != $tpp_table_name) {
				$sql = "CREATE TABLE IF NOT EXISTS {$tpp_table_name} (
							ID char(8) PRIMARY KEY,
							start timestamp NOT NULL,
							end timestamp NOT NULL
						);";
				$result = $wpdb->query($sql);
			}
		}

		function page_audit($new_status, $old_status, $post)
		{

			error_log("Test");

			if ($new_status=='trash') {
				$uid = get_current_user_id();
				$post_id =
				$ip =
				$date = get_post_modified_time();

				error_log("uuid: $uid");

			}

		} // END public static function activate


	}
}