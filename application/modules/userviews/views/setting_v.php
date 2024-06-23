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
                            <strong><?php echo $results['name'] ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
       


        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox">
                        <?php $attributes = array("name" => "formopen".$subtitle, "method" => "post", "class" => "form-horizontal");
                            echo form_open($mylink."/savepropertieseditor", $attributes);
                        ?> 
                        
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="m-b-md">
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-primary btn-sm" type="button" id="btnUpdatedUsv"><i class="fa fa-check" style="margin-right: 5px;"></i>  Save</button>
                                                <button class="btn btn-white btn-sm" type="reset" id="reset">Cancel</button>
                                            </div>
                                            <h2>Settings</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-sm">
                                    <div class="col-lg-12">
                                        <div class="panel blank-panel">
                                            <div class="panel-heading">
                                                <div class="panel-options">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active "><a href="#tab-1" data-toggle="tab" class="skin2">Edit <?php echo $results['name'] ?></a></li>
                                                        <li class=""><a href="#tab-2" data-toggle="tab" class="skin2">Advanced Options</a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">

                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab-1">

                                                        <fieldset id="form" >
                                                            <?php input_hidden('idSet',$results['id']) ?>
                                                            <?php input_text('userview', 'Userview', $results['name'],true,false) ?>
                                                            <?php input_text('icon', 'Icon', $results['icon'],true,false,'typeahead_1') ?>   
                                                        </fieldset> 
                                                        <!-- </div> -->
                                                    </div>
                                                    <div class="tab-pane" id="tab-2" >

                                                        <!-- <div class="feed-activity-list"> -->
                                                                
                                                            

                                                            <?php 
                                                                if($results['status']!="Mamah"){
                                                                    select_perpage('perpage','Perpage',$resultsD['perpage'],false,'');
                                                                }
                                                             ?>
                                                            
                                                            
                                                            <?php 
                                                                input_multiselect2('permision', 'Permision', $levu_options,$levu_selected,'');
                                                            ?> 

                                                            <?php
                                                                $hide_as_permission_on = $resultsD['hide_as_permission_on'];
                                                                ($hide_as_permission_on)? "false" : "true";
                                                                input_checkbox_switch('hiddenUserview','Hidden As Permission Actived',$hide_as_permission_on,'');
                                                            ?>

                                                            <?php   
                                                                if($results['status']!="Mamah"){
                                                                    $shownumber = $resultsD['show_numberrow'];
                                                                    ($shownumber)? "false" : "true";
                                                                    input_checkbox_switch('numRow','Show Number Row',$shownumber,'');
                                                                }  
                                                            ?>
                                                             
                                                            
                                                        <!-- </div> -->

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

        

        <script src="<?php echo base_url(); ?>assets/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
        <script>
            $(document).ready(function(){
                if($("#permision").val()==''){
                    $(".hiddenUserview").css('display','none');
                }
                $("#btnUpdatedUsv").click(function(){
                    var formData = new FormData();
                    formData.append('idSet',$('input[name=idSet]').val());
                    formData.append('userview',$('input[name=userview]').val());
                    formData.append('icon',$('input[name=icon]').val());

                    
                    formData.append('perpage',$('#perpage').val());
                    if ($('#numRow').is(':checked')){
                        formData.append('numRow',1);
                    }
                    else{
                        formData.append('numRow',0);
                    }

                    


                    var permision = $("#permision").val();
                    if(permision==''){
                        formData.append('hiddenUserview',0);
                    }
                    else{
                        if ($('#hiddenUserview').is(':checked')){
                            formData.append('hiddenUserview',1);
                        }
                        else{
                            formData.append('hiddenUserview',0);
                        }
                    }

                    formData.append('permision',$("#permision").val());
                    
                    
                    
                    var id = $('input[name=idSet]').val()
                    var userview = $('input[name=userview]').val();
                    var icon = $('input[name=icon]').val();
                    var result = '';
                    if(userview=='')
                    {
                        $('#userview').parent().addClass('has-error'); 
                        $('.userview').text('Userview Tidak Boleh Kosong');
                    }
                    else{
                        $('#userview').parent().removeClass('has-error');
                        $('.userview').text('');
                        result +='1';
                    }


                    if(icon=='')
                    {
                        $('#icon').parent().addClass('has-error'); 
                        $('.icon').text('Icon Tidak Boleh Kosong');
                    }
                    else{
                        $('#icon').parent().removeClass('has-error');
                        $('.icon').text('');
                        result +='2';
                    }

                    if(result=='12')
                    {  
                        $.ajax({
                            method: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            url: '<?php echo base_url().$mylink ?>/updated',
                            success: function(){
                                 <?php echo sweat_toastr_js('Data Berhasil Diupdate!','Silahkan Cek Data','success','toast-bottom-left') ?>
                            },
                            error: function(){
                                alert('Could not add data');
                            }
                        }); 
                    }
                });
                $("#permision").on('change', function(){
                    var permision = $('#permision').val();
                    if(permision!=''){
                        $('.hiddenUserview').css('display','block');
                    }else{
                        $('#hiddenUserview').prop("checked", false);
                        $('.hiddenUserview').css('display','none');
                    }
                });
                $("#userview, #icon").on('change',function(){
                    var userview = $("#userview").val();
                    var icon = $("#icon").val();
                    if(userview.length>=5){
                        $('#userview').parent().removeClass('has-error'); 
                        $('.userview').text('');
                    }
                    if(icon.length>=5){
                        $('#icon').parent().removeClass('has-error'); 
                        $('.icon').text('');
                    }
                });
                $("#reset").click(function(){
                    $('#userview').parent().removeClass('has-error'); 
                    $('.userview').text('');
                    $('#icon').parent().removeClass('has-error'); 
                    $('.icon').text('');
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