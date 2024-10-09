<div class="wrap">
	<h1>License</h1>
	<?php
		$license_key = get_option( 'my_plugin_license_key', '' );
	?>
	<form action="/wp-admin/admin.php?page=academy_wp_plugin_license" method="post">
		<table class="form-table">
			<tbody>
				<tr>
					<th>Enter License</th>
					<td><input type="text" class="regular-text" name="license_key" value="<?php echo $license_key; ?>"></td>
				</tr>
			</tbody>
		</table>

		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
	</form>
</div>
