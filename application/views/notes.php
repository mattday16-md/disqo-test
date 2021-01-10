<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Notes Site</title>

	<style type="text/css">

	</style>
	
	<script type="text/javascript">
	
	</script>
</head>
<body onload="loadNotes();">

<h2>Notes Site</h2>

<div id="notesControl">
	<input type="button" value="New" onclick="createNew();" />
</div>
<div id="notes">
	<div class="prototype">
		<input name="id" type="hidden" value="" />
		<textarea name="contents"></textarea>
		<div class="notesControlNote">
			<input type="button" value="Save" onclick="saveNote();" />
			<input type="button" value="Delete" onclick="deleteNote();" />
			<span class="created">&nbsp;</span>
			<span class="updated">&nbsp;</span>
		</div>
	</div>
</div>

</body>
</html>