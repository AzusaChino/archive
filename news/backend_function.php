<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>鑫新闻后台新闻</title>
    <link rel="stylesheet" href="main.css" />
   <script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
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
<div class="wrapper"><div class="header"><div class="logo"><a href="main.php"><img src="resources/xin_logo.jpg" /></a></div>
        <div class="top_search"></div>
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
    <?php
    require_once ('conn.php');
    $id = $_GET['id'];
    $query = "SELECT * FROM news WHERE id='$id'";
    $result = $conn->query($query);
    while ($row=$result->fetch_assoc()) {
    ?>
    <div class="form">
        <form action="" method="post">
            <table>
                <tr>
                    <th colspan="2"><h3>新闻修改</h3></th>
                </tr>
                <tr>
                    <td>新闻编号:</td>
                    <td><input class="text" type="text" name="id" value="<?= $row['id'] ?>" readonly/></td>
                </tr>
                <tr>
                    <td>新闻标题:</td>
                    <td><input class="text" type="text" name="title" value="<?= $row['title'] ?>" /></td>
                </tr>
                <tr>
                    <td>发布时间:</td>
                    <td><input class="text" id="time" type="text" name="date" value="<?=$row['date']?>"/></td>
                </tr>
                <tr>
                    <td>发布人:</td>
                    <td><input class="text" type="text" name="publisher" value="<?=$row['publisher'] ?>"/></td>
                </tr>
                <tr>
                    <td>新闻栏目:</td>
                    <td width="200px"><select name="type">
                            <?php
                            $query_ = "SELECT * FROM type";
                            $result_ = $conn->query($query_);
                            while($row_ = $result_->fetch_assoc()){
                                ?>
                                <option value="<?=$row_['type_name']?>" <?php if($row_['type_name']==$row['type']){ echo "checked=\"checked\"";}?>><?=$row_['type_name']?></option><?php }?>
                        </select> </td>
                </tr>
                <tr>
                    <td>新闻内容:</td>
                    <td width="800px"><textarea id="editor1" rows="10" cols="80" name="content"><?=$row['content']?></textarea>
                        <script>
                            CKEDITOR.replace( 'editor1' );
                        </script></td>
                </tr>
                <tr>
                    <td>显示状况:</td>
                    <td><input type="radio" name="value" value="1" <?php if ($row['value'] == "1") {
                            echo "checked=\"checked\"";
                        } ?>/>显
                        <input type="radio" name="value" value="0" <?php if ($row['value'] == "0") {
                            echo "checked=\"checked\"";
                        } ?>/>隐
                    </td>
                </tr>
                <tr>
                    <td><input class="button" type="submit" name="modify" value="修改"/>
                        <input class="button" type="submit" name="delete" value="删除"/></td>
                    <td><input class="button" type="button" value="返回管理主页" onclick="location.href='backend.php'"/>
                    </td>
                </tr>
            </table>
        </form>
        <?php
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
                    版权所有:长沙理工大学鑫新闻项目|地址:湖南省长沙市万家丽南路二段960号至诚轩1栋|邮编:410000|联系电话:
                    <tel>15802667808</tel>
                </div>-
            </div>
        </div>
    </div>
    <?php
    if(isset($_POST['modify'])){
        $title= $_POST['title'];
        $date= $_POST['date'];
        $publisher = $_POST['publisher'];
        $type= $_POST['type'];
        $content= $_POST['content'];
        $value=$_POST['value'];
        $query1 = "UPDATE news SET title='$title',date='$date',publisher='$publisher',type='$type',content='$content',value='$value' WHERE id='$id'";
        echo $query1;
        $conn->query($query1)or die("修改失败");
        echo "<script>alert('修改成功');location.href='backend.php'</script>";
    }elseif(isset($_POST['delete'])){
        $query2 = "DELETE FROM news WHERE id='$id'";
        $conn->query($query2)or die("删除失败");
        echo "<script>alert('删除成功');location.href='backend.php'</script>";
    }
    ?>
</body>
</html>