<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        #content {
            display: flex;
            justify-content: space-between;
        }
        #aside {
            border: 1px solid #000;
        }
        #loginBox {
            text-align: center;
            font-weight: bold;
            display: block;
            padding: 15px 0;
            color: #a0a0a1;
            background: gray;
            border-top: 1px solid #dde7e9;
        }
    </style>
</head>
<body>
<div id="container">
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	  <ul class="navbar-nav">
		<li class="nav-item active">
		  <a class="nav-link" href="#">TODO LIST</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" href="#">Link1</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" href="#">Link2</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link disabled" href="#">Disabled</a>
		</li>
	  </ul>
	</nav>
	<header style="border: 1px solid #000">
			<h1><span class="breadcrumb breadcrumb-secondary">TODO LIST</span></h1>
	</header>
	<section style="border: 1px solid #000; margin-top: 30px;">
		<?php //echo $aa ?>
		<?php //echo $list ?> <!--값 넘길 때 배열로 [] 키를 넘겨야 함 셀렉트도 데이터 베이스는 미리 등록 해놓고 사용하기도 함-->
		<div>
			<a href="/todo/writeNew">작성하기</a>
		</div>
		<form method="get" name="Main">
		<!--checkbox-->
			<input type="hidden" name="kind" value="<?php $kind?>">
			<!--카테고리-->
			<select name="category" id="category" onchange="this.form.submit()">
				<option value="">전체</option>
				<?php
				$query = mysqli_query($con, "SELECT `category` FROM `todo` WHERE `category` <> '' GROUP BY `category` ORDER BY `category`");
				while($data = mysqli_fetch_assoc($query)) {
					$selected = $_GET['category'] == $data['category'] ? " selected" : "";
					echo "<option value='".$data['category']."'".$selected.">".$data['category']."</option>";
				} ?>
			</select>
		</form>
		<div id="content">
			<form id="mainForm">
				<table  style="width: 700px; text-align: center; margin-top: 30px;">
					<tr>
						<th>번호</th>
						<th>제목</th>
						<th>날짜</th>
						<th>메모</th>
						<th>완료여부</th>
						<th>등록날짜</th>
					</tr>
					<tr>
						<?php
						//print_r($list);
						// 받아온 리스트 : $list
						// 단일 항목 : $item
						foreach($list as $item){
						?>
						<tr><!-- 단일 항목인 $item으로 해당하는 값을 출력합니다. -->
							<td><a href="/todo/write?idx=<?= $item['idx'] ?>"><?php echo $item['idx'];?></td>
							<td><?php echo $item['title'];?></td>
							<td><?php echo $item['set_date'];?></td>
							<td><?php echo $item['memo'];?></td>
							<td><?php echo $item['done'];?></td>
							<td><?php echo $item['reg_date'];?></td>
						</tr>
						<?php
						}
						?>
					</tr>
				</table>
			</form>
            <!-- 로그인 -->
            <form method="post" action="/todologin/member_login">
                <div id="aside">
                    <header><div>로그인하세요.</div></header>
                    <section>
                        <div>ID: &nbsp&nbsp<input type="text" name="loginid" id="loginId"></div>
                        <div>PW: <input type="password" name="loginpw" id="loginPw"></div>
                        <div><a href="/todologin/member">회원가입</a></div>
                    </setcion>
                    <footer id="loginBox"><input type="submit" value="로그인"></footer>
                </div>
            </form>
		</div>
	</section>
	<section style="border: 1px solid #000; margin-top: 30px;">
		<button type="button" class="btn">Basic</button>
		<button type="button" class="btn btn-primary">Primary</button>
		<button type="button" class="btn btn-secondary">Secondary</button>
		<button type="button" class="btn btn-success">Success</button>
		<button type="button" class="btn btn-info">Info</button>
		<button type="button" class="btn btn-warning">Warning</button>
		<button type="button" class="btn btn-danger">Danger</button>
		<button type="button" class="btn btn-dark">Dark</button>
		<button type="button" class="btn btn-light">Light</button>
		<button type="button" class="btn btn-link">Link</button>
	</section>
</div>
<footer style="border: 1px solid #000; margin-top: 30px;">
	<p>바닥</p>
</footer>
</body>
</html>