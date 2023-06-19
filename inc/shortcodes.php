<?php

declare(strict_types=1);

add_action( 'init', 'add_custom_shortcodes' );

function add_custom_shortcodes() {
	add_shortcode( 'footag', 'wpdocs_footag_func' );
	add_shortcode( 'tracker_page', 'esb_tracker_display_tracker_page' );
}

function wpdocs_footag_func() {
	return 'foo';
}

function esb_tracker_display_tracker_page() {
	
	// Get the current user
	$user = wp_get_current_user();
	
	// If the user exists and is logged in
	if ( $user && is_user_logged_in() ) {
		// If the user doesn't have the track_time permission set, then return a warning message
		if ( ! $user->has_cap('track_time') ) {
			return 'You are logged in, but your user type does not have permission to log time.  Please contact the administrator.';
		}
		return 'success';
	// If the visitor is logged out, redirect to the login page
	} else {
		auth_redirect();
		return 'You must login to access this page.';
	}
	
}