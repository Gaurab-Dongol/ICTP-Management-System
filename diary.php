<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Diary</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div>
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/456.png" alt="WSU">
                            </a>
                        </div>
                        <div class="diary-form">
                        <h3><center>Diary</center></h3>
                            <form action="dashboard.php" method="post">
                                <div class="form-group">
                                    <label>Enter start Date:</label>
                                    <input class="au-input au-input--full" type="date" name="start" required>
                                
                                </div>
                                <div class="form-group">
                                
                                    <label>Enter end Date:</label>
                                    <input class="au-input au-input--full" type="date" name="end" required>
                                
                                </div>
                                <?php
                                function createHours($id='hours_select', $selected=null)
                                
 
                                {
        /*** range of hours ***/
        $r = range(1, 12);

        /*** current hour ***/
        $selected = is_null($selected) ? date('h') : $selected;

        $select = "<select name=\"$id\" id=\"$id\">\n";
        foreach ($r as $hour)
        {
            $select .= "<option value=\"$hour\"";
            $select .= ($hour==$selected) ? ' selected="selected"' : '';
            $select .= ">$hour</option>\n";
        }
        $select .= '</select>';
        return $select;
    }
    function createMinutes($id='minute_select', $selected=null)
    {
        /*** array of mins ***/
        $minutes = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59);

    $selected = in_array($selected, $minutes) ? $selected : 0;

        $select = "<select name=\"$id\" id=\"$id\">\n";
        foreach($minutes as $min)
        {
            $select .= "<option value=\"$min\"";
            $select .= ($min==$selected) ? ' selected="selected"' : '';
            $select .= ">".str_pad($min, 1, '1')."</option>\n";
        }
        $select .= '</select>';
        return $select;
    }
    ?>

                                    <div class="form-group">
                                    <label>Enter Numbers of Hour</label>
                                    
                                    <table>
                                    
                                    
                                    <tr>
                                    
                                    <td><?php echo createHours('start_hour',1); ?></td>

                                    <td><?php echo createMinutes('start_minute',1); ?></td>



                                    </tr>

                                    </table>
                                    </div>
                                <div class="form-group">
                                    <label>Task Description</label>
                                    <input class="au-input au-input--full" type="text" name="Task description" required>
                                </div>
                                <div class="form-group">
                                    <label>Manager Remarks</label>
                                    <input class="au-input au-input--full" type="text" name="manager remarks" required>
                                </div>
                                <div class="form-group">
                                    <label>Unit coordinator Remarks</label>
                                    <input class="au-input au-input--full" type="text" name="unit co remarks" required>
                                </div>
                                
                              
                                
                                
                               
                                
                                
                                <button class="au-btn au-btn--block au-btn--green m-b-20" action="#" type="submit">Submit</button>
                                
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
