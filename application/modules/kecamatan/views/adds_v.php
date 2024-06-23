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
                            <strong>Add</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add New <?php echo $subtitle; ?></h5>
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
                        <?php $attributes = array("name" => "formGroups", "method" => "post");
                            echo form_open_multipart(strtolower($subtitle).'/saves', $attributes);
                        ?>
                            <div class="table-responsive">
                                <table class="table table-striped" id="dynamic_field" style="margin-bottom: 15px;">
                                    <thead>
                                        <tr>
                                            <th width="50px"># </th>
                                            <th colspan="2">Kecamatan </th>
                                            <!-- <th width="350px">Group </th> -->
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <tr style="padding-bottom: 0px; margin-bottom: 0px;">
                                            <td style="padding-bottom: margin-bottom:0px;0px;">1.</td>
                                            <td style="padding-top: 4px; padding-bottom: 0px;margin-bottom:0px;">
                                                <div class="col-lg-12 input-group">
                                                    <input type="text" name="nama_kecamatan[]" placeholder="Nama Kecamatan" class="input-sm form-control" style="background-color: transparent; border-top: none; border-left: none; border-right: none; border-bottom-style:dashed; padding-left: 0px; padding-right: 0px; margin-bottom: 0px; padding-bottom: 0px;" required="true"> 
                                                </div>
                                            </td>                                            
                                            <td style="padding-top: 4px; padding-bottom: 0px; margin-bottom:0px; width: 30px;">
                                                <div class="col-lg-12 input-group" style="padding-bottom: 0px;">
                                                    <button type="button" class="btn btn-sm btn-info pull-right" style="width: 30px;" name="add" id="add"><strong>+</strong></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" style="padding-top: 0px; padding-right: 0px; padding-left: 0px; height: 32px; padding-bottom: 0px; margin-bottom: 0px; background-color: #f3f3f4;">
                                                <!-- <div class="col-lg-12 input-group" style="padding:none; margin:none; padding-bottom: 0px; margin-bottom: 0px;"> -->
                                                    <?php echo form_dropdown('kabupaten_id', $datapages, '',array(
                                                            'class' => 'select2_demo_2 form-control',
                                                            'style'=>'width:100%;'
                                                        ));
                                                    ?>
                                                <!-- </div> -->
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <!-- <div class="form-group pull-right"> -->
                                    <div class="pull-right">
                                        <button class="btn btn-sm btn-default m-t-n-xs" type="button" onclick="self.history.back()">Kembali</button>
                                        <button class="btn btn-sm btn-primary m-t-n-xs" type="submit">Save</button>
                                    </div>
                                <!-- </div> -->
                            </div>


                        <?php echo form_close(); ?>
                    </div>




                    
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
                                                    "<input type='text' name='nama_kecamatan[]' placeholder='Nama Kecamatan' class='input-sm form-control' style='background-color: transparent; border-top: none; border-left: none; border-right: none; border-bottom-style:dashed; padding-left: 0px; padding-right: 0px;' required='true'> "+
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

            // $(document).ready(function(){
            //  $("h2").append("<p>Di DUMET School</p>");
            //  $(".inner").append("<div>Digital Marketing</div>");
            // });
        });
    </script>

    
    
        
    
       
       