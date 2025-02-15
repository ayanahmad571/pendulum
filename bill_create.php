<!DOCTYPE html>
<html lang="en">
    
<!-- the manform-wizard.htmlby ayan ahmad 07:30:41 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" href="img/favicon_1.ico">

        <title>Invoice Creation</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">

        <!--Animation css-->
        <link href="css/animate.css" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/ionicon/css/ionicons.min.css" rel="stylesheet" />

        <!--Form Wizard-->
        <link rel="stylesheet" type="text/css" href="assets/form-wizard/jquery.steps.css" />



        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/helper.css" rel="stylesheet">
        

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

   

    </head>


    <body>

            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">Form Wizard</h3> 
                </div>

                <!-- Basic Form Wizard -->
                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Basic Form Wizard</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <form id="basic-form" action="#">
                                    <div>
                                        <h3>Account</h3>
                                        <section>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="userName">User name *</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control required" id="userName" name="userName" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="password"> Password *</label>
                                                <div class="col-lg-10">
                                                    <input id="password" name="password" type="text" class="required form-control">

                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="confirm">Confirm Password *</label>
                                                <div class="col-lg-10">
                                                    <input id="confirm" name="confirm" type="text" class="required form-control">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                            </div>
                                        </section>
                                        <h3>Profile</h3>
                                        <section>
                                            <div class="form-group clearfix">

                                                <label class="col-lg-2 control-label" for="name"> First name *</label>
                                                <div class="col-lg-10">
                                                    <input id="name" name="name" type="text" class="required form-control">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="surname"> Last name *</label>
                                                <div class="col-lg-10">
                                                    <input id="surname" name="surname" type="text" class="required form-control">

                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="email">Email *</label>
                                                <div class="col-lg-10">
                                                    <input id="email" name="email" type="text" class="required email form-control">
                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="address">Address *</label>
                                                <div class="col-lg-10">
                                                    <input id="address" name="address" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                            </div>

                                        </section>
                                        <h3>Hints</h3>
                                        <section>
                                            <div class="form-group clearfix">
                                                <div class="col-lg-12">
                                                    <ul>
                                                        <li>Jonathan Smith </li>
                                                        <li>Lab</li>
                                                        <li>jonathan@smith.com</li>
                                                        <li>Your city, Cityname</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </section>
                                        <h3>Finish</h3>
                                        <section>
                                            <div class="form-group clearfix">
                                                <div class="col-lg-12">
                                                    <label class="cr-styled">
                                                        <input type="checkbox">
                                                        <i class="fa"></i> 
                                                        I agree with the Terms and Conditions.
                                                    </label>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </form> 
                            </div>  <!-- End panel-body -->
                        </div> <!-- End panel -->

                    </div> <!-- end col -->

                </div> <!-- End row -->




                <!-- Vertical Steps Example -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Vertical Steps Example</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <div id="wizard-vertical">
                                    <h3>Account</h3>
                                    <section>
                                        <div class="form-group clearfix">
                                            <label class="col-lg-2 control-label " for="userName1">User name *</label>
                                            <div class="col-lg-10">
                                                <input class="form-control required" id="userName1" name="userName" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <label class="col-lg-2 control-label " for="password1"> Password *</label>
                                            <div class="col-lg-10">
                                                <input id="password1" name="password" type="text" class="required form-control">
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <label class="col-lg-2 control-label " for="confirm1">Confirm Password *</label>
                                            <div class="col-lg-10">
                                                <input id="confirm1" name="confirm" type="text" class="required form-control">
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                        </div>
                                    </section>
                                    <h3>Profile</h3>
                                    <section>
                                        <div class="form-group clearfix">

                                            <label class="col-lg-2 control-label" for="name1"> First name *</label>
                                            <div class="col-lg-10">
                                                <input id="name1" name="name" type="text" class="required form-control">
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <label class="col-lg-2 control-label " for="surname1"> Last name *</label>
                                            <div class="col-lg-10">
                                                <input id="surname1" name="surname" type="text" class="required form-control">

                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <label class="col-lg-2 control-label " for="email1">Email *</label>
                                            <div class="col-lg-10">
                                                <input id="email1" name="email" type="text" class="required email form-control">
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <label class="col-lg-2 control-label " for="address1">Address *</label>
                                            <div class="col-lg-10">
                                                <input id="address1" name="address" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">
                                            <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                        </div>

                                    </section>
                                    <h3>Hints</h3>
                                    <section>
                                        <div class="form-group clearfix">
                                            <div class="col-lg-12">
                                                <ul>
                                                    <li>Jonathan Smith </li>
                                                    <li>Lab</li>
                                                    <li>jonathan@smith.com</li>
                                                    <li>Your city, Cityname</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </section>
                                    <h3>Finish</h3>
                                    <section>
                                        <div class="form-group clearfix">
                                            <div class="col-lg-12">
                                                <label class="cr-styled">
                                                    <input type="checkbox">
                                                    <i class="fa"></i> 
                                                    I agree with the Terms and Conditions.
                                                </label>
                                            </div>
                                        </div>
                                    </section>
                                </div> <!-- End #wizard-vertical -->
                            </div>  <!-- End panel-body -->
                        </div> <!-- End panel -->

                    </div> <!-- end col -->

                </div> <!-- End row -->



                <!-- Wizard with Validation -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Wizard with Validation</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <form id="wizard-validation-form" action="#">
                                    <div>
                                        <h3>Step 1</h3>
                                        <section>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="userName2">User name </label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" id="userName2" name="userName" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="password2"> Password *</label>
                                                <div class="col-lg-10">
                                                    <input id="password2" name="password" type="text" class="required form-control">

                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="confirm2">Confirm Password *</label>
                                                <div class="col-lg-10">
                                                    <input id="confirm2" name="confirm" type="text" class="required form-control">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                            </div>
                                        </section>
                                        <h3>Step 2</h3>
                                        <section>

                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label" for="name2"> First name *</label>
                                                <div class="col-lg-10">
                                                    <input id="name2" name="name" type="text" class="required form-control">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="surname2"> Last name *</label>
                                                <div class="col-lg-10">
                                                    <input id="surname2" name="surname" type="text" class="required form-control">

                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="email2">Email *</label>
                                                <div class="col-lg-10">
                                                    <input id="email2" name="email" type="text" class="required email form-control">
                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="address2">Address </label>
                                                <div class="col-lg-10">
                                                    <input id="address2" name="address" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                            </div>

                                        </section>
                                        <h3>Step 3</h3>
                                        <section>
                                            <div class="form-group clearfix">
                                                <div class="col-lg-12">
                                                    <ul class="list-unstyled w-list">
                                                        <li>First Name : Jonathan </li>
                                                        <li>Last Name : Smith </li>
                                                        <li>Emial: jonathan@smith.com</li>
                                                        <li>Address: 123 Your City, Cityname. </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </section>
                                        <h3>Step Final</h3>
                                        <section>
                                            <div class="form-group clearfix">
                                                <div class="col-lg-12">
                                                    <input id="acceptTerms-2" name="acceptTerms2" type="checkbox" class="required">
                                                    <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                                                </div>
                                            </div>

                                        </section>
                                    </div>
                                </form>
                            </div>  <!-- End panel-body -->
                        </div> <!-- End panel -->

                    </div> <!-- end col -->

                </div> <!-- End row -->
                        

            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            <footer class="footer">
                2015 © Velonic.
            </footer>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
        


        <!-- js placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>


        <!--Form Validation-->
        <script src="assets/form-wizard/bootstrap-validator.min.js" type="text/javascript"></script>

        <!--Form Wizard-->
        <script src="assets/form-wizard/jquery.steps.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="assets/jquery.validate/jquery.validate.min.js"></script>

        <!--wizard initialization-->
        <script src="assets/form-wizard/wizard-init.js" type="text/javascript"></script>


        <script src="js/jquery.app.js"></script>


    </body>

<!-- the manform-wizard.htmlby ayan ahmad 07:30:43 GMT -->
</html>
