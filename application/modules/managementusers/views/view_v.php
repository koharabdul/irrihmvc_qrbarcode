    
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
                        <?php $attributes = array("name" => "formopen".$subtitle, "method" => "post", "class" => "form-horizontal");
                            echo form_open(strtolower($subtitle)."/savepropertieseditor", $attributes);
                        ?> 
                        
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="m-b-md">
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-primary btn-sm" type="button" id="btnUpdated"><i class="fa fa-check" style="margin-right: 5px;"></i>  Save</button>
                                                <button class="btn btn-warning btn-sm demo4" type="button" id="delete"><i class="fa fa-trash" style="margin-right: 5px;"></i> Delete</button>
                                            </div>
                                            <h2><?php echo $results['name'] ?> Properties</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-sm">
                                    <div class="col-lg-12">
                                        <div class="panel blank-panel">
                                            <div class="panel-heading">
                                                <div class="panel-options">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active "><a href="#tab-1" data-toggle="tab" class="skin2">Details</a></li>
                                                        <li class=""><a href="#tab-2" data-toggle="tab" class="skin2">Edit</a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">

                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab-1">

                                                        <fieldset>
                                                            <?php input_text2('', 'Level User',$results['name'],true,true) ?>
                                                            <?php input_text2('', 'Description',$results['description'],true,true) ?>
                                                            <?php label_view('Active',$results['active']) ?>
                                                            <?php label_view_array('List Users',$results['groupuser']) ?>
                                                            <?php label_view_array('List Permission',$results['groupuserview']) ?>
                                                            <hr class="hr">
                                                            <?php input_text2('', 'Created At', date_convert($results['date_created'],true),true,true) ?>
                                                            <?php input_text2('', 'Created By Name of', $results['created_byname'],true,true) ?>
                                                            <?php input_text2('', 'Modified At', date_convert($results['date_modified'],true),true,true) ?>
                                                            <?php input_text2('', 'Modified By Name of', $results['modified_byname'],true,true) ?>
                                                        </fieldset> 
                                                        
                                                    </div>
                                                    <div class="tab-pane" id="tab-2" >
                                                        <fieldset>
                                                            <?php input_hidden('managementuser_id', $results['id']); ?>
                                                            <?php input_text('name', 'Name of Level User', $results['name'],true,false) ?>
                                                            <?php input_textarea('description', 'Description', $results['description'],false,false) ?>
                                                            <?php
                                                                $active = $results['active'];
                                                                ($active)? "false" : "true";
                                                                input_checkbox_switch('active','Active',$active,'');
                                                            ?>
                                                            <div id="list_menuusers">
                                                                <!-- <?php input_textarea('listusers', 'List Users', '',false,false,'','height:34px;resize: vertical;') ?> -->
                                                           <?php 
                                                                input_multiselect2('listusers', 'List Users', $levu_select,$levu_selected,'');
                                                            ?> 
                                                            </div>

                                                            
                                                            <!-- <select id="list_users" data-placeholder="Choose" class="select2_demo_2 form-control input-sm" multiple style="width:350px;">
                                                                <option value='U-36785963-2f37-1c50-9549-a35d9af07a81'>Aan Sauhanda</option>
                                                                <option value='PER-44eaa6c4-3f90-8d2e-cb93-c2f093c0ec3b'>Abdul Kohar</option>
                                                                  
                                                            </select>

 -->
                                                            
                                                           
                                                          
                                                        </fieldset> 
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>





          <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <label class="modal-title"></label>
                    </div>
                    <div class="modal-body" style="padding:15px;">
                       <div class="row">  
                            <div class="col-sm-8">
                                
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="search" id="search" class="form-control input-sm" placeholder="Cari Nama, NIK, dan Pendidikan">
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive x_panel" id="country_table">
                               
                            </div>
                        </div>
                        
                        <div>
                            <label style="font-weight: 100; padding-top: 6px; padding-bottom: 5px;" class="showCountData"></label> <span class="infocheckeds" id="infocheckeds"></span>
                            <label class="pull-right" id="pagination_link" style="font-weight: 100;margin-top: -20px;"></label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white btn-sm" data-dismiss="modal" >Close</button>
                        <button type="button" class="btn btn-primary btn-sm" id="select_users" >Select Users</button>
                    </div>
                </div>
            </div>
        </div>

        
    
    
    
        
        <script>
            $(document).ready(function(){
                $("#btnUpdated").on("click", function(){
                    var formData = new FormData();
                    formData.append('name',$('#name').val());
                    formData.append('description',$('#description').val());
                    formData.append('list_users',$('#listusers').val());
                    formData.append('id',$('#managementuser_id').val());
                    if ($('#active').is(':checked')){
                        formData.append('active',1);
                    }
                    else{
                        formData.append('active',0);
                    }
                    swal({
                        title: "Do you want to Update?",
                        text: "You will be change this data!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#F7A54A",
                        confirmButtonText: "Yes, update it!",
                        closeOnConfirm: false
                    },
                    function(){
                        $.ajax({
                            method: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            url: '<?php echo base_url().$mylink ?>/update',
                            success: function(){
                                window.location.href="<?php echo base_url().$mylink; ?>";
                            },
                            error: function(){
                                alert('Could not add data');
                            }
                        }); 
                    });
                });

                $('.demo4').click(function () {
                    swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                        }, function () {
                            swal({
                                title: "Deleted!",
                                text: "Your imaginary file has been deleted.",
                                type: "success",
                            }, 
                            function(){
                                var formData = new FormData();
                                formData.append('id',$('#managementuser_id').val());
                                $.ajax({
                                    method: "POST",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    url: '<?php echo base_url().$mylink ?>/delete',
                                    success: function(){
                                        window.location.href="<?php echo base_url().$mylink; ?>";
                                    },
                                    error: function(){
                                        alert('Could not add data');
                                    }
                                }); 
                        });
                    });
                });    

                /////////////////////////////////////////////////////////////////////////////////////
                $(document).on("click","#list_menuusers",function(){
                    $('#myModal5').modal({backdrop: "static"});
                    $('#myModal5').modal('show');
                    $('#myModal5').find('.modal-title').text('Select From List Users');
                    // $('#myModal').modal({backdrop: false});
                   

                });
                function load_country_data(page){
                    var formData = new FormData();
                    formData.append('id','<?php echo $this->uri->segment(3); ?>');
                    formData.append('search',$('#search').val());
                                        
                    $.ajax({
                        url:"<?php echo base_url().$mylink; ?>/pagination/"+page,
                        method:"POST",
                        dataType:"json",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success:function(data){
                            $('#country_table').html(data.country_table);
                            $('#pagination_link').html(data.pagination_link);
                            $('#infocheckeds').text('');
                            $('.showCountData').html(data.showCountData);
                        }
                    });
                }
                load_country_data(1);
                $(document).on("click",".pagination li a", function(event){
                    event.preventDefault();
                    var page = $(this).data("ci-pagination-page");
                    load_country_data(page);
                });
                $(document).on("change","#checkall_users", function(){
                    $(".checkitem_users").prop("checked", $(this).prop("checked"));
                    if($(".checkitem_users:checked").length > 0){
                        $(".infocheckeds").text("("+$(".checkitem_users:checked").length + " records selected)");
                    }
                    else if($(".checkitem_users:checked").length == 0){
                        $(".checkitems_users").prop("checked", false);
                        $(".infocheckeds").text("");
                    }
                });
                $(document).on("change",".checkitem_users", function(event){
                    event.preventDefault();
                    if($(".checkitem_users:checked").length > 0){
                        $('#btn_deleted').prop('disabled', false);
                        if($(".checkitem_users:checked").length == $(".checkitem_users").length){
                            $("#checkall_users").prop("checked", true);
                            $(".checkitems_users").prop("checked", true);
                            $(".infocheckeds").text("("+$(".checkitem_users:checked").length + " records selected)");
                        }
                        else if($(".checkitem_users:checked").length < $(".checkitem_users").length){
                            $(".checkitems_users").prop("checked", false);
                            $(".infocheckeds").text("("+$(".checkitem_users:checked").length + " records selected)");
                        }
                    }
                    else if($(".checkitem_users:checked").length == 0){
                        $("#checkall_users").prop("checked", false);
                        $(".checkitems_users").prop("checked", false);
                        $(".infocheckeds").text("");
                    }
                });
                $(document).on("keyup","#search", function(){
                    load_country_data(1);
                });


                $(document).on("click","#select_users",function(){
                    // var formData = new FormData();
                       
                    var checkedit = [];
                    $('.checkitem_users').each(function(){
                        if($(this).is(":checked"))
                        {
                            checkedit.push($(this).val());
                        }
                    });
                    checkedit = checkedit.toString();

                    $("#listusers").val(checkedit);
                    $('#myModal5').modal('hide');
                });           
               
               
            });
        </script>