<?php 
use Inc\Base\Menu;
?>

<div class="wrap">
	<h1>Dev Plugin Plugin</h1>
	<?php settings_errors(); ?>

	<form method="post" action="options.php">
		<?php 
			settings_fields( 'devplugin_options_group' );
			do_settings_sections( Menu::DASHBOARD );
			submit_button();
		?>
	</form>
</div>