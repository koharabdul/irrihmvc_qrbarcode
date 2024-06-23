
	   <div class="row wrapper border-bottom white-bg page-heading">
		    <div class="col-lg-10">
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
		            	<strong>Rekap Final Data Pemutakhiran</strong>
		            </li>
		        </ol>
		    </div>
		</div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Rekap Final Hasil Dari Pemutakhiran Data</h5>
                    <div class="ibox-tools">
                        <a class="fullscreen-link">
                            <i class="fa fa-expand" id="expand"></i>
                        </a> 
                    </div>
                </div>
                
                
            

                <div class="ibox-content" style="padding-bottom: 5px; padding-top: 5px;">
                    <div class="row wrapper white-bg page-heading" style="padding-bottom: 0px; padding-top: 5px;">
                        <div class="col-sm-7">

                            	    <table class="table table-bordered table-hover">
                                        <tr>
                                            <th rowspan="2" class="text-center" width="35px;" style="vertical-align: middle;">No.</th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">Nama PPDP</th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;" width="5%">No. TPS</th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;" width="5%">Jumlah KK</th>
                                            <th colspan="3" class="text-center" style="vertical-align: middle;">Pemilih A-KWK</th>
                                            <th rowspan="27" class="text-center success" style="vertical-align: middle;" width="1px;"></th>
                                            <th colspan="3" class="text-center" style="vertical-align: middle;">Final Daftar Pemilih</th>
                                        </tr> 
                                        <tr>
                                            <td class="text-center" width="4%">L</td>
                                            <td class="text-center" width="4%">P</td>
                                            <td class="text-center" width="4%">L+P</td>
                                            <td class="text-center" width="4%">L</td>
                                            <td class="text-center" width="4%">P</td>
                                            <td class="text-center" width="4%">L+P</td>
                                        </tr> 
                            <?php 
                                $no=1;
                                foreach ($result as $k) {
                                    echo"<tr>
                                            <td class='text-center' style='padding-top:1px; padding-bottom:1px;'>$no</td>
                                            <td style='padding-top:1px; padding-bottom:1px;'>$k->petugas</td>
                                            <td class='text-center' style='padding-top:1px; padding-bottom:1px;'>$k->tps</td>
                                            <td class='text-center' style='padding-top:1px; padding-bottom:1px;'>$k->jum_kk</td>
                                            <td class='text-center' style='padding-top:1px; padding-bottom:1px;'>$k->jum_laki</td>
                                            <td class='text-center' style='padding-top:1px; padding-bottom:1px;'>$k->jum_perempuan</td>
                                            <td class='text-center' style='padding-top:1px; padding-bottom:1px;'>$k->akwklp</td>
                                            <td class='text-center' style='padding-top:1px; padding-bottom:1px;'>$k->jnsl</td>
                                            <td class='text-center' style='padding-top:1px; padding-bottom:1px;'>$k->jnsp</td>
                                            <td class='text-center' style='padding-top:1px; padding-bottom:1px;'>$k->jnsk</td>
                                        </tr>";  
                                        $no++;
                                }
                             ?>
                                       
                                           <tr>
                                               <td colspan="3" style="text-align: right;">Jumlah</td>
                                               <td class="text-center"><?php echo $jum_kk ?></td>
                                               <td class="text-center"><?php echo $jum_laki ?></td>
                                               <td class="text-center"><?php echo $jum_p ?></td>
                                               <td class="text-center"><?php echo $tot ?></td>
                                               <td class="text-center"><?php echo $jumlahlaki ?></td>
                                               <td class="text-center"><?php echo $jumlahperempuan ?></td>
                                               <td class="text-center"><?php echo $kelamintot ?></td>
                                           </tr>
                                       
                                        
                                       
                                    </table>

                                </div>







                	    
                	</div>
                </div>
            </div>
        </div>

    
    


   


   