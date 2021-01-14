<!DOCTYPE html>
<HTML>
<head>
    <title>图书查询页</title>
    <meta content="text/html" charset="UTF-8">
    <link rel="stylesheet" href="css/main.css" />
    <script src="js/jquery-1.11.3.min.js"></script>

</head>
<body>
<div class="wrapper">
    <?php
    session_start();
    require_once ('conn.php');
    if(isset($_SESSION['user_name'])){
        $user_name = $_SESSION['user_name'];
        $stu_id=$_SESSION['stu_id'];
        $manager_id=$_SESSION['manager_id'];
    }else echo "<script>alert('未登录用户不允许入内');location.href='index.php'</script>";

    $key = $_GET['search'];
    ?>

    <div class="top">

        <img class="pic" src="resource/top.jpg" />
    </div>
    <div class="header">
        <div class="nav">
            <UL>
                <LI class="onelink"><A href="main.php" target="">推荐主页</A> </LI>
                <?php
                if(isset($stu_id)) {
                    ?>
                    <LI><A href="collection.php">收藏夹</A></LI>
                    <?php
                }
                ?>
                <LI><A href="history.php">借阅历史</A></LI>
                    <?php
                if(isset($manager_id)) {
                    ?>
                    <LI><A href="center.php">管理中心</A></LI>
                    <LI><A href="book_add.php" rel="dropmenu3" target="">添加图书</A> </LI>
                    <?php
                }
                ?>
                <LI><A href="password.php" rel="dropmenu4" target="">修改密码</A> </LI>
                <LI><A href="logout.php" target="">注销</A> </LI>
            </UL>

        </div>
        <div class="banner">
            <img src="resource/banner.jpg" >
        </div>
    </div>
    <div style="text-align: center" class="welcome">
        <h3>欢迎&nbsp;<?=$user_name?></h3>
    </div>
    <div class="result" style="text-align: center">
        <?php
        $sql = "select * from books where title like '%$key%'";
        $result = $connect->query($sql);
        if(isset($_GET['page'])&&(int)$_GET['page']>0){
            $page = $_GET['page'];
        }else $page = 1;
        $pagesize=10;
        $recordcount =mysqli_num_rows($result);
        $pagecount=ceil($recordcount/$pagesize);
        $row=$result->fetch_assoc();
        $result->data_seek(($page-1)*$pagesize);
        for($i=0;$i<$pagesize;$i++){
        $row = $result->fetch_assoc();
        if($row){
            ?>
            <div class="search_book">
                <a href="book.php?book_id=<?=$row['book_id']?>"><?=$row['title']?></a>
            </div>
        <?php
        }else{
            if($i==0){
                echo "<span style='font-size: 20px;color:#ff5500'>馆内没有相关图书</span>";break;
            }
        }
        }
        ?>
    </div>
    <p class="page"><?php
        if($page ==1){
            echo "第一页 上一页";
        }    else echo "<a href='?page=1&search=$key'>第一页</a>
<a href='?page=".($page-1)."&search=$key'>上一页</a>";
        for($i=1;$i<=$pagecount;$i++){
            if($i==$page) echo "$i ";
            else echo"<a href='?page=$i&search=$key'>$i</a>";
        }if($page == $pagecount){
            echo "下一页 末页";
        }else echo "<a href='?page=".($page+1)."&search=$key'>下一页</a>
<a href='?page=".$pagecount."&search=$key'>末页</a>";
        echo "&nbsp 共".$recordcount."本书&nbsp";
        echo "$page/$pagecount 页";
        ?></p>
    <div class="button_s"><a href="javascript:history.back(-1)">返回上一页</a> </div>
    <DIV class="buttom_nav">
        <TABLE id="buttom" border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
            <TBODY>
            <TR height="20">
                <TD width="100%" colspan="17"></TD></TR>
            <TR height="25" bgcolor="#004580">
                <TD width="3%" align="center"></TD>
                <TD width="11%" align="center"><A href="#" target="_blank">读者协会</A></TD>
                <TD width="1%" align="center">|</TD>
                <TD width="17%" align="center"><A href="#" target="_blank">学科服务平台</A></TD>
                <TD width="1%" align="center">|</TD>
                <TD width="15%" align="center"><A href="#" target="_blank">国学读书会</A></TD>
                <TD width="1%" align="center">|</TD>
                <TD width="13%" align="center"><A href="#" target="_blank">移动图书馆</A></TD>
                <TD width="1%" align="center">|</TD>
                <TD width="11%" align="center"><A href="#" target="_blank">新生专栏</A></TD>
                <TD width="1%" align="center">|</TD>
                <TD width="3%" align="center"></TD></TR></TBODY></TABLE></DIV>
    <DIV class="copy">
        <DIV class="copyright" align="center"><div class="copyrightfont">
                <P>Copyright &copy; PYC All rights reserved<BR>本网站由长沙理工大学图书馆个性化图书推荐系统管理部制作和维护 联系方式:azusa146@gmail.com</P>
            </div>
        </DIV>
    </DIV>

</div>
</body>
</HTML>