<?php
/**
 * This is the main/default page template for the "bootstrap" skin.
 *
 * This skin only uses one single template which includes most of its features.
 * It will also rely on default includes for specific dispays (like the comment form).
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://b2evolution.net/man/skin-structure}
 *
 * The main page template is used to display the blog when no specific page template is available
 * to handle the request (based on $disp).
 *
 * @package evoskins
 * @subpackage bootstrap
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

if( version_compare( $app_version, '5.0' ) < 0 )
{ // Older skins (versions 2.x and above) should work on newer b2evo versions, but newer skins may not work on older b2evo versions.
	die( 'This skin is designed for b2evolution 5.0 and above. Please <a href="http://b2evolution.net/downloads/index.html">upgrade your b2evolution</a>.' );
}

// This is the main template; it may be used to display very different things.
// Do inits depending on current $disp:
skin_init( $disp );


// -------------------------- HTML HEADER INCLUDED HERE --------------------------
skin_include( '_html_header.inc.php', array(
	'html_tag' => '<!DOCTYPE html>'."\r\n"
	             .'<html lang="'.locale_lang( false ).'">',
) );
// Note: You can customize the default HTML header by copying the generic
// /skins/_html_header.inc.php file into the current skin folder.
// -------------------------------- END OF HEADER --------------------------------


// ---------------------------- SITE HEADER INCLUDED HERE ----------------------------
// If site headers are enabled, they will be included here:
siteskin_include( '_site_body_header.inc.php' );
// ------------------------------- END OF SITE HEADER --------------------------------
?>

<div class="container">
	<div class="row">
		<div class="coll-xs-12 coll-sm-12 col-md-4 col-md-push-8">
			<div class="PageTop">
	<?php
		// ------------------------- "Page Top" CONTAINER EMBEDDED HERE --------------------------
		// Display container and contents:
		skin_container( NT_('Page Top'), array(
				// The following params will be used as defaults for widgets included in this container:
				'block_start'         => '<div class="widget $wi_class$">',
				'block_end'           => '</div>',
				'block_display_title' => false,
				'list_start'          => '<ul>',
				'list_end'            => '</ul>',
				'item_start'          => '<li>',
				'item_end'            => '</li>',
			) );
		// ----------------------------- END OF "Page Top" CONTAINER -----------------------------
	?>
			</div>
		</div>
		<div class="coll-xs-12 col-sm-12 col-md-8 col-md-pull-4">
			<div class="pageHeader">
	<?php
		// ------------------------- "Header" CONTAINER EMBEDDED HERE --------------------------
		// Display container and contents:
		skin_container( NT_('Header'), array(
				// The following params will be used as defaults for widgets included in this container:
				'block_start'       => '<div class="widget $wi_class$">',
				'block_end'         => '</div>',
				'block_title_start' => '<h1>',
				'block_title_end'   => '</h1>',
			) );
		// ----------------------------- END OF "Header" CONTAINER -----------------------------
	?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
	<?php
		// ------------------------- "Menu" CONTAINER EMBEDDED HERE --------------------------
		// Display container and contents:
		// Note: this container is designed to be a single <ul> list
		skin_container( NT_('Menu'), array(
				// The following params will be used as defaults for widgets included in this container:
				'block_start'         => '',
				'block_end'           => '',
				'block_display_title' => false,
				'list_start'          => '',
				'list_end'            => '',
				'item_start'          => '<li>',
				'item_end'            => '</li>',
				'item_selected_start' => '<li class="active">',
				'item_selected_end'   => '</li>',
				'item_title_before'   => '',
				'item_title_after'    => '',
			) );
		// ----------------------------- END OF "Menu" CONTAINER -----------------------------
	?>
			</ul>
		</div>
	</div>

<!-- =================================== START OF MAIN AREA =================================== -->
	<div class="row">
		<div class="<?php echo ( $Skin->get_setting( 'layout' ) == 'single_column' ? 'col-md-12' : 'col-md-9' ); ?>"<?php
				echo ( $Skin->get_setting( 'layout' ) == 'left_sidebar' ? ' style="float:right;"' : '' ); ?>>

	<?php
	if( ! in_array( $disp, array( 'login', 'lostpassword', 'register', 'activateinfo', 'access_requires_login' ) ) )
	{ // Don't display the messages here because they are displayed inside wrapper to have the same width as form
		// ------------------------- MESSAGES GENERATED FROM ACTIONS -------------------------
		messages( array(
				'block_start' => '<div class="action_messages">',
				'block_end'   => '</div>',
			) );
		// --------------------------------- END OF MESSAGES ---------------------------------
	}
	?>

	<?php
		// ------------------- PREV/NEXT POST LINKS (SINGLE POST MODE) -------------------
		item_prevnext_links( array(
				'block_start' => '<ul class="pager">',
				'prev_start'  => '<li class="previous">',
				'prev_end'    => '</li>',
				'next_start'  => '<li class="next">',
				'next_end'    => '</li>',
				'block_end'   => '</ul>',
			) );
		// ------------------------- END OF PREV/NEXT POST LINKS -------------------------
	?>

	<?php
		// ------------------------ TITLE FOR THE CURRENT REQUEST ------------------------
		request_title( array(
				'title_before'      => '<h2>',
				'title_after'       => '</h2>',
				'title_none'        => '',
				'glue'              => ' - ',
				'title_single_disp' => true,
				'format'            => 'htmlbody',
				'register_text'     => '',
				'login_text'        => '',
				'lostpassword_text' => '',
				'account_activation' => '',
				'msgform_text'      => '',
			) );
		// ----------------------------- END OF REQUEST TITLE ----------------------------
	?>

	<?php
	// Go Grab the featured post:
	if( $Item = & get_featured_Item() )
	{ // We have a featured/intro post to display:
		// ---------------------- ITEM BLOCK INCLUDED HERE ------------------------
		echo '<div class="panel panel-default"><div class="panel-body">';
		skin_include( '_item_block.inc.php', array(
				'feature_block' => true,
				'content_mode' => 'auto',		// 'auto' will auto select depending on $disp-detail
				'intro_mode'   => 'normal',	// Intro posts will be displayed in normal mode
				'item_class'   => '',
			) );
		echo '</div></div>';
		// ----------------------------END ITEM BLOCK  ----------------------------
	}
	?>

	<?php
	if( $disp != 'front' && $disp != 'download' && $disp != 'search' )
	{
		// -------------------- PREV/NEXT PAGE LINKS (POST LIST MODE) --------------------
		mainlist_page_links( array(
				'block_start' => '<div class="center"><ul class="pagination">',
				'block_end' => '</ul></div>',
				'page_current_template' => '<span><b>$page_num$</b></span>',
				'page_item_before' => '<li>',
				'page_item_after' => '</li>',
			) );
		// ------------------------- END OF PREV/NEXT PAGE LINKS -------------------------
	?>


	<?php
		// --------------------------------- START OF POSTS -------------------------------------
		// Display message if no post:
		display_if_empty();

		while( $Item = & mainlist_get_item() )
		{ // For each blog post, do everything below up to the closing curly brace "}"

			// ---------------------- ITEM BLOCK INCLUDED HERE ------------------------
			skin_include( '_item_block.inc.php', array(
					'content_mode' => 'auto',		// 'auto' will auto select depending on $disp-detail
					// Comment template
					'comment_start'         => '<div class="evoComment panel panel-default">',
					'comment_end'           => '</div>',
					'comment_title_before'  => '<div class="panel-heading"><h4 class="evoComment-title panel-title">',
					'comment_title_after'   => '</h4></div><div class="panel-body">',
					'comment_avatar_before' => '<div class="evoComment-avatar">',
					'comment_avatar_after'  => '</div>',
					'comment_rating_before' => '<div class="evoComment-rating">',
					'comment_rating_after'  => '</div>',
					'comment_text_before'   => '<div class="evoComment-text">',
					'comment_text_after'    => '</div>',
					'comment_info_before'   => '<div class="evoComment-info clear text-muted"><small>',
					'comment_info_after'    => '</small></div></div>',
					'preview_start'         => '<div class="panel panel-warning" id="comment_preview">',
					'preview_end'           => '</div>',
					'comment_attach_info'   => get_icon( 'help', 'imgtag', array(
							'data-toggle'    => 'tooltip',
							'data-placement' => 'bottom',
							'data-html'      => 'true',
							'title'          => htmlspecialchars( get_upload_restriction( array(
									'block_after'     => '',
									'block_separator' => '<br /><br />' ) ) )
						) ),
					// Comment form
					'form_title_start'      => '<div class="panel '.( $Session->get('core.preview_Comment') ? 'panel-danger' : 'panel-default' )
					                           .' comment_form"><div class="panel-heading"><h3>',
					'form_title_end'        => '</h3></div>',
					'after_comment_form'    => '</div>',
				) );
			// ----------------------------END ITEM BLOCK  ----------------------------

		} // ---------------------------------- END OF POSTS ------------------------------------
	?>

	<?php
		// -------------------- PREV/NEXT PAGE LINKS (POST LIST MODE) --------------------
		mainlist_page_links( array(
				'block_start' => '<div class="center"><ul class="pagination">',
				'block_end' => '</ul></div>',
				'page_current_template' => '<span><b>$page_num$</b></span>',
				'page_item_before' => '<li>',
				'page_item_after' => '</li>',
				'prev_text' => '&lt;&lt;',
				'next_text' => '&gt;&gt;',
			) );
		// ------------------------- END OF PREV/NEXT PAGE LINKS -------------------------
	}
	?>


	<?php
		// -------------- MAIN CONTENT TEMPLATE INCLUDED HERE (Based on $disp) --------------
		skin_include( '$disp$', array(
				'disp_posts'  => '',		// We already handled this case above
				'disp_single' => '',		// We already handled this case above
				'disp_page'   => '',		// We already handled this case above
				'skin_form_params' => $Skin->get_template( 'Form' ),
				'author_link_text' => 'preferredname',
				'profile_tabs' => array(
					'block_start'         => '<ul class="nav nav-tabs profile_tabs">',
					'item_start'          => '<li>',
					'item_end'            => '</li>',
					'item_selected_start' => '<li class="active">',
					'item_selected_end'   => '</li>',
					'block_end'           => '</ul>',
				),
				'pagination' => array(
					'block_start'           => '<div class="center"><ul class="pagination">',
					'block_end'             => '</ul></div>',
					'page_current_template' => '<span><b>$page_num$</b></span>',
					'page_item_before'      => '<li>',
					'page_item_after'       => '</li>',
					'prev_text'             => '&lt;&lt;',
					'next_text'             => '&gt;&gt;',
				),
				// Form params for the forms below: login, register, lostpassword, activateinfo and msgform
				'skin_form_before'      => '<div class="panel panel-default skin-form">'
																			.'<div class="panel-heading">'
																				.'<h3 class="panel-title">$form_title$</h3>'
																			.'</div>'
																			.'<div class="panel-body">',
				'skin_form_after'       => '</div></div>',
				// Login
				'display_form_messages' => true,
				'form_title_login'      => T_('Log in to your account').'$form_links$',
				'form_class_login'      => 'wrap-form-login',
				'form_title_lostpass'   => get_request_title().'$form_links$',
				'form_class_lostpass'   => 'wrap-form-lostpass',
				'login_form_inskin'     => false,
				'login_page_before'     => '<div class="$form_class$">',
				'login_page_after'      => '</div>',
				'login_form_class'      => 'form-login',
				'display_reg_link'      => true,
				'abort_link_position'   => 'form_title',
				'abort_link_text'       => '<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
				// Register
				'register_page_before'      => '<div class="wrap-form-register">',
				'register_page_after'       => '</div>',
				'register_form_title'       => T_('Register'),
				'register_form_class'       => 'form-register',
				'register_links_attrs'      => '',
				'register_use_placeholders' => true,
				'register_field_width'      => 252,
				'register_disabled_page_before' => '<div class="wrap-form-register register-disabled">',
				'register_disabled_page_after'  => '</div>',
				// Activate form
				'activate_form_title'  => T_('Account activation'),
				'activate_page_before' => '<div class="wrap-form-activation">',
				'activate_page_after'  => '</div>',
				// Profile
				'profile_avatar_before' => '<div class="panel panel-default profile_avatar">',
				'profile_avatar_after'  => '</div>',
				// Search
				'search_input_before'  => '<div class="input-group">',
				'search_input_after'   => '',
				'search_submit_before' => '<span class="input-group-btn">',
				'search_submit_after'  => '</span></div>',
				// Comment template
				'comment_start'         => '<div class="evoComment panel panel-default">',
				'comment_end'           => '</div>',
				'comment_post_before'   => '<div class="panel-heading"><h4 class="panel-title pull-left">',
				'comment_post_after'    => '</h4>',
				'comment_title_before'  => '<h4 class="panel-title pull-right">',
				'comment_title_after'   => '</h4><div class="clearfix"></div></div><div class="panel-body">',
				'comment_avatar_before' => '<div class="evoComment-avatar">',
				'comment_avatar_after'  => '</div>',
				'comment_rating_before' => '<div class="evoComment-rating">',
				'comment_rating_after'  => '</div>',
				'comment_text_before'   => '<div class="evoComment-text">',
				'comment_text_after'    => '</div>',
				'comment_info_before'   => '<div class="evoComment-info clear text-muted"><small>',
				'comment_info_after'    => '</small></div></div>',
				'comment_attach_info'   => get_icon( 'help', 'imgtag', array(
						'data-toggle'    => 'tooltip',
						'data-placement' => 'bottom',
						'data-html'      => 'true',
						'title'          => htmlspecialchars( get_upload_restriction( array(
								'block_after'     => '',
								'block_separator' => '<br /><br />' ) ) )
					) ),
				// Front page
				'featured_intro_before' => '<div class="jumbotron">',
				'featured_intro_after'  => '</div>',
				// Form "Sending a message"
				'msgform_form_title' => T_('Sending a message'),
			) );
		// Note: you can customize any of the sub templates included here by
		// copying the matching php file into your skin directory.
		// ------------------------- END OF MAIN CONTENT TEMPLATE ---------------------------
	?>
	</div>


<!-- =================================== START OF SIDEBAR =================================== -->
	<?php
	if( $Skin->get_setting( 'layout' ) != 'single_column' )
	{
	?>
		<div class="col-md-3"<?php echo ( $Skin->get_setting( 'layout' ) == 'left_sidebar' ? ' style="float:left;"' : '' ); ?>>
	<?php
		// ------------------------- "Sidebar" CONTAINER EMBEDDED HERE --------------------------
		// Display container contents:
		skin_container( NT_('Sidebar'), array(
				// The following (optional) params will be used as defaults for widgets included in this container:
				// This will enclose each widget in a block:
				'block_start' => '<div class="panel panel-default widget $wi_class$">',
				'block_end' => '</div>',
				// This will enclose the title of each widget:
				'block_title_start' => '<div class="panel-heading"><h4 class="panel-title">',
				'block_title_end' => '</h4></div>',
				// This will enclose the body of each widget:
				'block_body_start' => '<div class="panel-body">',
				'block_body_end' => '</div>',
				// If a widget displays a list, this will enclose that list:
				'list_start' => '<ul>',
				'list_end' => '</ul>',
				// This will enclose each item in a list:
				'item_start' => '<li>',
				'item_end' => '</li>',
				// This will enclose sub-lists in a list:
				'group_start' => '<ul>',
				'group_end' => '</ul>',
				// This will enclose (foot)notes:
				'notes_start' => '<div class="notes">',
				'notes_end' => '</div>',
				// Widget 'Search form':
				'search_class'         => 'compact_search_form',
				'search_input_before'  => '<div class="input-group">',
				'search_input_after'   => '',
				'search_submit_before' => '<span class="input-group-btn">',
				'search_submit_after'  => '</span></div>',
			) );
		// ----------------------------- END OF "Sidebar" CONTAINER -----------------------------
	?>
		</div>
	<?php } ?>
	</div>


<!-- =================================== START OF FOOTER =================================== -->
	<div class="row">
		<div class="col-md-12 center">
	<?php
		// Display container and contents:
		skin_container( NT_("Footer"), array(
				// The following params will be used as defaults for widgets included in this container:
			) );
		// Note: Double quotes have been used around "Footer" only for test purposes.
	?>
	<p>
		<?php
			// Display footer text (text can be edited in Blog Settings):
			$Blog->footer_text( array(
					'before'      => '',
					'after'       => ' &bull; ',
				) );

		// TODO: dh> provide a default class for pTyp, too. Should be a name and not the ityp_ID though..?!
		?>

		<?php
			// Display a link to contact the owner of this blog (if owner accepts messages):
			$Blog->contact_link( array(
					'before'      => '',
					'after'       => ' &bull; ',
					'text'   => T_('Contact'),
					'title'  => T_('Send a message to the owner of this blog...'),
				) );
			// Display a link to help page:
			$Blog->help_link( array(
					'before'      => ' ',
					'after'       => ' ',
					'text'        => T_('Help'),
				) );
		?>

		<?php
			// Display additional credits:
			// If you can add your own credits without removing the defaults, you'll be very cool :))
			// Please leave this at the bottom of the page to make sure your blog gets listed on b2evolution.net
			credits( array(
					'list_start'  => '&bull;',
					'list_end'    => ' ',
					'separator'   => '&bull;',
					'item_start'  => ' ',
					'item_end'    => ' ',
				) );
		?>
	</p>

	<?php
		// Please help us promote b2evolution and leave this logo on your blog:
		powered_by( array(
				'block_start' => '<div class="powered_by">',
				'block_end'   => '</div>',
				// Check /rsc/img/ for other possible images -- Don't forget to change or remove width & height too
				'img_url'     => '$rsc$img/powered-by-b2evolution-120t.gif',
				'img_width'   => 120,
				'img_height'  => 32,
			) );
	?>

		</div>
	</div>
</div>

<?php
// ---------------------------- SITE FOOTER INCLUDED HERE ----------------------------
// If site footers are enabled, they will be included here:
siteskin_include( '_site_body_footer.inc.php' );
// ------------------------------- END OF SITE FOOTER --------------------------------


// ------------------------- HTML FOOTER INCLUDED HERE --------------------------
skin_include( '_html_footer.inc.php' );
// Note: You can customize the default HTML footer by copying the
// _html_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
?>