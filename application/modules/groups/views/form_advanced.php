<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Advanced Form Elements</title>

   

    <link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">

    

    <link href="<?php echo base_url(); ?>assets/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

   

    
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">


</head>


            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Advanced Form Elements</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>assets/index.html">Home</a>
                        </li>
                        <li>
                            <a>Forms</a>
                        </li>
                        <li class="active">
                            <strong>Advanced Form Elements</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>TouchSpin <small>http://www.virtuosoft.eu/code/bootstrap-touchspin/</small></h5>
                        </div>
                        <div class="ibox-content">
                            <p>
                                A mobile and touch friendly input spinner component for Bootstrap 3. It supports the mousewheel and the up/down keys.
                            </p>

                            <div class="row">
                                <div class="col-md-4">

                                    <p class="font-bold">
                                        Basic example with empty value
                                    </p>

                                    <input class="touchspin1" type="text" value="" name="demo1">
                                </div>
                                <div class="col-md-4">
                                    <p class="font-bold">
                                        Example with postfix
                                    </p>
                                    <input class="touchspin2" type="text" value="55" name="demo2">
                                </div>
                                <div class="col-md-4">

                                    <p class="font-bold">
                                        Example with vertical button alignment:
                                    </p>
                                    <input class="touchspin3" type="text" value="" name="demo3">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

           

            <div class="row">
                <div class="col-lg-12">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Select2 <small>https://select2.github.io/</small></h5>
                        </div>
                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-md-4">
                                    <p>
                                        Select2 is a jQuery based replacement for select boxes. It can take a regular select box and turn it into:
                                    </p>
                                    <select class="select2_demo_1 form-control">
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                        <option value="5">Option 5</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <p>
                                        A placeholder value can be defined and will be displayed until a selection is made.
                                    </p>
                                    <select class="select2_demo_3 form-control">
                                        <option></option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                    </select>

                                </div>
                                <div class="col-md-4">
                                    <p>
                                        Select2 also supports multi-value select boxes. The select below is declared with the multiple attribute.
                                    </p>
                                    <select class="select2_demo_2 form-control" multiple="multiple">
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
          
           
        </div>
       
                  

    <!-- Mainly scripts -->
   

   

  

   <!-- Input Mask-->
   <script src="<?php echo base_url(); ?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>

  
   

   
    <!-- pace.min merupakan cara untuk menghindari error pada chat/time gitu lah -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>
   

    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/iCheck/icheck.min.js"></script>

   
 
    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/select2/select2.full.min.js"></script>

    <!-- TouchSpin -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    
    

    <script>
        $(document).ready(function(){

            

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            
            $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });


            $(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin2").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin3").TouchSpin({
                verticalbuttons: true,
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

           


        });

        

       


    </script>

</body>

</html>
