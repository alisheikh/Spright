<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/"><img src="/images/logo.png" alt="Spright. Logo"></a>
    </div>
    <!-- /.navbar-header -->


    <ul class="nav navbar-top-links navbar-right">
     <!-- /.dropdown -->
     <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-alerts">
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-comment fa-fw"></i> New Comment
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                        <span class="pull-right text-muted small">12 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-tasks fa-fw"></i> New Task
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a class="text-center" href="#">
                    <strong>See All Alerts</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-alerts -->
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
 <li><a href="/changepassword"><i class="fa fa-key fa-fw"></i> Change Password</a>
            </li>
            <li class="divider"></li>
            <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">


<li class="sidebar-search">
<?php //echo $this->Element('getstarted');

?>

</li>

            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>



            <li>
                <a href="/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            
            <li>
                <a href="#"><i class="fa fa-tasks fa-fw"></i> Work Orders<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/jobs/add/">Raise Work Order</a>
                    </li>
                    <li>
                        <a href="/jobs/">Work Order List</a>
                    </li>
                    <li>
                        <a href="/tasks/workplanner">Work Planner</a>
                    </li>


                </ul>
                <!-- /.nav-second-level -->
            </li>
                        <li>
            <a href="/room-booking"><i class="fa fa-calendar"></i> Scheduled Work<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                    <li>
                        <a href="/schedules/create">Create Schedule</a>
                    </li>
                    <li>
                        <a href="/schedules">Schedules</a>
                    </li>
                </ul>
            </li>
            <li>
            <li>
            <a href="/room-booking"><i class="fa fa-book fa-fw"></i> Room Booking<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                    <li>
                        <a href="#">Your Bookings</a>
                    </li>
                    <li>
                        <a href="#">Create Booking</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Location Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">Buildings</a>
                    </li>
                    <li>
                        <a href="#">Skills</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-car"></i> Asset Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/assets/create">Create Asset</a>
                    </li>
                    <li>
                        <a href="/assets">Asset List</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-cogs fa-fw"></i> Configuration<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/jobtemplates">Job Templates</a>
                    </li>
                    
                    <li>
                        <a href="/questions">Decision Tree</a>
                    </li>

                    <li>
                        <a href="#">User Management<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="/users">Users</a>
                            </li>
                            <li>
                                <a href="/groups">User Groups</a>
                            </li>

                        </ul>
                        <!-- /.nav-third-level -->
                    </li>


                </ul>
                <!-- /.nav-second-level -->
            </li>


        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>