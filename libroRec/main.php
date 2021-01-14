<!DOCTYPE html>
<HTML>
<head>
    <title>图书推荐首页</title>
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
    <div class="bottom">
        <div class="title">热门推荐</div>
    <div id="hot">
            <ul>
                <?php
                $array_collection = $array_dislike = $array_unseen = $array_list = $array_stu = $array_interim = $arrayS = $array_rec = $array_rank = $interim = array();

                $query = "select * from collections where stu_id='$stu_id'";
                $result = $connect->query($query);
                while($row=$result->fetch_assoc()){
                    array_push($array_collection,$row['book_id']);
                }
                $query0 = "select * from dislike where stu_id='$stu_id'";
                $result0 = $connect->query($query0);
                while($row0 = $result0->fetch_assoc()){
                    array_push($array_dislike,$row0['book_id']);
                }

                $array_unseen =array_merge($array_collection,$array_dislike);//contain dislike and collection,which can't be seen in the rec

                $query1= "select * from books ORDER BY book_count DESC";
                $result1= $connect->query($query1);
                $z =5;
                for($j=0;$j<$z;$j++){
                    $row1=$result1->fetch_assoc();
                   if(in_array($row1['book_id'],$array_unseen)){
                       $z++;
                   }else{
                    ?>
                    <li>
                        <a href="book.php?book_id=<?=$row1['book_id']?>">
                            <img height="300" width="200" src="<?=$row1['url']?>"><span style="font-size: 20px"><?=$row1['title']?></span>
                        </a> <br>
                        <?php if(isset($stu_id)){ ?>
                            <a href="like.php?book_id=<?= $row1['book_id'] ?>&stu_id=<?= $stu_id ?>" class="dislike">收藏</a>
                        <a href="dislike.php?book_id=<?= $row1['book_id'] ?>&stu_id=<?= $stu_id ?>" class="dislike">不感兴趣</a>
                            <?php }?>
                    </li>
                    <?php
                } }
                ?>
            </ul>
        </div>
        <?php
        if(isset($manager_id)){
            ?>
        <h1 style="text-align: center;color:#ff0000">管理员没有个性化推荐</h1>
            <?php
        }
        ?>
        <?php
        if(isset($stu_id)){
            $query2 = "select * from borrow_list where stu_id='$stu_id' order by borrow_id DESC";
            $result2 = $connect->query($query2) ;
            while($row2 = $result2->fetch_assoc()) {
            array_push($array_list,$row2['book_id']);//get the borrow list of current student(contains book_id)
            $array_list=array_unique($array_list);
            }
            if(count($array_list)>=5){
            ?>
        <div class="title" >个性化推荐</div>
        <div id="similarity">
            <ul>
                <?php
                $query3 = "select * from student where stu_id!='$stu_id' order by stu_id";
                $result3 = $connect->query($query3);
                while ($row3 = $result3->fetch_assoc()) {
                    if($row3['borrow_count']>=5){
                    array_push($array_stu, $row3['stu_id']);//get the list of all other students(stu_id)
                        // only serves for user borrow over 5 books
                }
                }
                for ($b = 0; $b < sizeof($array_stu); $b++) {
                    $id = $array_stu[$b];
                    $query4 = "select * from borrow_list where stu_id='$id' order by borrow_id DESC";
                    $result4 = $connect->query($query4) ;
                    while($row4 = $result4->fetch_assoc()) {
                        array_push($array_interim,$row4['book_id']);//get the borrow list of current student(contains book_id)
                        $array_interim=array_unique($array_interim);
                    }
                    $similarity = (count(array_intersect($array_list, $array_interim))) / count(array_unique(array_merge($array_list, $array_interim)));
                    array_push($arrayS, $similarity);//$arrayS contains all similarity of this stu with current stu
                }
                $array_last=array_combine($array_stu,$arrayS);//关联数组 key为学号 value为相似度
                $a=0;
                foreach($array_last as $key=>$sim){
                    $query5 = "select * from borrow_list where stu_id='$key' order by borrow_id DESC";
                    $result5 = $connect->query($query5);
                    while($row5 = $result5->fetch_assoc()) {
                        array_push($array_rank,$row5['book_id']);//get the borrow list of the highest similarity student(contains book_id)
                        $array_rank=array_unique($array_rank);
                    }
                    $array_rec=array_unique(array_merge($interim,array_diff($array_rank, $array_list)));//find all different books high stu->current stu and add to last rec
                $a++;
                if($a>=3){
                    break;
                } }
                foreach ($array_rec as $id_rec) {
                    $c = 0;
                    $query6 = "select * from books where book_id='$id_rec'";
                    $result6 = $connect->query($query6);
                    $row6 = $result6->fetch_assoc();
                    if(in_array($row6['book_id'],$array_unseen)){
                    }else{
                    ?>
                    <li>
                        <a href="book.php?book_id=<?= $row6['book_id'] ?>">
                            <img height="300" width="200" src="<?= $row6['url'] ?>"><span style="font-size: 20px"><?= $row6['title'] ?></span>
                        </a> <br>
                        <a href="like.php?book_id=<?= $row6['book_id'] ?>&stu_id=<?= $stu_id ?>" class="dislike">收藏</a>
                        <a href="dislike.php?book_id=<?= $row6['book_id'] ?>&stu_id=<?= $stu_id ?>" class="dislike">不感兴趣</a>
                    </li>
                    <?php
                    $c++;
                    if ($c == 5) {
                        break;
                    } } }
                ?>
            </ul>
        </div>
            <?php
        }else {
                ?>
        <h1 style="text-align: center;color:#ff0000">您尚未借阅5本及以上图书，没有个性化推荐</h1>
        <?php
            } }
        ?>
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