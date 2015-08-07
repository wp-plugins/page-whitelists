=== Page Whitelists ===
Contributors: corvidism
Tags: pages, user access management, UAM, editing pages, deleting pages, admin tools, user capabilities, access rights, limit access
Requires at least: 3.6
Tested up to: 4.2.2
Stable tag: 3.0.2
Author URI: http://corvidism.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin enables admins to limit user access only to selected pages by creating whitelists and assigning them to users or roles.

== Description ==

Page Whitelists is an administration tool that can be used to allow selected users to edit only certain pages, leaving the rest inaccessible. This is done by creating "whitelists", and assigning them to users and/or roles. Each whitelist can also alow/deny users to create additional pages. Every page, user and role can belong to multiple whitelists.

This plugin was written as a light-weight replacement for the whitelisting functionality of Role Scoper.  

== Installation ==

1. Install and activate like any other plugin. 
1. Create a whitelist in Settings->Page Whitelists.
1. Add users/roles and pages to it.

You can also add page to a whitelist when editing it in Page Editor, or a user through User Editor.

== FAQ ==

= What happens when user is assigned more than one whitelist? = 
Whitelists are additive - every user has access to all pages in all whitelists they're assigned to. 'Strict' whitelists have priority - once a user is assigned to a whitelist that disables creation of new pages, they are not allowed to do so (even if other whitelists are 'non-strict').

= I set up Page Whitelists, but my users still can't access Pages. What's happening? = 
This is most likely caused by a missing capability 'edit-pages'. Page Whitelists is substractive, so the user must have access to all pages first. This can happen if you previously used another access manager, especially Role Scoper, and it didn't reset the capabilities properly when uninstalling. 
You can fix that easily with any plugin that can edit user roles (for example [User Role Editor](https://wordpress.org/plugins/user-role-editor/)).


= Advanced: I need the most recent code of this plugin. Where can I find it? =
Github: <https://github.com/corvidism/page-whitelists> :ike many other WP plugin developers, I primarily use git for versioning, so this is the most recent version of the plugin. If you ever wanted to make modifications to the code, I recommend using files from the Github repo. 

== Changelog ==
= 3.0.2 = 
Bug fix - missing file `wp-content/plugins/page-whitelists/templates/profile_field.php` causes Fatal Error on Edit User page.

= 3.0.1 =
Bug fix - setting strict whitelist also blocked creation of new posts (creator-introduced bug, I am very sorry)

= 3.0.0 =
Bug fix - fixed an issue with plugins that allow creation of pages
Plugin compatibility fix - Tree Page View.
New - column with assigned whitelists in User Table
New - field on User Profile editor
New - select all/none pages when creating/editing whitelist. 

= 2.0 =
Bug fix - plugin now doesn't throw error on screen-less admin pages (various AJAX helpers for plugins etc.)
New - plugin now filters all backend queries that request pages (usually by other plugins) including those made by AJAX.

= 1.2 =
Bug fix - automatic addition of newly created pages to non-strict whitelists now works.

== Upgrade Notice ==

= 3.0.2 =
Fixes a bug resulting in Fatal error on the Edit User page (missing file profile_field.php). Update strongly recomended.

= 3.0.1 =
Fixes a bug which blocked creation of new posts for users in strict whitelists. Update necessary. I am very sorry for the inconvenience.

= 3.0.0 =
Fixes possible conflicts with page creating plugins, adds new GUI options. Update recomended.

= 2.0 =
Fixes a conflict between Page Whitelists and the Nextgen Gallery plugin. 

= 1.2 =
Version fixes a bug in the non-strict whitelist functionality. Update recomended.

= 1.0 =
First published version.

