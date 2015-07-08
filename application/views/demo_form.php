<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	/* TinyMCE specific rules */

	</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>

    <script type="text/javascript">
        tinymce.init({
            selector: "#files-selected",
            plugins:"autoresize,textcolor,autolink,link",
            toolbar: "undo redo | styleselect | fontsizeselect | forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            //toolbar: "forecolor backcolor",
            autoresize_min_height : "20px",
            autoresize_max_height : "300px",
            content_css : "tinymce.css",
        });
    </script>
<script>
$(document).ready(function(){
	$('#attach').change(function (e) {
		e.preventDefault();
		
		console.log("submit event");
		var fd = new FormData(document.getElementById("commentForm"));
            	//fd.append("label", "WEBUPLOAD");
            	$.ajax({
              		url: "<?php echo site_url('demo/upload'); ?>",
              		type: "POST",
              		data: fd,
              		enctype: 'multipart/form-data',
              		processData: false,  // tell jQuery not to process the data
              		contentType: false   // tell jQuery not to set contentType
           	}).done(function( data ) {
           		$("#attach").val("");
                		console.log("PHP Output:");
                		
                		console.log(data.length);
                		console.log(data);

                		var obj = $.parseJSON(data);
                		console.log(obj.msg);

                		if (obj.error == 0) {
                			var areaValue = $("#files-selected").val();
                			//$('#files-selected').val(areaValue + "\n" + obj.msg + "\n"); /// do whatever you want here.
                			//$('#files-selected').focus();
                			tinyMCE.execCommand('mceInsertContent', false, '<img alt="'+ obj.img_name +'" src="'+ obj.img_url +'" />');
                		}
                		

                		/*for(i=0;i<data.length;i++){
                			console.log(data[i]);
                		}
*/
                		/*data=$.parseJSON(data);
			    alert(data);
			    $.each(data, function(i,item){
			    alert(item);
			});*/
                		
                		/*var obj = jQuery.parseJSON(data);
                		for(i=0;i<data.length;i++){
                			console.log(data);
                			//$('#files-selected').append(obj[i].name + "<br>"); /// do whatever you want here.
			};*/
                		
                		
            	});
            	return false;
		
		/*$.each( this.files, function( key, value ) {
			alert( key + ": " + value.getAsDataURL());
		});*/
		//$('#files-selected').text(this.files.length + " file selected");
	});
});
</script>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
<p>
<div>
<textarea id="files-selected" cols="50" rows="10"></textarea>
</div>
<?php echo site_url('demo'); ?>
<form id="commentForm" name="commentForm" method="post">
<label>Select a file:</label> <input type="file" name="attach" id="attach" />
</form>
<div id="result"></div>
</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>