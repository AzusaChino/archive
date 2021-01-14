<?php
session_start();
if(isset($_SESSION['user_name'])){
    session_unset();
    session_destroy();
    echo "<script>alert('注销成功,返回登录页');location.href='index.php'</script>";
}
?>