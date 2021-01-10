<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Notes Site</title>

	<style type="text/css">

	</style>
	
	<script type="text/javascript">
	
		var NOTES_PROTOTYPE = null;
	
		function prepare()
		{
			var nts = document.querySelector(".prototype");
			
			NOTES_PROTOTYPE = nts.cloneNode(true);
			NOTES_PROTOTYPE.setAttribute("class", "note");
			document.querySelector("#notes").removeChild(nts);
		}
		
		function createNew()
		{
			var nnt = NOTES_PROTOTYPE.cloneNode(true);
			document.querySelector("#notes").appendChild(nnt);
		}
		
		function saveNote(vt)
		{
			var nd = vt.target;
			
			var id = nd.querySelector("[name=id]").value;
			var contents = nd.querySelector("[name=contents]").value;
			
			sendRequest({'id': id, 'contents': contents});
		}
		
		function deleteNote(vt)
		{
			
		}
		
		function sendRequest(da, ab, mt)
		{
			var http = new XMLHttpRequest();

			http.onreadystatechange = function()
			{
				if(http.readyState === 4 && http.status === 200)
				{
					var rsp = JSON.parse(http.responseText);
					ab(rsp['status']);
				}
			}

			http.open(mt, "http://localhost/notes");
			http.send();
        }
	
	</script>
</head>
<body onload="prepare();">

<h2>Notes Site</h2>

<div id="notesControl">
	<input type="button" value="New" onclick="createNew();" />
</div>
<div id="notes">
	<div class="prototype">
		<input name="id" type="hidden" value="" />
		<textarea name="contents"></textarea>
		<div class="notesControlNote">
			<input type="button" value="Save" onclick="saveNote(event);" />
			<input type="button" value="Delete" onclick="deleteNote(event);" />
			<span class="created">&nbsp;</span>
			<span class="updated">&nbsp;</span>
		</div>
	</div>
	<?php foreach($notes as $n) { ?>
	<div class="note">
		<input name="id" type="hidden" value="<?= $n->id ?>" />
		<textarea name="contents"><?= $n->contents ?></textarea>
		<div class="notesControlNote">
			<input type="button" value="Save" onclick="saveNote(event);" />
			<input type="button" value="Delete" onclick="deleteNote(event);" />
			<span class="created"><?= $n->create_time ?></span>
			<span class="updated"><?= $n->last_update_time ?></span>
		</div>
	</div>
	<?php } ?>
</div>

</body>
</html>