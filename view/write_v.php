<?php
include "header_v.php";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
<?php
//print_r($_GET['idx']);
//print_r($data);
//print_r($fdata);
if($_GET) {
	// update
	foreach($aa as $items) { ?>
		<?php echo "ddd"; ?>
		<form method="post" action="/todo/insert">
			<input type="hidden" name="no" value="<?php echo $items['idx']; ?>" id="no">
			<div>
				<div>일정 : <input type="text" name="title" value="<?php echo $items['title']; ?>"></div>
				<div>날짜 : <input type="text" name="set_date" value="<?php echo $items['set_date']; ?>"></div>
				<div>메모 : <textarea name="memo"><?php echo $items['memo']; ?></textarea></div>
				<div>완료 : <input type="checkbox" name="done" id="doneCheck" value="<?php echo $items['done'] ?>"></div>
				<input type="hidden" name="done" id="yn" value="n">
			</div>
			<script>
				$("#doneCheck").on('change', function(){
					if($(this).prop('checked')) {
						$("#yn").val("y");
					} else {
						$("#yn").val("n");
					}
				});
			</script>
			<!--file-->
			<div>
					<input type="file" name="userfile" size="20" />
					<br /><br />
				<div>
					<input type="checkbox" name="check" id="fileCheck" value="">
					<input type="hidden" name="check" id="fchk" value="0">
					<a href="/todo/download?idx=<?php echo $items['idx'] ?>"><?= $items['rfname'] ?></a>
				</div>
				<script>
				$("#fileCheck").on('change', function(){
					if($(this).prop('checked')) {
						$("#fchk").val("1");
					} else {
						$("#fchk").val("0");
					}
				});
			</script>
				<!-- <div>
					<a href="/todo/delfile?idx=<?php echo $items['idx'] ?>">파일삭제</a>
				</div> -->
			</div>
			<div>
				<input type="submit" value="저장">
			</div>
			<div>
				<a href="/todo/dellist?idx=<?php echo $items['idx']; ?>" onclick="return comment_delete();">삭제</a>
			</div>
			<div>
				<a href="/todo/plist">취소</a>
			</div>
		</form>
	<?php
	}
} else { // new ?>
	<form method="post" action="/todo/insert" id="upload_form" enctype="multipart/form-data">
			<div>

				<div>일정 : <input type="text" name="title"></div>
				<div>날짜 : <input type="text" name="set_date"></div>
				<div>메모 : <textarea name="memo"></textarea></div>
				<div>완료 : <input type="checkbox" name="done" id="doneCheck"></div>
				<input type="hidden" name="done" id="yn" value="n">
			</div>
			<script>
				$("#doneCheck").on('change', function(){
					if($(this).prop('checked')) {
						$("#yn").val("y");
					} else {
						$("#yn").val("n");
					}
				});
			</script>
			<div>
				<input type="file" name="userfile" id="ufile" size="20" />
				<br /><br />
			</div>
			<script>
				 $(document).ready(function(){
					  $('#upload_form').on('submit', function(e){
						   e.preventDefault();
						   if($('#ufile').val() == '')	{
								alert("Please Select the File");
						   }
						   else
						   {
								$.ajax({
									 url:"./insert",
									 method:"POST",
									 data:new FormData(this),
									 contentType: false,
									 cache: false,
									 processData:false,
									 success:function(data) {
										 location.href = "/todo/plist";
										//echo "success";
									 }

								});
						   }
					  });
				 });
			 </script>
			<div>
				<input type="submit" value="저장">
			</div>
			<div>
				<a href="/todo/plist">취소</a>
			</div>
		</form>
		<?php
			}?>
<script>
	function comment_delete() {
		return confirm("이 댓글을 삭제하시겠습니까?");
	}
</script>
</body>
</html>