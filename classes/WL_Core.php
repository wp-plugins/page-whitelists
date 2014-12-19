<?php

class Whitelists 
{
	public function __construct($data,$settings) {
		$this->data = $data;
		$this->settings = $settings;		
		$this->access_manager = new WL_Access_Manager($this->data);
		$this->admin = new WL_Admin($this->data,$this->settings);
		
	}
	
	public function install() {
		$this->data->initialize();
		//TODO manage db versions somehow see tutorial on WP page
	}
	
	public function uninstall() {
		
	}
	
	public function run() {		
		//filter hooks
		add_action('init',array($this->access_manager, 'access_check'));
		add_action('new_to_auto-draft', array($this->access_manager,'auto_add_page'), 10, 3);
		add_action('before_delete_post',array($this->data,'remove_page_from_all'));
		add_action('add_meta_boxes', array($this->admin, 'add_metabox'));
		add_action('save_post', array($this->admin, 'save_metabox'));
		add_action('admin_menu',array($this->admin, 'add_menus'));
		add_action('admin_enqueue_scripts',array($this->admin,'enqueue_assets'));
		add_action('admin_init',array($this->admin,'register_ajax'));
		
	}
	
	
	
}