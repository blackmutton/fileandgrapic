<?php
include_once "db.php";
$image = find('images', $_GET['id']);

if (!empty($_FILES)) {
    // echo "檔案名稱：" . $_FILES['file']['name'] . "<br>";
    // echo "檔案類型：" . $_FILES['file']['type'] . "<br>";
    // echo "檔案大小：" . $_FILES['file']['size'] . "<br>";
    // echo "暫存檔名：" . $_FILES['file']['tmp_name'] . "<br>";
    unlink("images/" . $image['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], "images/" .
        $_FILES['file']['name'])) {
        // 由於可能上傳多張圖，所以須以陣列方式儲存
        // $_SESSION['file'][] = $_FILES['file']['name'];
        $image['name'] = $_FILES['file']['name'];
        $image['type'] = $_FILES['file']['type'];
        $image['size'] = $_FILES['file']['size'];
        // dd($images);
        save("images", $image);

        header("location:upload.php");
    } else {
        echo "檔案上傳失敗";
    }
}
?>
<!----建立你的表單及設定編碼----->
<form action="edit_image.php?id=<?= $_GET['id']; ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="submit">
</form>

<?php
echo "<img src='images/{$image['name']}'>";
?>