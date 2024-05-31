<?php
include_once "db.php";
// 啟用session
session_start();
/**
 * 1.建立表單
 * 2.建立處理檔案程式
 * 3.搬移檔案
 * 4.顯示檔案列表
 */
if (!empty($_FILES)) {
    // echo "檔案名稱：" . $_FILES['file']['name'] . "<br>";
    // echo "檔案類型：" . $_FILES['file']['type'] . "<br>";
    // echo "檔案大小：" . $_FILES['file']['size'] . "<br>";
    // echo "暫存檔名：" . $_FILES['file']['tmp_name'] . "<br>";
    if (move_uploaded_file($_FILES['file']['tmp_name'], "images/" .
        $_FILES['file']['name'])) {
        // 由於可能上傳多張圖，所以須以陣列方式儲存
        // $_SESSION['file'][] = $_FILES['file']['name'];
        $data['name'] = $_FILES['file']['name'];
        $data['type'] = $_FILES['file']['type'];
        $data['size'] = $_FILES['file']['size'];
        save("images", $data);
        echo "檔案上傳成功";
    } else {
        echo "檔案上傳失敗";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案上傳</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 class="header">檔案上傳練習</h1>
    <!----建立你的表單及設定編碼----->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="submit">
    </form>




    <!----建立一個連結來查看上傳後的圖檔---->
    <<?php
        /* if (isset($_SESSION['file'])) {
            foreach ($_SESSION['file'] as $file)
                echo "<img src='images/{$file}' class='upload-img'>";
        } */

        // 改用scandir()的方式來讀取圖片檔
        // scandir()為掃描此資料夾的所有資訊
        // $files = scandir("images/");
        // 掃瞄出的資料會有. 和..，這是作業系統中表達此資料夾、回到上一個資料夾的方式，但對網頁呈現不需要，故用unset()拿走
        /* unset($files[0], $files[1]);
        foreach ($files as $file) {
            echo "<img src='images/{$file}' class='upload-img'>";
        } */

        $images = all('images');

        foreach ($images as $image) {
            echo "<img src='images/{$image['name']}' class='upload-img'>";
        }
        ?> </body>

</html>