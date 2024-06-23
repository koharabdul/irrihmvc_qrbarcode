
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
		            	<strong>Rekap PPDP</strong>
		            </li>
		        </ol>
		    </div>
		</div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Rekap PPDP</h5>
                    <div class="ibox-tools">
                        <a class="fullscreen-link">
                            <i class="fa fa-expand" id="expand"></i>
                        </a> 
                    </div>
                </div>
                
                
            

                <div class="ibox-content" style="padding-bottom: 5px; padding-top: 5px;">
                    <div class="row wrapper white-bg page-heading" style="padding-bottom: 0px; padding-top: 5px;">

                	    <table class="table table-bordered table-hover">
                            <tr>
                                <th rowspan="2" class="text-center" width="35px;" style="vertical-align: middle;">No.</th>
                                <th rowspan="2" class="text-center" style="vertical-align: middle;">Nama PPDP</th>
                                <th rowspan="2" class="text-center" style="vertical-align: middle;" width="5%">No. TPS</th>
                                <th rowspan="2" class="text-center" style="vertical-align: middle;" width="5%">Jumlah KK</th>
                                <th rowspan="2" class="text-center" style="vertical-align: middle;" width="8%">% Pemilih Sudah Dicoklit</th>
                                <th colspan="3" class="text-center" style="vertical-align: middle;">Pemilih A-KWK</th>
                                <th colspan="3" class="text-center" style="background-color: #dff0d86b; vertical-align: middle;">Pemilih Cocok</th>
                                <th colspan="3" class="text-center" style="background-color: #d9edf759; vertical-align: middle;">Pemilih Baru</th>
                                <th colspan="3" class="text-center" style="background-color: #f2dede57; vertical-align: middle;">Pemilih TMS</th>
                                <th colspan="3" class="text-center" style="background-color: #fcf8e359; vertical-align: middle;">Perbaikan Data Pemilih</th>
                            </tr> 
                            <tr>
                                <td class="text-center" width="4%">L</td>
                                <td class="text-center" width="4%">P</td>
                                <td class="text-center" width="4%">L+P</td>
                                <td class="text-center" width="4%" style="background-color: #dff0d86b;">L</td>
                                <td class="text-center" width="4%" style="background-color: #dff0d86b;">P</td>
                                <td class="text-center" width="4%" style="background-color: #dff0d86b;">L+P</td>
                                <td class="text-center" width="4%" style=" background-color: #d9edf759;">L</td>
                                <td class="text-center" width="4%" style=" background-color: #d9edf759;">P</td>
                                <td class="text-center" width="4%" style=" background-color: #d9edf759;">L+P</td>
                                <td class="text-center" width="4%" style="background-color: #f2dede57;">L</td>
                                <td class="text-center" width="4%" style="background-color: #f2dede57;">P</td>
                                <td class="text-center" width="4%" style="background-color: #f2dede57;">L+P</td>
                                <td class="text-center" width="4%" style="background-color: #fcf8e359;">L</td>
                                <td class="text-center" width="4%" style="background-color: #fcf8e359;">P</td>
                                <td class="text-center" width="4%" style="background-color: #fcf8e359;">L+P</td>
                            </tr> 
                <?php 
                    $no=1;
                    foreach ($result as $k) {
                        echo"<tr>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px;'>$no</td>
                                <td style='padding-top:2px; padding-bottom:2px;'>$k->petugas</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px;'>$k->tps</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px;'>$k->jum_kk</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px;'>$k->persen</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px;'>$k->jum_laki</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px;'>$k->jum_perempuan</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px;'>$k->akwklp</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px;background-color: #dff0d86b;'>$k->cocokl</td>
                                <td class='text-center success' style='padding-top:2px; padding-bottom:2px;background-color: #dff0d86b;'>$k->cocokp</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px;background-color: #dff0d86b;'>$k->cocok</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px; background-color: #d9edf759;'>$k->barul</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px; background-color: #d9edf759;'>$k->barup</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px; background-color: #d9edf759;'>$k->baru</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px; background-color: #f2dede57;'>$k->tmsl</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px; background-color: #f2dede57;'>$k->tmsp</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px; background-color: #f2dede57;'>$k->tms</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px; background-color: #fcf8e359;'>$k->ubahl</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px; background-color: #fcf8e359;'>$k->ubahp</td>
                                <td class='text-center' style='padding-top:2px; padding-bottom:2px; background-color: #fcf8e359;'>$k->ubah</td>
                            </tr>";  
                            $no++;
                    }

                 ?>
                            
                           
                        </table>







                	    
                	</div>
                </div>
            </div>
        </div>



   


   