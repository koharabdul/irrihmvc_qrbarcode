            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $subtitle ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().$datatampil ?>"><?php echo $subtitle; ?></a>
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
                    <h5>Create New <?php echo $subtitle; ?></h5>
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
                        
                        <form method="post" id="import_form" enctype="multipart/form-data">

                        <input type="file" name="file" id="file">
                        <br>

                        
                                
                            

                            
                        <input type="submit" name="import" value="Import" id="import" disabled="true" class="btn btn-default btn-sm"></input>  
                        <?php echo form_close(); ?> 
                        <div class="table-responsive" id="customer_data"></div>
                    </div>


                    

                    
                </div>
            </div>
        </div>
        <?php echo $this->session->flashdata('infosave'); ?>


        <script>
            load_data();
            function load_data(){
                $.ajax({
                    url:"<?php echo base_url().$datatampil ?>/import",
                    method:"POST",
                    success:function(data){
                        $('#customer_data').html(data);
                    },
                })
            }
            $('#file').on('change', function(){
                var file = $('#file').val();
                if(file!=''){
                    $('#import').prop('disabled', false);
                }
            });
            $('#import_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:"<?php echo base_url().$datatampil ?>/save",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){
                        load_data();
                        alert(data);
                        $('#import').prop('disabled', true);
                        $('#file').val('');
                    }
                })

            });
        </script>