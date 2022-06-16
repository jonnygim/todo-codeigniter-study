<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
//print_r($_GET['idx']);
print_r($aa);
foreach($aa as $items) { ?>
	<form method="post" action="/todo/insert">
		<input type="hidden" name="no" value="<?php echo $items['idx']; ?>" id="no">
		<div>
			<div>일정 : <input type="text" name="title" value="<?php echo $items['title']; ?>"></div>
			<div>날짜 : <input type="text" name="set_date" value="<?php echo $items['set_date']; ?>"></div>
			<div>메모 : <textarea name="memo"><?php echo $items['memo']; ?></textarea></div>
			<div>완료 :
			<?php
			if($items['done'] == 'yes') { ?>
			<input type="checkbox" name="done" id="doneCheck" value="yes" checked>
			<?php
			} else { ?>
				<input type="checkbox" name="done" value="no" id="doneCheck"></div>
			<?php
			} ?>
		</div>
		<div>
			<input type="submit" value="저장">
		</div>
	</form>
<?php
}?>
</body>
</html>