<?php include_once "db.php";
$img = find('images', $_GET['id']);
dd($img);
// 先刪掉資料夾的檔案
echo "images/" . $img['name'];
unlink("images/" . $img['name']);
// 再刪掉資料庫的資料
del('images', $_GET['id']);
header("location:upload.php");
