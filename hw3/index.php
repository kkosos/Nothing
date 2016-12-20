<head>
	<title>MainPage</title> <!-- 這邊可以設定網頁的標題 -->	
	<meta  charset=utf-8" />
</head>
<body style="background-color:silver"> 
<?php
#載入跟資料庫連線的程式碼
include 'connect.php';
?>

<!-- 這邊是設定接下來輸出的位置，用絕對路徑，左上角靠近左邊是畫面的35%,左上角靠近上方是畫面的15% -->

<div style="position:absolute;left:35%;top:15%">
	<table border="1">
	
		<tbody>
		<!--接下來用三個下拉式選單，讓使用者選擇起站跟迄站跟車種-->
		 
		<form  method="POST" action="search.php" id="youform">
		
		<tr>
			<td>
				<font color="FF00FF">起站 : </font> 
				<select name="start" form="youform">  <!-- 接下來要利用PHP跟MYSQL 去抓取資料庫鍾 所有地點的名稱，然後透過<option value=?>??</option>的方式增加到下拉式選單-->
<?php
	#去MYSQL抓取所有車站的名稱
	#============= write your code heer=================
	#假設我的車站都放在Stations這個table中，然後該欄位的名稱為name
	$request = "SELECT * FROM Station";

	$result = $mysqli->query($request);
	
	while($row=mysqli_fetch_array($result)){
		echo $row;
	      echo "<option value=".$row['name'].">".$row['name']."</option>\n";
	}
?>
				</select>
			</td>
		</tr>
		<!-- 接下來設置第二個下拉式選單，讓使用者選擇迄站 -->
		<tr>
			<td>
				<font color="brown">迄站 : </font>
   				<select name="dest" id="dest" form="youform">

<?php
	#去MYSQL抓取所有車站的名稱
	#============= write your code heer=================
	
	$request = "SELECT * FROM Station";
	$result = $mysqli->query($request);
	while($row=mysqli_fetch_array($result)){
	      echo "<option value=".$row['name'].">".$row['name']."</option>\n";
	}
?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<font color="brown">車種 : </font>
				<select name="type" form="youform"> <!-- 要創造一個選單給使用者選擇 name是後面給POST方法使用的-->
<?php
	#去MYSQL抓取所有車種的名稱
	#============= write your code heer=================

	$request = "SELECT * FROM Train";
	$result = $mysqli->query($request);
	while($row=mysqli_fetch_array($result)){
	      echo "<option value=".$row['name'].">".$row['name']."</option>\n";
	}
		
?>
				</select>	
			</td>
		</tr>	
		<tr>
			<td>
				<!-- 這邊是一個送出的按鈕，顯示的名稱就是查詢，按下去後，會與剛剛的form一起運作，把使用者選擇的兩個選項都利用POST的方式送到search.php中去查詢 -->
				<INPUT TYPE="submit" name="submit"  value="查詢" />
			</td>
		</tr>
		</form>

		</tbody>

	</table>
</div>	
</body>
</html>
