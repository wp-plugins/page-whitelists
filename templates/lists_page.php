<div class="wrap">
<h2><?php echo "Whitelists"; ?></h2>
<p>Creating/editing/deleting whitelists.</p>
<style>
	.id-column {
		width:2em;
	}
	#wl-lists tfoot tr {
		width:100%;
	}
</style>
<table id="wl-lists" class="wp-list-table widefat fixed">
	<thead>
		<tr>
			<th scope="col" class="manage-column id-column">ID</th>
			<th scope="col" class="manage-column">Title</th>
			<th scope="col" class="manage-column">Assigned to roles</th>
			<th scope="col" class="manage-column">Assigned to users</th>
			<th scope="col" class="manage-column">Assigned pages</th>
			<th scope="col" class="manage-column">Date</th>
		</tr>
	</thead>
	<tbody>
		<?php
			
			foreach($lists as $ord=>$list) { ?>
					<tr id="wlist-<?php echo $list->get_id(); ?>" class="whitelist-row <?php echo ($ord%2==0)?'alternate':''; ?>">
			<th scope="row" class="id-column"><?php echo $list->get_id(); ?></th>
			<td><a href="##" class="list-name"><?php echo $list->get_name(); ?></a>
				<div class="row-actions">
					<span class="edit"><a href="#" id="edit-wlist-<?php echo $list->get_id(); ?>">Edit</a>|</span>
					<span class="trash"><a href="#" id="delete-wlist-<?php echo $list->get_id(); ?>">Delete</a></span>
				</div>
			</td>
			<td><?php $list->the_roles();	?></td>
			<td><?php $list->the_users(); ?></td>
			<td><?php $list->the_pages(); ?></td>
			<td><abbr title="<?php echo mysql2date( 'Y/m/d h:i:s A', $list->get_time(),true); ?>"><?php echo mysql2date( 'Y/m/d', $list->get_time(),true); ?></abbr></td>
		</tr>			
			<?php }; ?>
	</tbody>
</table>
<p><a href="#" id="create-wlist">Create new...</a>
</p>
<form action="options.php" method="post"> 
</form></div>