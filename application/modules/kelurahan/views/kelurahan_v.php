	 <link href="<?php echo base_url(); ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet"> 



            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $subtitle; ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                        </li>
                        <li class="active">
                            <strong><?php echo $subtitle; ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List <?php echo $subtitle; ?></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                
            

                <div class="ibox-content" style="padding-bottom: 5px; padding-top: 5px;">
                    <div class="row wrapper white-bg page-heading" style="padding-bottom: 0px; padding-top: 5px;">

                	    <div class="row">
	                        <div class="col-sm-7 column-title">
	                            <?php $attributes = array("name" => "flatihan", 'method' => 'post');
	                                echo form_open(strtolower($subtitle)."/search", $attributes);
	                            ?>
	                                <div class="input-group anto">
	                                    <?php 
	                                    	$urione = $this->uri->segment(2);
                                    		if($urione == 'search'){
                                    			$viewcari = $tampilcari;
                                    		}
                                    		else{
                                    			$viewcari = '';
                                    		}
                                    		$data = array('type' => 'text',
	                                                      'placeholder' => 'Searching for '.$subtitle.'/Desa, Nama '.$subtitle.', Kecamatan, Kabupaten and Provinsi',
	                                                      'class' => 'input-sm form-control',
	                                                      'name' => 'cari',
	                                                      'id' => 'input_search',
	                                                      'value' => $viewcari );
	                                        echo form_input($data);
	                                     ?>
	                                    <span class="input-group-btn">
	                                        <button type="submit" class="btn btn-sm btn-primary" id="btn_search"> Go!</button> 
	                                    </span>
	                                </div>
	                            <?php echo form_close(); ?> 
	                        </div>
    	                        <div class="col-sm-5 m-b-xs column-title">
    	                            <div class="btn-group">
    	                                <button type="botton" id="btn_add" class="btn btn-sm btn-white">Adds</button>
    	                                <button type="botton" id="btn_print" class="btn btn-sm btn-white">Print</button>
                        <?php $attributes = array("name" => "flatihan", 'method' => 'post', 'class' => 'btn-group');
                            echo form_open(strtolower($subtitle)."/delete_multiple", $attributes);
                        ?>
    	                                <button type="submit" id="btn_deleted" class="btn btn-sm btn-white" disabled>Delete</button>
    	                                
    	                            </div>
    	                        </div>
	                        </div>

                        
                        	<div>
                                <div class="table-responsive x_panel">
                                    <div class="x_content">
                                        <table class="table table-striped table-hover responsive-utilities jambo_table bulk_action" style="margin-bottom: 3px;" >
                                            <thead>
                                            <tr>
                                                <th width="1px">
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="checkall" class="checkitems" style="">
                                                        <label>
                                                        </label>
                                                    </div>
                                                </th>
                                                <th>No.</th>
                                                <th>Nama Kel./Desa</th>
                                                <th>Nama Kecamatan</th>
                                                <th>Nama Kabupaten</th>
                                                <th>Nama Provinsi</th>
                                                <th>Date Created</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $urione = $this->uri->segment(2);
                                                if($urione == 'search'){
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
                                                            <td colspan='9'>$viewempty<td>
                                                        </tr>";
                                                }
                                                else
                                                {
                                                    foreach ($results as $p) {
                                                        $datecreated = date_convert($p->date_created,true);
                                                        // $arr_kalimat = explode("|", $datecreated);
                                                        // var_dump($arr_kalimat);
                                                        
                                                        
                                                        
                                                        echo"
                                                        <tr>
                                                            <td>
                                                                <div class='checkbox checkbox-inline' >
                                                                    <input type='checkbox' name='table_records[]' class='checkitem' value='$p->id'>
                                                                    <label> 
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>$no</td>
                                                            <td>$p->type_kelurahan $p->kelurahan</td>
                                                            <td>$p->kecamatan</td>
                                                            <td>$p->kabupaten</td>
                                                            <td>$p->provinsi</td>
                                                            <td>"; echo date_convert($p->date_created,true); echo"</td>
                                                            <td>$p->created_byname</td>
                                                            <td>
                                                                <a href='".base_url().strtolower($subtitle)."/view/$p->id'>View</a>
                                                            </td>
                                                        </tr>";
                                                        $no++;
                                                    }
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div style="padding-top: 2px;">
                                    <label style="font-weight: 100; padding-top: 4px; padding-bottom: 5px;">
                                        <?php echo $numberofpage; ?> <span class="infochecked"></span>
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

    <?php echo $this->session->flashdata('infosaveadd'); ?>
    <?php echo $this->session->flashdata('infoupdate'); ?>
    <?php echo $this->session->flashdata('infodeleted'); ?>
    <?php echo $this->session->flashdata('inforemovechecked'); ?>
    

    <script>
        $("#checkall").change(function(){
            $(".checkitem").prop("checked", $(this).prop("checked"));
            if($(".checkitem:checked").length > 0){
                $('#btn_deleted').prop('disabled', false);
                $(".infochecked").text("("+$('.checkitem:checked').length + " records selected)");
                $('#btn_add').prop('disabled', true);
                $('#btn_print').prop('disabled', true);
                $('#input_search').prop('disabled', true);
                $('#input_search').val('');
                $('#btn_search').prop('disabled', true);
            }
            else if($(".checkitem:checked").length == 0){
                $(".checkitems").prop("checked", false);
                $('#btn_deleted').prop('disabled', true);
                $(".infochecked").text("");
                $('#btn_add').prop('disabled', false);
                $('#btn_print').prop('disabled', false);
                $('#input_search').prop('disabled', false);
                $('#btn_search').prop('disabled', false);
            }
        })
        $(".checkitem").change(function(){
            if($(".checkitem:checked").length > 0){
                $('#btn_deleted').prop('disabled', false);
                $('#btn_add').prop('disabled', true);
                $('#btn_print').prop('disabled', true);
                $('#input_search').prop('disabled', true);
                $('#btn_search').prop('disabled', true);
                $('#input_search').val('');
                if($(".checkitem:checked").length == $(".checkitem").length){
                    $(".checkitems").prop("checked", true);
                    $(".infochecked").text("("+$('.checkitem:checked').length + " records selected)");
                }
                else if($(".checkitem:checked").length < $(".checkitem").length){
                    $(".checkitems").prop("checked", false);
                    $(".infochecked").text("("+$('.checkitem:checked').length + " records selected)");
                }
            }
            else if($(".checkitem:checked").length == 0){
                $(".checkitems").prop("checked", false);
                $('#btn_deleted').prop('disabled', true);
                $(".infochecked").text("");
                $('#btn_add').prop('disabled', false);
                $('#btn_print').prop('disabled', false);
                $('#input_search').prop('disabled', false);
                $('#btn_search').prop('disabled', false);
            }
        });
        $('#btn_deleted').click(function(){
           window.location.href="<?php echo base_url().strtolower($subtitle); ?>/delete_multiple";
        });
        $('#btn_add').click(function(){
            window.location.href="<?php echo base_url().strtolower($subtitle); ?>/adds";
        });
        $('#btn_print').click(function(){
            window.location.href="<?php echo base_url().strtolower($subtitle); ?>/prints";
        });
        

        
    </script>
