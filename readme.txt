=== Page Whitelists ===
Contributors: corvidism
Tags: pages, user access management, UAM, editing pages, deleting pages, admin tools, user capabilities, access rights, limit access
Requires at least: 3.6
Tested up to: 4.2.0
Stable tag: 2.0.1
Author URI: http://corvidism.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin enables admins to limit user access only to selected pages by creating whitelists and assigning them to users or roles.

== Description ==

Page Whitelists is an administration tool that can be used to allow selected users to edit only certain pages, leaving the rest inaccessible. This is done by creating "whitelists", and assigning them to users and/or roles. Each whitelist can also alow/deny users to create additional pages. Every page, user and role can belong to multiple whitelists. 

Combining whitelists:
* Whitelists are additive - every user has access to all pages in all whitelists they're assigned to.
* 'Strict' whitelists have priority - once a user is assigned to a whitelist that disables creation of new pages, they are not allowed to do so (even if other whitelists are 'non-strict').

== Installation ==

1. Install and activate like any other plugin. 
1. Create a whitelist in Settings->Page Whitelists.
1. Add users/roles and pages to it.

You can also add page to a whitelist when editing it in Page Editor.

== FAQ ==

= Known problems and conflicts =
* Some plugins (i.e. Tree Page View) display the number of all pages, not just the whitelisted. (unfixable, as there is no way for the plugin to intercept these numbers when the GUI is being drawn)

== Changelog ==

= 2.0 =
Bug fix - plugin now doesn't throw error on screen-less admin pages (various AJAX helpers for plugins etc.)
New - plugin now filters all backend queries that request pages (usually by other plugins) including those made by AJAX.

= 1.2 =
Bug fix - automatic addition of newly created pages to non-strict whitelists now works.

== Upgrade Notice ==

= 2.0 =
Fixes a conflict between Page Whitelists and the Nextgen Gallery plugin. 

= 1.2 =
Version fixes a bug in the non-strict whitelist functionality. Update recomended.

= 1.0 =
First published version.

