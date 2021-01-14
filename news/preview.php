<!doctype html>
<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="content-type" />
    <title>鑫新闻后台预览页</title>
    <link rel="stylesheet" href="main.css" />
</head>
<body>
<?php
session_start();
date_default_timezone_set('prc');
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    if($username =="admin"){
    }else
        echo"<script>alert('非管理员不能进入后台');location.href='login.php'</script>";
}else{
    echo"<script>alert('未登录用户不能进入后台');location.href='login.php'</script>";
}
if(isset($_POST['preview'])) {
    $title = $_POST['title'];
    $date =date('y-m-d H:i:s',time());
    $publisher = $_POST['publisher'];
    $type = $_POST['type'];
    $content = $_POST['content'];
}
    require_once ('conn.php');
    $query = "INSERT INTO news(title,date,publisher,type,content) VALUES('$title','$date','$publisher','$type','$content')";
    $conn->query($query) or die("新闻添加失败");
    $query_="SELECT * FROM news WHERE title LIKE '$title'";
    $result_ =$conn->query($query_)or die("预览失败");
?>
<div class="wrapper">
    <div class="header">
        <div class="logo"><a href="main.php"><img src="resources/xin_logo.jpg"/></a></div>
    </div>
    <div class="nav">
        <ul>
          <li><a href="main.php">主页</a></li>
          <li><a href="news.php?type=国内新闻">国内新闻</a></li>
          <li><a href="news.php?type=国际新闻">国际新闻</a></li>
          <li><a href="news.php?type=社会">社会</a></li>
          <li><a href="news.php?type=娱乐">娱乐</a></li>
          <li><a href="news.php?type=科技">科技</a></li>
          <li><a href="https://www.baidu.com" >更多</a></li>
        </ul>
    </div>
    <div class="content_preview">
        <?php
        while($row_ = $result_->fetch_assoc()){
        ?>
        <div class="content_header"><?= $row_['title'] ?></div>
        <div class="info">
            <p><span>发布人:<?=$row_['publisher'] ?></span>&nbsp;&nbsp;<span>发布时间:<?=$row_['date'] ?></span></p>
        </div>
        <div class="content"><?= $row_['content'] ?></div> <?php }?>
    </div>
    <div class="submit">
        <form action="preview_function.php" method="post">
            <table>
                <tr>
                    <td>
                        <input class="button" type="submit" name="submit_preview" value="发布"/></td>
                    <td><input class="button" id="button" type="button" value="返回" onclick="location.href='backend.php'"/></td>
                </tr>
            </table>
        </form>
    </div>
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
</body>
</html>
