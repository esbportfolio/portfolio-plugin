<?php

declare(strict_types=1);

define(
	'PROJECTS_TBL_SQL',
	'CREATE TABLE tracker_tbl_projects(
		project_id int AUTO_INCREMENT NOT null,
		project_name varchar(100) not null,
		project_desc varchar(255),
		project_duration float,
		project_due date,
		project_active tinyint(1),
		PRIMARY KEY(project_id)
	);'
);

define(
	'TIME_TBL_SQL',
	'CREATE TABLE tracker_tbl_time(
		time_log_id int AUTO_INCREMENT NOT null,
		time_start int(11) UNSIGNED,
		time_end int(11) UNSIGNED,
		project_id int not null,
		PRIMARY KEY(time_log_id),
		FOREIGN KEY (project_id) REFERENCES tracker_tbl_projects(project_id)
			ON UPDATE CASCADE
			ON DELETE CASCADE
	);'
);