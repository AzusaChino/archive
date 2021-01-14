<?php
require_once ('conn.php');
$book_id = $_GET['book_id'];
$stu_id =$_GET['stu_id'];
$query = "insert into dislike (book_id, stu_id) values ('$book_id','$stu_id')";

$connect->query($query) or die("发生了未知错误");
echo "<script>alert('操作成功，此书将不再推荐给您');location.href='main.php'</script>";
?>