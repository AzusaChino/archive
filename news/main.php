<!doctype HTML>
<html>
<head>
    <meta content="text/html;charset=utf-8" />
   <title>鑫新闻唯一正版网站</title>
    <script src="js/main.js" ></script>
    <link rel="stylesheet" href="main.css" />
</head>
<body>
<div class="wrapper">
        <?php
        session_start();
        require_once ('conn.php');
        if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "<div class=\"top_login\"><a href=\"logout.php\"><img src=\"resources/logout.jpg\"></a></div>";
            }else{
                $username ="用户(未登录)";
            echo " <div class=\"top_login\">
            <a href=\"login.php\"><img src=\"resources/login.jpg\"></a><a href=\"register.php\"><img src=\"resources/register.jpg\" ></a></div>";
            }
            ?>
    <div class="header"><div class="logo"><a href="main.php"><img src="resources/xin_logo.jpg" /></a></div>
    <div class="welcome">欢迎:&nbsp;<?=$username?></div>
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
    <div class="main_content">
            <div class="wrap" id="wrap">
                <ul id="pic" style="left:0">
                    <li> <a href="#"><img src="resources/computer.jpg" alt="1" width="500px" height="340px" /></a> </li>
                    <li> <a href="#"><img src="resources/surface_2.jpg" alt="2" width="500px" height="340px" /></a> </li>
                    <li> <a href="#"><img src="resources/mac_1.jpg" alt="3" width="500px" height="340px" /></a> </li>
                    <li> <a href="#"><img src="resources/mac_2.jpg" alt="4" width="500px" height="340px" /></a> </li>
                </ul>
                <ul id="list">
                    <li class="on"></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <a href="javascript:" class="Prev" id="Prev"></a>
                <a href="javascript:" class="Next" id="Next"></a>
            </div>
                <?php
                $query_ = "select * from type where value='1' ORDER BY type_id";
                 $result_ = $conn->query($query_);
                 for($i=0;$i<5;$i++){
                 $row_ = $result_->fetch_assoc();
                 if($row_){
                     $type=$row_['type_name'];
                     ?>
                 <div class="pannel">
                     <div title="pannel_title">
                         <div class="title_more">
                             <a href="news.php?type=<?=$type?>">MORE+</a>
                         </div>
                         <div class="title_text"><?=$type?></div>
                         <div class="clearBoth"></div>
                     </div>
                     <div class="news_content"><ul>
                             <?php
                             $query = "SELECT * FROM news WHERE type='$type'&& value='1' ORDER BY  date DESC";
                             $result=$conn->query($query);
                             for($j=0;$j<5;$j++){
                                 $row = $result->fetch_assoc();
                                 if($row){
                                     ?>
                                     <li><a href="page.php?id=<?=$row['id']?>"><?=$row['title']?></a></li>
                                 <?php } } ?></ul>
                     </div>
            </div>
                     <?php } } ?>
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
                版权所有:长沙理工大学鑫新闻项目&nbsp;地址:湖南省长沙市万家丽南路二段960号至诚轩1栋&nbsp;邮编:410000&nbsp;联系电话:15802667808
        </div>
    </div>
</div>
</div>
</body>
</html>
