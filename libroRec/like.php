<?php
require_once ('conn.php');
$book_id = $_GET['book_id'];
$stu_id =$_GET['stu_id'];
$query = "insert into collections (book_id, stu_id) values ('$book_id','$stu_id')";

$connect->query($query) or die("发生了未知错误");
echo "<script>alert('操作成功，此书已添加到收藏夹');location.href='main.php'</script>";
?>