<!DOCTYPE html>
<HTML>
<head>
    <title>借阅历史更新页</title>
    <meta content="text/html" charset="UTF-8">
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/bootstrap.css"/>
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
        if(isset($manager_id)){

        }else{
            echo "<script>alert('非管理员不允许入内');location.href='index.php'</script>";
        }
    }else
        echo "<script>alert('未登录用户不允许入内');location.href='index.php'</script>";

    $borrow_id = $_GET['borrow_id'];

    if(isset($borrow_id)) {
        $query0 = "select * from borrow_list join books on borrow_list.book_id=books.book_id where borrow_id='$borrow_id'";
        $result0 = $connect->query($query0);
        $row0 = $result0->fetch_assoc();

    }else{
        echo "<script>alert('Unknown Error');location.href='history.php'</script>";
    }
    ?>

    <div class="top">

        <img class="pic" src="resource/top.jpg" />
    </div>
    <div class="header">
        <div class="nav">
            <UL>
                <LI class="onelink"><A href="main.php" target="">推荐主页</A> </LI>
                <LI><A href="book_add.php" rel="dropmenu3" target="">添加图书</A> </LI>
                <li><a href="history.php">借阅历史</a></li>
                <li><a href="center.php">管理中心</a></li>
                <LI><A href="password.php" rel="dropmenu4" target="">修改密码</A> </LI>
                <LI><A href="logout.php" target="">注销</A> </LI>
            </UL>
        </div>
        <div class="banner">
            <img src="resource/banner.jpg" >
        </div>
    </div>
    <div class="top">
        <div style="text-align: center" class="welcome">
            <h3>欢迎&nbsp;<?=$user_name?></h3>
        </div>

    </div>
    <div class="wrapper_login">
        <div class="login">
            <div class="form">
                <form action="#" method="post">
                    <div class="conbox">
                        <div class="boxname"><span>管理员ID</span></div>
                        <div class="input"><input class="inputbox" type="text"  name="manager_id" value="<?=$manager_id?>" disabled="disabled"/>
                        </div></div>
                    <div class="conbox">
                        <div class="boxname"><span>学号</span></div>
                        <div class="input"><input class="inputbox" type="text"  name="stu_id" value="<?=$row0['stu_id']?>"/>
                        </div></div>
                    <div class="conbox">
                        <div class="boxname"><span>图书号</span></div>
                        <div class="input"><input class="inputbox" type="text"  name="book_id" value="<?=$row0['book_id']?>"/>
                        </div></div>
                    <div class="conbox">
                        <div class="boxname"><span>图书名</span></div>
                        <div class="input"><input class="inputbox" type="text"  name="title" value="<?=$row0['title']?>"/>
                        </div></div>
                    <div class="conbox">
                        <div class="boxname"><span>借阅时间</span></div>
                        <div class="input"><input class="inputbox" type="text" name="borrow_time" value="<?=$row0['borrow_time']?>" placeholder="请以'-'分隔年月日" />
                        </div></div>
                    <div class="conbox">
                        <div class="boxname"><span>归还时间</span></div>
                        <div class="input"><input class="inputbox" type="text" name="return_time" required="required" placeholder="请以'-'分隔年月日" />
                        </div></div>
                    <input type="submit" class="submit" name="submit" value="更新" />
                </form>
            </div>
        </div>
    </div>

    <?php
    if(isset($_POST['submit'])){
        $stu_id=$_POST['stu_id'];
        $book_id = $_POST['book_id'];
        $borrow_time = $_POST['borrow_time'];
        $return_time = $_POST['return_time'];

        $sql1 = "select * from books where book_id='$book_id'";//获取原借阅数
        $result1= $connect->query($sql1);
        $row1 = $result1->fetch_assoc();
        $count = $row1['book_count'];

        $countNew = $count+1;

        $sql2 = "update books set book_count='$countNew' where book_id='$book_id'";//总借阅数+1

        $connect->query($sql2) or die("Unknown Error");

        $query = "update borrow_list set return_time='$return_time' where borrow_id='$borrow_id'";//更新借阅记录

        $connect->query($query) or die("Unknown Error");

        echo "<script>alert('借阅归还成功');location.href='history.php'</script>";

    }
    ?>
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