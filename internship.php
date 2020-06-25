<?php 
  //session_start();
  
  //if(!isset($_SESSION['RoleId']))
  //{
  //  header('location:login.php?lmsg=true');
  //  exit;
 // }   

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
            
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                      <div class="row">
                            <div class="col-md-12">
                                <div class="au-card">
                                  <div>
                                        <div class="table-button" align="right">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#myModalProfile">
                                                Add Internship</button>
                                        </div>
                                        <h3>My Internship Detail</h3>
                                    </div>
                                    <hr>
                                    <div>
                                        <div class="table-button" align="right" style="font-size: 24px;">Status
                                            <button class="au-btn au-btn-icon au-btn--blue au-btn--large" >
                                                NOT APPROVED</button>
                                        </div>
                                        <h3>Software Developer</h3>
                                        <h3>TGP Global</h3>
                                        <h4>Sydney NSW</h4>
                                        <h4>December 2019 to Current</h4>
                                        <p>Worked with team towards developing PHP Applications and Building Websites using PHP, JavaScript, AJAX, JSON. Involved in architecting internal CRM Dashboard using various tools like Trello, Slack and Git Web application was implemented using Bootstrap, PHP, Node.js and MongoDB. Developed dynamic and interactive UI and UX for various responsive websites. REST API Testing and Documentation using Postman.r</p>
                                    </div>    
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
          </div>
    </div>
            <!-- END MAIN CONTENT-->
    
            <div id="myModalProfile" class="modal fade" role="dialog">
              <div class="modal-dialog">
              <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                        
                            <strong>Add My Internship</strong>
                          </div>
                          <form action="" method="POST">
                          <div class="card-body card-block">
                            <div class="form-group">
                              <label class=" form-control-label">Job Reference No</label>
                              <input type="text" placeholder="Reference No" class="form-control" name="jrNo">
                            </div>
                            
                            

                            <div class="form-group">
                                    <label for="textarea-input" class="form-control-label">Job Responsibility<small><i>(in bullet form)</i></small> </label>
                                    </div>
                                    <div class="form-group">
                                    <textarea class="ckeditor" name="JobRes"></textarea>
                                    </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default" name="Update">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal Code Finish-->

            
    <?php require_once('layouts/footer.php'); ?>
