<?php
/**
 * This file is the template that displays an access denied for not logged in users
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://b2evolution.net/man/skin-structure}
 *
 * @package evoskins
 * @subpackage bootstrap
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );


global $app_version, $disp, $Blog;

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
		<div class="col-md-12">

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

<!-- =================================== START OF MAIN AREA =================================== -->
	<div class="row">
		<div class="col-md-12">

	<?php
		// -------------- MAIN CONTENT TEMPLATE INCLUDED HERE (Based on $disp) --------------
		skin_include( '$disp$', array(
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
			) );
		// Note: you can customize any of the sub templates included here by
		// copying the matching php file into your skin directory.
		// ------------------------- END OF MAIN CONTENT TEMPLATE ---------------------------
	?>

		</div>
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