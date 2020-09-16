<?php
/**
 * Yogastudio Framework: messages subsystem
 *
 * @package	yogastudio
 * @since	yogastudio 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('yogastudio_messages_theme_setup')) {
	add_action( 'yogastudio_action_before_init_theme', 'yogastudio_messages_theme_setup' );
	function yogastudio_messages_theme_setup() {
		// Core messages strings
		add_filter('yogastudio_action_add_scripts_inline', 'yogastudio_messages_add_scripts_inline');
	}
}


/* Session messages
------------------------------------------------------------------------------------- */

if (!function_exists('yogastudio_get_error_msg')) {
	function yogastudio_get_error_msg() {
		return yogastudio_storage_get('error_msg');
	}
}

if (!function_exists('yogastudio_set_error_msg')) {
	function yogastudio_set_error_msg($msg) {
		$msg2 = yogastudio_get_error_msg();
		yogastudio_storage_set('error_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}

if (!function_exists('yogastudio_get_success_msg')) {
	function yogastudio_get_success_msg() {
		return yogastudio_storage_get('success_msg');
	}
}

if (!function_exists('yogastudio_set_success_msg')) {
	function yogastudio_set_success_msg($msg) {
		$msg2 = yogastudio_get_success_msg();
		yogastudio_storage_set('success_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}

if (!function_exists('yogastudio_get_notice_msg')) {
	function yogastudio_get_notice_msg() {
		return yogastudio_storage_get('notice_msg');
	}
}

if (!function_exists('yogastudio_set_notice_msg')) {
	function yogastudio_set_notice_msg($msg) {
		$msg2 = yogastudio_get_notice_msg();
		yogastudio_storage_set('notice_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}


/* System messages (save when page reload)
------------------------------------------------------------------------------------- */
if (!function_exists('yogastudio_set_system_message')) {
	function yogastudio_set_system_message($msg, $status='info', $hdr='') {
		update_option('yogastudio_message', array('message' => $msg, 'status' => $status, 'header' => $hdr));
	}
}

if (!function_exists('yogastudio_get_system_message')) {
	function yogastudio_get_system_message($del=false) {
		$msg = get_option('yogastudio_message', false);
		if (!$msg)
			$msg = array('message' => '', 'status' => '', 'header' => '');
		else if ($del)
			yogastudio_del_system_message();
		return $msg;
	}
}

if (!function_exists('yogastudio_del_system_message')) {
	function yogastudio_del_system_message() {
		delete_option('yogastudio_message');
	}
}


/* Messages strings
------------------------------------------------------------------------------------- */

if (!function_exists('yogastudio_messages_add_scripts_inline')) {
	function yogastudio_messages_add_scripts_inline($vars=array()) {
        // Strings for translation
        $vars["strings"] = array(
            'ajax_error' => esc_html__('Invalid server answer', 'yogastudio'),
            'bookmark_add' => esc_html__('Add the bookmark', 'yogastudio'),
            'bookmark_added' => esc_html__('Current page has been successfully added to the bookmarks. You can see it in the right panel on the tab \'Bookmarks\'', 'yogastudio'),
            'bookmark_del' => esc_html__('Delete this bookmark', 'yogastudio'),
            'bookmark_title' => esc_html__('Enter bookmark title', 'yogastudio'),
            'bookmark_exists' => esc_html__('Current page already exists in the bookmarks list', 'yogastudio'),
            'search_error' => esc_html__('Error occurs in AJAX search! Please, type your query and press search icon for the traditional search way.', 'yogastudio'),
            'email_confirm' => esc_html__('On the e-mail address "%s" we sent a confirmation email. Please, open it and click on the link.', 'yogastudio'),
            'reviews_vote' => esc_html__('Thanks for your vote! New average rating is:', 'yogastudio'),
            'reviews_error' => esc_html__('Error saving your vote! Please, try again later.', 'yogastudio'),
            'error_like' => esc_html__('Error saving your like! Please, try again later.', 'yogastudio'),
            'error_global' => esc_html__('Global error text', 'yogastudio'),
            'name_empty' => esc_html__('The name can\'t be empty', 'yogastudio'),
            'name_long' => esc_html__('Too long name', 'yogastudio'),
            'email_empty' => esc_html__('Too short (or empty) email address', 'yogastudio'),
            'email_long' => esc_html__('Too long email address', 'yogastudio'),
            'email_not_valid' => esc_html__('Invalid email address', 'yogastudio'),
            'subject_empty' => esc_html__('The subject can\'t be empty', 'yogastudio'),
            'subject_long' => esc_html__('Too long subject', 'yogastudio'),
            'text_empty' => esc_html__('The message text can\'t be empty', 'yogastudio'),
            'text_long' => esc_html__('Too long message text', 'yogastudio'),
            'send_complete' => esc_html__("Send message complete!", 'yogastudio'),
            'send_error' => esc_html__('Transmit failed!', 'yogastudio'),
            'login_empty' => esc_html__('The Login field can\'t be empty', 'yogastudio'),
            'login_long' => esc_html__('Too long login field', 'yogastudio'),
            'login_success' => esc_html__('Login success! The page will be reloaded in 3 sec.', 'yogastudio'),
            'login_failed' => esc_html__('Login failed!', 'yogastudio'),
            'password_empty' => esc_html__('The password can\'t be empty and shorter then 4 characters', 'yogastudio'),
            'password_long' => esc_html__('Too long password', 'yogastudio'),
            'password_not_equal' => esc_html__('The passwords in both fields are not equal', 'yogastudio'),
            'registration_success' => esc_html__('Registration success! Please log in!', 'yogastudio'),
            'registration_failed' => esc_html__('Registration failed!', 'yogastudio'),
            'geocode_error' => esc_html__('Geocode was not successful for the following reason:', 'yogastudio'),
            'googlemap_not_avail' => esc_html__('Google map API not available!', 'yogastudio'),
            'editor_save_success' => esc_html__("Post content saved!", 'yogastudio'),
            'editor_save_error' => esc_html__("Error saving post data!", 'yogastudio'),
            'editor_delete_post' => esc_html__("You really want to delete the current post?", 'yogastudio'),
            'editor_delete_post_header' => esc_html__("Delete post", 'yogastudio'),
            'editor_delete_success' => esc_html__("Post deleted!", 'yogastudio'),
            'editor_delete_error' => esc_html__("Error deleting post!", 'yogastudio'),
            'editor_caption_cancel' => esc_html__('Cancel', 'yogastudio'),
            'editor_caption_close' => esc_html__('Close', 'yogastudio')
        );
        return $vars;
	}
}
?>