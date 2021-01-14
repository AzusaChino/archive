<!DOCTYPE html>
<HTML>
<head>
    <title>密码修改页</title>
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
    <div class="wrapper_login">
        <div class="login" >
            <?php
            if(isset($manager_id)) {
                ?>
                <div id="login_tch">
                    <div class="form">
                        <form action="#" method="post">
                            <div class="conbox">
                                <div class="boxname"><span>管理员ID</span></div>
                                <div class="input"><input class="inputbox" type="text" name="manager_id"
                                                          required="required" value="<?=$manager_id ?>" disabled="disabled"/>
                                </div>
                            </div>
                            <div class="conbox">
                                <div class="boxname"><span>原密码</span></div>
                                <div class="input"><input class="inputbox" type="password" name="manager_password"
                                                          required="required" placeholder="请输入原密码"/>
                                </div>
                            </div>
                            <div class="conbox">
                                <div class="boxname"><span>新密码</span></div>
                                <div class="input"><input class="inputbox" type="password" name="manager_new_password"
                                                          required="required" placeholder="请输入新密码"/>
                                </div>
                            </div>
                            <div class="conbox">
                                <div class="boxname"><span>确认新密码</span></div>
                                <div class="input"><input class="inputbox" type="password" name="manager_new_repassword"
                                                          required="required" placeholder="请再次输入新密码"/>
                                </div>
                            </div>
                            <input type="submit" class="submit" name="submit" value="确认修改"/>
                        </form>
                    </div>
                </div>
                <?php
            }
            ?>
            <?php
            if(isset($stu_id)){
            ?>
            <div id="login_stu">
                <div class="form">
                    <form action="#" method="post">
                        <div class="conbox">
                            <div class="boxname"><span>学号</span></div>
                            <div class="input"><input class="inputbox" type="text"  name="stu_id" required="required" value="<?=$stu_id?>" disabled="disabled"/>
                            </div></div>
                        <div class="conbox">
                            <div class="boxname"><span>原密码</span></div>
                            <div class="input"><input class="inputbox" type="password" name="stu_password" required="required" placeholder="请输入原密码"/>
                            </div></div>
                        <div class="conbox">
                            <div class="boxname"><span>新密码</span></div>
                            <div class="input"><input class="inputbox" type="password" name="stu_new_password" required="required" placeholder="请输入新密码"/>
                            </div></div>
                        <div class="conbox">
                            <div class="boxname"><span>确认新密码</span></div>
                            <div class="input"><input class="inputbox" type="password" name="stu_new_repassword" required="required" placeholder="请再次输入新密码"/>
                            </div></div>
                        <input type="submit" class="submit" name="submit" value="确认修改" />
                    </form>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
    if(isset($_POST['submit'])){
        if(isset($stu_id)) {
            $stu_password = $_POST['stu_password'];
            $stu_new_password = $_POST['stu_new_password'];
            $stu_new_repassword = $_POST['stu_new_repassword'];
            $sql1 = "select * from student where stu_id='$stu_id'";
            $result1 = $connect->query($sql1);
            $row1 = $result1->fetch_assoc();
            if($stu_password == $row1['stu_password']){
            if($stu_new_password==$stu_new_repassword){
            $query1 = "update student set stu_password='$stu_new_password' where stu_id ='$stu_id'";
            $connect->query($query1) or die("Unknown Error");
            echo "<script>alert('修改成功，请重新登录');location.href='logout.php'</script>";
            }else{
                echo "<script>alert('两次密码不相同,请重试');location.href='password.php'</script>";
            }
            }else {
                echo "<script>alert('原密码错误,请重试');location.href='password.php'</script>";
            }
        }
        else if(isset($manager_id)){
            $manager_password=$_POST['manager_password'];
            $manager_new_password=$_POST['manager_new_password'];
            $manager_new_repassword=$_POST['manager_new_repassword'];
            $sql2 = "select * from manager where manager_id='$manager_id'";
            $result2 = $connect->query($sql2);
            $row2 =$result2->fetch_assoc();
            if($manager_password==$row2['manager_password']){
            if($manager_new_password==$manager_new_repassword){
            $query2  = "update manager set manager_password='$manager_new_password' where manager_id='$manager_id'";
            $connect->query($query2) or die("Unknown Error");
            echo "<script>alert('修改成功，请重新登录');location.href='logout.php'</script>";
            }else{
                echo "<script>alert('密码不相同,请重试');location.href='password.php'</script>";
            }
        }else{
                echo "<script>alert('原密码错误,请重试');location.href='password.php'</script>";
            }
        }
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