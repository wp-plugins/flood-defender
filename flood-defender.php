<?php
/*
Plugin Name: Flood Defender
Version: 1.00
Plugin URI: http://beyn.org/flood-defender/
Author: Baris Unver
Author URI: http://beyn.org/
Description: Prevents visitors to repetitively post comments into a post.
*/

function fd_options_page() {
	if (isset($_POST['fd_update_options'])):
		$ss_fd_message = stripslashes_deep($_POST['fd_message']);
		update_option('fd_message', $ss_fd_message);
		update_option('fd_show_comment', (int)$_POST['fd_show_comment']);
		?>
        <div id="message" class="updated fade"><p>Saved!</p></div>
		<?php
		endif;

		if (get_option('fd_show_comment')) {
			$fd_show_comment = 'checked="checked"';
		} else {
		    $fd_show_comment = '';
		}

		$fd_message = get_option('fd_message');
?>
	<div class="wrap">
	<h2>Flood Defender Options</h2>
	<form id="fd_form" method="post" action="" class="form-table">
     <fieldset>
		<div>
			<label for="fd_message">Message to be shown to the commenter:<br /><small>(HTML is allowed)</small></label>
			<textarea id="fd_message" name="fd_message" rows="7" cols="60"/><?php echo htmlspecialchars($fd_message); ?></textarea>
		</div>
		<div>
			<label for="fd_show_comment">&nbsp;</label>
			<input type="checkbox" id="fd_show_comment" name="fd_show_comment" value="1" <?php echo $fd_show_comment; ?> />&nbsp;Show the comment below the error message
		</div>
	</fieldset>

	<div class="submit"><input type="submit" name="fd_update_options" value="Save Options" /></div>

    </form>
	<div style="color:#d00;padding:0 50px">By the way; if you liked this plugin and if you want to appreciate the plugin developer, <a href="http://tr.im/beyndonate">donations are welcome</a>! :)</div>
    </div>
<?php		
}	 

function fd_options_style() {
?>
	<style type="text/css" media="screen">
  		#fd_form fieldset { border:0;margin: 0;padding:0; }
  		#fd_form label { width:225px;float:left;font-weight:bold; }
  		#fd_form fieldset div { clear: both; margin-top: 5px; padding: 12px; }
	</style>
<?php
}
add_action('admin_head', 'fd_options_style');

function fd_add_options_page() {
add_options_page('Flood Defender', 'Flood Defender', 'manage_options', 'flooddefender', 'fd_options_page');
}
add_action('admin_menu', 'fd_add_options_page');

register_activation_hook( __FILE__, 'fd_activate' );

function fd_activate () {
	add_option('fd_message', "<p>It's not allowed to post two or more comments, one after another. You can post your comment after someone else comments on the post. <strong>Here is your comment:</strong></p>");
	add_option('fd_show_comment', 1);
}

function artarda($commentdata) {
	global $wpdb;
	$lastid = $commentdata['comment_post_ID'];
	$lastip = $wpdb->get_row("SELECT comment_author_IP as ip FROM $wpdb->comments WHERE comment_type='' AND comment_post_ID=$lastid ORDER BY comment_date DESC LIMIT 1");
	if ( preg_replace( '/[^0-9a-fA-F:., ]/', '',$_SERVER['REMOTE_ADDR'] ) == $lastip->ip ) {
		$floodmessage = get_option('fd_message');
		$floodcomment = '<p>' . stripslashes_deep($commentdata['comment_content']) . '</p>';
		if (get_option('fd_show_comment')) {
			wp_die($floodmessage.$floodcomment);
		} else {
			wp_die($floodmessage);
		}
	} else {
		return $commentdata;
	}
}

add_filter('preprocess_comment', 'artarda');

?>