<?php

declare(strict_types=1);

// Set up access to the database operations class
$db_ops = new Esb_Tracker_Db_Ops();

// Make sure tables exist
$db_ops->create_tables();

// Get array of projects from db_ops
$projects = $db_ops->fetch_projects();
// Get projects options list
$proj_options = '';
foreach ( $projects as $project ) {
	$proj_options .= N . str_repeat(T, 3) . '<option value="' . $project->project_id . '">' . $project->project_name . '</option>';
}

?>
<!-- Progress tracker form starts -->
<script>
<?php

// Script needs to be inline here because browsers won't let you load scripts locally
include( dirname(__DIR__) . '\js\tracker-form.js' );
echo N;

?>
</script>
<form>
	<div class="mb-3">
		<label for="project-dropdown" class="form-label">Project</label>
<?php
if ( count($projects) > 0 ) {
?>
		<select id="project-dropdown" class="form-select"><?php echo $proj_options; ?></select>
<?php
} else {
?>
		<div id="dropdown-help" class="alert alert-danger py-1 px-2">No projects are currently active. Please add or edit projects to make them available here.</div>
		<select id="project-dropdown" class="form-select" aria-disabled="true" aria-describedby="dropdown-help" disabled></select>
<?php
}
?>
	</div>
</form>
<pre>
<?php // echo var_dump($projects); ?>
</pre>
<!-- Progress tracker form ends -->