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
    <style>
        #cont {
            display: flex;
            justify-content: center;
        }

        #content {
            border: 1px solid #000;
            width: 300px;
            height: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div id="cont">
        <form method="post" action="/todologin/member_insert">
            <div id="content">
                <div><h3>회원가입</h3></div>
                <div>ID: <input type="text" name="userid"></div>
                <div>PW: <input type="password" name="userpw"></div>
                <div>Email: <input type="text" name="email"></div>
            </div>
            <div id="contentBtn">
                <div><input type="submit" value="회원가입"></div>
                <div><a href="">취소</a></div>
            </div>
        </form>
    </div>
</body>