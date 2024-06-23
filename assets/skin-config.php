            
            <div class="title">Skins
                <input type="hidden" name="body" id="body" >
            </div>
            <div class="setings-item default-skin">
                    <span class="skin-name ">
                         <a href="#" class="s-skin-0 theme-skin">
                             Default
                         </a>
                    </span>
            </div>
            <div class="setings-item blue-skin">
                    <span class="skin-name ">
                        <a href="#" class="s-skin-1 theme-skin">
                            Blue light
                        </a>
                    </span>
            </div>
            <a href="#" class="s-skin-2 theme-skin" >
                <div class="title">
                    White
                </div>
            </a>
                        
                   
            <div class="setings-item yellow-skin">
                    <span class="skin-name ">
                        <a href="#" class="s-skin-3 theme-skin">
                            Yellow/Purple
                        </a>
                    </span>
            </div>
            <div class="setings-item ultra-skin">
                    <span class="skin-name ">
                        <a href="#" class="md-skin theme-skin">
                            Material Design
                        </a>
                    </span>
            </div>
        

<script>
    $('.s-skin-0').click(function (){
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
        $("body").removeClass("md-skin");
        /////////////////////////////////////
        $("#body").val("");
    });

    // Blue skin
    $('.s-skin-1').click(function (){
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
        $("body").removeClass("md-skin");
        $("body").addClass("skin-1");
        /////////////////////////////////////
        $("#body").val("skin-1");
    });

    // Inspinia ultra skin
    $('.s-skin-2').click(function (){
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-3");
        $("body").removeClass("md-skin");
        $("body").addClass("skin-2");
        /////////////////////////////////////
        $("#body").val("skin-2");
    });

    // Yellow skin
    $('.s-skin-3').click(function (){
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").removeClass("md-skin");
        $("body").addClass("skin-3");
        /////////////////////////////////////
        $("#body").val("skin-3");
    });

    $('.md-skin').click(function (){
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
        $("body").addClass("md-skin");
        /////////////////////////////////////
        $("#body").val("md-skin");
    });
    $('.theme-skin').click(function(){       
       

        var formData = new FormData();
        var themeskin = $('#body').val();
        
       
        
        formData.append('theme',themeskin);
        
        $.ajax({
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            url: 'config/savetheme',
            success: function (){
                // alert('Upload success');
            },
            error: function (){
                alert('Error data');
            }
        });
    });
    $('.config-themes').click(function(){
        var formData = new FormData();

        formData.append('fixednav',$('#fixed-nav').val());
        formData.append('boxedlayout',$('#boxed-layout').val());
        formData.append('fixednavbasic',$('#fixed-nav-basic').val());
        formData.append('fixedsidebar',$('#fixed-sidebar').val());
        formData.append('mininavbar',$('#mini-navbar').val());
        formData.append('fixed',$('#fixed').val());
        formData.append('navbar_static_top',$('#navbar_static_top').val());
       
        
        $.ajax({
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            url: 'config/saveconfignav',
            success: function (){
                // alert('Upload success');
            },
            error: function (){
                alert('Error data');
            }
        });
    });
</script>