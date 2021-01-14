<!DOCTYPE html>
<HTML>
<head>
    <title>图书添加页</title>
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
                <li><a href="history.php">借阅历史</a></li>
                <LI><A href="center.php">管理中心</A></LI>
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
                        <div class="boxname"><span>馆内查询号</span></div>
                        <div class="input"><input class="inputbox" type="text"  name="search_id" required="required" placeholder="请输入馆内查询号" />
                        </div></div>
                    <div class="conbox">
                        <div class="boxname"><span>ISBN</span></div>
                        <div class="input"><input class="inputbox" type="text"  name="ISBN" required="required" placeholder="请输入ISBN号"/>
                        </div></div>
                    <div class="conbox">
                        <div class="boxname"><span>图书名</span></div>
                        <div class="input"><input class="inputbox" type="text"  name="title" required="required" placeholder="请输入图书名"/>
                        </div></div>
                    <div class="conbox">
                        <div class="boxname"><span>作者</span></div>
                        <div class="input"><input class="inputbox" type="text"  name="author" required="required" placeholder="请输入作者名"/>
                        </div></div>
                    <div class="conbox">
                        <div class="boxname"><span>出版日期</span></div>
                        <div class="input"><input class="inputbox" type="text"  name="publish_year" required="required" placeholder="请以'.'分隔年月"/>
                        </div></div>
                    <div class="conbox">
                        <div class="boxname"><span>出版社</span></div>
                        <div class="input"><input class="inputbox" type="text"  name="publisher" required="required" placeholder="请输入出版社名"/>
                        </div></div>
                    <div class="conbox">
                        <div class="boxname"><span>封面地址</span></div>
                        <div class="input"><input class="inputbox" type="text"  name="url" required="required" placeholder="请输入图书封面地址"/>
                        </div></div>
                    <div class="conbox">
                        <div class="boxname"><span>图书分类号</span></div>
                        <div class="input"><input class="inputbox" type="text" name="tag_id" required="required" placeholder="请输入图书分类号" />
                        </div></div>
                    <input type="submit" class="submit" name="submit" value="添加" />
                </form>
            </div>
        </div>
    </div>

    <?php
    if(isset($_POST['submit'])){
        $search_id = $_POST['search_id'];
        $ISBN = $_POST['ISBN'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publish_year = $_POST['publish_year'];
        $publisher  = $_POST['publisher'];
        $url = $_POST['url'];
        $tag_id = $_POST['tag_id'];

        $query = "insert into books(search_id, ISBN, title, author,publish_year,publisher,url,tag_id) values ('$search_id', '$ISBN', '$title', '$author','$publish_year','$publisher','$url','$tag_id')";
        $connect->query($query) or die("Unknown Error");

        echo "<script>alert('图书添加成功');location.href='center.php'</script>";

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