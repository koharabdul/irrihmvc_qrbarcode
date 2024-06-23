
 			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Ranting</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>home">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>ranting">Ranting</a>
                        </li>
                        <li class="active">
                            <strong>Tampil Data</strong>
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
                            <h5>Daftar Nama - nama Ranting / Pengamat </h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                       <div class="ibox-content">
		                    <div class="row">
		                        <div class="col-sm-4 column-title">
		                            <?php $attributes = array("name" => "flatihan", 'method' => 'post');
		                                echo form_open("ranting/src", $attributes);
		                            ?>
		                                <div class="input-group anto">
		                                    <input type="text" placeholder="Pencarian NIK/Nama Lengkap" class="input-sm form-control" name="cari"> 
		                                    <span class="input-group-btn">
		                                        <button type="submit" class="btn btn-sm btn-primary"> Go!</button> 
		                                    </span>
		                                </div>
		                            <?php echo form_close(); ?>   
		                        </div>
		                        <div class="col-sm-8 m-b-xs column-title">
		                            <div class="btn-group">
		                                <?php echo anchor('ranting/add','Add',array('class' => 'btn btn-sm btn-white','type' => 'botton')); ?>
		                                <?php echo anchor('ranting/print','Print',array('class' => 'btn btn-sm btn-white','type' => 'botton')); ?>
		                                <button type="botton" class="btn btn-sm btn-white" disabled>Delete</button>
		                            </div>
		                        </div>
		                        <div class="col-sm-4 bulk-actions">
		                            <div class="input-group anto">
		                                <input type="text" placeholder="Pencarian NIK/Nama Lengkap" class="input-sm form-control" disabled> 
		                                <span class="input-group-btn">
		                                    <button type="button" class="btn btn-sm btn-primary" disabled> Go!</button> 
		                                </span>
		                            </div>
		                        </div>
		                    <?php $attributes = array("name" => "flatihan", 'method' => 'post');
		                        echo form_open("ranting/delete_multiple", $attributes);
		                    ?>
		                        <div class="col-sm-8 m-b-xs bulk-actions">
		                            <div class="btn-group anto">
		                                <button type="botton" class="btn btn-sm btn-white" disabled>Add</button>
		                                <button type="botton" class="btn btn-sm btn-white" disabled>Print</button>
		                                <?php $data = array('type' => 'submit', 'class' => 'btn btn-sm btn-white ', 'content' => 'Delete', 'onclick' => "return confirm('are you sure want to delete?');");
		                                    echo form_button($data);
		                                ?>
		                                <!-- <button type="submit" class="btn btn-sm btn white">Delete</button> -->
		                            </div>
		                        </div>
		                        <div style="padding: 15px; padding-bottom: 0px;">
		                            <div class="table-responsive x_panel" style="padding:0.1px; padding-bottom: 0px; padding-top:0px; padding-bottom:0px;border: none;">
		                                <div class="x_content">
		                                    <table class="table table-striped responsive-utilities jambo_table bulk_action">
		                                        <thead>
		                                          <tr class="headings">
		                                            <th>
		                                              <input type="checkbox" id="check-all" class="flat">
		                                            </th>
		                                            <th class="column-title">No. </th>
		                                            <th class="column-title">Nama Ranting </th>
		                                            <th class="column-title">Lokasi</th>
		                                            <th class="column-title">Tahun Berdiri</th>
		                                            <th class="column-title no-link last"><span class="nobr">Action</span>
		                                            </th>
		                                            <th class="bulk-actions" colspan="7">
		                                              <a class="antoo" style="color:#333; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
		                                            </th>
		                                          </tr>
		                                        </thead>

		                                        <tbody>

		                                        <?php $offset = $this->uri->segment(3, 0) + 1; ?>
		                                        <?php 
		                                            $no = $offset++;
		                                            foreach ($results as $p) {
		                                                
		                                                echo"
		                                                      <tr class='even pointer'>
		                                                        <td class='a-center '>
		                                                          <input type='checkbox' class='flat' name='table_records[]' value='$p->id'>
		                                                        </td>
		                                                        <td>$no</td>
		                                                        <td>$p->nm_ranting</td>
		                                                        <td>$p->lokasi</td>
		                                                        <td>$p->thn_berdiri</td>
		                                                        <td class='last'>".anchor('ranting/vie/'.$p->id,'View')."</a></td>
		                                                      </tr>";
		                                                $no++;
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
		                        </div>
		                    </div>
		                        <div class="row">
		                            <div class="col-sm-12 m-b-xs">
		                                <div>
		                                    <label style="padding-top:5px; font-weight: 100;">
		                                        <?php echo"Showing $sjadi to $tot of $row entries"; ?>  
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
		                    <?php echo form_close(); ?>   
		               











                        </div>
                    </div>
                </div>

            </div>
        </div>
		<?php echo $this->session->flashdata('info'); ?>
		<?php echo $this->session->flashdata('infodeleted'); ?>


       