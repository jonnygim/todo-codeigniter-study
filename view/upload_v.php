<?php
include "header_v.php"
?>
<html>
<head>
<title>Upload Form</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>

<?php echo $error;?>

<?php //echo form_open_multipart('upload/do_upload');?>
<form method="post" id="upload_form" enctype="multipart/form-data">
	<input type="file" name="userfile" id="ufile" size="20" />
	<br /><br />
	<input type="submit" value="upload" />
</form>

<div id="uploaded_file">
</div>

</body>
<script>
 $(document).ready(function(){
      $('#upload_form').on('submit', function(e){
           e.preventDefault();
           if($('#ufile').val() == '')
           {
                alert("Please Select the File");
           }
           else
           {
                $.ajax({
                     url:"./ajax_upload",
                     method:"POST",
                     data:new FormData(this),
                     contentType: false,
                     cache: false,
                     processData:false,
                     success:function(data)
                     {
                          $('#uploaded_file').html(data);
                     }

                });
           }
      });
 });
 </script>
</html>