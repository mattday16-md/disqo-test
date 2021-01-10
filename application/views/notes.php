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
			var nd = vt.target.parentNode.parentNode;
			
			var id = nd.querySelector("[name=id]").value;
			var t = nd.querySelector("[name=title]").value;
			var contents = nd.querySelector("[name=contents]").value;
			
			var fn = function(dt)
			{
				nd.querySelector("[name=id]").value = dt;
			};
			
			sendRequest({'id': id, 'title': t, 'contents': contents}, fn, "http://localhost/index.php/notes/save", "POST");
		}
		
		function deleteNote(vt)
		{
			var nd = vt.target.parentNode.parentNode;
			
			var id = nd.querySelector("[name=id]").value;
			
			var fn = function(dt)
			{
				nd.querySelector("[name=id]").value = dt;
			};
			
			if(window.confirm("Are you sure?"))
			{
				sendRequest({'id': id}, fn, "http://localhost/index.php/notes/delete", "POST");
				nd.parentNode.removeChild(nd);
			}
		}
		
		function sendRequest(da, ab, ur, mt)
		{
			var http = new XMLHttpRequest();

			http.onreadystatechange = function()
			{
				if(http.readyState === 4 && http.status === 200)
				{
					var rsp = JSON.parse(http.responseText);
					ab(rsp);
				}
			}

			http.open(mt, ur);
			http.send(JSON.stringify(da));
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
		Title: <input name="title" type="text" value="" /> <br />
		Contents: <textarea name="contents"></textarea> <br />
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
		Title: <input name="title" type="text" value="<?= $n->title ?>" /> <br />
		Contents: <textarea name="contents"><?= $n->contents ?></textarea>
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