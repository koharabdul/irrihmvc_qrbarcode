<body class="<?php echo $publish_app['theme'].' '.$publish_app['confnav'] ?>">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation" >
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo base_url(); ?>uploads/images/thumbs/AbdulKohar.jpg" />
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
                            <?php echo $this->session->userdata('nm_lengkap'); ?>
                                
                            </strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile">Profile</a></li>
                                <li><a href="contacts">Contacts</a></li>
                                <li><a href="mailbox">Mailbox</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>

                    <?php 
                        // echo $this->uri->segment(1);
                        foreach ($userview as $u) {
                            if($this->uri->segment(1)==$u->link){
                                $status = "class='active'";
                            }
                            else{
                                $status = "";
                            }
                            // var_dump($status_mom);

                            $motheractived = $this->session->tempdata($u->link,0,1);
                            if(empty($motheractived)){
                                $collapse = "collapse";
                            }
                            else{
                                $collapse = "";
                            }

                            if($u->countname==0 and ($u->ada == '' or $u->ada = '-')){
                                $hidepermission = "";
                            }
                            else if($u->countname>0 and $u->ada == ''){
                                $hidepermission = "display:none;";
                            }
                            else if($u->countname>0 and $u->ada == '-'){
                                $hidepermission = "";
                            }
                            else{
                                $hidepermission = "";
                            }

                        
                            if($u->status=='Anak'){
                                echo"<li ".$status."  style='".$hidepermission."'>
                                        <a href='".base_url().$u->link."'><i class='$u->icon'></i> <span class='nav-label'>$u->name</span></a>
                                    </li>";
                            }
                            else if(($u->status=='Mamah')and($u->s_no>=2)){
                                echo"<li class='";echo $motheractived;echo"' style='".$hidepermission."'>
                                        <a>$u->name<span class='fa arrow'></span></a>
                                        <ul class='nav nav-third-level ";echo $collapse;echo"'>";
                            }
                            else if(($u->status=='Mamah')and($u->s_no==1)){
                                echo"<li class='";echo $motheractived;echo"' style='".$hidepermission."'>
                                        <a><i class='$u->icon'></i> <span class='nav-label'>$u->name </span> <span class='fa arrow'></span></a>
                                        <ul class='nav nav-second-level ";echo $collapse;echo"'>";
                            }
                            else if(substr($u->status,0,12)=='Ayah Level 1'){
                                echo"<li ".$status." style='".$hidepermission."'><a href='".base_url().$u->link."'>$u->name</a>
                                     </li></ul></li>";
                            }
                            else if(substr($u->status,0,12)=='Ayah Level 2'){
                                echo"<li ".$status." style='".$hidepermission."'><a href='".base_url().$u->link."'>$u->name</a>
                                     </li></ul></li></ul></li>";
                            }
                            else if(substr($u->status,0,12)=='Ayah Level 3'){
                                echo"<li ".$status." style='".$hidepermission."'><a href='".base_url().$u->link."'>$u->name</a>
                                     </li></ul></li></ul></li></ul></li>";
                            }
                            else if(substr($u->status,0,12)=='Ayah Level 4'){
                                echo"<li ".$status." style='".$hidepermission."'><a href='".base_url().$u->link."'>$u->name</a>
                                     </li></ul></li></ul></li></ul></li></ul></li>";
                            }
                            else if(substr($u->status,0,12)=='Ayah Level 5'){
                                echo"<li ".$status." style='".$hidepermission."'><a href='".base_url().$u->link."'>$u->name</a>
                                     </li></ul></li></ul></li></ul></li></ul></li></ul></li>";
                            }
                            else{
                                echo"<li ".$status."  style='".$hidepermission."'>
                                        <a href='".base_url().$u->link."'>$u->name</a>
                                    </li>";
                            }
                        }
                    ?>
          
                
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar <?php echo $publish_app['nav_static_top'] ?>" role="navigation" style="margin-bottom: 0;" >
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Searching for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to Ako's Website</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <div id="count_chats2"></div>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url(); ?>assets/img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url(); ?>assets/img/a4.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url(); ?>assets/img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="<?php echo base_url(); ?>login/logout">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
                <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li>
            </ul>

        </nav>
        </div>