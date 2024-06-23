            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $subtitle; ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().strtolower($subtitle) ?>"><?php echo $subtitle; ?></a>
                        </li>
                        <li class="active">
                            <strong>Adds</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Adds New <?php echo $subtitle; ?></h5>
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
                    
                    <?php $attributes = array("name" => "formGroups", "method" => "post","class" => "form-horizontal");
                        echo form_open_multipart(strtolower($subtitle).'/saves', $attributes);
                    ?>
                        <div class="row wrapper white-bg page-heading" style="padding-bottom: 0px; padding-top: 5px;">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Provinsi <font color="red"> &nbsp; * </font></label>
                                <div class="col-lg-10" >
                                    <select name="provinsi_id" id="provinsi_id" class="select2_demo_2 form-control" style="width: 100%;" >
                                        <option value>Pilih Provinsi</option>
                                        <?php 
                                            foreach ($dataprov as $row) {
                                                echo '<option value="'.$row->id.'">'.$row->provinsi.'</option>';
                                            }
                                        ?>
                                    </select>
                                    <span class="help-block" style="color:red;">
                                    <?php 
                                        echo form_error('provinsi_id');
                                    ?> 
                                    </span>
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Kabupaten <font color="red"> &nbsp; * </font></label>
                                <div class="col-lg-10" >
                                    <select name="kabupaten_id" id="kabupaten_id" class="select2_demo_2 form-control" style="width: 100%;">
                                        <option value>Pilih Kabupaten</option>
                                    </select>
                                    <span class="help-block" style="color:red;">
                                    <?php 
                                        echo form_error('kabupaten_id');
                                    ?> 
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Kecamatan <font color="red"> &nbsp; * </font></label>
                                <div class="col-lg-10" >
                                    <select name="kecamatan_id" id="kecamatan_id" class="select2_demo_2 form-control" style="width: 100%;">
                                        <option value>Pilih Kecamatan</option>
                                    </select>
                                    <span class="help-block" style="color:red;">
                                    <?php 
                                        echo form_error('kecamatan_id');
                                    ?>
                                    </span>
                                </div>
                            </div>

                            <?php 
                                $datakelurahan  = array(''=>'Pilih Salah Satu','Kelurahan' => 'Kelurahan', 'Desa' => 'Desa');
                                input_select('type_kelurahan','Kelurahan / Desa',$datakelurahan,'',true);
                            ?>
                        </div>
                        <div class="row wrapper white-bg page-heading">
                            

                            <div class="table-responsive">
                                <table class="table table-striped" id="dynamic_field" style="margin-bottom: 15px;">
                                    <thead>
                                        <tr>
                                            <th width="50px"># </th>
                                            <th colspan="2">Nama Kelurahan </th>
                                            <!-- <th width="350px">Group </th> -->
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <tr style="padding-bottom: 0px; margin-bottom: 0px;">
                                            <td style="padding-bottom: margin-bottom:0px;0px;">1.</td>
                                            <td style="padding-top: 4px; padding-bottom: 0px;margin-bottom:0px;">
                                                <div class="col-lg-12 input-group">
                                                    <input type="text" name="nama_kelurahan[]" placeholder="Nama Kelurahan" class="input-sm form-control" style="background-color: transparent; border-top: none; border-left: none; border-right: none; border-bottom-style:dashed; padding-left: 0px; padding-right: 0px; margin-bottom: 0px; padding-bottom: 0px;" required="true"> 
                                                </div>
                                            </td>                                            
                                            <td style="padding-top: 4px; padding-bottom: 0px; margin-bottom:0px; width: 30px;">
                                                <div class="col-lg-12 input-group" style="padding-bottom: 0px;">
                                                    <button type="button" class="btn btn-sm btn-info pull-right" style="width: 30px;" name="add" id="add"><strong>+</strong></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            

                            
                            <div class="pull-right" style="padding-right: 0px;">
                                <a href="<?php echo base_url().strtolower($subtitle);?>" type="botton" class="btn btn-sm btn-default m-t-n-xs">Back</a>
                                <button type="submit" class="btn btn-sm btn-primary m-t-n-xs">Save</button>
                            </div>
                                    
                                
                           
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <?php echo $this->session->flashdata('infosaveadd'); ?>


    <script>
        $(document).ready(function(){
            var i = 1;
            $("#add").click(function(){
                i++;
                $("#dynamic_field").append("<tr id='row"+i+"'>"+
                                            "<td>"+i+"."+"</td>"+
                                            "<td style='padding-top: 4px; padding-bottom: 0px;'>"+
                                                "<div class='col-lg-12 input-group'>"+
                                                    "<input type='text' name='nama_kelurahan[]' name='id_kel' placeholder='Nama Kelurahan' class='input-sm form-control' style='background-color: transparent; border-top: none; border-left: none; border-right: none; border-bottom-style:dashed; padding-left: 0px; padding-right: 0px;' required='true'> "+
                                                "</div>"+
                                            "</td>"+
                                            "<td style='padding-top: 4px; padding-bottom: 0px;'>"+
                                                "<div class='col-lg-12 input-group'>"+
                                                    "<button type='button' class='btn btn-sm btn-danger pull-right btn-remove' style='width: 30px;' name='remove' id='"+i+"'><strong>-</strong</button>"+
                                                "</div>"+
                                            "</td>"+
                                        "</tr>");
            });
            $(document).on("click", ".btn-remove", function(){
                var button_id = $(this).attr("id");
                $("#row"+button_id+"").remove();
            });

            $('#provinsi_id').change(function(){
                var provinsi_id = $('#provinsi_id').val();
                if(provinsi_id != ''){
                    $.ajax({
                        url:"<?php echo base_url().strtolower($subtitle); ?>/fetch_kab",
                        method:"POST",
                        data:{provinsi_id:provinsi_id},
                        success:function(data){
                            $('#select2-kabupaten_id-container').text('Pilih Kabupaten');//untuk kembali ke semula jika ada perubahan select
                            $('#kabupaten_id').html(data);

                            $('#select2-kecamatan_id-container').text('Pilih Kecamatan');//untuk kembali ke semula jika ada perubahan select
                            $('#kecamatan_id').html("<option value>Pilih Kecamatan</option>");
                            
                        }
                    })
                }
            });
            $('#kabupaten_id').change(function(){
                var kabupaten_id = $('#kabupaten_id').val();
                if(kabupaten_id != ''){
                    $.ajax({
                        url:"<?php echo base_url().strtolower($subtitle); ?>/fetch_kec",
                        method:"POST",
                        data:{kabupaten_id:kabupaten_id},
                        success:function(data){
                            $('#select2-kecamatan_id-container').text('Pilih Kecamatan');//untuk kembali ke semula jika ada perubahan select
                            $('#kecamatan_id').html(data);
                        }
                    })
                }
            });
        });
    </script>

    
    
        
    
       
       