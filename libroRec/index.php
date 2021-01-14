<!DOCTYPE html>
<HTML>
<head>
    <title>图书推荐系统登陆页</title>
    <meta content="text/html" charset="UTF-8">
    <link rel="stylesheet" href="css/main.css" />
    <script src="js/jquery-1.11.3.min.js"></script>
    <script>
        window.onload=function () {
            var tch =document.getElementById('tch');
            var stu =document.getElementById('stu');
            var login_tch = document.getElementById('login_tch');
            var login_stu = document.getElementById('login_stu');
            tch.onmouseover=function () {
                tch.style.color='#ff0000';
                login_tch.style.display='block';
                stu.style.color='#0000cc';
                login_stu.style.display='none';
            }
            stu.onmouseover=function () {
                stu.style.color='#ff0000';
                login_stu.style.display='block';
                tch.style.color='#0000cc';
                login_tch.style.display='none';
            }
        }
    </script>
</head>
<body>
<div class="wrapper">
    <?php
    session_start();
    require_once ('conn.php');
    ?>
    <div class="top">
        <img class="pic" src="resource/top.jpg" />
    </div>
    <div class="header">
        <div class="nav">
            <UL>
                <LI class="onelink"><A href="main.php" target="">推荐主页</A> </LI>
                <LI><A href="history.php">借阅历史</A></LI>
                <LI><A href="password.php" rel="dropmenu4" target="">修改密码</A> </LI>
            </UL>
        </div>
        <div class="banner">
            <img src="resource/banner.jpg" >
        </div>
    </div>
    <div class="wrapper_login">
        <div class="choice">
            <span id="tch" style="color:#0000cc">管理员入口</span>
            <span id="stu" style="color:#ff0000">学生入口</span>
        </div>
        <div class="login" >
            <div  style="display: none" id="login_tch">
                <div class="form">
                    <form action="#" method="post">
                        <div class="conbox">
                            <div class="boxname"><span>管理员号:</span></div>
                            <div class="input"><input class="inputbox" type="text"  name="manager_id" required="required" placeholder="请输入管理员号"/>
                            </div></div>
                        <div class="conbox">
                            <div class="boxname"><span>密码:</span></div>
                            <div class="input"><input class="inputbox" type="password" name="manager_password" required="required" placeholder="请输入管理员密码"/>
                            </div></div>
                        <input type="submit" class="submit" name="submit" value="登录" />
                    </form>
                </div>
            </div>
            <div id="login_stu" style="display: block">
                <div class="form">
                    <form action="#" method="post">
                        <div class="conbox">
                            <div class="boxname"><span>学号:</span></div>
                            <div class="input"><input class="inputbox" type="text"  name="stu_id" required="required" placeholder="请输入学号"/>
                            </div></div>
                        <div class="conbox">
                            <div class="boxname"><span>密码:</span></div>
                            <div class="input"><input class="inputbox" type="password" name="stu_password" required="required" placeholder="请输入学生密码"/>
                            </div></div>
                        <input type="submit" class="submit" name="submit" value="登录" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if(isset($_POST['submit'])){
        if(isset($_POST['stu_id'])) {
            $stu_id = $_POST['stu_id'];
            $stu_password = $_POST['stu_password'];
            $query = "select * from student where stu_id ='$stu_id'";
            $result = $connect->query($query);
            $row = $result->fetch_assoc();
            if ($row['stu_id'] == $stu_id && $row['stu_password'] == $stu_password) {
                $_SESSION['user_name']= $row['stu_name'];
                $_SESSION['stu_id']=$row['stu_id'];
                echo "<script>alert('登陆成功,前往图书推荐页');location.href='main.php'</script>";
            } else{
                echo "<script>alert('用户名或密码错误,登陆失败');location.href='index.php'</script>";
            }
        }
        else if(isset($_POST['manager_id'])){
            $manager_id=$_POST['manager_id'];
            $manager_password=$_POST['manager_password'];
            $query  = "select * from manager where manager_id='$manager_id'";
            $result = $connect->query($query);
            $row = $result->fetch_assoc();
            if($row['manager_id'] == $manager_id && $row['manager_password'] == $manager_password){
                $_SESSION['user_name']=$row['manager_name'];
                $_SESSION['manager_id'] = $row['manager_id'];
                echo "<script>alert('登陆成功,前往推荐系统管理中心');location.href='center.php'</script>";
            }else{
                echo "<script>alert('用户名或密码错误,登陆失败');location.href='index.php'</script>";
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
                <P>Copyright &copy; PYC All rights reserved<BR>本网站由长沙理工大学图书馆图书推荐系统管理部制作和维护 联系方式:azusa146@gmail.com</P>
            </div>
        </DIV>
    </DIV>
</div>
</body>
</HTML>