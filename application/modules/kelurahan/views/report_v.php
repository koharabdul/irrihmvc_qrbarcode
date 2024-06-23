            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php $subtitle ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().strtolower($subtitle) ?>"><?php echo $subtitle; ?></a>
                        </li>
                        <li class="active">
                            <strong>Print</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
          	<div class="ibox float-e-margins">
	            <div class="ibox-title">
	                <h5>Print Views</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                    <a class="close-link">
	                        <i class="fa fa-times"></i>
	                    </a>
	                </div>
	            </div>
	            <div class="ibox-content">
	               <object data="<?php echo base_url().strtolower($subtitle) ?>/generateReport" style="width:100%;height:600px;"></object>
	            </div>
	        </div>
        </div>



    
       
    <!-- pace.min merupakan cara untuk menghindari error pada chat/time gitu lah -->
    <!-- <script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script> -->