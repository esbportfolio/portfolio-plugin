<?php

declare(strict_types=1);

/*
 * Plugin Name: Progress Tracker
 * Description: Plugin for tracking progress on my portfolio site.
 * Version: 1.0
 * Author: Elizabeth Sullivan-Burton
 */

// Run on activation
register_activation_hook(
	__FILE__,
	'esb_tracker_activate'
);

register_deactivation_hook(
	__FILE__,
	'esb_tracker_deactivate'
);

require_once(__DIR__ . '\inc\shortcodes.php');
require_once(__DIR__ . '\classes\class-esb-tracker-db-ops.php');

// Fire on plugin activation
function esb_tracker_activate() {
	
	// Create the Tracker role if it doesn't exist
	if ( ! get_role('tracker') ) {
		add_role(
			'tracker',
			'Tracker',
			[
				'read' => true,
				'level_1' => true,
				'track_time' => true
			]
		);
	}
	
	// Add the track_time ability to the administrator
	$admin_role = get_role( 'administrator' );
	if ( ! $admin_role->has_cap('track_time') ) {
		$admin_role->add_cap('track_time', true);
	}
	
	$db_ops = new Esb_Tracker_Db_Ops();
	$db_ops->create_tables();
	unset($db_ops);
	
}

// Fire on plugin deactivation
function esb_tracker_deactivate() {
	
	// Note: This doesn't do anything to remove database tables
	// since I don't want them dropped by accident.  A public version
	// of this should include some sort of cleanup mechanism on deletion.
	
	// If the tracker role exists
	if ( get_role('tracker') ) {
		
		// Get users assigned to it
		$trackers = get_users([
			'role' => 'tracker',
			'orderby' => 'user_nicename',
			'order'   => 'ASC'
		]);
		
		// If there are any users assinged to this role, 
		// change them to subscribers
		if ( count($trackers) > 0 ) {
			foreach ( $trackers as $user ) {
				$user->set_role('subscriber');
			}
		}
		
		// Remove the tracker role
		remove_role('tracker');
		
	}
	
	// Remove the track_time ability from the administrator
	$admin_role = get_role( 'administrator' );
	if ( $admin_role->has_cap('track_time') ) {
		$admin_role->remove_cap('track_time');
	}
	
}

// file_put_contents(
	// getcwd() . '/plugin-test-log.txt',
	// __DIR__
// );