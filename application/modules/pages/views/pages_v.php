<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet"><!-- tambahan untuk tabel pagination bulk -->
<link href="<?php echo base_url(); ?>assets/css/icheck/flat/green.css" rel="stylesheet"><!-- tambahan untuk tabel pagination bulk -->
 			

 			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Pages</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                        </li>
                        <li class="active">
                            <strong>Pages</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>List Pages </h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>                        
                       <div class="ibox-content" style="padding-bottom: 1px;">
		                    <div class="row">
		                        <div class="col-sm-4 column-title">
		                            <?php $attributes = array("name" => "flatihan", 'method' => 'post');
		                                echo form_open("pages/src", $attributes);
		                            ?>
		                                <div class="input-group anto">
		                                    <?php 
		                                    	$urione = $this->uri->segment(2);
                                        		if($urione == 'src'){
                                        			$viewcari = $tampilcari;
                                        		}
                                        		else{
                                        			$viewcari = '';
                                        		}
                                        		$data = array('type' => 'text',
		                                                      'placeholder' => 'Name Pages/Urisegment',
		                                                      'class' => 'input-sm form-control',
		                                                      'name' => 'cari',
		                                                      'value' => $viewcari );
		                                        echo form_input($data);
		                                     ?>
		                                    <span class="input-group-btn">
		                                        <button type="submit" class="btn btn-sm btn-primary"> Go!</button> 
		                                    </span>
		                                </div>
		                            <?php echo form_close(); ?> 
		                        </div>
		                        <div class="col-sm-8 m-b-xs column-title">
		                            <div class="btn-group">
		                                <?php echo anchor('pages/add','Add',array('class' => 'btn btn-sm btn-white','type' => 'botton')); ?>
		                                <?php echo anchor('pages/prt','Print',array('class' => 'btn btn-sm btn-white','type' => 'botton')); ?>
		                                <button type="botton" class="btn btn-sm btn-white" disabled>Delete</button>
		                            </div>
		                        </div>
		                        <div class="col-sm-4 bulk-actions">
		                            <div class="input-group anto">
		                                <?php 
		                                    	$urione = $this->uri->segment(2);
                                        		if($urione == 'src'){
                                        			$viewcari = $tampilcari;
                                        		}
                                        		else{
                                        			$viewcari = '';
                                        		}
                                        		$data = array('type' => 'text',
		                                                      'placeholder' => 'Name Pages/Urisegment',
		                                                      'class' => 'input-sm form-control',
		                                                      'name' => 'cari',
		                                                      'value' => $viewcari,
		                                                  	  'disabled' => 'true');
		                                        echo form_input($data);
		                                     ?>
		                                <span class="input-group-btn">
		                                    <button type="button" class="btn btn-sm btn-primary" disabled> Go!</button> 
		                                </span>
		                            </div>
		                        </div>
		                        <?php $attributes = array("name" => "flatihan", 'method' => 'post');
			                        echo form_open("pages/dlm", $attributes);
			                    ?>
			                        <div class="col-sm-8 m-b-xs bulk-actions">
			                            <div class="btn-group anto">
			                                <button type="botton" class="btn btn-sm btn-white" disabled>Add</button>
			                                <button type="botton" class="btn btn-sm btn-white" disabled>Print</button>
			                                <?php $data = array('type' => 'submit', 'class' => 'btn btn-sm btn-white ', 'content' => 'Delete', 'onclick' => "return confirm('are you sure want to delete?');");
			                                    echo form_button($data);
			                                ?>
			                            </div>
			                        </div>
			                        <div style="padding: 15px; padding-bottom: 0px; padding-top: 0px; padding-bottom: 0px;">
			                            <div class="table-responsive x_panel" style="padding:0.1px; padding-bottom: 0px; padding-top:0px; padding-bottom:0px;border: none;">
			                                <div class="x_content">
			                                    <table class="table table-striped responsive-utilities jambo_table bulk_action" style=" margin-bottom: 0px;">
			                                        <thead>
			                                          <tr class="headings">
			                                          	<th width="1%">
			                                              <input type="checkbox" id="check-all" class="flat">
			                                            </th>
			                                            <th class="column-title" style="text-align: left; width: 6%;">No. </th>
			                                            <th class="column-title" width="20%">Page Name</th>
			                                            <th class="column-title" width="20%">Uri </th>
			                                            <th class="column-title" width="21%">Group </th>
			                                            <th class="column-title" width="8%">Active </th>
			                                            <th class="column-title" width="17%">Date Created </th>
			                                            <th class="column-title no-link last" width="6%"><span class="nobr">Action</span>
			                                            </th>
			                                            <th class="bulk-actions" colspan="7">
			                                              <a class="antoo" style="color:#333; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
			                                            </th>
			                                          </tr>
			                                        </thead>
			                                        <tbody>

				                                        <?php 
			                                        		$urione = $this->uri->segment(2);
			                                        		if($urione == 'src'){
			                                        			$offset = $this->uri->segment(4, 0) + 1; //untuk penomoran
			                                        			$viewempty = 'No matching records found';
			                                        		}
			                                        		else{
			                                        			$offset = $this->uri->segment(3, 0) + 1; 
			                                        			$viewempty = 'Empty File';
			                                        		}
				                                      
				                                            $no = $offset++;
				                                            if(empty($results))
				                                            {
				                                            	echo"<tr class='even pointer'>
				                                            			<td colspan='7'>$viewempty<td>
				                                            		</tr>";
				                                            }
				                                            else
				                                            {
					                                            foreach ($results as $p) {
					                                            
					                                            	$datecreated = date_convert($p->date_created,true);
					                                            	// $arr_kalimat = explode("|", $datecreated);
					                                            	// var_dump($arr_kalimat);

					                                                echo"
					                                                      <tr class='even pointer'>
					                                                      	<td class='a-center' width='1%'>
					                                                          <input type='checkbox' class='flat' name='table_records[]' value='$p->id'>
					                                                        </td>
					                                                        <td align='left' width='6%'>$no</td>
					                                                        <td width='20%'>$p->name</td>
					                                                        <td width='20%'>$p->uri</td>
					                                                        <td width='21%'>$p->countpage</td>
					                                                        <td width='8%'>"; echo ($p->active) ? "<i class='fa fa-check text-navy'></i>" : "<i class='fa fa-times text-danger'></i>"; echo"</td>
					                                                        <td width='17%'>"; echo date_convert($p->date_created,true); echo"</td>
					                                                        <td class='last' width='6%'>
					                                                        	<a href='".base_url()."pages/vew/$p->id' style='margin:inherit;border:none; background-color:transparent;'>View</a>
																			</td>
					                                                      </tr>
					                                                      ";
					                                                $no++;
					                                            }
					                                        }
				                                            $s = $offset - 1;
				                                            $j = $s + 9;
				                                            if($j >= $row)
				                                            {
				                                                $tot = $row;
				                                                if(count($results)>0){
				                                                     $sjadi = $s;
				                                                }
				                                                else{
				                                                     $sjadi = 0;
				                                                }
				                                            }
				                                            else
				                                            {
				                                                $tot = $j;
				                                                if(count($results)>0){
				                                                     $sjadi = $s;
				                                                }
				                                                else{
				                                                     $sjadi = 0;
				                                                }
				                                            }
				                                        ?>
			                                        </tbody>
			                                    </table>
			                                </div>

			                            </div>
			                            <div style="margin-top:10px;">
		                                    <label style="padding-top:5px; font-weight: 100;">
		                                        <?php
		                                        	if($row>10){
		                                        		echo"Showing $sjadi to $tot of $row entries"; 
		                                        	} 
		                                        ?>  
		                                    </label>
		                                    <label class="active pull-right">
		                                        <!-- untuk pagination -->
		                                        <ul class="pagination" style="padding:0px; margin:inherit; font-weight: 100;">
		                                            <?php 
		                                                echo $this->pagination->create_links();
		                                            ?>
		                                        </ul>
		                                        <!-- sampai sini pagination -->
		                                    </label>
		                                </div>
			                        </div>
			                    <?php echo form_close(); ?>
		                    </div>
		                    
		               











                        </div>
                    </div>
                </div>

            </div>
        </div>


		<?php echo $this->session->flashdata('infosave'); ?>
		<?php echo $this->session->flashdata('infodeleted'); ?>

	<!-- pace.min merupakan cara untuk menghindari error pada chat/time gitu lah -->
	<script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>


<script src="<?php echo base_url(); ?>assets/js/icheck/icheck.min.js"></script><!-- ditambahkan untuk tabel pagination dan bulk -->
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script><!-- ditambahkan untuk tabel pagination dan bulk -->
