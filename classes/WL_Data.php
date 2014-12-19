<?php

/**
 * class for manipulation of the custom database tables
 */
class WL_Data {
	
	private $list_table;
	private $list_role_table;
	private $list_page_table;
	
	public function __construct() {
		//WL_Dev::log("data class instantiated");
		global $wpdb;
		$prefix = $wpdb->prefix;
		$wl_table_prefix = $prefix."wl_";
		$this->list_table = $wl_table_prefix."list";
		$this->list_role_table = $wl_table_prefix."list_role";
		$this->list_page_table = $wl_table_prefix."list_page";
				 
	}
	
	public function initialize() {
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		
		$sqls = array();
		
		//whitelists
		$sqls[$list_table] = "CREATE TABLE $this->list_table (
			id INT NOT NULL AUTO_INCREMENT,
			name tinytext NOT NULL,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			UNIQUE KEY id (id)
			);";
		
		//junction table for list-group relationships
		$sqls[$list_role_table] = "CREATE TABLE $this->list_role_table (
			list_id INT NOT NULL,
			role_id INT NOT NULL,
			PRIMARY KEY  (list_id,role_id),
			INDEX (role_id)			
			);";
		
		//junction table for group-user relationships
		$sqls[$list_page_table] = "CREATE TABLE $this->list_page_table (
			list_id INT NOT NULL,
			post_id bigint(20) unsigned NOT NULL,
			PRIMARY KEY  (list_id,post_id),
			INDEX (post_id)
			);";
		
		foreach ($sqls as $table_name => $sql) {
			try {	
				dbDelta($sql);
			} catch (Exception $e) {
				WL_Dev::log("creation/update of ".$table_name." failed: ".$e->getMessage());
			}			
		};		
		
	}
	
		
	public function create_whitelist($name) {
		//check if name doesn't exist yet - if it does, warn for it (TODO: implement Ajax form field validation for this)
		//this should really use try throw catch...
		global $wpdb;
		$table = $this->list_table;
		WL_Dev::log('trying to access table '.$table);
		
		try {
			if ($wpdb->get_row("SELECT * FROM $table WHERE name = '$name'") != NULL) {
			throw new Exception("Table with this name already exists.", 1);
			};			
			$success = $wpdb->insert(
			$this->list_table,
			array(
				'name' => $name,
				'time' => date('Y-m-d H:i:s')
				)
			);
			if (!$success) {
				throw new Exception("Table row could not be written.");
			}
			$id = $wpdb->insert_id;
		} catch (Exception $e) {
			WL_Dev::log($e->getMessage());
			//do stuff that isn't just logging. Probably should display some native WP error message (if it does even have such a thing)
			return false;
		}		
		
		WL_Dev::log('created whitelist '.$id.', '.$name);
		return $wpdb->insert_id;
	}
	
	public function delete_whitelist($id) {
		//delete whitelist by id
		//remove all references to it in the junction table
		
	}
	
	public function create_role($name, $caps) {
		//create new role
		//
		$id = 0; 
		return $id;
	}
	
	public function delete_role($id) {
		
	}
	
	public function add_whitelist_to_role($list_id,$role_id) {
		//add role-list pair to junction table
		//add capability to edit the pages in the whitelist role
	}
	
	public function remove_whitelist_from_role($list_id, $role_id) {
		
	}
	
	
	/*
	 * good news: WP has a function to add tables to database.
	 * bad news: it's fussy as bitch and it HAS NO DOCUMENTATION. 
	 * -- because we needed another proof I've lost my marbles. Still easier than doing the SQL mating dance manually, though.
	 * Kingdom for a framework.
	 */
}
