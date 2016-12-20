<?php
#連線到資料庫去  參數分別是 網路位置、帳號、密碼、資料庫名稱
#範例: 
#======================修改資料庫位置=============================
#位置、帳號、密碼、資料庫名稱
$mysqli = mysqli_connect("localhost","root","root","FUCK");
$mysqli->query("SET  names utf8");
#如果資料庫連線失敗，我們就印出一些訊息幫助debug

if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: )".$mysqli->connect_errno .")".$mysqli->connect_error;
	}
?>
