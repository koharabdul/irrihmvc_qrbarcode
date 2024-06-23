    
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12">
                    <h2><?php echo $subtitle; ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                        </li>
                        <?php echo $runlink; ?>
                        <li>
                            <a href="<?php echo base_url().$mylink ?>"><?php echo $subtitle; ?></a>
                        </li>
                        <li class="active">
                            <strong>Print</strong>
                        </li>
                    </ol>
                </div>
            </div>
       


        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox">
                      
                        <div class="ibox-content">

                            <object data="<?php echo base_url().$mylink ?>/printviews" style="width:100%;height:600px;"></object>




                        </div>
                    </div>
                </div>
            </div>
        </div>