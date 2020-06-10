<?php 
	session_start();
	
	if(!isset($_SESSION['RoleId']))
	{
		header('location:login.php?lmsg=true');
		exit;
	}		

	require_once('inc/config.php');
    require_once('layouts/header.php'); 
?>

<div class="page-wrapper">
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            
            <!-- LEFT SIDEBAR-->
            <?php 
            require_once('layouts/left_sidebar.php'); 
            require_once('layouts/usersetting.php'); 
            ?>

<div class="row">
                            <div class="col-md-12">
                                <div class="au-card">
                                <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                               
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--sm">
                                            <select class="js-select2" name="time">
                                                <option selected="selected">Today</option>
                                                <option value="">3 Days</option>
                                                <option value="">1 Week</option>
                                                <option value="">2 Week</option>
                                                <option value="">3 Week</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>position</th>
                                                <th>Company</th>
                                                <th>email</th>
                                                <th>description</th>
                                                <th>closes</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="tr-shadow">
                                                <td>Junior Web Developer</td>
                                                <td>Web World Inc</td>
                                                <td>
                                                    <span class="block-email">lori@webworld.com.au</span>
                                                </td>
                                                <td class="desc">We are looking for a talented and creative content creator who specialises in social media. The right candidate would ideally be an influencer who is a passionate foodie and cafe lover. $30 / Hour. Hornsby, NSW. Casual position.</td>
                                                <td>2020-06-17</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                            <tr class="tr-shadow">
                                                <td>iOS Developer</td>
                                                <td>TGS Global</td>
                                                <td>
                                                    <span class="block-email">john@tgs.com</span>
                                                </td>
                                                <td class="desc">Looking for a iOS Developer - React.js for an AI project. Part-time opportunity. Melbourne, VIC location. $26.00 per hour.</td>
                                                <td>2020-05-29</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                            <tr class="tr-shadow">
                                                <td>Graduate Program</td>
                                                <td>Clean Energy Regulator</td>
                                                <td>
                                                    <span class="block-email">lyn@cer.com</span>
                                                </td>
                                                <td class="desc">iThe Clean Energy Regulator Graduate Development Program is seeking highly motivated graduates for their 2021 Graduate Development Program.</td>
                                                <td>2018-09-25</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                            <tr class="tr-shadow">
                                                <td>ICT Intern</td>
                                                <td>Western Sydney University</td>
                                                <td>
                                                    <span class="block-email">jenny@wsu.edu.au</span>
                                                </td>
                                                <td class="desc">WSU is looking for up to three students to join them for a three-month internship as Computer Application Developers. The internship will be based entirely from home, and will focus the development of computer applications. Unpaid Internship. 'Working from Home' based opportunity.</td>
                                                <td>2018-09-24</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </button
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div>
        <!-- END MAIN CONTENT-->
        </div>
    </div>

    <?php require_once('layouts/footer.php'); ?>