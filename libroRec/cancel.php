<?php
require_once ('conn.php');
$book_id = $_GET['book_id'];
$stu_id =$_GET['stu_id'];
$query = "delete from collections where stu_id='$stu_id' and book_id='$book_id'";

$connect->query($query) or die("发生了未知错误");
echo "<script>alert('操作成功，已取消收藏此书');location.href='main.php'</script>";
?>