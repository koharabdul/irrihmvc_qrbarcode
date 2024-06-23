    
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
                            <strong>View</strong>
                        </li>
                    </ol>
                </div>
            </div>
       


        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox">
                      
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                        
                                        <div class="pull-right">
                                            <?php echo $results['nourut'] ?>
                                        </div>
                                        <h2> View Details </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel blank-panel">

                                        <div class="panel-body">
                                            <table width="100%" class="table table-responsive">
                                                <?php table_tr('Nama Lengkap',$results['nm_lengkap'],':','') ?>
                                                <?php table_tr('NIK',$results['nik'],':','') ?>
                                                <?php table_tr('No. Urut',$results['urut'],':','') ?>
                                                <?php table_tr('Alamat',$results['alamat'],':','') ?>
                                                <tr>
                                                    <td><span class="pull-right">RT</span></td>
                                                    <td>:</td>
                                                    <td><?php echo $results['rts'] ?></td>
                                                </tr>
                                                 <tr>
                                                    <td><span class="pull-right">RW</span></td>
                                                    <td>:</td>
                                                    <td><?php echo $results['rws'] ?></td>
                                                </tr>
                                                <?php table_tr('Desa/Kel.',ucwords(strtolower($results['nm_desa'])),':','') ?>
                                                <?php table_tr('Kecamatan',ucwords(strtolower($results['nm_kec'])),':','') ?>
                                                <?php table_tr('Status Pendistribusian',$results['terdistribusi'],':','') ?>
                                                <tr><td colspan="3" style="border: none;"><br><br></td></tr>
                                                <?php table_tr('Created At',date_convert($results['date_created'],true),':','') ?>
                                                <?php 
                                                    if(empty($results['date_modified'])){
                                                        $mod = "-";
                                                    }
                                                    else{
                                                        $mod = date_convert($results['date_modified'],true);
                                                    }
                                                    table_tr('Modified At',$mod,':','');
                                                ?>
                                                <?php table_tr('Author',$results['created_byname'],':','') ?>
                                                <?php 
                                                    if(empty($results['modified_byname'])){
                                                        $modby = "-";
                                                    }
                                                    else{
                                                        $modby = $results['modified_byname'];
                                                    }
                                                    table_tr('Last Save by',$modby,':','');
                                                ?>
                                            </table>                                                
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        
    
    
    
        
       