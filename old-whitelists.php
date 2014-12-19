<?php
/*
Plugin Name: Whitelists
Version: 0.1-alpha
Description: PLUGIN DESCRIPTION HERE
Author: YOUR NAME HERE
Author URI: YOUR SITE HERE
Plugin URI: PLUGIN SITE HERE
Text Domain: whitelists
Domain Path: /languages
*/

if (!class_exists('Whitelists')) {
	
	define('WL_ID','whitelists');
	
	class Whitelists 
	{
		private $values = array(
		'groups' => array(),
		'whitelist' => array()
		);
		
		private $dummy_whitelist = array (
		'user' => 3,
		'whitelist' => array(291,289)
		);
		
		private $sim_table = array(
			'dummy' => array(
				'users' => array(3),
				'whitelist' => array(291,289)
			),
			'experiment' => array(
				'users' => array(2),
				'whitelist' => array(280)
			)
		); 
		
		public function activate() {
			
		}
		
		public function deactivate() {
			
		}
		
		public function __construct() {
			$this->init_values();
		}
		
		public function init_values() {
		}
		
		function in_pages_edit() {
			if ( ! is_admin() || ! current_user_can( 'edit_pages' ) ) return FALSE;
			$s = get_current_screen();
			//return ( $s instanceof WP_Screen && $s->id === 'edit-page' );
			return ( $s instanceof WP_Screen && in_array($s->id, array('edit-page','edit-post'))); //return true if it's edit-page.php or edit-post.php
		}		
		function in_edit_form() {
			$s = get_current_screen();
			return ( $s instanceof WP_Screen && in_array($s->id, array('page','post')));
		}
		
		function is_allowed() {
			global $post;
			$id = $post->ID;
			return (in_array($id,$this->values['whitelist']));
		}
		
		/**
		 * get whitelisted pages of a given whitelist
		 */
		public function get_whitelist($group) {
			$whitelist = $this->sim_table[$group]['whitelist'];
			return $whitelist;
		}
		
		
		public function update_whitelist() {
			$user = get_current_user_id();
			$groups = $this->get_assigned_groups($user);
			//if YES, get whitelist for restricted, add filter
			//if not, return
			if (empty($groups)) {
				return;				
			}
		}
		
		/**
		 * combine whitelists of all groups user is a member of
		 */		
		public function combine_whitelists($groups) {
			//return array of allowed pages
			$allowed_pages = array();
			foreach ($groups as $group) {
				$allowed_pages = array_merge($allowed_pages,$this->sim_table[$group]['whitelist']);
			}			
			return $allowed_pages;
		}
		
		/**
		 * returns an array of ids of groups a user is assigned to. 
		 */
		function get_assigned_groups($user) {
			$groups = array();
			foreach ($this->sim_table as $whitelist_name => $whitelist) {
				if (in_array($user, $whitelist['users'])) {
					$groups[] = $whitelist_name; 
				}
			}
			return $groups; //return IDs of groups, else empty array.
		}
		
		/**
		 * remove pages from query
		 */
		public function remove_restricted($query) {
			if ( ! $this->in_pages_edit() || ! $query->is_main_query() ) return;
			$query->set('post__in',$this->values['whitelist']);
		}
		
		/**
		 * hide restricted pages from edit-page.php and edit-post.php listing
		 */
		public function filter_displayed() {
			if (! $this->in_pages_edit() || empty($this->values['groups'])) {
				return;
			}
			add_action('pre_get_posts',array($this,'remove_restricted'));
			 
		}
		
		
		public function test() {
			
		}
		
		/**
		 * allow/deny access to a user based on the groups they're in
		 */		
		public function check_access() {
			if (! $this->in_edit_form() || empty($this->values['groups'])) {
				return;
			}					
			if (!$this->is_allowed()) {
				wp_die( __('You are not allowed to access this part of the site') );
			}
		}
		
		public function filter_editable() {
			add_action( 'pre_get_posts', array($this, 'check_access') );
		}
		
		public function filter_admin_bar() {
			if(empty($this->values['groups'])) return;
			global $wp_admin_bar;
			if (!$this->is_allowed()) {
				$wp_admin_bar->remove_menu('edit');
			};			
		}
		
		
		public function init() {
			$user = get_current_user_id();
			$groups = $this->get_assigned_groups($user);
			if (empty($groups)) {
				return;				
			}
			$this->values['groups'] = $groups;
			$this->values['whitelist']=$this->combine_whitelists($groups);
		}
		
	}
};

if (class_exists('Whitelists')) {
	//installation and uninstallation hooks
	register_activation_hook(__FILE__, array(WL_ID, 'activate'));
    register_deactivation_hook(__FILE__, array(WL_ID, 'deactivate'));
	
	
	//instantiate the plugin class
	$whitelists = new Whitelists();
	
	//filter hooks	
	add_action('init',array($whitelists, 'init'));
	add_action( 'load-edit.php', array($whitelists, 'filter_displayed') );
	//add action on opening the post editor
	add_action('load-post.php', array($whitelists, 'filter_editable'));
	add_action( 'admin_notices', array($whitelists, 'test'));
	add_action( 'wp_before_admin_bar_render', array($whitelists, 'filter_admin_bar') );
}