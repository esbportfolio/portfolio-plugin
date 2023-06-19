<?php

declare(strict_types=1);

class Esb_Tracker_Db_Ops {
	
	final const PROJECTS_TBL_SQL = 
		'project_id int AUTO_INCREMENT NOT null,
		project_name varchar(100) not null,
		project_desc varchar(255),
		project_duration float,
		project_due date,
		project_active tinyint(1),
		PRIMARY KEY(project_id)';
	
	final const TIME_TBL_SQL = 
		'time_log_id int AUTO_INCREMENT NOT null,
		time_start int(11) UNSIGNED,
		time_end int(11) UNSIGNED,
		project_id int not null,
		PRIMARY KEY(time_log_id),
		FOREIGN KEY (project_id) REFERENCES tracker_tbl_projects(project_id)
			ON UPDATE CASCADE
			ON DELETE CASCADE';
	
	// Create tables if necessary
	public function create_tables() {
		$proj_tbl_name = 'tracker_tbl_projects';
		$time_tbl_name = 'tracker_tbl_time';
		
		// Must be included before maybe_create_table for it to work
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		
		maybe_create_table(
			$proj_tbl_name,
			'CREATE TABLE ' . $proj_tbl_name . '(' . self::PROJECTS_TBL_SQL . ');'
		);
		maybe_create_table(
			$time_tbl_name,
			'CREATE TABLE ' . $time_tbl_name . '(' . self::TIME_TBL_SQL . ');'
		);
	}
	
}