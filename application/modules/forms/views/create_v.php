
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins/jqueryHover/jquery-hover-dropdown-box.css" />
    <link href="<?php echo base_url(); ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet"> 
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $subtitle; ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                        </li>
                        <?php echo $runlink; ?>
                        <li class="active">
                            <a href="<?php echo base_url(); ?>forms">Forms</a>
                        </li>
                        <li class="active">
                            <strong><?php echo $namaform['name']; ?></strong>
                        </li>
                    </ol>
                </div>
            </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="wrapper wrapper-content project-manager">
                    <h4>Menu</h4>
                    <div class="dd" id="nestable">
                        <ol class="dd-list" id="shownes" >
                           
                            <!-- <li class="dd-item" data-id="4" id="six">
                                <div class="dd-handle">
                                    Costume HTML
                                </div>
                            </li> -->


                        </ol>
                    </div>
                  
                    <textarea id="nestable-output" class="form-control" style="display: none;"></textarea>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="">
                        <div clas="ibox-content">
                            <h4>Form Builder</h4>
                            <div class="ibox-content">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="dd" id="nestable2">
                                            <ol class="dd-list" id="showdata">
                                                                                            
                                                

                                                <li class="dd-item destroy">
                                                    <div class="dd-handle" style="height: 35px; background: #fff; border: none;"></div>
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                               
                                


                                
                                <!-- <input type="text" id="nestable3-output" name="nestable3-output" > -->
                                <!--  <textarea id="nestable2-output" name="nestable2-output" class="form-control" style="display: 0px;max-height: 0px;"></textarea> -->
                                <textarea class="form-control" style="border: none;background: transparent;cursor: auto;resize: none;" disabled="true"></textarea>
                                <textarea id="nestable2-output" id="nestable2-output" class="form-control" style="display: none;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       


       
 
    <script src="<?php echo base_url(); ?>assets/js/plugins/nestable/jquery.nestable2.js"></script>
    <script>
         $(document).ready(function(){
            showAllForm();

            var updateOutput = function (e) {
                 var list = e.length ? e : $(e.target),
                         output = list.data('output');
                 if (window.JSON) {
                     output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                 } else {
                     output.val('JSON browser support required for this demo.');
                 }
             };
             // activate Nestable for list 1
             $('#nestable').nestable({
                 group: 1
             }).on('change', updateOutput);

             // activate Nestable for list 2
             $('#nestable2').nestable({
                 group: 1
             }).on('change', updateOutput);

             // output initial serialised data
             updateOutput($('#nestable').data('output', $('#nestable-output')));
             updateOutput($('#nestable2').data('output', $('#nestable2-output')));

             $('#nestable-menu').on('click', function (e) {
                 var target = $(e.target),
                         action = target.data('action');
                 if (action === 'expand-all') {
                     $('.dd').nestable('expandAll');
                 }
                 if (action === 'collapse-all') {
                     $('.dd').nestable('collapseAll');
                 }
             });

            $('#shownes').load("<?php echo base_url().$mylink; ?>/nestable");

            
            $('.dd').nestable().on('change', function() {
                var nestable2_output = $('#nestable2-output').val();
                if(nestable2_output=='[{}]'){
                    $('.destroy').css("display", "block");
                }
                else{
                    $('.destroy').css("display", "none");
                    $('.destroy').remove();
                }
            
                $('#nestable2').children('ol.dd-list').children('li.dd-item').children('div.dd-handle').addClass('only');
                $('#shownes').load("<?php echo base_url().strtolower($subtitle) ?>/nestable");


            });

            
            $('#nestable2').nestable().on('change', function() {
                var formData = new FormData();
                var data_uri = "<?php echo $this->uri->segment(3) ?>";

                             
                formData.append('id',data_uri);
                formData.append('nestable2-output',$('textarea#nestable2-output').val());
                
                $.ajax({
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: '<?php echo base_url().$mylink; ?>/createid',
                    success: function (){
                        // alert('Upload success');
                        // window.location.href="<?php echo base_url().strtolower($subtitle) ?>";
                    },
                    error: function (){
                        alert('Error data');
                    }
                });


                showAllForm();
                
            
                
            });

            


            function showAllForm(){
                var data_uri = "<?php echo $this->uri->segment(3) ?>";
                $.ajax({
                    type: 'ajax',
                    url: '<?php echo base_url().strtolower($subtitle) ?>/showAllForm/'+data_uri,
                    async: false,
                    dataType: 'json',
                    success: function(data){
                        var html = '';
                        var i;
                        if(data==false){
                            html = '<li class="dd-item destroy"><div class="dd-handle" style="height: 35px; background: #fff; border: none;"></div></li>';
                        }else{
                            for(i=0; i<data.length; i++){
                                if((data[i].type)=='text'){
                                    var span = '<label style="padding-top: 3px; position:absolute;cursor:pointer;">'+data[i].label+'</label><span style="margin-left: 100px;"><input type="text" name="nameText" value="Text Field" style="height: 26px; width: 172px;padding: 1px 0px; position: absolute;"></span>';
                                    var height = 40;
                                }
                                else if((data[i].type)=='password'){
                                    var span = '<label style="padding-top: 3px; position:absolute;cursor:pointer;">'+data[i].label+'</label><span style="margin-left: 100px;"><input type="password" name="nameText" value="password" style="height: 26px; width: 172px;padding: 1px 0px; position: absolute;"></span>';
                                    var height = 40;
                                }
                                else if((data[i].type)=='date'){
                                    var span = '<label style="padding-top: 3px; position:absolute;cursor:pointer;">'+data[i].label+'</label><span style="margin-left: 100px;"><input type="text" name="nameText" value="Date Field" style="height: 26px; width: 172px;padding: 1px 0px; position: absolute;"><i class="fa fa-calendar" style="position:absolute; margin-left:175px;margin-top:5px;"></i></span>';
                                    var height = 40;
                                }
                                else if((data[i].type)=='option'){
                                    var span = '<label style="padding-top: 3px; position:absolute;cursor:pointer;">'+data[i].label+'</label><span style="margin-left: 100px;"><select name="nameSelect" style="height: 26px; width: 172px;padding: 1px 0px; position: absolute;"><option>Select Option</option></select></span>';
                                    var height = 40;
                                }else if((data[i].type)=='textarea'){
                                    var span = '<label style="padding-top: 3px; position:absolute;cursor:pointer;">'+data[i].label+'</label><span style="margin-left: 100px;"><textarea name="nameTextarea" style="height: 44px; width: 172px;padding: 1px 0px; position: absolute;">Textarea</textarea></span>';
                                    var height = 60;
                                }
                                else if((data[i].type)=='checkbox'){
                                    var span = '<label style="padding-top: 3px; position:absolute;cursor:pointer;">'+data[i].label+'</label><span style="margin-left: 100px; padding: 5px 1px; position: absolute;"><input type="Checkbox" name="nameRadio"><label style="padding-right:20px;">Satu</label><input type="Checkbox" name="nameRadio"><label>Dua</label></span>';
                                    var height = 40;
                                }
                                else if((data[i].type)=='radio'){
                                    var span = '<label style="padding-top: 3px; position:absolute;cursor:pointer;">'+data[i].label+'</label><span style="margin-left: 100px; padding: 5px 1px; position: absolute;"><input type="radio" name="nameRadio"><label style="padding-right:20px;">Satu</label><input type="radio" name="nameRadio"><label>Dua</label></span>';
                                    var height = 40;
                                }
                                else if((data[i].type)=='file upload'){
                                    var span = '<label style="padding-top: 3px; position:absolute;cursor:pointer;">'+data[i].label+'</label><span style="margin-left: 100px;"><input type="file" name="nameText" value="Text Field" style="height: 26px; width: 172px;padding: 3px 0px; position: absolute; margin-left:100px;"></span>';
                                    var height = 40;
                                }
                                else if((data[i].type)=='Costume HTML'){
                                    var span = '<label style="padding-top: 3px; position:absolute;cursor:pointer;" data-toggle="tooltip" data-placement="top" title="Costume HTML"><i class="fa fa-file-code-o" style="font-size:larger;"></i></label><span style="margin-left: 100px;"></span>';
                                    var height = 40;
                                }
                                else if((data[i].type)=='hidden'){
                                    var span = '<label style="padding-top: 3px; position:absolute;cursor:pointer;" data-toggle="tooltip" data-placement="top" title="Hidden Field"><i class="fa fa-eye-slash" style="font-size:larger;"></i></label><span style="margin-left: 100px;"></span>';
                                    var height = 40;
                                }
                                else{
                                    var span = '';
                                    var height = 40;
                                }
                                


                                html +='<li class="dd-item" data-id="'+data[i].id+'" data-type="'+data[i].type+'" >'+
                                            '<div class="dd-handle tooltip-demo" style="padding-bottom: 5px; padding-top: 5px; height: '+height+'px;">'+
                                                   span+
                                            '</div>'+
                                            '<div class="pull-right tooltip-demo" style="margin-right: 38px;">'+
                                                '<a href="<?php echo base_url().strtolower($subtitle) ?>/createproperties/'+data[i].id+'"><span class="btn btn-sm btn-outline btn-default pull-right" style="position: absolute;z-index: 100000; margin-top: -'+height+'px;" data-toggle="tooltip" data-placement="top" title="Properties"><i class="fa fa-gear"></i></span></a>'+
                                            '</div>'+
                                        '</li>';
                            }
                        }
                        $('#showdata').html(html);
                    },
                    error: function(){
                        alert('Could not get Data from Database');
                    }
                });
            }


                $('#loading-example-btn').click(function () {
                    btn = $(this);
                    simpleLoad(btn, true)

                    // Ajax example
    //                $.ajax().always(function () {
    //                    simpleLoad($(this), false)
    //                });

                    simpleLoad(btn, false)
                });
            });

            function simpleLoad(btn, state) {
                if (state) {
                    btn.children().addClass('fa-spin');
                    btn.contents().last().replaceWith(" Loading");
                } else {
                    setTimeout(function () {
                        btn.children().removeClass('fa-spin');
                        btn.contents().last().replaceWith(" Refresh");
                    }, 2000);
                }
            }


            



           
           


            
            
           


            


           
            

            

       
    </script>
               