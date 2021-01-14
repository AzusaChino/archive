<?php
session_start();
?>
<!doctype html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <title>鑫新闻登录页</title>
    <link rel="stylesheet" href="main.css" />
    <script>
        /*function validateForm(){
            var x = document.forms['login_form']['username'].value;
            var y = document.forms['login_form']['password'].value;
            if(x == null || x ==""){
                alert("请输入用户名");
                return false;
            }
            if(y == null || y ==""){
                alert("请输入密码");
                return false;
            }
        }*/
    </script>
</head>
<body>
<div class="wrapper">
    <div class="header"><div class="logo"><a name="主页" href="main.php"><img src="resources/xin_logo.jpg" /></a></div>
        <div class="top_search"></div></div>
    <div class="nav"><ul>
      <li><a href="main.php">主页</a></li>
      <li><a href="news.php?type=国内新闻">国内新闻</a></li>
      <li><a href="news.php?type=国际新闻">国际新闻</a></li>
      <li><a href="news.php?type=社会">社会</a></li>
      <li><a href="news.php?type=娱乐">娱乐</a></li>
      <li><a href="news.php?type=科技">科技</a></li>
      <li><a href="https://www.baidu.com" >更多</a></li>
        </ul>
    </div>
<div class="form">
  <form action="" method="post" name="login_form" onsubmit="validateForm()">
   <table >
    <tr><th colspan="2"><h2>用户登录框</h2></th></tr>
      <tr><td>用户名:</td>
        <td><input class="text" type="text" name="username" placeholder="请输入用户名"/></td></tr>
        <tr><td>密码:</td>
          <td><input class="text" type="password" name="password" placeholder="请输入密码"/></td></tr>
          <tr><td><input class="button" type="submit" name="submit" value="登录"/></td>
              <td><input class="button" type="reset" value="重置" /></td>
          </tr>
   </table>
  </form>
</div>
  <?php
require_once('conn.php');
if(isset($_POST['submit']))
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  $query = "SELECT username,password FROM user WHERE username='$username'";
  $result =$conn->query($query);
      $row = $result->fetch_assoc();
      if($row['username']==$username&&$row['password']==$password){
          if ($row['username'] == 'admin' && $row['password'] == 'admin') {
              $_SESSION['username'] = $username;
              echo "<script>alert('欢迎管理员');location.href='backend.php'</script>";
          }else{
              $_SESSION['username']=$username;
              echo "<script>alert('登陆成功,$username');location.href='main.php'</script>";
          }
}else{
      echo "<script>alert('用户名或密码错误');location.href='login.php'</script>";
}
}
   ?>
    <div class="footer">
        <div class="map_item">
            <div class="map_title"><a href="backend.php">后端技术</a>顾问 </div>
            <div class="map_name"><a href="#">庞尹春</a></div>
            <div class="map_name"><a href="#">菜鸟</a></div>
        </div>
        <div class="map_item">
            <div class="map_title"> <a href="#">前端技术顾问</a> </div>
            <div class="map_name"><a href="#">曹治宾</a></div>
            <div class="map_name"><a href="#">界面特别好看</a></div>
        </div>
        <div class="map_item">
            <div class="map_title"> <a href="#">PS部门部长</a> </div>
            <div class="map_name"><a href="#">王嘉鑫</a></div>
            <div class="map_name"><a href="#">图标</a></div>
        </div>
    </div>
    <div class="copyright_bg">
        <div class="copyright">
            <div class="textsize-16">
                版权所有:长沙理工大学鑫新闻项目&nbsp;地址:湖南省长沙市万家丽南路二段960号至诚轩1栋&nbsp;邮编:410000&nbsp;联系电话:15802667808
            </div>
        </div>
    </div>
</div>
</body>
</html>
