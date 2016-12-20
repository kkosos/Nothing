<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<!--<body   background="background.jpg">-->

<body   bgcolor="silver">
<!-- 除了bgcolor外，也可以設定背景圖片，這邊可以吃相對路徑或是絕對路徑 -->
<!-- 把輸出都弄到畫面中間，與index.php一樣 -->
<div style="position:absolute;left:35%;top:15%"> 

<?php
#載入連結資料庫的檔案
include 'connect.php';
	
	
	
	#剛剛的表單會把你所選擇的起站、迄站、車種給傳遞過來
	#可以使用 $_POST['start'] $_POST['dest'] $_POST['type'] 來取得
	echo $_POST['start'];
	echo "你選擇的起站是 <b>".$_POST['start']."</b></br>";
	echo "你選擇的迄站是 <b>".$_POST['dest']."</b></br>";
	echo "你選擇的車種是 <b>".$_POST['type']."</b></br>";

	#==============Wrtie code here==========================
	#接者根據使用者輸入的資訊，去查詢資料庫中是否有符合的車種


	#接下來我們要畫表格，利用table來達成，第一個row放的是說明，接下來就放查詢到的資料
	echo "<table border='1'>";
	echo "<tr>";
	echo "<td>車次</td>";
	echo "<td>車種</td>";
	echo "<td>起站</td>";
	echo "<td>迄站</td>";
	echo "<td>經過站點</td>";
	echo "</tr>";
	
	#測試區塊，
	
	
	$request = "SELECT * FROM Route Where start=\"".$_POST['start']."\" and dest=\"".$_POST['dest']."\";";
	$result = $mysqli->query($request);
	while($row=mysqli_fetch_array($result)){
	      
    	  echo "<tr>";  
	  echo "<td>".$row['number']."</td>"; 
	  echo "<td>".$_POST['type']."</td>"; 
	  echo "<td>".$row['start']."</td>"; 
	  echo "<td>".$row['dest']."</td>"; 
	  echo "<td>".$row['station']."</td>"; 
	// echo “<td>”.$row['number'].”</td>”;
	  //echo "<td>".$_POST['type']."</td>"; 
	  //echo “<td>”.$row['start'].”</td>”;
	  //echo “<td>”.$row['dest'].”</td>”;
	
	echo "</tr>";	
	}
	#這邊是剛剛查詢得到的結果，依序存取
	#接者去把查詢到的所有結果，依序放到表格中列印出來

    #==================wrtie code here===============       
    #從result中把資料一個一個以表格方式呈現
 	#假設我把起站、迄站、車種、車次都分別存在start,dest,type,tid這些欄位之中，可以用以下 	  #語法將其以表格顯示
	#while(.....){	
    #  echo “<tr>”  ;  
	#  echo “<td>”.$row['tid'].”</td>”;
	#  echo "<td>".$row['type']."</td>"; 
	#  echo “<td>”.$row['start'].”</td>”;
	#  echo “<td>”.$row['dest'].”</td>”;
	#  echo “</tr>”;
    #}
    # 請依照自己的table設計去作修改

	echo "</table>";

?>
	<!-- 一個超連結，href接的是導向的網址，後面則是使用者看到的文字 -->
	<a href="index.php">繼續查詢</a>
