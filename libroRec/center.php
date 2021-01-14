<!DOCTYPE html>
<HTML>
<head>
    <title>推荐系统管理页</title>
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
    ?>

    <div class="top">
        <img class="pic" src="resource/top.jpg" />
    </div>
    <div class="header">
        <div class="nav">
            <UL>
                <LI class="onelink"><A href="main.php" target="">推荐主页</A> </LI>
                <LI><A href="book_add.php" rel="dropmenu3" target="">添加图书</A> </LI>
                <li><a href="history.php">借阅记录</a></li>
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
        <div class="search">
            <form action="search.php" method="get">
                <input class="search_box" type="text" name="search" placeholder="输入书名以查询"/>
                <input type="submit" class="submit" name="submit" value="查询" />
            </form>
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
                    <div class="input"><input class="inputbox" type="text"  name="stu_id" required="required" placeholder="请输入学号"/>
                    </div></div>
                <div class="conbox">
                    <div class="boxname"><span>图书号</span></div>
                    <div class="input"><input class="inputbox" type="text"  name="book_id" required="required" placeholder="请输入图书号"/>
                    </div></div>
                <div class="conbox">
                    <div class="boxname"><span>借阅时间</span></div>
                    <div class="input"><input class="inputbox" type="text" name="borrow_time" required="required" placeholder="请以'-'分隔年月日" />
                    </div></div>
                <input type="submit" class="submit" name="submit" value="登记" />
            </form>
        </div>
        </div>
    </div>

    <?php
    if(isset($_POST['submit'])){
        $stu_id = $_POST['stu_id'];
        $book_id = $_POST['book_id'];
        $borrow_time = $_POST['borrow_time'];

        $query = "insert into borrow_list(stu_id, manager_id, book_id, borrow_time) values ('$stu_id','$manager_id','$book_id','$borrow_time')";
        $connect->query($query) or die("Unknown Error");

        $query2 = "select * from student where stu_id='$stu_id'";
        $result = $connect->query($query2);
        $row = $result->fetch_assoc();
        $borrow_count =$row['borrow_count'];
        $new_count = $borrow_count+1;

        $query3 = "update student set borrow_count='$new_count' where stu_id='$stu_id'";//学生借阅数+1
        $connect->query($query3)or die ("Unknown Error");
        echo "<script>alert('借阅记录登记成功');location.href='center.php'</script>";

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