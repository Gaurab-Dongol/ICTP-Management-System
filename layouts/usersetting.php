<?php 
if(isset($_GET['logout']) && $_GET['logout'] == true)
{
	session_destroy();
	header("location:login.php");
	exit;
}

//Fetch data 
$UID = $_GET['UID'];
$fetch = "SELECT username FROM login AS A LEFT OUTER JOIN student AS B ON A.USERID = B.USERID LEFT OUTER JOIN staff AS C ON B.USERID = C.USERID LEFT OUTER JOIN companyuser AS D ON C.USERID = D.UserId WHERE A.USERID = '".$UID."'";
$s = mysqli_query($conn, $fetch);
$usersetting = mysqli_fetch_array($s);
?>
<!-- HEADER DESKTOP-->
<header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="" alt="" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $usersetting['username']?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="" alt="" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <!--<h5 class="name">
                                                        <a href="#">Student</a>
                                                    </h5>-->
                                                    <span class="email"><?php echo $usersetting['username']?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="login.php?logout=true">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->