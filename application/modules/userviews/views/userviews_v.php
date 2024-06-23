	 
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $subtitle; ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                        </li>
                        <?php echo $runlink; ?>
                        <li class="active">
                            <strong><?php echo $subtitle; ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
           <div class="wrapper wrapper-content  animated fadeInRight">
                <!-- <div class="row">
                    <div class="col-md-4">
                        
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5><?php echo $subtitle ?></h5>
                            </div>
                            <div class="ibox-content" style="padding-bottom: 5px; padding-top: 5px;">
                                <div class="row wrapper white-bg page-heading form-inline" style="padding-bottom: 0px; padding-top: 5px; padding-bottom: 10px;">

                                    
                                        <div id="nestable-menu">                                           
                                            <input type='hidden' name='menu_userview' id='menu_userview' value='<?php echo $menuuserview['menu_userview']; ?>'>
                                            <div class="form-group">
                                                <label for="exampleInputEmail2" class="sr-only">Email address</label>
                                                <input type="text" id="userview" class="input-sm form-control" placeholder="Enter Name of Userview">
                                                <input type="hidden" id="link" class="input-sm form-control" placeholder="Enter Link">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword2" class="sr-only">Password</label>
                                                <input type="text" id="icon"  placeholder="Icon"
                                                       class="form-control input-sm typeahead_1">
                                            </div>
                                            <div class="checkbox m-r-xs">
                                                <!-- <span class="input-group-btn"> -->
                                                    <?php echo form_button('add','<i class="fa fa-plus"></i> Add',array('class' => 'btn btn-sm btn-primary','type' => 'botton','id' => 'add', 'disabled' => 'true')); ?>
                                                    <?php echo form_button('expand-all','Expand All',array('class' => 'btn btn-sm btn-white','type' => 'botton', 'data-action' => 'expand-all')); ?>
                                                    <?php echo form_button('collapse-all','Collapse All',array('class' => 'btn btn-sm btn-white','type' => 'botton', 'data-action' => 'collapse-all')); ?>

                                                    
                                                    

                                                    <?php $attributes = array("name" => "formGroups", "method" => "post", "class" => "form-control", "style" => "border:none; margin-top:-9px;background: transparent;");
                                                        echo form_open_multipart(strtolower($subtitle).'/save', $attributes);
                                                    ?> 
                                                        <div style="display:none;"><textarea id="nestable2-output" name="content" class="form-control" ></textarea></div>
                                                        <div style="display: none;"><textarea id="nestable-output" name="idDeleted" class="form-control" ></textarea></div>
                                                        <!-- <div class="pull-right" style="margin-top: 10px"> -->
                                                            <button type="submit" class="btn btn-sm btn-warning" id="saveUserview" style="margin-left: -12px;display: none;"><i class="fa fa-check"></i> Save</button>
                                                        <!-- </div> -->
                                                    <?php echo form_close(); ?>  

                                                    
                                                <!-- </span> -->
                                            </div>
                                                
                                        </div>


                                                                    
                                    

                                    
                                        <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">
                                            <div class="dd" id="nestable2">

                                                <ol class="dd-list tooltip-demo" id="plus">
                                                    <?php 
                                                        
                                                        foreach ($results as $r) {
                                                            if($r->status=='Anak'){
                                                                echo"
                                                                <li class='dd-item' data-id='".$r->id."' data-icon='".$r->icon."' data-name='".$r->name."'  data-link='".$r->link."'>
                                                                    
                                                                 ";
                                                                    echo anchor(strtolower($subtitle)."/settings/".$r->id,"<span class='btn btn-sm btn-outline btn-default pull-right modaledit ' style='margin-top:7px;margin-right:5px;border:none;' name='edit' data-toggle='tooltip' data-placement='top' title='Properties' ><strong><i class='fa fa-gear' style='color:#676a6c;padding-top:3px;'></i></strong></span>");
                                                                    echo"$r->flag
                                                                    <div class='dd-handle ' style='padding-bottom: 5px; padding-top: 5px; height:42px;'>
                                                                        <div style='padding-top:5px;'><span class='label label-info'><i class='$r->icon'></i></span> $r->name
                                                                        </div>
                                                                    </div>
                                                                </li>";
                                                            }
                                                            else if(substr($r->status,0,5)=='Mamah') {
                                                                 echo"
                                                                 <li class='dd-item' data-id='".$r->id."' data-icon='".$r->icon."' data-name='".$r->name."'  data-link='".$r->link."'>";
                                                                 echo anchor(strtolower($subtitle)."/settings/".$r->id,"<span class='btn btn-sm btn-outline btn-default pull-right modaledit ' style='margin-top:7px;margin-right:5px;border:none;' name='edit' data-toggle='tooltip' data-placement='top' title='Properties' ><strong><i class='fa fa-gear' style='color:#676a6c;padding-top:3px;'></i></strong></span>");
                                                                    echo"$r->flag
                                                                    <div class='dd-handle ' style='padding-bottom: 5px; padding-top: 5px; height:42px;'>
                                                                        <div style='padding-top:5px;'><span class='label label-info'><i class='$r->icon'></i></span> $r->name
                                                                        </div>
                                                                    </div>
                                                                    <ol>";
                                                            }
                                                            else if(substr($r->status,0,12)=="Ayah Level 1") {
                                                                echo"
                                                                        <li class='dd-item' data-id='".$r->id."' data-icon='".$r->icon."' data-name='".$r->name."'  data-link='".$r->link."'>";
                                                                            echo anchor(strtolower($subtitle)."/settings/".$r->id,"<span class='btn btn-sm btn-outline btn-default pull-right modaledit ' style='margin-top:7px;margin-right:5px;border:none;' name='edit' data-toggle='tooltip' data-placement='top' title='Properties' ><strong><i class='fa fa-gear' style='color:#676a6c;padding-top:3px;'></i></strong></span>");
                                                                            echo"$r->flag
                                                                            <div class='dd-handle ' style='padding-bottom: 5px; padding-top: 5px; height:42px;'>
                                                                                <div style='padding-top:5px;'><span class='label label-info'><i class='$r->icon'></i></span> $r->name
                                                                                </div>
                                                                            </div>

                                                                        </li>
                                                                    </ol>";
                                                            }
                                                            else if(substr($r->status,0,12)=="Ayah Level 2") {
                                                                echo"
                                                                            <li class='dd-item' data-id='".$r->id."' data-icon='".$r->icon."' data-name='".$r->name."'  data-link='".$r->link."'>"; 
                                                                                echo anchor(strtolower($subtitle)."/settings/".$r->id,"<span class='btn btn-sm btn-outline btn-default pull-right modaledit ' style='margin-top:7px;margin-right:5px;border:none;' name='edit' data-toggle='tooltip' data-placement='top' title='Properties' ><strong><i class='fa fa-gear' style='color:#676a6c;padding-top:3px;'></i></strong></span>");
                                                                                echo"$r->flag
                                                                                <div class='dd-handle ' style='padding-bottom: 5px; padding-top: 5px; height:42px;'>
                                                                                    <div style='padding-top:5px;'><span class='label label-info'><i class='$r->icon'></i></span> $r->name
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ol>
                                                                    </li>
                                                                </ol>";
                                                            }
                                                            else if(substr($r->status,0,12)=="Ayah Level 3") {
                                                                echo"
                                                                                    <li class='dd-item' data-id='".$r->id."' data-icon='".$r->icon."' data-name='".$r->name."'  data-link='".$r->link."'>"; 
                                                                                    echo anchor(strtolower($subtitle)."/settings/".$r->id,"<span class='btn btn-sm btn-outline btn-default pull-right modaledit ' style='margin-top:7px;margin-right:5px;border:none;' name='edit' data-toggle='tooltip' data-placement='top' title='Properties' ><strong><i class='fa fa-gear' style='color:#676a6c;padding-top:3px;'></i></strong></span>");
                                                                                        echo"$r->flag
                                                                                        <div class='dd-handle ' style='padding-bottom: 5px; padding-top: 5px; height:42px;'>
                                                                                            <div style='padding-top:5px;'><span class='label label-info'><i class='$r->icon'></i></span> $r->name
                                                                                            </div>
                                                                                        </div>

                                                                                    </li>
                                                                                </ol>
                                                                            </li>
                                                                        </ol>
                                                                    </li>
                                                                </ol>";
                                                            }
                                                            else if(substr($r->status,0,12)=="Ayah Level 4") {
                                                                echo"
                                                                                            <li class='dd-item' data-id='".$r->id."' data-icon='".$r->icon."' data-name='".$r->name."' data-link='".$r->link."' >";
                                                                                                echo anchor(strtolower($subtitle)."/settings/".$r->id,"<span class='btn btn-sm btn-outline btn-default pull-right modaledit ' style='margin-top:7px;margin-right:5px;border:none;' name='edit' data-toggle='tooltip' data-placement='top' title='Properties' ><strong><i class='fa fa-gear' style='color:#676a6c;padding-top:3px;'></i></strong></span>");
                                                                                                echo"$r->flag
                                                                                                <div class='dd-handle ' style='padding-bottom: 5px; padding-top: 5px; height:42px;'>
                                                                                                    <div style='padding-top:5px;'><span class='label label-info'><i class='$r->icon'></i></span> $r->name
                                                                                                    </div>
                                                                                                </div>

                                                                                            </li>
                                                                                        </ol>
                                                                                    </li>
                                                                                </ol>
                                                                            </li>
                                                                        </ol>
                                                                    </li>
                                                                </ol>";
                                                            }
                                                            else if(substr($r->status,0,12)=="Ayah Level 5") {
                                                                echo"
                                                                                                    <li class='dd-item' data-id='".$r->id."'  data-icon='".$r->icon."' data-name='".$r->name."'  data-link='".$r->link."'>";
                                                                                                        echo anchor(strtolower($subtitle)."/settings/".$r->id,"<span class='btn btn-sm btn-outline btn-default pull-right modaledit ' style='margin-top:7px;margin-right:5px;border:none;' name='edit' data-toggle='tooltip' data-placement='top' title='Properties' ><strong><i class='fa fa-gear' style='color:#676a6c;padding-top:3px;'></i></strong></span>");
                                                                                                        echo"$r->flag
                                                                                                        <div class='dd-handle ' style='padding-bottom: 5px; padding-top: 5px; height:42px;'>
                                                                                                            <div style='padding-top:5px;'><span class='label label-info'><i class='$r->icon'></i></span> $r->name
                                                                                                            </div>
                                                                                                        </div>

                                                                                                    </li>
                                                                                                </ol>
                                                                                            </li>
                                                                                        </ol>
                                                                                    </li>
                                                                                </ol>
                                                                             </li>
                                                                        </ol>
                                                                    </li>
                                                                </ol>";
                                                            }
                                                            else{

                                                                echo"
                                                                <li class='dd-item' data-id='".$r->id."' data-icon='".$r->icon."' data-name='".$r->name."' data-link='".$r->link."' >
                                                                    
                                                                 "; echo anchor(strtolower($subtitle)."/settings/".$r->id,"<span class='btn btn-sm btn-outline btn-default pull-right modaledit ' style='margin-top:7px;margin-right:5px;border:none;' name='edit' data-toggle='tooltip' data-placement='top' title='Properties' ><strong><i class='fa fa-gear' style='color:#676a6c;padding-top:3px;'></i></strong></span>");
                                                                    echo"$r->flag
                                                                    <div class='dd-handle ' style='padding-bottom: 5px; padding-top: 5px; height:42px;'>
                                                                        <div style='padding-top:5px;'><span class='label label-info'><i class='$r->icon'></i></span> $r->name
                                                                        </div>
                                                                    </div>
                                                                </li>";

                                                            }
                                                        }
                                                    ?>

                                                </ol>
                                            </div>
                                        </div>


                                        <div class="col-md-2" style="padding-left: 0px; padding-right: 0px;">
                                            

                                            <div class="ibox" id="ibox1">
                                                <div class="ibox-content" style="margin-top: 5px;border:none;">
                                                    <div class="sk-spinner sk-spinner-chasing-dots">
                                                        <div class="sk-dot1"></div>
                                                        <div class="sk-dot2"></div>
                                                    </div>
                                                    <div class="dd" id="nestable" >
                                                        

                                                        <div class="dropdown profile-element" style="position: absolute;">
                                                            <p style="margin-top: -15px;">Drop List Here to Delete</p>
                                                            <span>
                                                                <img style="margin-top: -10px;" class="img-responsive" src="<?php echo base_url(); ?>assets/img/remove-icon-png-26.png">
                                                            </span>
                                                            
                                                        </div>
                                                                            
                                                        <ol class="dd-empty" style="background: transparent; margin-top: 10px; "></ol>
                                                    </div>
                                                    

                                                </div>
                                            </div>
                                            <textarea id="idUserview" style="height: 80px; display: none;" placeholder="untuk mengisi new userview"></textarea>

                                            
                                        </div>



                                       






                                    
                                    <!-- <div class="m-t-md">
                                        <h5>Serialised Output</h5>
                                    </div> -->
                                    

                                    <br>
                                    <br>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



               


            </div>


            
    <!-- Nestable List -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/nestable/jquery.nestable.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>

    <script>
         $(document).ready(function(){
            
            $('#idUserview').load("<?php echo base_url().strtolower($subtitle); ?>/getuiid");
            // $("#idUserview").load("assets/idUserview.php");
            // $("#add").prop('disabled',true);
            $("#userview, #icon").change(function(){
                
                var userview = $('#userview').val();
                var icon = $('#icon').val();
                var link = $('#link').val();
                if(userview!='' && icon !='' && link !=''){
                    $("#add").prop('disabled',false);
                    
                }
                else{
                    $("#add").prop('disabled',true);
                }
            });

            
            var i = 1;
            $("#add").click(function(){
                i++;
                var userview = $('#userview').val();
                var link = $('#link').val();
                var icon = $('#icon').val();

                $('#idUserview').load("<?php echo base_url().strtolower($subtitle); ?>/getuiid");
                var idUserview = $("#idUserview").val();
                
                if(userview!=''&&icon!=''){
                    $("#plus").append("<li class='dd-item' data-id='"+idUserview+"' data-icon='"+icon+"' id='row"+i+"' data-name='"+userview+"' data-link='"+link+"'>"+
                                                    "<div class='col-md-12 ' style='position: absolute; margin-left:40px; padding-top: 4px; '>"+
                                                         "<span class='btn btn-sm btn-outline btn-default pull-right btn-remove' style='margin-top:2px;margin-right:30px; width: 30px; border:none;' name='remove' data-toggle='tooltip' data-placement='top' title='Delete' id='"+i+"'><strong><i class='fa fa-times'></i></strong</span>"+
                                                    "</div>"+
                                                    "<div class='dd-handle'>"+
                                                        "<span class='label label-warning'><i class='"+icon+"'></i></span><label id='viewuserview"+i+"' style='margin-bottom:0px;'></label>"+
                                                    "</div>"+
                                                "</li>");

                    $("#viewuserview"+i).html(userview);//untuk menampilkan


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
                    $('#userview').val('');//untuk menghapus
                    $('#link').val('');//untuk menghapus
                    $('#icon').val('');//untuk menghapus
                    $("#add").prop('disabled',true);


                    var menuuserview = $('#menu_userview').val();
                    var nestable2_output = $('#nestable2-output').val();
                    if(nestable2_output==menuuserview){
                        $('#saveUserview').css('display','none');
                    }
                    else{
                        $('#saveUserview').css('display','block');
                    }
                }

            });

            $("#userview").change(function(){
                var link = $('#userview').val();
                $('#link').val(link.replace(/\s/g, ''));//menghilangkan spasi
            });

            $(document).on("click", ".btn-remove", function(){
                var button_id = $(this).attr("id");
                $("#row"+button_id+"").remove();
                updateOutput($('#nestable2').data('output', $('#nestable2-output')));


                var menuuserview = $('#menu_userview').val();
                var nestable2_output = $('#nestable2-output').val();
                if(nestable2_output==menuuserview){
                    $('#saveUserview').css('display','none');
                }
                else{
                    $('#saveUserview').css('display','block');
                }
            });


            $("#id").click(function(){
                alert('hallo');
            });


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

            $('#nestable').nestable().on('change', function() {
                $('#ibox1').children('.ibox-content').addClass('sk-loading').delay(1500).fadeTo(function(){
                   $('#ibox1').children('.ibox-content').removeClass('sk-loading');
                });
                $('#nestable').html('<div class="dropdown profile-element" style="position: absolute;"><p style="margin-top: -15px;">Drop List Here to Delete</p><span><img style="margin-top: -10px; " class="img-responsive" src="<?php echo base_url(); ?>assets/img/remove-icon-png-26.png"></span></div><ol class="dd-empty" style="background: transparent; margin-top: 10px;"></ol>');

            });
            $('#nestable2').nestable().on('change', function() {
                var menuuserview = $('#menu_userview').val();
                var nestable2_output = $('#nestable2-output').val();
                if(nestable2_output==menuuserview){
                    $('#saveUserview').css('display','none');
                }
                else{
                    $('#saveUserview').css('display','block');
                }
            });
                       

            $('.typeahead_1').typeahead({//ini buat autocomplete icons
                source: ["fa fa-address-book"
                        ,"fa fa-address-book-o"
                        ,"fa fa-address-card"
                        ,"fa fa-address-card-o"
                        ,"fa fa-bandcamp"
                        ,"fa fa-bath"
                        ,"fa fa-bathtub"
                        ,"fa fa-drivers-license"
                        ,"fa fa-drivers-license-o"
                        ,"fa fa-eercast"
                        ,"fa fa-envelope-open"
                        ,"fa fa-envelope-open-o"
                        ,"fa fa-etsy"
                        ,"fa fa-free-code-camp"
                        ,"fa fa-grav"
                        ,"fa fa-handshake-o"
                        ,"fa fa-id-badge"
                        ,"fa fa-id-card"
                        ,"fa fa-id-card-o"
                        ,"fa fa-imdb"
                        ,"fa fa-linode"
                        ,"fa fa-meetup"
                        ,"fa fa-microchip"
                        ,"fa fa-podcast"
                        ,"fa fa-quora"
                        ,"fa fa-ravelry"
                        ,"fa fa-s15"
                        ,"fa fa-shower"
                        ,"fa fa-snowflake-o"
                        ,"fa fa-superpowers"
                        ,"fa fa-telegram"
                        ,"fa fa-thermometer"
                        ,"fa fa-thermometer-0"
                        ,"fa fa-thermometer-1"
                        ,"fa fa-thermometer-2"
                        ,"fa fa-thermometer-3"
                        ,"fa fa-thermometer-4"
                        ,"fa fa-thermometer-empty"
                        ,"fa fa-thermometer-full"
                        ,"fa fa-thermometer-half"
                        ,"fa fa-thermometer-quarter"
                        ,"fa fa-thermometer-three-quarters"
                        ,"fa fa-times-rectangle"
                        ,"fa fa-times-rectangle-o"
                        ,"fa fa-user-circle"
                        ,"fa fa-user-circle-o"
                        ,"fa fa-user-o"
                        ,"fa fa-vcard"
                        ,"fa fa-vcard-o"
                        ,"fa fa-window-close"
                        ,"fa fa-window-close-o"
                        ,"fa fa-window-maximize"
                        ,"fa fa-window-minimize"
                        ,"fa fa-window-restore"
                        ,"fa fa-wpexplorer"
                        ,"fa fa-angellist"
                        ,"fa fa-area-chart"
                        ,"fa fa-at"
                        ,"fa fa-bell-slash"
                        ,"fa fa-bell-slash-o"
                        ,"fa fa-bicycle"
                        ,"fa fa-binoculars"
                        ,"fa fa-birthday-cake"
                        ,"fa fa-bus"
                        ,"fa fa-calculator"
                        ,"fa fa-cc"
                        ,"fa fa-cc-amex"
                        ,"fa fa-cc-discover"
                        ,"fa fa-cc-mastercard"
                        ,"fa fa-cc-paypal"
                        ,"fa fa-cc-stripe"
                        ,"fa fa-cc-visa"
                        ,"fa fa-copyright"
                        ,"fa fa-eyedropper"
                        ,"fa fa-futbol-o"
                        ,"fa fa-google-wallet"
                        ,"fa fa-ils"
                        ,"fa fa-ioxhost"
                        ,"fa fa-lastfm"
                        ,"fa fa-lastfm-square"
                        ,"fa fa-line-chart"
                        ,"fa fa-meanpath"
                        ,"fa fa-newspaper-o"
                        ,"fa fa-paint-brush"
                        ,"fa fa-paypal"
                        ,"fa fa-pie-chart"
                        ,"fa fa-plug"
                        ,"fa fa-shekel"
                        ,"fa fa-sheqel"
                        ,"fa fa-slideshare"
                        ,"fa fa-soccer-ball-o"
                        ,"fa fa-toggle-off"
                        ,"fa fa-toggle-on"
                        ,"fa fa-trash-o"
                        ,"fa fa-tty"
                        ,"fa fa-twitch"
                        ,"fa fa-wifi"
                        ,"fa fa-yelp"
                        ,"fa fa-rub"
                        ,"fa fa-ruble"
                        ,"fa fa-rouble"
                        ,"fa fa-pagelines"
                        ,"fa fa-stack-exchange"
                        ,"fa fa-arrow-circle-o-right"
                        ,"fa fa-arrow-circle-o-left"
                        ,"fa fa-caret-square-o-left"
                        ,"fa fa-toggle-left"
                        ,"fa fa-dot-circle-o"
                        ,"fa fa-wheelchair"
                        ,"fa fa-vimeo-square"
                        ,"fa fa-try"
                        ,"fa fa-turkish-lira"
                        ,"fa fa-plus-square-o"
                        ,"fa fa-automobile"
                        ,"fa fa-bank"
                        ,"fa fa-behance"
                        ,"fa fa-behance-square"
                        ,"fa fa-bomb"
                        ,"fa fa-building"
                        ,"fa fa-cab"
                        ,"fa fa-car"
                        ,"fa fa-child"
                        ,"fa fa-circle-o-notch"
                        ,"fa fa-circle-thin"
                        ,"fa fa-codepen"
                        ,"fa fa-cube"
                        ,"fa fa-cubes"
                        ,"fa fa-database"
                        ,"fa fa-delicious"
                        ,"fa fa-deviantart"
                        ,"fa fa-digg"
                        ,"fa fa-drupal"
                        ,"fa fa-empire"
                        ,"fa fa-envelope-square"
                        ,"fa fa-fax"
                        ,"fa fa-file-archive-o"
                        ,"fa fa-file-audio-o"
                        ,"fa fa-file-code-o"
                        ,"fa fa-file-excel-o"
                        ,"fa fa-file-image-o"
                        ,"fa fa-file-movie-o"
                        ,"fa fa-file-pdf-o"
                        ,"fa fa-file-photo-o"
                        ,"fa fa-file-picture-o"
                        ,"fa fa-file-powerpoint-o"
                        ,"fa fa-file-sound-o"
                        ,"fa fa-file-video-o"
                        ,"fa fa-file-word-o"
                        ,"fa fa-file-zip-o"
                        ,"fa fa-ge"
                        ,"fa fa-git"
                        ,"fa fa-git-square"
                        ,"fa fa-google"
                        ,"fa fa-graduation-cap"
                        ,"fa fa-hacker-news"
                        ,"fa fa-header"
                        ,"fa fa-history"
                        ,"fa fa-institution"
                        ,"fa fa-joomla"
                        ,"fa fa-jsfiddle"
                        ,"fa fa-language"
                        ,"fa fa-life-bouy"
                        ,"fa fa-life-ring"
                        ,"fa fa-life-saver"
                        ,"fa fa-mortar-board"
                        ,"fa fa-openid"
                        ,"fa fa-paper-plane"
                        ,"fa fa-paper-plane-o"
                        ,"fa fa-paragraph"
                        ,"fa fa-paw"
                        ,"fa fa-pied-piper"
                        ,"fa fa-pied-piper-alt"
                        ,"fa fa-pied-piper-square"
                        ,"fa fa-qq"
                        ,"fa fa-ra"
                        ,"fa fa-rebel"
                        ,"fa fa-recycle"
                        ,"fa fa-reddit"
                        ,"fa fa-reddit-square"
                        ,"fa fa-send"
                        ,"fa fa-send-o"
                        ,"fa fa-share-alt"
                        ,"fa fa-share-alt-square"
                        ,"fa fa-slack"
                        ,"fa fa-sliders"
                        ,"fa fa-soundcloud"
                        ,"fa fa-space-shuttle"
                        ,"fa fa-spoon"
                        ,"fa fa-spotify"
                        ,"fa fa-steam"
                        ,"fa fa-steam-square"
                        ,"fa fa-stumbleupon"
                        ,"fa fa-stumbleupon-circle"
                        ,"fa fa-support"
                        ,"fa fa-taxi"
                        ,"fa fa-tencent-weibo"
                        ,"fa fa-tree"
                        ,"fa fa-university"
                        ,"fa fa-vine"
                        ,"fa fa-wechat"
                        ,"fa fa-weixin"
                        ,"fa fa-wordpress"
                        ,"fa fa-yahoo"
                        ,"fa fa-adjust"
                        ,"fa fa-anchor"
                        ,"fa fa-archive"
                        ,"fa fa-arrows"
                        ,"fa fa-arrows-h"
                        ,"fa fa-arrows-v"
                        ,"fa fa-asterisk"
                        ,"fa fa-ban"
                        ,"fa fa-bar-chart-o"
                        ,"fa fa-barcode"
                        ,"fa fa-bars"
                        ,"fa fa-beer"
                        ,"fa fa-bell"
                        ,"fa fa-bell-o"
                        ,"fa fa-bolt"
                        ,"fa fa-book"
                        ,"fa fa-bookmark"
                        ,"fa fa-bookmark-o"
                        ,"fa fa-briefcase"
                        ,"fa fa-bug"
                        ,"fa fa-building-o"
                        ,"fa fa-bullhorn"
                        ,"fa fa-bullseye"
                        ,"fa fa-calendar"
                        ,"fa fa-calendar-o"
                        ,"fa fa-camera"
                        ,"fa fa-camera-retro"
                        ,"fa fa-caret-square-o-down"
                        ,"fa fa-caret-square-o-left"
                        ,"fa fa-caret-square-o-right"
                        ,"fa fa-caret-square-o-up"
                        ,"fa fa-certificate"
                        ,"fa fa-check"
                        ,"fa fa-check-circle"
                        ,"fa fa-check-circle-o"
                        ,"fa fa-check-square"
                        ,"fa fa-check-square-o"
                        ,"fa fa-circle"
                        ,"fa fa-circle-o"
                        ,"fa fa-clock-o"
                        ,"fa fa-cloud"
                        ,"fa fa-cloud-download"
                        ,"fa fa-cloud-upload"
                        ,"fa fa-code"
                        ,"fa fa-code-fork"
                        ,"fa fa-coffee"
                        ,"fa fa-cog"
                        ,"fa fa-cogs"
                        ,"fa fa-comment"
                        ,"fa fa-comment-o"
                        ,"fa fa-comments"
                        ,"fa fa-comments-o"
                        ,"fa fa-compass"
                        ,"fa fa-credit-card"
                        ,"fa fa-crop"
                        ,"fa fa-crosshairs"
                        ,"fa fa-cutlery"
                        ,"fa fa-dashboard"
                        ,"fa fa-desktop"
                        ,"fa fa-dot-circle-o"
                        ,"fa fa-download"
                        ,"fa fa-edit"
                        ,"fa fa-ellipsis-h"
                        ,"fa fa-ellipsis-v"
                        ,"fa fa-envelope"
                        ,"fa fa-envelope-o"
                        ,"fa fa-eraser"
                        ,"fa fa-exchange"
                        ,"fa fa-exclamation"
                        ,"fa fa-exclamation-circle"
                        ,"fa fa-exclamation-triangle"
                        ,"fa fa-external-link"
                        ,"fa fa-external-link-square"
                        ,"fa fa-eye"
                        ,"fa fa-eye-slash"
                        ,"fa fa-female"
                        ,"fa fa-fighter-jet"
                        ,"fa fa-film"
                        ,"fa fa-filter"
                        ,"fa fa-fire"
                        ,"fa fa-fire-extinguisher"
                        ,"fa fa-flag"
                        ,"fa fa-flag-checkered"
                        ,"fa fa-flag-o"
                        ,"fa fa-flash"
                        ,"fa fa-flask"
                        ,"fa fa-folder"
                        ,"fa fa-folder-o"
                        ,"fa fa-folder-open"
                        ,"fa fa-folder-open-o"
                        ,"fa fa-frown-o"
                        ,"fa fa-gamepad"
                        ,"fa fa-gavel"
                        ,"fa fa-gear"
                        ,"fa fa-gears"
                        ,"fa fa-gift"
                        ,"fa fa-glass"
                        ,"fa fa-globe"
                        ,"fa fa-group"
                        ,"fa fa-hdd-o"
                        ,"fa fa-headphones"
                        ,"fa fa-heart"
                        ,"fa fa-heart-o"
                        ,"fa fa-home"
                        ,"fa fa-inbox"
                        ,"fa fa-info"
                        ,"fa fa-info-circle"
                        ,"fa fa-key"
                        ,"fa fa-keyboard-o"
                        ,"fa fa-laptop"
                        ,"fa fa-leaf"
                        ,"fa fa-legal"
                        ,"fa fa-lemon-o"
                        ,"fa fa-level-down"
                        ,"fa fa-level-up"
                        ,"fa fa-lightbulb-o"
                        ,"fa fa-location-arrow"
                        ,"fa fa-lock"
                        ,"fa fa-magic"
                        ,"fa fa-magnet"
                        ,"fa fa-mail-forward"
                        ,"fa fa-mail-reply"
                        ,"fa fa-mail-reply-all"
                        ,"fa fa-male"
                        ,"fa fa-map-marker"
                        ,"fa fa-meh-o"
                        ,"fa fa-microphone"
                        ,"fa fa-microphone-slash"
                        ,"fa fa-minus"
                        ,"fa fa-minus-circle"
                        ,"fa fa-minus-square"
                        ,"fa fa-minus-square-o"
                        ,"fa fa-mobile"
                        ,"fa fa-mobile-phone"
                        ,"fa fa-money"
                        ,"fa fa-moon-o"
                        ,"fa fa-music"
                        ,"fa fa-gear"
                        ,"fa fa-gear-square"
                        ,"fa fa-gear-square-o"
                        ,"fa fa-phone"
                        ,"fa fa-phone-square"
                        ,"fa fa-picture-o"
                        ,"fa fa-plane"
                        ,"fa fa-plus"
                        ,"fa fa-plus-circle"
                        ,"fa fa-plus-square"
                        ,"fa fa-plus-square-o"
                        ,"fa fa-power-off"
                        ,"fa fa-print"
                        ,"fa fa-puzzle-piece"
                        ,"fa fa-qrcode"
                        ,"fa fa-question"
                        ,"fa fa-question-circle"
                        ,"fa fa-quote-left"
                        ,"fa fa-quote-right"
                        ,"fa fa-random"
                        ,"fa fa-refresh"
                        ,"fa fa-reply"
                        ,"fa fa-reply-all"
                        ,"fa fa-retweet"
                        ,"fa fa-road"
                        ,"fa fa-rocket"
                        ,"fa fa-rss"
                        ,"fa fa-rss-square"
                        ,"fa fa-search"
                        ,"fa fa-search-minus"
                        ,"fa fa-search-plus"
                        ,"fa fa-share"
                        ,"fa fa-share-square"
                        ,"fa fa-share-square-o"
                        ,"fa fa-shield"
                        ,"fa fa-shopping-cart"
                        ,"fa fa-sign-in"
                        ,"fa fa-sign-out"
                        ,"fa fa-signal"
                        ,"fa fa-sitemap"
                        ,"fa fa-smile-o"
                        ,"fa fa-sort"
                        ,"fa fa-sort-alpha-asc"
                        ,"fa fa-sort-alpha-desc"
                        ,"fa fa-sort-amount-asc"
                        ,"fa fa-sort-amount-desc"
                        ,"fa fa-sort-asc"
                        ,"fa fa-sort-desc"
                        ,"fa fa-sort-down"
                        ,"fa fa-sort-numeric-asc"
                        ,"fa fa-sort-numeric-desc"
                        ,"fa fa-sort-up"
                        ,"fa fa-spinner"
                        ,"fa fa-square"
                        ,"fa fa-square-o"
                        ,"fa fa-star"
                        ,"fa fa-star-half"
                        ,"fa fa-star-half-empty"
                        ,"fa fa-star-half-full"
                        ,"fa fa-star-half-o"
                        ,"fa fa-star-o"
                        ,"fa fa-subscript"
                        ,"fa fa-suitcase"
                        ,"fa fa-sun-o"
                        ,"fa fa-superscript"
                        ,"fa fa-tablet"
                        ,"fa fa-tachometer"
                        ,"fa fa-tag"
                        ,"fa fa-tags"
                        ,"fa fa-tasks"
                        ,"fa fa-terminal"
                        ,"fa fa-thumb-tack"
                        ,"fa fa-thumbs-down"
                        ,"fa fa-thumbs-o-down"
                        ,"fa fa-thumbs-o-up"
                        ,"fa fa-thumbs-up"
                        ,"fa fa-ticket"
                        ,"fa fa-times"
                        ,"fa fa-times-circle"
                        ,"fa fa-times-circle-o"
                        ,"fa fa-tint"
                        ,"fa fa-toggle-down"
                        ,"fa fa-toggle-left"
                        ,"fa fa-toggle-right"
                        ,"fa fa-toggle-up"
                        ,"fa fa-trash-o-o"
                        ,"fa fa-trophy"
                        ,"fa fa-truck"
                        ,"fa fa-umbrella"
                        ,"fa fa-unlock"
                        ,"fa fa-unlock-alt"
                        ,"fa fa-unsorted"
                        ,"fa fa-upload"
                        ,"fa fa-user"
                        ,"fa fa-users"
                        ,"fa fa-video-camera"
                        ,"fa fa-volume-down"
                        ,"fa fa-volume-off"
                        ,"fa fa-volume-up"
                        ,"fa fa-warning"
                        ,"fa fa-wheelchair"
                        ,"fa fa-wrench"
                        ,"fa fa-check-square"
                        ,"fa fa-check-square-o"
                        ,"fa fa-circle"
                        ,"fa fa-circle-o"
                        ,"fa fa-dot-circle-o"
                        ,"fa fa-minus-square"
                        ,"fa fa-minus-square-o"
                        ,"fa fa-plus-square"
                        ,"fa fa-plus-square-o"
                        ,"fa fa-square"
                        ,"fa fa-square-o"
                        ,"fa fa-bitcoin"
                        ,"fa fa-btc"
                        ,"fa fa-cny"
                        ,"fa fa-dollar"
                        ,"fa fa-eur"
                        ,"fa fa-euro"
                        ,"fa fa-gbp"
                        ,"fa fa-inr"
                        ,"fa fa-jpy"
                        ,"fa fa-krw"
                        ,"fa fa-money"
                        ,"fa fa-rmb"
                        ,"fa fa-rouble"
                        ,"fa fa-rub"
                        ,"fa fa-ruble"
                        ,"fa fa-rupee"
                        ,"fa fa-try"
                        ,"fa fa-turkish-lira"
                        ,"fa fa-usd"
                        ,"fa fa-won"
                        ,"fa fa-yen"
                        ,"fa fa-align-center"
                        ,"fa fa-align-justify"
                        ,"fa fa-align-left"
                        ,"fa fa-align-right"
                        ,"fa fa-bold"
                        ,"fa fa-chain"
                        ,"fa fa-chain-broken"
                        ,"fa fa-clipboard"
                        ,"fa fa-columns"
                        ,"fa fa-copy"
                        ,"fa fa-cut"
                        ,"fa fa-dedent"
                        ,"fa fa-eraser"
                        ,"fa fa-file"
                        ,"fa fa-file-o"
                        ,"fa fa-file-text"
                        ,"fa fa-file-text-o"
                        ,"fa fa-files-o"
                        ,"fa fa-floppy-o"
                        ,"fa fa-font"
                        ,"fa fa-indent"
                        ,"fa fa-italic"
                        ,"fa fa-link"
                        ,"fa fa-list"
                        ,"fa fa-list-alt"
                        ,"fa fa-list-ol"
                        ,"fa fa-outdent"
                        ,"fa fa-paperclip"
                        ,"fa fa-paste"
                        ,"fa fa-repeat"
                        ,"fa fa-rotate-left"
                        ,"fa fa-rotate-right"
                        ,"fa fa-save"
                        ,"fa fa-scissors"
                        ,"fa fa-strikethrough"
                        ,"fa fa-table"
                        ,"fa fa-text-height"
                        ,"fa fa-text-width"
                        ,"fa fa-th"
                        ,"fa fa-th-large"
                        ,"fa fa-th-list"
                        ,"fa fa-underline"
                        ,"fa fa-undo"
                        ,"fa fa-unlink"
                        ,"fa fa-angle-double-down"
                        ,"fa fa-angle-double-left"
                        ,"fa fa-angle-double-right"
                        ,"fa fa-angle-double-up"
                        ,"fa fa-angle-down"
                        ,"fa fa-angle-left"
                        ,"fa fa-angle-right"
                        ,"fa fa-angle-up"
                        ,"fa fa-arrow-circle-down"
                        ,"fa fa-arrow-circle-left"
                        ,"fa fa-arrow-circle-o-down"
                        ,"fa fa-arrow-circle-o-left"
                        ,"fa fa-arrow-circle-o-right"
                        ,"fa fa-arrow-circle-o-up"
                        ,"fa fa-arrow-circle-right"
                        ,"fa fa-arrow-circle-up"
                        ,"fa fa-arrow-down"
                        ,"fa fa-arrow-left"
                        ,"fa fa-arrow-right"
                        ,"fa fa-arrow-up"
                        ,"fa fa-arrows"
                        ,"fa fa-arrows-alt"
                        ,"fa fa-arrows-h"
                        ,"fa fa-arrows-v"
                        ,"fa fa-caret-down"
                        ,"fa fa-caret-left"
                        ,"fa fa-caret-right"
                        ,"fa fa-caret-square-o-down"
                        ,"fa fa-caret-square-o-left"
                        ,"fa fa-caret-square-o-right"
                        ,"fa fa-caret-square-o-up"
                        ,"fa fa-caret-up"
                        ,"fa fa-chevron-circle-down"
                        ,"fa fa-chevron-circle-left"
                        ,"fa fa-chevron-circle-right"
                        ,"fa fa-chevron-circle-up"
                        ,"fa fa-chevron-down"
                        ,"fa fa-chevron-left"
                        ,"fa fa-chevron-right"
                        ,"fa fa-chevron-up"
                        ,"fa fa-hand-o-down"
                        ,"fa fa-hand-o-left"
                        ,"fa fa-hand-o-right"
                        ,"fa fa-hand-o-up"
                        ,"fa fa-long-arrow-down"
                        ,"fa fa-long-arrow-left"
                        ,"fa fa-long-arrow-right"
                        ,"fa fa-long-arrow-up"
                        ,"fa fa-toggle-down"
                        ,"fa fa-toggle-left"
                        ,"fa fa-toggle-right"
                        ,"fa fa-toggle-up"
                        ,"fa fa-arrows-alt"
                        ,"fa fa-backward"
                        ,"fa fa-compress"
                        ,"fa fa-eject"
                        ,"fa fa-expand"
                        ,"fa fa-fast-backward"
                        ,"fa fa-fast-forward"
                        ,"fa fa-forward"
                        ,"fa fa-pause"
                        ,"fa fa-play"
                        ,"fa fa-play-circle"
                        ,"fa fa-play-circle-o"
                        ,"fa fa-step-backward"
                        ,"fa fa-step-forward"
                        ,"fa fa-stop"
                        ,"fa fa-youtube-play"
                        ,"fa fa-adn"
                        ,"fa fa-android"
                        ,"fa fa-apple"
                        ,"fa fa-bitbucket"
                        ,"fa fa-bitbucket-square"
                        ,"fa fa-bitcoin"
                        ,"fa fa-btc"
                        ,"fa fa-css3"
                        ,"fa fa-dribbble"
                        ,"fa fa-dropbox"
                        ,"fa fa-facebook"
                        ,"fa fa-facebook-square"
                        ,"fa fa-flickr"
                        ,"fa fa-foursquare"
                        ,"fa fa-github"
                        ,"fa fa-github-alt"
                        ,"fa fa-github-square"
                        ,"fa fa-gittip"
                        ,"fa fa-google-plus"
                        ,"fa fa-google-plus-square"
                        ,"fa fa-html5"
                        ,"fa fa-instagram"
                        ,"fa fa-linkedin"
                        ,"fa fa-linkedin-square"
                        ,"fa fa-linux"
                        ,"fa fa-maxcdn"
                        ,"fa fa-pagelines"
                        ,"fa fa-pinterest"
                        ,"fa fa-pinterest-square"
                        ,"fa fa-renren"
                        ,"fa fa-skype"
                        ,"fa fa-stack-exchange"
                        ,"fa fa-stack-overflow"
                        ,"fa fa-trello"
                        ,"fa fa-tumblr"
                        ,"fa fa-tumblr-square"
                        ,"fa fa-twitter"
                        ,"fa fa-twitter-square"
                        ,"fa fa-vimeo-square"
                        ,"fa fa-vk"
                        ,"fa fa-weibo"
                        ,"fa fa-windows"
                        ,"fa fa-xing"
                        ,"fa fa-xing-square"
                        ,"fa fa-youtube"
                        ,"fa fa-youtube-play"
                        ,"fa fa-youtube-square"
                        ,"fa fa-ambulance"
                        ,"fa fa-h-square"
                        ,"fa fa-hospital-o"
                        ,"fa fa-medkit"
                        ,"fa fa-plus-square"
                        ,"fa fa-stethoscope"
                        ,"fa fa-user-md"
                        ,"fa fa-wheelchair"]
            });
         });
    </script>
   <!--  <script type="text/javascript">
        
        var rupiah = document.getElementById('userview');
        rupiah.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });
 
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa            = split[0].length % 3,
            rupiah          = split[0].substr(0, sisa),
            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
 
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
 
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
 -->
   
