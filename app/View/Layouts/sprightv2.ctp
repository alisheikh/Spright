<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Spright | <?php echo $pageTitle; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />


        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="/libs/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="/libs/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="/css/select2.css" rel="stylesheet"/>
        <link href="/css/select2-bootstrap.css" rel="stylesheet"/>
        <link href="/css/ui.fancytree.min.css" rel="stylesheet" type="text/css"> 
        <link href="/css/spright.css" rel="stylesheet"/>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->

        <?php  //if ($this->Session->read('Auth.User')): ?>
        <header class="header">
            <a href="../../index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img alt="Spright. Logo" src="/images/logo.png" height="30" width="140">
            </a>
            <!-- Header Navbar: style can be found in header.less -->

            
            
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
   
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Ashley Smith <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="/lib/img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                       Ashley Smith - Founder
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="/logout" class="btn btn-default btn-flat">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="/libs/img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello,  Ash</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
              
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="/">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
               <li class="treeview">
                <a href="#"><i class="fa fa-tasks"></i> <span>Asset Module</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/assets/"><i class="fa fa-angle-double-right"></i> View Assets</a>
                    </li>
                    <li>
                        <a href="/assets/create/"><i class="fa fa-angle-double-right"></i> Create Asset</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
               <li class="treeview">
                <a href="#"><i class="fa fa-tasks"></i> <span>Works Module</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/jobs/add/"><i class="fa fa-angle-double-right"></i> Raise Work Order</a>
                    </li>
                    <li>
                        <a href="/jobs/"><i class="fa fa-angle-double-right"></i> Work Order List</a>
                    </li>
                    <li>
                        <a href="/tasks/workplanner"><i class="fa fa-angle-double-right"></i> Work Planner</a>
                    </li>


                </ul>
                <!-- /.nav-second-level -->
            </li> 
                           <li class="treeview">
                <a href="#"><i class="fa fa-tasks"></i> <span>Configuration</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/users"><i class="fa fa-angle-double-right"></i> User Management</a>
                    </li>
                    <li>
                        <a href="/questions"><i class="fa fa-angle-double-right"></i> Decision Tree</a>
                    </li>

                                   <li class="treeview">
                <a href="#"><i class="fa fa-database"></i> <span>Background Data</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/faulttypes"><i class="fa fa-angle-double-right"></i> Fault Types</a>
                    </li>


                </ul>
                <!-- /.nav-second-level -->
            </li> 



                </ul>
                <!-- /.nav-second-level -->
            </li> 
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
<?php //endif; ?>
                   
                    <?php echo $this->fetch('content'); ?>






        </div><!-- ./wrapper -->

            <script src="/js/jquery-1.11.1.js"></script>
            <script src="/js/jquery-ui.js"></script>
            <script type="text/javascript" src="/js/jquery.validate.min.js"></script>
            <script src="/js/bootstrap.min.js"></script>
            <script src="/js/plugins/metisMenu/metisMenu.min.js"></script>
            <script src="/js/sb-admin-2.js"></script>
            <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
            <script type="text/javascript" src="/js/bootstrap-growl.min.js" charset="UTF-8"></script>
            
            <script src="/js/bootbox.min.js"></script>
            <script src="/js/jquery.knob.js"></script>
            <script src="/js/jquery.ui.widget.js"></script>
            <script src="/js/jquery.iframe-transport.js"></script>
            <script src="/js/jquery.fileupload.js"></script>
            
            <script src="/js/select2.min.js"></script>
            <script src="/js/bootstrap-growl.min.js"></script>
            <script src="//cdn.datatables.net/1.10.3/js/jquery.dataTables.min.js"></script>
            <script src="/libs/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

            <script src="/js/jquery.simplecolorpicker.js"></script>
            <script src="/js/jquery.fancytree-all.min.js" type="text/javascript"></script>
            <script src="/js/jquery.loadJSON.js" type="text/javascript"></script>
   
        

        <!-- Template libs -->
                <script src="/libs/js/AdminLTE/app.js" type="text/javascript"></script>

      
        <!-- Refer to lib.min.js for a full list of the open source libraries which Spright uses -->
      <!--   <script src="/js/lib.min.js"></script>   -->

        <!-- Spright. Modules -->
        <script src="/js/spright.validation.js"></script> 
        
        <script src="/js/spright.work.js?v=<?php echo rand() ?>"></script>
        <script src="/js/spright.admin.js"></script>
        <script src="/js/spright.asset.js"></script>
        <script src="/js/spright.js?v=<?php echo rand() ?>"></script>

<script>
$('.sticky').affix({
      offset: {
        top: $('header').height()
      }
}); 
</script>

    </body>
</html>
