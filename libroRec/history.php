<!DOCTYPE html>
<HTML>
<head>
    <title>借阅历史</title>
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
        <div style="text-align: center" class="welcome">
            <h3>欢迎&nbsp;<?=$user_name?></h3>
        </div>
    </div>
    <div class="history">
        <?php
        if(isset($stu_id)) {
            ?>
            <table class="his_table">
                <tr>
                    <th>管理员</th>
                    <th>学生</th>
                    <th>图书名</th>
                    <th>借阅时间</th>
                    <th>归还时间</th>
                </tr>

                <?php
                $sql = "select manager.manager_name,student.stu_name,books.title,borrow_list.borrow_time,borrow_list.return_time from borrow_list 
        join manager on manager.manager_id=borrow_list.manager_id
        join student on student.stu_id=borrow_list.stu_id 
        join books on borrow_list.book_id=books.book_id
        where borrow_list.stu_id='$stu_id' ORDER by borrow_list.borrow_id DESC";
                $result = $connect->query($sql);
                if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
                    $page = $_GET['page'];
                } else $page = 1;
                $pagesize = 10;
                $recordcount = mysqli_num_rows($result);
                $pagecount = ceil($recordcount / $pagesize);
                $row = $result->fetch_assoc();
                $result->data_seek(($page - 1) * $pagesize);
                for ($i = 0; $i < $pagesize; $i++) {
                    $row = $result->fetch_assoc();
                    if ($row) {
                        ?>
                        <tr>
                            <td><?= $row['manager_name'] ?></td>
                            <td><?= $row['stu_name'] ?></td>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['borrow_time'] ?></td>
                            <td><?= $row['return_time'] ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <?php
        }
        ?>
        <?php
        if(isset($manager_id)) {
            ?>
            <table class="his_table">
                <tr>
                    <th>管理员</th>
                    <th>学生</th>
                    <th>图书名</th>
                    <th>借阅时间</th>
                    <th>归还时间</th>
                    <th>更新归还时间</th>
                </tr>
                <?php
                $sql = "select borrow_list.borrow_id,manager.manager_name,student.stu_name,books.title,borrow_list.borrow_time,borrow_list.return_time from borrow_list 
        join manager on manager.manager_id=borrow_list.manager_id
        join student on student.stu_id=borrow_list.stu_id 
        join books on borrow_list.book_id=books.book_id
        where borrow_list.manager_id='$manager_id' ORDER by borrow_list.borrow_id DESC";
                $result = $connect->query($sql);
                if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
                    $page = $_GET['page'];
                } else $page = 1;
                $pagesize = 10;
                $recordcount = mysqli_num_rows($result);
                $pagecount = ceil($recordcount / $pagesize);
                $row = $result->fetch_assoc();
                $result->data_seek(($page - 1) * $pagesize);
                for ($i = 0; $i < $pagesize; $i++) {
                    $row = $result->fetch_assoc();
                    if ($row) {
                        ?>
                        <tr>
                            <td><?= $row['manager_name'] ?></td>
                            <td><?= $row['stu_name'] ?></td>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['borrow_time'] ?></td>
                            <td><?= $row['return_time'] ?></td>
                            <?php
                            if(isset($row['return_time'])){
                                ?>
                                <td>已归还</td>
                                <?php }else{
                            ?><td><a href="update.php?borrow_id=<?=$row['borrow_id']?>">更新</a></td>
                        <?php }
                    }
                }
                ?>
                        </tr>
            </table>
            <?php
        }
        ?>
    </div>
    <p class="page"><?php
        if($page ==1){
            echo "第一页 上一页";
        }    else echo "<a href='?page=1'>第一页</a>
<a href='?page=".($page-1)."'>上一页</a>";
        for($i=1;$i<=$pagecount;$i++){
            if($i==$page) echo "$i ";
            else echo"<a href='?page=$i'>$i</a>";
        }if($page == $pagecount){
            echo "下一页 末页";
        }else echo "<a href='?page=".($page+1)."'>下一页</a>
<a href='?page=".$pagecount."&'>末页</a>";
        echo "&nbsp 共".$recordcount."条记录&nbsp";
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