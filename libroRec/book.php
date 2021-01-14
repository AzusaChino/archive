<!DOCTYPE html>
<HTML>
<head>
    <title>图书详细页</title>
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
    }else
        echo "<script>alert('未登录用户不允许入内');location.href='index.php'</script>";

    $book_id = $_GET['book_id'];
    if(!isset($book_id)){
        echo "<script>confirm('发生未知错误，返回推荐首页');location.href='main.php'</script>";
    }
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
                <LI><A href="history.php">借阅记录</A></LI>
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
    <div id="book">
        <div class="article">
            <?php
            $query = "select * from books where book_id='$book_id'";
            $result = $connect->query($query);
            $row = $result->fetch_assoc();
            ?>
            <h1>&nbsp;&nbsp;<?=$row['title']?></h1>
            <div id="book-basic-info">
                <div class="basic-content">
                    <ul>
                        <?php
                        if(isset($manager_id)) {
                            ?>
                            <li>馆内图书号:<?= $row['book_id'] ?></li>
                            <?php
                        }
                        ?>
                        <li>作者:<?=$row['author']?></li>
                        <li>出版年份:<?=$row['publish_year']?></li>
                        <li>出版社:<?=$row['publisher']?></li>
                        <li>图书馆查询号:<?=$row['search_id']?></li>
                        <!--<li>馆藏地址：库本阅览室;已借出;库本阅览室;已借出;</li>-->
                        <li>ISBN:<?=$row['ISBN']?></li>
                        <li>借阅次数：<?=$row['book_count']?></li>
                        <li class="button"><a href="javascript:history.back(-1)">返回</a>
                            <?php
                            if(isset($manager_id)) {
                                ?>
                                <span class="button"><a href="book_correct.php?book_id=<?=$row['book_id']?>">修改</a> </>
                                <?php
                            }
                            ?>
                        </li>


<!--                        <li class="button"><a href="http://162.105.138.200/uhtbin/f001/012017147623" title="库本阅览室;已借出;库本阅览室;已借出;" alt="库本阅览室;已借出;库本阅览室;已借出;" target="_blank">我要借阅</a></li>-->
                    </ul>
                </div>
                <div class="basic-image"><img style="height: 400px;width: 300px" src="<?=$row['url']?>"></div>
            </div>

        </div>
    </div>
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