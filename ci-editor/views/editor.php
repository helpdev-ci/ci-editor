<script type="text/javascript">
	$(document).ready(function(){

		$('#attach').change(function (e) {
			e.preventDefault();

			$('#insertIMG').html("Uploading.....");
			
			console.log("submit event");
			var fd = new FormData(document.getElementById("editorForm"));
	            	//fd.append("label", "WEBUPLOAD");
	            	$.ajax({
	              		url: "<?php echo site_url('cms/upload'); ?>",
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

	                		if (obj.error == 0) {
	                			console.log("error = 0");
	                			console.log(obj.msg);
	                			var areaValue = $("#files-selected").val();
	                			//$('#files-selected').val(areaValue + "\n" + obj.msg + "\n"); /// do whatever you want here.
	                			//$('#files-selected').focus();
	                			tinyMCE.execCommand('mceInsertContent', false, '<img title="'+ obj.img_name +'" alt="'+ obj.img_name +'" src="'+ obj.img_url +'" />');
	                			$('#insertIMG').html('');
	                		} else {
	                			console.log('error = 1');
	                			console.log(obj.msg);
	                			$('#insertIMG').html(obj.msg);
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
	                		
	                		
	            	})
			.fail(function (jqXHR, textStatus) {
			    alert(jqXHR.statusText);
			    $('#insertIMG').html(obj.img_name);
			});
	            	return false;
			
			/*$.each( this.files, function( key, value ) {
				alert( key + ": " + value.getAsDataURL());
			});*/
			//$('#files-selected').text(this.files.length + " file selected");
		});
	});
</script>            
            <div class="container-fluid">

                <!-- Page Heading -->
                <!--div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Forms
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Forms
                            </li>
                        </ol>
                    </div>
                </div-->
                <!-- /.row -->

                <div class="row">


  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#editor" aria-controls="editor" role="tab" data-toggle="tab">Editor</a></li>
    <li role="presentation"><a href="#preferences" aria-controls="preferences" role="tab" data-toggle="tab">Preferences</a></li>
    <li role="presentation"><a href="#help" aria-controls="help" role="tab" data-toggle="tab">Help</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="editor">
        <div class="col-lg-12">
            <h1 class="page-header">
                Editor
            </h1>
        </div>
        <div class="col-lg-12">
	<form id="editorForm" name="editorForm" method="post" class="form-horizontal" role="form">
		<textarea id="files-selected" cols="50" rows="10"><?php echo $editor['content']; ?></textarea>
		<div id="insertIMG"></div>
		<label>Select a picture:</label> <input type="file" name="attach" id="attach" />
		<div class="">
		<!-- Indicates a successful or positive action -->
  <div class="form-group">
    <div class="control-label col-sm-2" for="create_ref">
    	<input type="hidden" name="create_ref" id="create_ref" value="<?php echo $editor['create_ref']; ?>" placeholder="<?php echo $editor['create_ref']; ?>">
    </div>
    <div class="col-sm-10 text-right">
      <button type="submit" class="btn btn-success">Save</button>
    </div>
  </div>
		</div>
	</form>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="preferences">
        <div class="col-lg-12">
            <h1 class="page-header">
                Preferences
            </h1>
        </div>
        <div class="col-lg-12">
                        <form role="form">
                            <div class="form-group">
                                <label>Text Input with Placeholder</label>
                                <input class="form-control" placeholder="Enter text">
                            </div>
                        </form>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="help">
        <div class="col-lg-12">
            <h1 class="page-header">
                Help
            </h1>
        </div>
    </div>
  </div>


                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->