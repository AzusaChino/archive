<!doctype html>
<?php
require_once ('conn.php');
$id = $_GET['id'];
$sql = "UPDATE news SET hits=hits+1 WHERE id=$id";
$conn->query($sql);
$query = "SELECT * FROM news WHERE id='$id'&&value='1' ORDER BY date ";
$result = $conn->query($query);
$row = $result->fetch_assoc();
?>
<html>
<head>
    <title><?=$row['title']?>-来自鑫新闻</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <link rel="stylesheet" href="main.css" />
    <script>
        window.onload=function () {
            oDiv = document.getElementById('elm');+
            function getQueryVariable(variable)
            {
                var query = window.location.search.substring(1);
                var vars = query.split("&");
                for (var i=0;i<vars.length;i++) {
                    var pair = vars[i].split("=");
                    if(pair[0] == variable){return pair[1];}
                }
                return(false);
            }
            elm_id=getQueryVariable(id);
        if(elm_id==22){
            oDiv.style.display="block";
        }else{
            oDiv.style.display="none";
        }
        }
    </script>
</head>
<body>
<div class="wrapper">
    <?php
    session_start();
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "<div class=\"top_login\"><a href=\"logout.php\"><img src=\"resources/logout.jpg\"></a></div>";
    }else{
        $username ="用户(未登录)";
        echo " <div class=\"top_login\"><a href=\"login.php\"><img src=\"resources/login.jpg\"></a><a href=\"register.php\"><img src=\"resources/register.jpg\" ></a></div>";
    }
    ?>
    <div class="header"><div class="logo"><a href="main.php"><img src="resources/xin_logo.jpg" /></a></div>
        <div class="top_search"></div>
        <div class="welcome">欢迎:<?=$username?></div></div>
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
    <div class="func">
        当前位置:<a href="main.php">首页</a>&gt;<a href="news.php?type=<?=$row['type']?>"><?=$row['type']?></a>&gt;正文
    </div>
    <div class="page">
    <div class="content_header"><?=$row['title']?></div>
    <div class="info">
        <p><span>发布人:<?=$row['publisher']?></span>&nbsp;&nbsp;<span>发布时间:<?=$row['date']?></span>&nbsp;&nbsp;<span>点击量:<?=$row['hits']?></span></p>
    </div>
    <div class="content"><?=$row['content']?>
      <div class="pic" id="elm">
          <img src="<?=$row['pic']?>" />
      </div>
    </div>
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
                版权所有:长沙理工大学鑫新闻项目|地址:湖南省长沙市万家丽南路二段960号至诚轩1栋|邮编:410000|联系电话:<tel>15802667808</tel>
            </div>
        </div>
    </div>
</div>
</body>
</html>
