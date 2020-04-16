<?php include 'header.php'?>

<?php
if(!isset($_SESSION['email']))
  header('location:login.php');

  $my_array = array("01" => "January","02" => "February","03" => "March","04" => "April","05" => "May","06" => "June","07" => "July","08" => "August","09" => "September","10" => "October","11" => "November","12" => "December");

$emailid=$_SESSION['email'];
mysqli_query($con,"UPDATE chats SET isonline=1 WHERE reciver='$emailid'");

$q="SELECT * FROM customer WHERE email='$emailid' ";
$q_run =mysqli_query($con, $q);

if(!$q_run)
	die("Unable to connect to database".mysqli_error($con));

$result = mysqli_fetch_array($q_run);
$name = $result['firstname']." ".$result['lastname'];

if(isset($_GET['prodtype'])){
$prodtype = $_GET['prodtype'];
$prodid = $_GET['prodid'];
$email = $_GET['email'];
$temp = $prodtype."-".$prodid;

if($email!=$emailid)
    mysqli_query($con, "INSERT INTO chatmsg (email,emailid,product) VALUES('$email','$emailid','$temp')");
}
if(isset($_POST['register'])){
    $sender = $_POST['sender'];
    $reciver = $_POST['reciver'];
    $content = $_POST['content'];
    $product = $_POST['product'];
    $user = $_POST['user'];
    $roll = $_POST['roll'];
    mysqli_query($con, "INSERT INTO chats (sender,reciver,content,product) VALUES('$sender','$reciver','$content','$product')");
    ?>
    <script>location.replace('chat.php?user=<?php echo $user; ?>&roll=<?php echo $roll; ?>&product=<?php echo $product?>')</script>
    <?php
    // header('location:chat.php?user='.$user.'&roll='.$roll.'');
}
if(isset($_GET['worker'])){
if($_GET['worker']=='deleteuser'){
    $sno = $_GET['product'];
    mysqli_query($con, "DELETE FROM chatmsg WHERE sno='$sno'");
    ?>
    <script>location.replace('chat.php')</script>
    <?php
}
}
if(isset($_GET['work'])){
    $user = $_GET['user']; 
    $roll = $_GET['roll'];
    $production = $_GET['product']; 
    // echo $thereciver;
    if($_GET['work']=='deleteall'){
        $thereciver = $_GET['reciver'];
        if($roll=='buy'){
            mysqli_query($con, "UPDATE chatmsg set emaildelete=CURRENT_TIME() WHERE emailid='$emailid' AND email='$thereciver' AND product='$production'");
        } else if($roll=='sell'){
            mysqli_query($con, "UPDATE chatmsg set emailiddelete=CURRENT_TIME() WHERE email='$emailid' AND emailid='$thereciver' AND product='$production'");
        }
    } else if($_GET['work']=='block'){
        $thereciver = $_GET['reciver'];
        if($roll=='buy'){
            mysqli_query($con, "UPDATE chatmsg set emailblock=CURRENT_TIME() WHERE emailid='$emailid' AND email='$thereciver' AND product='$production'");
        } else if($roll=='sell'){
            mysqli_query($con, "UPDATE chatmsg set emailidblock=CURRENT_TIME() WHERE email='$emailid' AND emailid='$thereciver' AND product='$production'");
        }

    } else if($_GET['work']=='unblock'){
        $thereciver = $_GET['reciver'];
        if($roll=='buy'){
            mysqli_query($con, "UPDATE chatmsg set emailblock=0 WHERE emailid='$emailid' AND email='$thereciver' AND product='$production'");
        } else if($roll=='sell'){
            mysqli_query($con, "UPDATE chatmsg set emailidblock=0 WHERE email='$emailid' AND emailid='$thereciver' AND product='$production'");
        }
    }
    else if($_GET['work']=='delete'){
        $thereciver = $_GET['reciver'];
        $tempid = $_GET['id'];
        if($_GET['sender']==$emailid){
            $thereciver = $_GET['reciver'];
            mysqli_query($con, "UPDATE chats set senderdelete=1 WHERE sender='$emailid' AND reciver='$thereciver' AND sno='$tempid'");
        } else if($_GET['reciver']==$emailid){
            $thereciver = $_GET['sender'];
            mysqli_query($con, "UPDATE chats set receverdelete=1 WHERE reciver='$emailid' AND sender='$thereciver' AND sno='$tempid'");
        }
    } 
    else if($_GET['work']=='deleteboth'){
        $tempo = $_GET['id'];
        mysqli_query($con, "DELETE FROM chats where sno='$tempo'");
    }
        // header('location:chat.php?user='.$user.'&roll='.$roll.'');
    ?>
    <script>location.replace('chat.php?user=<?php echo $user; ?>&roll=<?php echo $roll; ?>&product=<?php echo $production?>')</script>
    <?php
}
?>

