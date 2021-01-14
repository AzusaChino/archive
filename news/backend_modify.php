<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>鑫新闻后台修改删除</title>
    <link rel="stylesheet" href="main.css" />
    <script src="ckeditor/ckeditor.js" ></script>
</head>
<body>
<?php
session_start();
require_once ('conn.php');
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    if($username =="admin"){
    }else
        echo"<script>alert('非管理员不能进入后台');location.href='login.php'</script>";
}else{
    echo"<script>alert('未登录用户不能进入后台');location.href='login.php'</script>";
}
?>
<div class="wrapper"><div class="header"><div class="logo"><a href="main.php"><img src="resources/xin_logo.jpg" /></a></div>
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
    <div class="form">
        <form action="" method="post" >
            <table><tr><td>选择栏目:</td><td width="200px"><select id="type" name="type">
                            <?php
                            $query = "SELECT * FROM type ";
                            $result = $conn->query($query);
                            $num = $result->num_rows;
                            for($i=0;$i<$num;$i++){
                                $row = $result->fetch_assoc() ?>
                                <option value="<?=$row['type_name']?>"><?php
                                if(isset($_POST['type'])){
                                    if($i==0){
                                    $type_=$_POST['type'];
                                    echo $type_;}
                                    elseif($i!=0&&$row['type_name']==$_POST['type']){
                                        $type_2 ="国内新闻" ;
                                        echo $type_2;
                                    }
                                    else{
                                    $type_3 = $row['type_name'];
                                    echo $type_3;}
                                }
                                else{
                                     $type_ = $row['type_name'];
                                     echo $type_;
                                }
                                ?></option><?php }?>
                        </select></td>
            <td><input class="button" type="submit" name="submit" value="更换栏目"/></td>
            </tr>
            </table>
        </form>
    </div>
    <div class="form">
        <table><?php
            if(isset($_POST['type'])){
            $type = $_POST['type'];
            }else{
                $type="国内新闻";
            }?>
            <tr><th colspan="6"><h2>新闻管理</h2>当前栏目(<?=$type?>)</th><th><input class="button" type="button" value="返回管理主页" onclick="location.href='backend.php'"/></th></tr>
            <tr><td width="100px">标题</td><td>内容</td><td>时间</td><td>发布人</td><td>显</td> <td>隐</td><td>修改</td></tr>
            <?php
             $query = "SELECT * FROM news WHERE type='$type' ORDER BY id";
             $result = $conn->query($query);
                 while ($row=$result->fetch_assoc()){
            ?>
            <tr><td><?=$row['title']?></td><td class="content">
                    <?=$row['content']?>
                </td>
                <td><?=$row['date']?></td><<td><?=$row['publisher']?></td><td><?php
                    if($row['value']==1){
                        echo "√";
                    }
                    ?></td><td><?php
                    if($row['value']==0){
                        echo "×";
                    }
                    ?></td>
                <td><a href="backend_function.php?id=<?=$row['id']?>">修改</a> </td></tr>
            <?php }?>
        </table>
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
