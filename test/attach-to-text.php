<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('#attach').change(function (e) {
		e.preventDefault();
		$("p").hide();

		console.log("submit event");
		var fd = new FormData(document.getElementById("commentForm"));
            	fd.append("label", "WEBUPLOAD");
            	$.ajax({
              		url: "upload.php",
              		type: "POST",
              		data: fd,
              		enctype: 'multipart/form-data',
              		processData: false,  // tell jQuery not to process the data
              		contentType: false   // tell jQuery not to set contentType
           	}).done(function( data ) {
                		console.log("PHP Output:");
                		console.log( data );
            	});
            	return false;
		
		$.each( this.files, function( key, value ) {
			alert( key + ": " + value.getAsDataURL());
		});
		//$('#files-selected').text(this.files.length + " file selected");

	});
});
</script>
</head>
<body>

<h2>This is a heading</h2>
<div id="files-selected"></div>
<div style="height:900px;">Test</div>
<p>This is a paragraph.</p>
<p>This is another paragraph.</p>
<form id="commentForm" name="commentForm" method="post">
<label>Select a file:</label> <input type="file" name="attach" id="attach" multiple="multiple" />
</form>

</body>
</html>