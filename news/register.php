<!doctype html>
<html>
<head>
    <title>鑫新闻注册页</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
   <link rel="stylesheet" href="main.css" />
    <script>
        function validateForm(){
            var x = document.forms['register_form']['username'].value;
            var y = document.forms['register_form']['password'].value;
            if(x == null || x ==""){
                alert("请输入用户名");
                return false;
            }
            if(y == null || y ==""){
                alert("请输入密码");
                return false;
            }
        }
    </script>
</head>
<body>
<div class="wrapper">
    <div class="header"><div class="logo"><a href="main.php"><img src="resources/xin_logo.jpg" /></a></div>
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
      <form action="" name="register_form" method="post">
    <table>
        <tr><th class="th" colspan="2"><h2>用户注册</h2></th></tr>
        <tr><td><span>用户名:</span></td>
        <td><input class="text" type="text" name="username" /></td>
        </tr>
        <tr><td><span>密码:</span></td>
            <td><input class="text" type="password" name="password" /></td>
        </tr>
        <tr><td><span>确认密码:</span></td>
            <td><input class="text" type="text" name="repassword" /></td>
        </tr>
        <tr><td><span>邮箱:</span></td>
            <td><input class="text" type="text" name="email" /></td>
        </tr>
        <tr><td><span>年龄</span></td>
            <td><input class="text" type="text" name="age" /></td>
        </tr>
        <tr><td><span>性别</span></td>
            <td><input type="radio" name="sex" value="男"/>男
            <input type="radio" name="sex" value="女"/>女</td>
        </tr>
        <tr><td colspan="2"><input class="button" type="submit" name="submit" value="注册" onclick="validateForm()" />
            <input class="button"  type="reset" value="重置"/></td>
        </tr>
    </table>
</form></div>
<?php
require_once ('conn.php');
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $query = "INSERT INTO user(username,password,age,sex,email) VALUES ('$username','$password','$age','$sex','$email')";
    if($password==$repassword){
        $conn->query($query)or die('注册失败');
        echo "<script>alert('注册成功，跳转登录页');location.href='login.php'</script>";
    }
}
?>
<div class="footer">
    <div class="map_item">
        <div class="map_title"><a href="backend.php">后端技术</a>顾问</div>
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
            版权所有:长沙理工大学鑫新闻项目|地址:湖南省长沙市万家丽南路二段960号至诚轩1栋|邮编:410000|联系电话:15802667808
        </div>
    </div>
</div>
</div>
</body>
</html>
