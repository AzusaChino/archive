<!doctype html>
<html>
<head>
    <title>欢迎来到鑫新闻</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="main.css" />
</head>
<body>
<?php
require_once ('conn.php');
$type = $_GET['type'];
?>
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
    <div class="content_list">
    <div class="func">
    <p>当前位置:<a href="main.php">首页</a>&gt;<?=$type?></p></div>
       <ul>
           <?php
           $query= "SELECT * FROM news WHERE type='$type'&&value='1' ORDER BY date DESC";
           $result = $conn->query($query);
           if(isset($_GET['page'])&&(int)$_GET['page']>0){
               $page = $_GET['page'];
           }else $page = 1;
           $pagesize=5;
           $recordcount =mysqli_num_rows($result);
           $pagecount=ceil($recordcount/$pagesize);
           $row=$result->fetch_assoc();
           $result->data_seek(($page-1)*$pagesize);
           for($i=0;$i<$pagesize;$i++){
           $row = $result->fetch_assoc();
           if($row){
           ?>
            <li><a href="page.php?id=<?=$row['id']?>"><?=$row['title']?></a></li>
           <?php } }?>
       </ul>

    <p class="page"><?php
        if($page ==1){
            echo "第一页 上一页";
        }    else echo "<a href='?page=1&type=$type'>第一页</a>
<a href='?page=".($page-1)."&type=$type'>上一页</a>";
        for($i=1;$i<=$pagecount;$i++){
            if($i==$page) echo "$i ";
            else echo"<a href='?page=$i&type=$type'>$i</a>";
        }if($page == $pagecount){
            echo "下一页 末页";
        }else echo "<a href='?page=".($page+1)."&type=$type'>下一页</a>
<a href='?page=".$pagecount."&type=$type'>末页</a>";
        echo "&nbsp 共".$recordcount."条新闻&nbsp";
        echo "$page/$pagecount 页";
        ?></p>
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
                版权所有:长沙理工大学鑫新闻项目|地址:湖南省长沙市万家丽南路二段960号至诚轩1栋|邮编:410000|联系电话:<tel>15802667808</tel>
            </div>
        </div>
    </div>
</div>
</body>
</html>
