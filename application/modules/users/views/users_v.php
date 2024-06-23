	<link href="<?php echo base_url(); ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet"> 
    <style type="text/css">
        .dipilih .fa.fa-ako:after{
            content: "\f160";
        }
        
        /*.dipilih .fa.fa-sort-amount-asc:before{
            content: "\f161";
        }*/
        
        
    </style>

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
	                                                      'placeholder' => 'Searching for NIK, Name, Gender, Religion, Marital Status, Last Education or Employement of '.$subtitle,
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
	                                <button type="botton" id="btn_add" class="btn btn-sm btn-white">Add</button>
	                                <button type="botton" id="btn_print" class="btn btn-sm btn-white">Print</button>
	                                <button type="botton" id="btn_deleted" class="btn btn-sm btn-white" disabled>Delete</button>
	                                
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
			                                <th class="hurung">
                                                <label>
                                                    NIK
                                                    <input type="checkbox" id="option1" name="options" class="options" > </label>
                                                <i class="aktif"></i>
                                            </th>
			                                <th class="hurung">
                                                <label>
                                                    Nama Lengkap
                                                <input type="checkbox" id="option2" name="options" class="options" > </label>
                                                <i class="aktif"></i>
                                            </th>
			                                <th class="hurung">
                                                <label>
                                                    Tempat, Tgl. Lahir
                                                <input type="checkbox" id="option3" name="options" class="options" > </label>
                                                <i class="aktif"></i>
                                            </th>
                                            <th class="hurung">
                                                <label>
                                                    Umur
                                                    <input type="checkbox" id="option3" name="options" class="options" > </label>
                                                <i class="aktif"></i>
                                            </th>
			                                <th class="hurung">
                                                <label>Agama 
                                                <input type="checkbox" id="option4" name="options" class="options" > 
                                                </label>
                                            </th>
                                            <th class="hurung">
                                                <label>
                                                Sts. Perkawinan 
                                                <input type="checkbox" id="option5" name="options" class="options">
                                                </label>
                                            </th>
                                            <th class="hurung">Pendidikan</th>
                                            <th class="hurung">Pekerjaan</th>
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
                                            			<td colspan='10'>$viewempty<td>
                                            		</tr>";
                                            }
                                            else
                                            {
	                                            foreach ($results as $p) {
	                                            	$datecreated = date_convert($p->date_created,true);
	                                            	// $arr_kalimat = explode("|", $datecreated);
	                                            	// var_dump($arr_kalimat);
	                                            	if($p->user_active=='1'){
	                                            		$useractive = " <i class='fa fa-key pull-right'> </i><i class='fa fa-user pull-right'> </i> ";
	                                            	}
	                                            	else{
	                                            		$useractive = "";
	                                            	}

	                                            	if(($p->ta_lahir == 0) || ($p->ta_lahir == null) || ($p->ta_lahir == ''))
	                                                {
	                                                    $q = "-";
	                                                }
	                                                else
	                                                {
	                                                    if($p->b_post > $p->b_lahir)
	                                                    {
	                                                        $q = $p->umur;
	                                                    }
	                                                    else if($p->b_post == $p->b_lahir)
	                                                    {
	                                                        if($p->t_post >= $p->t_lahir)
	                                                        {
	                                                            $q = $p->umur;
	                                                        }
	                                                        else
	                                                        {
	                                                            $q = $p->umur-1;
	                                                        }
	                                                    }
	                                                    else
	                                                    {
	                                                        $q = $p->umur-1;
	                                                    }
	                                                }
                                                    
                                                    
	                                                echo"
						                            <tr>
						                            	<td>
						                            		<div class='checkbox checkbox-inline' >
			                                                    <input type='checkbox' name='table_records[]' class='checkitem'>
			                                                    <label> 
			                                                    </label>
			                                                </div>
						                            	</td>
						                                <td>$no</td>
						                                <td>$p->NIK</td>
						                                <td>$p->jns_kelamin $p->scat $useractive</td>
                                                        <td>$p->tmp_lahir, "; echo date_convert($p->tgl_lahir); echo"</td>
						                                <td>$q Tahun</td>
                                                        <td>$p->agama</td>
                                                        <td>$p->sts_perkawinan</td>
                                                        <td>$p->scatpendidikan</td>
                                                        <td>$p->scatpekerjaan</td>
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



                    </div>                   
                </div>
            </div>
        </div>
        <?php echo $this->session->flashdata('infosave'); ?>

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
            alert('Hello');
        });
        $('#btn_add').click(function(){
            window.location.href="<?php echo base_url().strtolower($subtitle); ?>/create";
        });
        $(".hurung").click(function(event){

            $(".hurung").removeClass("dipilih");

            

            if($(".options:checked").length > 1){
                $(".options").prop("checked", false);
            }
            else{
                $(".aktif").html("<label class='fa fa-ako pull-right'></label>");
                $(this).addClass("dipilih");
                 window.location.href="<?php echo base_url().strtolower($subtitle); ?>";
            }




            // if($(is(not(".options:checked")))){
            //     alert("hall");
            // }
        });
        
        

        
    </script>