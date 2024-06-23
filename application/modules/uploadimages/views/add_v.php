    <link href="<?php echo base_url(); ?>assets/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    <!-- <link href="<?php echo base_url(); ?>assets/css/plugins/cropper/cropper.min.css" rel="stylesheet"> -->

    <!-- cropper master -->
    <link href="<?php echo base_url(); ?>assets/cropper-master/dist/cropper.css" rel="stylesheet">

    <style>
        .cropper-crop {
            display: none;
        }

        .cropper-bg {
            background: none;
        }
    </style>




    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Pages</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . strtolower($subtitle) ?>"><?php echo $subtitle; ?></a>
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
                <h5>Create New Group</h5>
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
                    <?php $attributes = array("name" => "formGroups", "method" => "post", "class" => "form-horizontal");
                    echo form_open_multipart(strtolower($subtitle) . '/sad', $attributes);
                    ?>


                    <?php input_text('nameImage', 'Description Image', '', true, false) ?>

                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="image-crop" class="hide" style="height: 400px;">
                                <img src="<?php echo base_url(); ?>assets/img/p3.jpg" id="image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Preview image</h4>
                            <div class="img-preview img-preview-sm"></div>
                            <h4>Comon method</h4>

                            <div class="btn-group">
                                <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                    <input type="file" accept="image/*" name="userfile" id="inputImage" class="hide">
                                    Upload new image
                                </label>
                            </div>
                        </div>
                    </div>

                    <br>
                    <br>
                    <button id="btnUpload" type="button" class="btn btn-default btn-sm">Crop</button>

                    <!-- <?php btn_saveAndback('Back', strtolower($subtitle), '', 'Save'); ?>                        -->
                    <?php echo form_close(); ?>
                </div>





            </div>
        </div>
    </div>
    <?php echo $this->session->flashdata('infosaveadd'); ?>




    <!-- Input Mask-->
    <script src="<?php echo base_url(); ?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- cropper master -->
    <script src="<?php echo base_url(); ?>assets/cropper-master/dist/cropper.js"></script>
    <!-- Image cropper -->
    <!-- <script src="<?php echo base_url(); ?>assets/js/plugins/cropper/cropper.min.js"></script> -->

    <!-- Tags Input -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>


    <script>
        $('.tagsinput').tagsinput({
            tagClass: 'label label-primary'
        });
        var $image = $(".image-crop > img")
        $($image).cropper({
            aspectRatio: 1.0,
            preview: ".img-preview",
            done: function(data) {
                // Output the result data for cropping image.
            }
        });
        var $inputImage = $("#inputImage");
        if (window.FileReader) {
            $inputImage.change(function() {
                var fileReader = new FileReader(),
                    files = this.files,
                    file;

                if (!files.length) {
                    return;
                }

                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function() {
                        // $inputImage.val("");//cirian heula
                        $image.cropper("reset", true).cropper("replace", this.result);
                    };
                } else {
                    showMessage("Please choose an image file.");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }
        $("#image").cropper();
        $('#btnUpload').click(function() {
            $("#image").cropper('getCroppedCanvas', {
                width: 250,
                height: 250,
                minWidth: 250,
                minHeight: 250,
                // fillColor: '#044B94',
                // fillOpacity: '0.1',
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high'
            }).toBlob(function(blob) {
                var formData = new FormData();

                var file = $('#inputImage').prop('files')[0];

                formData.append('croppedImage', blob);
                formData.append('nameImage', $('input[name=nameImage]').val());

                formData.append('userfile', file);

                $.ajax({
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: '<?php echo base_url() ?>uploadimages/upload',
                    success: function() {
                        alert('Upload success');
                        window.location.href = "<?php echo base_url() ?>uploadimages";
                    },
                    error: function() {
                        alert('Error data');
                    }
                });
            });
        });
    </script>