<title> Chat App</title>
</head>

<body>
    <section class="section-main bg padding-y">
        <div class="container">
            <div class="row">
                <aside class="col-md-3 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="profile.php">
                            <?php
                                if($result['picture']==null)
                                    echo '<img class="rounded-circle icon img-xs border" src="'.$result['pic'].'">' ;
                                else
                                    echo '<img class="rounded-circle icon img-xs border" src="profilepics/'.$result['picture'].'">' ;
                            ?>
                            <strong class="ml-3"> <?php echo $name;?> </strong>
                            </a>
                        </div>
                    </div>
                    <div class="card">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <h6 class="title">INBOX</h6>
                                </a>
                            </header>
                            <div class="card-body">
                                <div class="filter-content collapse show" id="collapse_1" style="">
                                    <ul class="list-menu list-group-flush">
                                        <?php
                                        $query="SELECT * FROM chatmsg WHERE emailid='$emailid'";
                                        $query_run = mysqli_query($con, $query);
                                        
                                        if(!$query_run)
                                            die("Unable to connect to database".mysqli_error($con));
                                        
                                        $number=mysqli_num_rows($query_run);

                                        for($i=1;$i<=$number;$i++)
                                            {
                                                $results = mysqli_fetch_array($query_run);
                                                $uniqueid = $results['email'];

                                                $myslq = mysqli_query($con, "SELECT * FROM customer WHERE email='$uniqueid'");
                                                $myresults = mysqli_fetch_array($myslq);

                                                // $my_chat = mysqli_query($con,"SELECT * FROM chats WHERE reciver='$emailid' AND isread=0");
                                                // $numchat = mysqli_num_rows($my_chat);
                                        ?>
                                        <a href="chat.php?user=<?php echo $i;?>&roll=buy&product=<?php echo $results['product']?>">
                                        <li class="nav-item list-group-item-action my-2 p-2" style="cursor:pointer;">
                                        <?php
                                            if($myresults['picture']==null)
                                                echo '<img class="rounded-circle icon img-xs border" src="'.$myresults['pic'].'">' ;
                                            else
                                                echo '<img class="rounded-circle icon img-xs border" src="profilepics/'.$myresults['picture'].'">' ;
                                        ?>
                                        <strong class="ml-2"><?php echo $myresults['firstname']." ".$myresults['lastname'];?></strong>
                                        <a href="chat.php?worker=deleteuser&product=<?php echo $results['sno']?>" style="float:right;"><i class="fa fa-times ml-2"></i></a>
                                        <!-- <span class="badge badge-pill badge-danger notify" name="msg"><?php echo $numchat;?></span> -->
                                        </li>
                                        </a>
                                            <?php } ?>
                                            <?php
                                        $query="SELECT * FROM chatmsg WHERE email='$emailid'";
                                        $query_run = mysqli_query($con, $query);
                                        
                                        if(!$query_run)
                                            die("Unable to connect to database".mysqli_error($con));
                                        
                                        $number=mysqli_num_rows($query_run);

                                        for($i=1;$i<=$number;$i++)
                                            {
                                                $results = mysqli_fetch_array($query_run);
                                                $uniqueid = $results['emailid'];

                                                $myslq = mysqli_query($con, "SELECT * FROM customer WHERE email='$uniqueid'");
                                                $myresults = mysqli_fetch_array($myslq);
                                        ?>
                                        <a href="chat.php?user=<?php echo $i;?>&roll=sell&product=<?php echo $results['product']?>">
                                        <li class="nav-item list-group-item-action my-2 p-2" style="cursor:pointer;">
                                        <?php
                                            if($myresults['picture']==null)
                                                echo '<img class="rounded-circle icon img-xs border" src="'.$myresults['pic'].'">' ;
                                            else
                                                echo '<img class="rounded-circle icon img-xs border" src="profilepics/'.$myresults['picture'].'">' ;
                                        ?>
                                        <strong class="ml-2"><?php echo $myresults['firstname']." ".$myresults['lastname'];?></strong>
                                        <a href="chat.php?worker=deleteuser&product=<?php echo $results['sno']?>" style="float:right;"><i class="fa fa-times"></i></a>
                                        <!-- <span class="badge badge-pill badge-danger notify" name="msg"><?php echo $numchat;?></span> -->
                                        </li>
                                        </a>
                                            <?php } ?>
                                    </ul>
                                </div>
                            </div>
                    </div>
                </aside> <!-- col.// -->
                <main class="col-md-9 mt-3">
                    <div class="card" style="min-height:700px; max-height:700px;">
                    <?php if(isset($_GET['user'])){ 
                            $user = $_GET['user'];
                            if($_GET['roll']=='buy'){
                            $my_slq = mysqli_query($con, "SELECT * FROM chatmsg WHERE emailid='$emailid'");
                            for($i=1;$i<=$user;$i++)
                            {
                                $my_results = mysqli_fetch_array($my_slq);
                            }
                            $mail = $my_results['email'];
                        } else if($_GET['roll']=='sell'){
                            $my_slq = mysqli_query($con, "SELECT * FROM chatmsg WHERE email='$emailid'");
                            for($i=1;$i<=$user;$i++)
                            {
                                $my_results = mysqli_fetch_array($my_slq);
                            }
                            $mail = $my_results['emailid'];
                        }
                            $my_slqi = mysqli_query($con, "SELECT * FROM customer WHERE email='$mail'");
                            $my_result = mysqli_fetch_array($my_slqi);
                        ?>
                        <header class="card-header">
                            <div class="row">
                                <div class="col-md-5">
                                <?php
                                    if($my_result['picture']==null)
                                        echo '<img class="rounded-circle icon img-xs border" src="'.$my_result['pic'].'">' ;
                                    else
                                        echo '<img class="rounded-circle icon img-xs border" src="profilepics/'.$my_result['picture'].'">' ;
                                ?>
                                <strong class="ml-2"><?php echo $my_result['firstname']." ".$my_result['lastname'];?></strong>
                                <?php 
                                $my_query = mysqli_query($con, "SELECT * FROM chats WHERE reciver='$mail'");
                                $my_query_run = mysqli_fetch_array($my_query);
                                // echo $my_query_run['isonline'];
                                if($my_query_run){
                                if(strpos($my_query_run['isonline'], "00:00:00")>0){
                                ?>
                                <p class="ml-5">online</p>
                                <?php } else { 
                                     $online = $my_query_run['isonline'];
                                     $my_arrs = explode(" ",$online);
                                     $curr_date = $my_arrs[0];
                                     $curr_time = $my_arrs[1];
                                    //  $my_temp = explode("-",$curr_time);
                                    $notok ="20".date("y-m-d");
                                    if($my_arrs[0]==$notok){
                                        $ison = explode(":",$curr_time);
                                        echo "<p class='ml-5'>last seen Today at : $ison[0]:$ison[1]</p>";
                                    }
                                    else{
                                        $my_temp = explode("-",$curr_date);
                                        echo "<p class='ml-5'>last seen on : $my_temp[2]/$my_temp[1]/$my_temp[0]</p>";
                                    } 
                                } 
                                } ?>
                                </div>
                                <div class="col-md-5">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="search"placeholder="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-light" type="button" id="btnsearch" ><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-2 icon" style="font-size:20px; color:#9CA1A3; cursor:pointer;">
                                    <!-- <i class="fas fa-search" id="btnsearch"></i> -->
                                    <!-- <i class="fas fa-paperclip ml-5"></i> -->
                                    <!-- <ul class="navbar-nav">
                                        <li class="nav-item dropdown"> -->
                                        <a class="ml-3" data-toggle="dropdown" href="#"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="report.php?email=<?php echo $my_result['email']?>">User Report</a>
                                            <a class="dropdown-item" href="chat.php?work=deleteall&reciver=<?php echo $mail; ?>&user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>">Delete Chat</a>
                                            <?php 
                                            if($_GET['roll']=='buy'){
                                                if(strpos($my_results['emailblock'], "00:00:00")>0){ ?>
                                            <a class="dropdown-item" href="chat.php?work=block&reciver=<?php echo $mail; ?>&user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>">Block User</a>
                                            <?php } else{ ?>
                                            <a class="dropdown-item" href="chat.php?work=unblock&reciver=<?php echo $mail; ?>&user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>">Unblock User</a>
                                            <?php } }
                                            else if($_GET['roll']=='sell'){
                                                if(strpos($my_results['emailidblock'], "00:00:00")>0){ 
                                            ?> 
                                            <a class="dropdown-item" href="chat.php?work=block&reciver=<?php echo $mail; ?>&user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>">Block User</a>
                                            <?php } else{ ?>
                                            <a class="dropdown-item" href="chat.php?work=unblock&reciver=<?php echo $mail; ?>&user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>">Unblock User</a>
                                            <?php } } ?>                                        
                                        </div>
                                        <!-- </li>
                                    </ul> -->
                                    <a href="chat.php"><i class="fa fa-times ml-5"></i></a>
                                </div>
                            </div>
                        </header>
                        <div class="card-body" id="scroll" style="overflow-y:auto;">
                            <?php
                            $day = $my_results['time'];
                            $array = explode(" ",$day);
                            $date = $array[0];
                            $time = $array[1];
                            $myarray1 = explode("-",$date);
                            $myarray2 = explode(":",$time);
                            ?>
                            <center><strong><?php echo $my_array[$myarray1[1]].",".$myarray1[2];?></strong></center>
                            <div class="card mt-2">
                                <div class="row">
                                    <div class="col-md-2">
                                    <?php 
                                    $product = $my_results['product'];
                                    $arr = explode("-",$product);
                                    $type = $arr[0];
                                    $id = $arr[1];
                                    
                                    $myquery = mysqli_query($con, "SELECT * FROM $type WHERE prodid='$id'");
                                    $val = mysqli_fetch_array($myquery);

                                    echo '<img class="img-sm" src="productpics/'.$val['prodpic'].'">' ;
                                    ?>
                                    </div>
                                    <div class="col-md-10">
                                    <h5 class="mt-2"><?php echo $val['prodname'];?></h5>
                                    <span>₹ <?php echo $val['prodnewprice'];?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                            <?php
                            // $thedate = mysqli_query($con, "SELECT * FROM chats WHERE (sender='$emailid' AND reciver='$mail') OR (sender='$mail' AND reciver='$emailid') AND product='$product' ORDER BY sno DESC");
                            // $rows = mysqli_fetch_array($thedate);
                            // $datetimes = $rows['datetime'];
                            // $my_arrs = explode(" ",$datetimes);
                            // $currdate = $my_arrs[0];
                            // $my_temp = explode("-",$currdate);

                            // if($my_temp[2]==$my_temp[2])
                            //     echo "<center><strong>TODAY</strong></center>";
                            // else if($my_temp[2]==$my_temp[2]-1)
                            //     echo "<center><strong>YESTERDAY</strong></center>";
                            // else 
                            //     echo "<center><strong>$my_temp[2]/$my_temp[1]/$my_temp[0]</strong></center>";  
                            // echo $product;
                            $emailblock = $my_results['emailblock'];
                            $emailidblock = $my_results['emailidblock'];
                            $emaildelete = $my_results['emaildelete'];
                            $emailiddelete = $my_results['emailiddelete'];
                            if($_GET['roll']=='buy' && strpos($emailblock, "00:00:00")==0){              
                                echo "<input type='hidden' id='emailblock' value='$emailblock'>";
                                $chats = mysqli_query($con, "SELECT * FROM chats WHERE product='$product' AND datetime<'$emailblock' AND (sender='$emailid' AND reciver='$mail') OR product='$product' AND datetime<'$emailblock' AND (sender='$mail' AND reciver='$emailid') ORDER BY 1 ASC");
                            } else if($_GET['roll']=='sell' && strpos($emailidblock, "00:00:00")==0){
                                echo "<input type='hidden' id='emailidblock' value='$emailidblock'>";
                                $chats = mysqli_query($con, "SELECT * FROM chats WHERE product='$product' AND datetime<'$emailidblock' AND (sender='$emailid' AND reciver='$mail') OR product='$product' AND datetime<'$emailidblock' AND (sender='$mail' AND reciver='$emailid') ORDER BY 1 ASC");
                            } else{ 
                                echo "<input type='hidden' id='emailblock' value='$emailblock'>";
                                echo "<input type='hidden' id='emailidblock' value='$emailidblock'>";
                                $chats = mysqli_query($con, "SELECT * FROM chats WHERE product='$product' AND (sender='$emailid' AND reciver='$mail') OR product='$product' AND (sender='$mail' AND reciver='$emailid') ORDER BY 1 ASC");
                                mysqli_query($con, "UPDATE chats set isread=1 WHERE reciver='$emailid' AND sender='$mail' AND product='$product'");
                            }

                            while($row = mysqli_fetch_array($chats)){
                                $sender = $row['sender'];
                                $reciver = $row['reciver'];
                                $content = $row['content'];
                                $datetime = $row['datetime'];
                                $my_arr = explode(" ",$datetime);
                                $currtime = $my_arr[1];
                                $mytemp = explode(":",$currtime);

                                if($_GET['roll']=='buy' && $datetime>$emaildelete){
                                if($sender==$emailid && $reciver==$mail && $row['senderdelete']==0){
                                ?>
                                <div class="col-md-6"></div>
                                    <div class="card mb-2 p-2 col-md-5 ml-5"  style="background-color:#98FB98;">
                                        <!-- <span class="tail-container" style=""></span> -->	
                                        <div class="row">
                                            <div class="col-md-10">
                                                <span class="border-box"><?php echo $content;?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#" data-toggle="dropdown" style="float:right;"><i class="fa fa-trash"></i></a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="chat.php?work=delete&sender=<?php echo $emailid; ?>&reciver=<?php echo $mail; ?>&user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>&id=<?php echo $row['sno']?>">DELETE FOR ME</a>
                                                    <a class="dropdown-item" href="chat.php?work=deleteboth&user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>&id=<?php echo $row['sno']?>">DELETE FOR EVERYONE</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($row['isread']==1){ ?>
                                        <small style="margin-left:85%;"><?php echo $mytemp[0].":".$mytemp[1]; ?><i class="fa fa-check-double ml-1" style="color:blue;"></i></small>
                                        <?php } else {?>
                                        <small style="margin-left:85%;"><?php echo $mytemp[0].":".$mytemp[1]; ?><i class="fa fa-check-double ml-1"></i></small>
                                        <?php } ?>  
                                    </div>
                                <!-- <div class="col-md-1"></div> -->
                                <?php
                                } else if($sender==$mail && $reciver==$emailid && $row['receverdelete']==0){
                                ?>
                                <!-- <div style="background-image: url(http://localhost/PDE/images/marker.png); background-repeat: no-repeat;"></div> -->
                                    <div class="card mb-2 p-2 col-md-5 mx-4" style="background-color:#F5F5F5;">
                                        <span class="border-box"><?php echo $content;?><a href="chat.php?work=delete&sender=<?php echo $mail; ?>&reciver=<?php echo $emailid; ?>&user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>&id=<?php echo $row['sno']?>" style="float:right"><i class="fa fa-trash"></i></a></span>
                                        <small style="margin-left:91%;"><?php echo $mytemp[0].":".$mytemp[1];; ?></small>
                                    </div>
                                    <div class="col-md-6"></div>
                                <?php
                                }
                            }
                            else if($_GET['roll']=='sell' && $datetime>$emailiddelete){
                                if($sender==$emailid && $reciver==$mail && $row['senderdelete']==0){
                                ?>
                                <div class="col-md-6"></div>
                                    <div class="card mb-2 p-2 col-md-5 ml-5"  style="background-color:#98FB98;">
                                        <!-- <span class="tail-container" style=""></span> -->	
                                        <div class="row">
                                            <div class="col-md-10">
                                                <span class="border-box"><?php echo $content;?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#" data-toggle="dropdown" style="float:right;"><i class="fa fa-trash"></i></a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="chat.php?work=delete&sender=<?php echo $emailid; ?>&reciver=<?php echo $mail; ?>&user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>&id=<?php echo $row['sno']?>">DELETE FOR ME</a>
                                                    <a class="dropdown-item" href="chat.php?work=deleteboth&user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>&id=<?php echo $row['sno']?>">DELETE FOR EVERYONE</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($row['isread']==1){ ?>
                                        <small style="margin-left:85%;"><?php echo $mytemp[0].":".$mytemp[1]; ?><i class="fa fa-check-double ml-1" style="color:blue;"></i></small>
                                        <?php } else {?>
                                        <small style="margin-left:85%;"><?php echo $mytemp[0].":".$mytemp[1]; ?><i class="fa fa-check-double ml-1"></i></small>
                                        <?php } ?>  
                                    </div>
                                <!-- <div class="col-md-1"></div> -->
                                <?php
                                } else if($sender==$mail && $reciver==$emailid&& $row['receverdelete']==0){
                                ?>
                                <!-- <div style="background-image: url(http://localhost/PDE/images/marker.png); background-repeat: no-repeat;"></div> -->
                                    <div class="card mb-2 p-2 col-md-5 mx-4" style="background-color:#F5F5F5;">
                                        <span class="border-box"><?php echo $content;?><a href="chat.php?work=delete&sender=<?php echo $mail; ?>&reciver=<?php echo $emailid; ?>&user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>&id=<?php echo $row['sno']?>" style="float:right"><i class="fa fa-trash"></i></a></span>
                                        <small style="margin-left:91%;"><?php echo $mytemp[0].":".$mytemp[1];; ?></small>
                                    </div>
                                    <div class="col-md-6"></div>
                                <?php
                                }
                            }
                            }
                            ?>
                            </div>
                        </div>
                        <form action="chat.php" method="post" onsubmit="return block()">

                            <div class="row m-3">
                                <div class="col-md-11 right-chat-textbox">
                                    <textarea type="text" class="form-control" name="content" id="content" placeholder="Type a message....." required rows="1"></textarea>
                                    <input type="hidden" name="sender" value="<?php echo $emailid;?>">
                                    <input type="hidden" name="reciver" value="<?php echo $mail;?>">
                                    <input type="hidden" name="product" value="<?php echo $product;?>">
                                    <input type="hidden" name="user" value="<?php echo $user;?>">
                                    <input type="hidden" name="roll" id="roll" value="<?php echo $_GET['roll'];?>">
                                </div>
                                <div class="col-md-1 input-group-append">
                                    <button class="btn form-control btn-lighgt" type="submit" name="register" value="register">
                                        <i class="fa fa-paper-plane"></i>
                                    </button>                             
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                    </div>
                </main> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- container //  -->
    </section>
</body>
<!-- <script>
    <form class="pb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="inputVal" placeholder="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-light" type="button" id="btnsearch" ><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form><hr>
    let btnsearch = document.getElementById('btnsearch');
    let inputVal = document.getElementById('inputVal');
    btnsearch.addEventListener('click', function () {
        let li = document.getElementById('li');
        console.log(li)
        Array.from(li).forEach(function (element) {
            consol.log("1")
            let cardTxt = element.getElementsByTagName('strong')[1].innerText;
            if (cardTxt.includes(inputVal.value))
                element.style.display = 'block';
            else
                element.style.display = 'none';
        })
    });
</script> -->
<script>
    let btnsearch = document.getElementById('btnsearch');
    let search = document.getElementById('search')
    btnsearch.addEventListener('click', function () {
        window.find(search.value)
    });   
    search.addEventListener('input', function () {
        clearInterval(interval)
    }); 
    btnsearch.addEventListener('blur', function () {
        location.replace('chat.php?user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>')
    });     
    let scroll = document.getElementById('scroll');
    let content = document.getElementById('content');
        document.addEventListener("DOMContentLoaded", function(event) { 
            let scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos==0) scroll.scrollTop = scroll.scrollHeight;
            else scroll.scrollTo(0, scrollpos);
        });
        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', scroll.scrollTop);
        };
        let interval = setInterval(function() { window.location.reload(); }, 10000);
        content.addEventListener("input", function() { 
            clearInterval(interval);
        });
        content.addEventListener('blur', function () {
        location.replace('chat.php?user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>')
        }); 
        function block(){
            let roll = document.getElementById('roll');
            let str = roll.value;
            if(str=='sell'){
                let emailidblock = document.getElementById('emailidblock');
                if(emailidblock.value.includes("00:00:00")){
                    return true
                }
                else{
                    let temp = confirm("press okk to unblock user")
                    if(temp){
                        location.replace('chat.php?work=unblock&reciver=<?php echo $mail; ?>&user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>')
                    }
                }
            } else if(str=='buy'){
                let emailblock = document.getElementById('emailblock');
                if(emailblock.value.includes("00:00:00")){
                    return true
                }
                else{
                    let temp = confirm("press okk to unblock user")
                    if(temp){
                        location.replace('chat.php?work=unblock&reciver=<?php echo $mail; ?>&user=<?php echo $_GET['user'];?>&roll=<?php echo $_GET['roll'];?>&product=<?php echo $_GET['product']?>')
                    }
                }
            }
            return false
        }
    </script>
<?php include 'footer.php'?>