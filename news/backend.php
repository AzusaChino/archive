<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>鑫新闻后台管理</title>
   <link rel="stylesheet" href="main.css" />
</head>
<body>
<?php
session_start();
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    if($username =="admin"){
    }else
        echo"<script>alert('非管理员不能进入后台');location.href='login.php'</script>";
}else{
    echo"<script>alert('未登录用户不能进入后台');location.href='login.php'</script>";
}
?>
<div class="wrapper">
    <div class="header"><div class="logo"><a href="main.php"><img src="resources/xin_logo.jpg" /></a></div>
        </div>
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
    <div class="new_">
        <input type="button" class="button" onclick="location.href='news_add.php'" value="添加新闻"/>
        <input type="button" class="button" onclick="location.href='backend_modify.php'" value="新闻修改"/>
    </div>
    <div class="type_">
       <input type="button" class="button" onclick="location.href='type_add.php'" value="添加栏目"/>
      <input type="button" class="button" onclick="location.href='type_modify.php'" value="栏目修改"/>
    </div>
    <div class="file form">
        <form action="upload_file.php" method="post" enctype="multipart/form-data">
            <table>
                <tr><td><label for="file">图片：</label></td>
            <td><input type="file" name="file" id="file"></td>
          <td>  <input class="button" type="submit" name="submit" value="上传"></td></tr></table>
        </form>
    </div>
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
