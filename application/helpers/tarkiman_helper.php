<?php

/**
 * @author Tarkiman <tarkiman.zone@gmail.com  | 085222241987 | https://www.linkedin.com/in/tarkiman | http://www.tarkiman.com >
 */


function input_button($name='',$label='',$value='',$class='btn btn-success btn-sm')
{
    echo '<button type="button" id="'.$name.'" name="'.$name.'" $value="'.$value.'" class="'.$name.'">'.$label.'</button>';
}

function button_submit($label)
{
    echo '<button type="submit" id="send" class="btnSubmit btn btn-success btn-sm">'.$label.'</button>';
}

function btn_view($uri)
{
    return anchor($uri, '<i class="fa fa-folder"></i> View ',
        array(
            'title' => 'View Data',
            'class' => 'btn btn-primary btn-xs'
        ));
}

function btn_save()
{
    echo '<button type="submit" id="send" class="btn btn-success"><span class="fa fa-floppy-o fa-right"></span> Submit</button>';
}

function btn_edit($uri)
{
    return anchor($uri, '<i class="fa fa-pencil"></i> Edit ',
        array(
            'title' => 'Edit Data',
            'class' => 'btn btn-info btn-xs',
            'data-toggle' => 'tooltip',
            'data-placement' => 'left'
        ));
}


function btn_delete($uri)
{
    return anchor($uri, '<i class="fa fa-trash-o"></i> Delete ',
        array(
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Sure to remove data?');",
            'title' => 'Delete'
        ));
}

function btn_active($uri)
{
    return anchor($uri, 'Active',
        array(
            'onclick' => "return confirm('Are you sure?');",
            'title' => 'Set Active',
            'class' => 'btn btn-flat btn-success '
        ));
}

function btn_nonactive($uri)
{
    return anchor($uri, 'Inactive',
        array(
            'onclick' => "return confirm('Are you sure?');",
            'title' => 'Set Inactive',
            'class' => 'btn btn-flat btn-danger '
        ));
}

function btn_back($uri)
{
    // echo anchor($uri, 'Cancel',
    //     array(
    //         'title' => 'Back',
    //         'class' => 'btn'
    //     ));
    
    echo '<a href="'.base_url($uri).'" class="btn btn-danger"><span class="fa fa-reply"></span> Back</a>';
}

function permission_link($uri,$title,$class,$id=null)
{

    $id= !is_null($id) ? "/".$id : "";

    $page_data = get_pagedata();

    if (in_array($uri, $page_data)){

        return anchor($uri.$id, $title,
        array(
            'class' => $class
        ));

    }
    else{
        return "";
    }
}

function link_new($uri)
{

    $page_data = get_pagedata();

    if (in_array($uri, $page_data)){

        return anchor($uri, 'Create New',
        array(
            'class' => 'btn btn-danger btn-condensed'
        ));

    }
    else{
        return "";
    }
}

function link_view($uri,$id)
{

    $page_data = get_pagedata();

    if (in_array($uri, $page_data)){

        return anchor($uri.'/'.$id, '<i class="glyphicon glyphicon-zoom-in"></i>',
        array(
            'class' => 'btn btn-success btn-condensed',
            'data-original-title'=>'View'
        ));

    }
    else{
        return "";
    }
}

function link_edit($uri,$id)
{

    $page_data = get_pagedata();

    if (in_array($uri, $page_data)){

        return anchor($uri.'/'.$id, '<i class="glyphicon glyphicon-edit"></i>',
        array(
            'class' => 'btn btn-info btn-condensed',
            'data-original-title'=>'Edit'
        ));

    }
    else{
        return "";
    }

}

function link_remove($uri,$id)
{

    $page_data = get_pagedata();

    if (in_array($uri, $page_data)){

        return anchor($uri.'/'.$id, '<i class="glyphicon glyphicon-trash"></i>',
        array(
            'class' => 'btn btn-danger btn-condensed',
            'onclick' => "return confirm('Sure to remove data?');",
            'data-original-title'=>'Remove'
        ));

    }
    else{
        return "";
    }
}

function load_notif()
{
    $CI = &get_instance();
    if ($CI->session->flashdata('error')) {
        // echo '<div class="alert alert-dismissible alert-danger">';
        // echo '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>';
        // echo $CI->session->flashdata('error');
        // echo '</div>';
      echo "<script>$(document).ready(function(){t_alert('error','".$CI->session->flashdata('error')."');});</script>";
    } elseif ($CI->session->flashdata('success')) {
        // echo '<div class="alert alert-dismissible alert-success">';
        // echo '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>';
        // echo $CI->session->flashdata('success');
        // echo '</div>';
        echo "<script>$(document).ready(function(){t_alert('success','".$CI->session->flashdata('success')."');});</script>";
    }
}

function simple_load_notif()
{
    $CI = &get_instance();
    if ($CI->session->flashdata('error')) {
        echo '<div class="alert alert-dismissible alert-danger">';
        echo '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>';
        echo $CI->session->flashdata('error');
        echo '</div>';
    } elseif ($CI->session->flashdata('success')) {
        echo '<div class="alert alert-dismissible alert-success">';
        echo '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>';
        echo $CI->session->flashdata('success');
        echo '</div>';
    }
}

function btn_print($uri)
{
    return anchor($uri, '<i class="fa fa-print"></i> Print',
        array(
            'title' => 'Print',
            'class' => 'btn btn-flat btn-default '
        ));
}

function active_status($status)
{
    if ($status == 1) {
        $ret = '<center><span class="text-success"><strong>Active</strong></span></center>';
    } else {
        $ret = '<center><span class="text-error"><strong>Inactive</strong></span></center>';
    }
    return $ret;
}

function stock_status($status)
{
    if ($status == 1) {
        $ret = '<center><span class="text-success"><strong>Ready Stock</strong></span></center>';
    } else {
        $ret = '<center><span class="text-error"><strong>Out of Stock</strong></span></center>';
    }
    return $ret;
}

function input_text($field_name, $label, $value = '',$required = false, $readonly=false, $class='col-md-6 col-xs-12')
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;

    echo'<div class="form-group">';
        echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
        echo'<div class="'.$class.'">';                                            
            echo'<div class="input-group">';
                echo'<span class="input-group-addon"><span class="fa fa-pencil"></span></span>';
                echo form_input( $attribut, set_value($field_name, $value));
            echo'</div>';                                            
            echo'<span class="help-block"></span>';
            echo form_error($field_name);
        echo'</div>';
    echo'</div>';
}

function input_text2($field_name, $label, $value = '',$required = false, $readonly=false, $class='col-md-6 col-xs-12')
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;

    echo'<div class="form-group">';
        echo'<label>'.$label.$req.'</label>';
        echo form_input( $attribut, set_value($field_name, $value));
        echo form_error($field_name);
    echo'</div>';

}

function input_hidden($field_name, $value = '')
{   
    echo'<input type="hidden" name="'.$field_name.'" id="'.$field_name.'" value="'.set_value($field_name, $value).'">';
}

function input_number($field_name, $label, $value = '',$required = false, $readonly=false)
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control tarkiman',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;

    echo'<div class="form-group">';
          echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
          echo'<div class="col-md-6 col-xs-12">';                                            
              echo'<div class="input-group">';
                  echo'<span class="input-group-addon"><span class="fa fa-pencil"></span></span>';
                  echo form_input( $attribut, set_value($field_name, $value));
              echo'</div>';                                            
              echo'<span class="help-block"></span>';
              echo form_error($field_name);
          echo'</div>';
      echo'</div>';
}

function input_text_prepend($field_name, $label, $value = '',$required = false, $readonly=false, $prepend='')
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
            'name' => $field_name,
            'id' => $field_name,
            'class' => 'input-xlarge tarkiman',
            'placeholder' => 'Enter '.$label,
        );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="control-group">';
        echo'<label class="control-label" for="'.$field_name.'">'.$label.$req.'</label>';
        echo'<div class="controls controls-row">';
        echo '<div class="input-prepend">';
        echo '<span class="add-on">'.$prepend.'</span>';

            echo form_input($attribut , set_value($field_name, $value));

        echo '</div>';
        echo form_error($field_name);
        echo'</div>';
    echo'</div>';

}


function input_text_append($field_name, $label, $value = '',$required = false, $readonly=false, $append='')
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;

      echo'<div class="form-group">';
          echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
          echo'<div class="col-md-6 col-xs-12">';                                            
              echo'<div class="input-group">';                  
                  echo form_input( $attribut, set_value($field_name, $value));
                  echo'<span class="input-group-addon">'.$append.'</span>';
              echo'</div>';                                            
              echo'<span class="help-block"></span>';
              echo form_error($field_name);
          echo'</div>';
      echo'</div>';

}

function input_currency($field_name, $label, $value = '',$required = false, $readonly=false, $class='col-md-6 col-xs-12')
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control tarkiman',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;

    echo'<div class="form-group">';
          echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
          echo'<div class="'.$class.'">';                                            
              echo'<div class="input-group">';
                  echo'<span class="input-group-addon">Rp. </span>';
                  echo form_input( $attribut, set_value($field_name, $value));
              echo'</div>';                                            
              echo'<span class="help-block"></span>';
              echo form_error($field_name);
          echo'</div>';
      echo'</div>';
}

function input_password($field_name, $label, $required = false)
{
    $req = ($required) ? '<font color="red"> * </font>' : '';
    $attribut = array(
        'name' => $field_name,
        'id' => $field_name,
        'class' => 'form-control',
        'placeholder' => 'Enter'.$label
    );
    $value = null;

    //!$readonly ?: $attribut['readonly'] = true;

    echo'<div class="form-group">';                                        
          echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
          echo'<div class="col-md-6 col-xs-12">';
              echo'<div class="input-group">';
                  echo'<span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>';
                  echo form_password($attribut, set_value($field_name, $value));
                  
              echo'</div>';            
              echo'<span class="help-block"></span>';
              echo form_error($field_name);
          echo'</div>';
      echo'</div>';
}

function input_repeat_password($field_name, $label, $equalTo = '',$required = false)
{
    $req = ($required) ? '<font color="red"> * </font>' : '';
    $attribut = array(
        'name' => $field_name,
        'id' => $field_name,
        'class' => 'form-control',
        'placeholder' => 'Enter'.$label
    );
    $value = null;
    //!$readonly ?: $attribut['readonly'] = true;

    echo'<div class="form-group">';                                        
          echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
          echo'<div class="col-md-6 col-xs-12">';
              echo'<div class="input-group">';
                  echo'<span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>';
                  echo form_password($attribut, set_value($field_name, $value));
                  
              echo'</div>';            
              echo'<span class="help-block"></span>';
              echo form_error($field_name);
          echo'</div>';
      echo'</div>';
}


function input_select($field_name, $label, $options,$selected = '',$required='',$disabled=false,$class ='col-md-6 col-xs-12')
{
    $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
    $classRequired = ($required) ? 'required' : '';

    $attribut = array(
        'class' => 'form-control select '.$classRequired,
        'placeholder'=>'Choose '.$label,
        'data-live-search'=>'true'
    );

    !$disabled ?: $attribut['disabled'] = true;

    echo'<div class="form-group">';
          echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
          echo'<div class="'.$class.'">';                                                                                            
              echo form_dropdown($field_name, $options, $selected,$attribut);
              echo'<span class="help-block"></span>';
              echo form_error($field_name);
          echo'</div>';
      echo'</div>';
}



function input_multiselect($field_name, $label, $options,$selected = '',$required='',$readonly=false)
{
    $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
    $classRequired = ($required) ? 'required' : '';
    $has_error = (form_error($field_name) != null) ? 'has-error' : '';
    
    if(!$readonly){

        echo'<div class="form-group">';
              echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
              echo'<div class="col-md-6 col-xs-12">';                                                                                           
                  echo form_dropdown($field_name, $options, $selected,array(
                        'class' => 'form-control select',
                        'placeholder'=>'Pilih '.$label,
                        'multiple'=> 'true'
                    ));
                  echo form_error($field_name);
                  echo'<span class="help-block"></span>';
              echo'</div>';
          echo'</div>';


    }
    else{

        echo'<div class="form-group">';
          echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
          echo'<div class="col-md-6 col-xs-12">';                                            
              echo'<div class="input-group">';
                  $_selected = count($selected);
                if ($_selected > 0) {
                    $_result = "";
                    foreach ($selected as $s) {
                        $_result .= '<span class="btn btn-primary btn-rounded">' . $options[$s] . '</span> &nbsp;';                
                    }
                    echo $_result;
                } else {
                    echo '<font color="red"> - </font>';
                }
              echo'</div>';                                            
              echo'<span class="help-block"></span>';
          echo'</div>';
      echo'</div>';

    }
}

function input_tags($field_name, $label, $value = '',$required = false, $readonly=false)
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control tagsinput',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;

    echo'<div class="form-group">';
        echo'<label>'.$label.$req.'</label>';
        echo'<div class="col-md-12 col-xs-12">';                                                                                
            echo form_input( $attribut, set_value($field_name, $value));
            echo form_error($field_name);
        echo'</div>';
    echo'</div>';

}


function input_email($field_name, $label, $value = '',$required=false,$readonly = false)
{ 

    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control',
                    'email' => 'true',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;

    echo'<div class="form-group">';
          echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
          echo'<div class="col-md-6 col-xs-12">';                                            
              echo'<div class="input-group">';
                  echo'<span class="input-group-addon">@</span>';
                  echo form_input( $attribut, set_value($field_name, $value));
                  
              echo'</div>';                                            
              echo'<span class="help-block"></span>';
              echo form_error($field_name);
          echo'</div>';
      echo'</div>';

}

function input_phone($field_name, $label, $value = '',$required=false,$readonly = false)
{ 

    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;

    echo'<div class="form-group">';
          echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
          echo'<div class="col-md-6 col-xs-12">';                                            
              echo'<div class="input-group">';
                  echo'<span class="input-group-addon"><span class="fa fa-phone"></span></span>';
                  echo form_input( $attribut, set_value($field_name, $value));
                  echo form_error($field_name);
              echo'</div>';                                            
              echo'<span class="help-block"></span>';
          echo'</div>';
      echo'</div>';

}

function input_label($field_name, $label, $value = '')
{
    echo '<div class="row">';
        echo '<label for="'.$field_name.'">';
            echo '<strong>'.$label.'</strong>';
        echo '</label>';
        echo '<div style="padding-top: 20px;">';
        echo $value;
        echo '</div>';
    echo '</div>';

}

function upload_image($field_name, $label, $image, $required=false, $readonly = true)
{
    $req = ($required) ? '<font color="red"> * </font>' : '';
    $url = base_url('uploads/thumbs/' . $image);

    $file_headers = @get_headers($url);
    if ($readonly) {

        if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
            echo '<div class="control-group">';
            echo '<label class="control-label" for="'.$field_name.'">'.$label.$req.'</label>';
            echo '<div class="controls controls-row">';
                echo '<a class="thumbnail-img span2" data-gallery="gallery" href="'.base_url('uploads/' . $image).'" target="_blank" data-original-title="' . $image.'">';
                echo '<img src="'.base_url('uploads/not-found.jpg').'" alt="Not Found">';
                echo '</a>';
            echo '</div>';       
            echo '<div class="controls controls-row">';
            echo '</div>';
            echo '</div>';
        }
        else {
            echo '<div class="control-group">';
            echo '<label class="control-label" for="'.$field_name.'">'.$label.$req.'</label>';
            echo '<div class="form-control">';
                echo '<a class="thumbnail-img span2" data-gallery="gallery" href="'.base_url('uploads/' . $image).'" target="_blank"  data-original-title="' . $image.'">';
                echo '<img src="'.base_url('uploads/' . $image).'" alt="">';
                echo '</a>';
            echo '</div>';

            echo '<div class="controls controls-row">';
            echo '</div>';
            echo '</div>';
        }
        
    }else{

        if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
            echo '<div class="control-group">';
            echo '<label class="control-label" for="'.$field_name.'">'.$label.$req.'</label>';
            echo '<div class="controls controls-row">';
                echo '<a class="thumbnail-img span2" data-gallery="gallery" href="'.base_url('uploads/' . $image).'" target="_blank" data-original-title="' . $image.'">';
                echo '<img src="'.base_url('uploads/not-found.jpg').'" alt="Not Found">';
                echo '</a>';
            echo '</div>';       
            echo '<div class="controls controls-row">';
            echo '<br/>';       
                echo '<input class="input-group" type="file" name="'.$field_name.'"/>';
                echo form_error($field_name);
            echo '</div>';
            echo '</div>';
        }
        else {
            echo '<div class="control-group">';
            echo '<label class="control-label" for="'.$field_name.'">'.$label.$req.'</label>';
            echo '<div class="controls controls-row">';
                echo '<a class="thumbnail-img span2" data-gallery="gallery" href="'.base_url('uploads/' . $image).'" target="_blank"  data-original-title="' . $image.'">';
                echo '<img src="'.base_url('uploads/' . $image).'" alt="">';
                echo '</a>';
            echo '</div>';

            echo '<div class="controls controls-row">';
            echo '<br/>'; 
                echo '<input class="input-group" type="file" name="'.$field_name.'"/>';
                echo form_error($field_name);
            echo '</div>';
            echo '</div>';
        }
    }

}

function input_file($field_name, $label, $value = '',$required = false, $readonly=false)
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'fileinput btn-primary',
                    'title' => 'Browse file',
                );

    !$readonly ?: $attribut['readonly'] = true;


    echo'<div class="form-group">';
          echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
          echo'<div class="col-md-6 col-xs-12">'; 

                echo'<input type="file" name="'.$field_name.'" value="http://budgeting/uploads/thumbs/user_36cb549a-5fd7-ad98-bb78-998629e2db79.jpg" multiple id="file-simple"/>';                                                                                                                               
              echo form_error($field_name);
              echo'<span class="help-block"></span>';
          echo'</div>';
    echo'</div>';
}


function input_textarea($field_name, $label, $value = '', $required=false, $readonly=false,$class='col-md-6 col-xs-12')
{
    $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';

    echo'<div class="form-group">';
        echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
        echo'<div class="'.$class.'">';                                            

                if(!$readonly){

                    echo form_textarea(
                    array(
                        'name' => $field_name,
                        'id' => $field_name,
                        'class' => 'form-control',
                        'rows'=>'5',
                    ), htmlspecialchars_decode(set_value($field_name, $value)));                    

                    echo form_error($field_name);

                }else{

                    echo'<div class="hero-unit">';

                    echo $value;

                    echo'</div>';
                }

            echo'<span class="help-block"></span>';
        echo'</div>';
    echo'</div>';

}

function input_textarea_wysiwyg($field_name, $label, $value = '', $required=false, $readonly=false)
{
    $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';

    echo'<div class="control-group">';
        echo'<label class="control-label" for="'.$field_name.'">'.$label.$req.'</label>';
        echo'<div class="controls">';

            if(!$readonly){

                echo form_textarea(
                array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'mytextarea input-block-level no-margin',
                    'style'=>'height: 240px',
                ), htmlspecialchars_decode(set_value($field_name, $value)));                    

                echo form_error($field_name);

            }else{

                echo'<div class="hero-unit">';

                echo $value;

                echo'</div>';
            }
            echo'</div>';
    echo'</div>';

}

// function input_checkbox($field_name, $default_val)
// {
//     $active = ($default_val) ? 'checked' : '';
//     echo '<label><input type="checkbox" class="flat" name="active" value="1" ' . $active . ' /></label>';
//     echo form_error($field_name);
// }

function input_date($field_name, $label, $value = '',$required = false, $readonly=false,$class='col-md-6 col-xs-12')
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control datepicker',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;

    echo'<div class="form-group">';
          echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
          echo'<div class="'.$class.'">';                                            
              echo'<div class="input-group">';
                  echo'<span class="input-group-addon"><span class="fa fa-calendar"></span></span>';
                  echo form_input( $attribut, set_value($field_name, $value));
              echo'</div>';                                            
              echo'<span class="help-block"></span>';
              echo form_error($field_name);
          echo'</div>';
      echo'</div>';
}

function generate_input($id, $name, $label, $required = true, $value = '')
{
    $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
    $has_error = (form_error($id) != null) ? 'has-error' : '';

    if ($value = '') {
        $value = set_value($name, '');
    }else{
        $value = set_value($name, $value);
    }

    $ret = "<div class='form-group " . $has_error . "'>";
    $ret .= '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">' . $label . $req . '</label>';
    $ret .= '<div class="col-md-6 col-sm-6 col-xs-12"> <input type="text" id="' . $id . '" $req name="' . $name . '" value="' . $value . '" class="form-control col-md-7 col-xs-12"> ';
    $ret .= form_error($id);
    $ret .= '</div>';
    $ret .= '</div>';
    echo $ret;

}

function generate_textarea($id, $name, $label, $required = true, $value = '')
{
    $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
    $has_error = (form_error($id) != null) ? 'has-error' : '';

    if ($value = '') {
        $value = set_value($name, '');
    }else{
        $value = set_value($name, $value);
    }

    $ret = "<div class='form-group " . $has_error . "'>";
    $ret .= '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">' . $label . $req . '</label>';
    $ret .= '<div class="col-md-6 col-sm-6 col-xs-12">';
    $ret .= '<textarea name="' . $name . '" id="' . $id . '" class=" mytextarea form-control col-md-8 col-xs-12">' . $value . '</textarea>';
    $ret .= form_error($id);
    $ret .= '</div>';
    $ret .= '</div>';
    echo $ret;
}

function generate_activeinput($value = '', $disabled=false)
{
    $a = '';
    $in = '';

    $in = ($value == 1) ? $in = 'checked' : $a = 'checked';

    $disabled = ($disabled) ? 'disabled' : '';

    echo'<div class="form-group">';
          echo'<label class="col-md-3 col-xs-12 control-label">Active</label>';
          echo'<div class="col-md-6 col-xs-12">';                                                                                            echo'<label class="check"><input type="radio" name="active" class="icheckbox" value="1"'.$in.' '.$disabled.'/> Yes </label> &nbsp;';
              echo'<label class="check"><input type="radio" name="active" class="icheckbox" value="0"'.$a.' '.$disabled.'/> No</label>';
              echo form_error('active');
              echo'<span class="help-block"></span>';
          echo'</div>';
      echo'</div>';
}

function slideon($label='Active', $name='active',$value = '', $required=false, $disabled=false)
{
    $a = '';
    $in = '';

    $in = ($value == 1) ? 'checked' : '';
    $status = ($value == 1) ? 'ON' : 'OFF';
    $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
    $disabled = ($disabled) ? 'disabled' : '';

    echo'<div class="form-group">';
      echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
        echo'<div class="col-md-6 col-xs-6">';
            echo'<label class="switch">';
                echo'<input type="checkbox" name="'.$name.'" value="1" '.$in.' '.$disabled.'/>';
                echo'<span> '.$status.' </span>';
                echo form_error('active');
            echo'</label>';
        echo'</div>';
    echo'</div>';
}


function radio_button($field_name, $label, $options,$value = 0,$required=false, $disabled=false)
{
  // $options=array(
  //                 array('label' => 'Pending',
  //                       'value' => 0 ),
  //                 array('label' => 'Success',
  //                       'value' => 1 );
        $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
        $_required = ($required) ? ' required' : '';
        $_disabled = ($disabled) ? ' disabled' : '';
        echo'<div class="control-group">';
        echo'<label class="col-md-3 col-xs-12 control-label">' . $label . $req . '</label>';

            foreach ($options as $r){
              echo '<div class="col-md-1 col-xs-12">';
                echo'<label class="check">';
                    if($r['value']==set_value($field_name, $value)){
                        echo'<input type="radio" class="iradio" name="'.$field_name.'" id="'.$field_name.'" value="'.$r['value'].'" checked '.$_required.$_disabled.'> '.$r['label'];
                    }
                    else{
                        echo'<input type="radio" class="iradio" name="'.$field_name.'" id="'.$field_name.'" value="'.$r['value'].'" '.$_required.$_disabled.'> '.$r['label'];
                    }
                echo'</label>';
                echo form_error('active');
                echo'<span class="help-block"></span>';
              echo '</div>';
            }

        echo form_error($field_name);
    echo'</div>';
}

function input_checkbox($field_name, $label, $options,$selected = 0,$required=false, $disabled=false,$class ='col-md-6 col-xs-12')
{
    $req = ($required) ? '<font color="red">&nbsp; * </font>' : '';
    $classRequired = ($required) ? 'required' : '';

    $attribut = array(
        'class' => 'form-control select '.$classRequired,
        'placeholder'=>'Choose '.$label,
        'data-live-search'=>'true'
    );

    !$disabled ?: $attribut['disabled'] = true;

    echo'<div class="form-group">';
          echo'<label class="col-md-3 col-xs-12 control-label">'.$label.$req.'</label>';
          echo'<div class="'.$class.'">';                                                                   
              foreach ($options as $key => $value) {
                echo'<div class="form-group">';
                    echo'<div class="col-md-4">';                                    
                        echo'<label class="check"><input type="checkbox" name="'.$field_name.'" value="'.$key.'" class="icheckbox" checked="checked"/> '.$value.'</label>';
                    echo'</div>';
                echo'</div>';
              }
              echo'<span class="help-block"></span>';
              echo form_error($field_name);
          echo'</div>';
      echo'</div>';
}


function input_text_contact($field_name, $label, $required = true, $value)
{
    $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
    $has_error = (form_error($field_name) != null) ? 'has-error' : '';
    $icon = (($field_name == "name") ? "fa fa-user" :(($field_name == "email") ? "fa fa-envelope" :(($field_name == "message") ? "fa fa-pencil" : "")));

    echo '<div class="form-group contact-form-icon '.$has_error.'">';
        echo '<label class="sr-only" >'.$label.$req.'</label>';
        echo '<i class="'.$icon.'" style="color: black;padding: 14px 12px;pointer-events: none;position: absolute;"></i>';
            echo form_input(
                array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'contact-input-form form-control',
                    'style' => 'padding-left: 35px;',
                    'required' => 'true',
                    'placeholder' => $label
                ), set_value($field_name, $value));
            echo form_error($field_name);
    echo '</div>';

}

function input_textarea_contact($field_name, $label, $required = true, $value)
{
    $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
    $has_error = (form_error($field_name) != null) ? 'has-error' : '';

    echo '<div class="form-group contact-form-icon '.$has_error.'">';
        echo '<label class="sr-only" >'.$label.$req.'</label>';
        echo '<i class="fa fa-pencil" style="color: black;padding: 14px 12px;pointer-events: none;position: absolute;"></i>';
            echo form_textarea(
                array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'contact-input-form form-control',
                    'style' => 'padding-left: 35px;',
                    'required' => $required,
                    'placeholder' => $label
                ), set_value($field_name, $value));
            echo form_error($field_name);
    echo '</div>';

}


function popup_selectbox($field_name, $label, $value = '',$required = false, $readonly=false)
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'input-xlarge',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="control-group">';
        echo'<label class="control-label" for="'.$field_name.'">'.$label.$req.'</label>';
        echo'<div class="controls controls-row">';

            echo form_input( $attribut, set_value($field_name, $value));

        echo form_error($field_name);
        echo'</div>';
    echo'</div>';
}

function get_pagedata(){

    $CI = &get_instance();
    $CI->load->model('group/group_m');
    $id = $CI->session->userdata('logged_in')['id'];
    $page_data = $CI->group_m->get_authorize_pages($id);

    return $page_data;
}

function tarkiman_datatable($table,$columns,$condition,$primaryKey='id')
{
    require __DIR__ . '/../libraries/ssp.class.php';

    $CI =& get_instance();
    $CI->load->database();

    $sql_details = array(
        'user' => $CI->db->username,
        'pass' => $CI->db->password,
        'db'   => $CI->db->database,
        'host' => $CI->db->hostname
    );

    echo json_encode(
        //SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
        SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, $condition)
    );
}

function language($_lang = null)
{
    $CI = &get_instance();
    $_lang = ($_lang != null) ? $CI->lang->line($_lang) : "";
    echo $_lang;
}


function number($value='')
{
  return str_replace(',', '', $value);
}


/*Form Builder*/
function formElementUpdate($json=''){

    $element = "";
    foreach ($json as $r) {

        $type  = isset($r->type) ? $r->type : '';
        $name  = isset($r->name) ? $r->name : '';
        $label  = isset($r->label) ? $r->label : '';
        $value = isset($r->value) ? $r->value : '';
        $required = isset($r->required) ? 'true' : 'false';        
        $className = isset($r->className) ? $r->className : '';

        if($r->type=='text'){
            $element = $element."
            <?php input_text('".$name."','".$label."',\$data->".$name.",".$required.",false); ?>";
        }
        elseif($r->type=='hidden'){
            $element = $element."
            <?php input_hidden('".$name."',\$data->".$name."); ?>";
        }
        elseif($r->type=='date'){
            $element = $element."
            <?php input_date('".$name."','".$label."',\$data->".$name.",".$required.",false); ?>";
        }
        elseif ($r->type=='button') {
            $element = $element."
            <?php input_button('".$name."','".$label."',\$data->".$name.",'".$className."'); ?>";
        }
        elseif ($r->type=='select') {
            $element = $element."
            <?php
            \$options = array(";


            foreach ($r->values as $x) {
                $element = $element."
                '".$x->value."' => '".$x->label."',";
            }

            $element = rtrim($element,",");               

            $element = $element."
            );
            ?>";

            $element = $element."
            <?php input_select('".$name."','".$label."',\$options,\$data->".$name.",".$required."); ?>";
        }

    }

    return $element;
}

function formElementView($json=''){

    $element = "";
    foreach ($json as $r) {

        $type  = isset($r->type) ? $r->type : '';
        $name  = isset($r->name) ? $r->name : '';
        $label  = isset($r->label) ? $r->label : '';
        $value = isset($r->value) ? $r->value : '';
        $required = isset($r->required) ? 'true' : 'false';        
        $className = isset($r->className) ? $r->className : '';

        if($r->type=='text'){
            $element = $element."
            <?php input_text('".$name."','".$label."',\$data->".$name.",".$required.",true); ?>";
        }
        elseif($r->type=='hidden'){
            $element = $element."
            <?php input_hidden('".$name."',\$data->".$name."); ?>";
        }
        elseif($r->type=='date'){
            $element = $element."
            <?php input_date('".$name."','".$label."',\$data->".$name.",".$required.",true); ?>";
        }
        elseif ($r->type=='button') {
            $element = $element."
            <?php input_button('".$name."','".$label."',\$data->".$name.",'".$className."'); ?>";
        }
        elseif ($r->type=='select') {
            $element = $element."
            <?php
            \$options = array(";


            foreach ($r->values as $x) {
                $element = $element."
                '".$x->value."' => '".$x->label."',";
            }

            $element = rtrim($element,",");               

            $element = $element."
            );
            ?>";

            $element = $element."
            <?php input_select('".$name."','".$label."',\$options,\$data->".$name.",".$required.",true); ?>";
        }

    }

    return $element;
}

/*Form Builder*/
function formElementCreate($json=''){

    $element = "";
    foreach ($json as $r) {

        $type  = isset($r->type) ? $r->type : '';
        $name  = isset($r->name) ? $r->name : '';
        $label  = isset($r->label) ? $r->label : '';
        $value = isset($r->value) ? $r->value : '';
        $required = isset($r->required) ? 'true' : 'false';        
        $className = isset($r->className) ? $r->className : '';

        if($r->type=='text'){
            $element = $element."
            <?php input_text('".$name."','".$label."','',".$required.",false); ?>";
        }
        elseif($r->type=='hidden'){
            $element = $element."
            <?php input_hidden('".$name."',''); ?>";
        }
        elseif($r->type=='date'){
            $element = $element."
            <?php input_date('".$name."','".$label."','',".$required.",false); ?>";
        }
        elseif ($r->type=='button') {
            $element = $element."
            <?php input_button('".$name."','".$label."','','".$className."'); ?>";
        }
        elseif ($r->type=='select') {
            $element = $element."
            <?php
            \$options = array(";


            foreach ($r->values as $x) {
                $element = $element."
                '".$x->value."' => '".$x->label."',";
            }

            $element = rtrim($element,",");               

            $element = $element."
            );
            ?>";

            $element = $element."
            <?php input_select('".$name."','".$label."',\$options,'',".$required.",true); ?>";
        }


    }

    return $element;
}


function controllerMethodDatatables($moduleName,$json){

  $datatables = "
                public function datatables(){
                    \$table = 
                        \"
                        (
                        SELECT id,";

                        foreach ($json as $r) {

                            $datatables = $datatables.$r->name.",";
                        }

                        $datatables = rtrim($datatables,",");  
                        

                        $datatables= $datatables."
                        FROM ".$moduleName."
                        WHERE deleted='0'
                        ) temp
                        \";  

                    \$columns = array(
                        array('db' => 'id', 'dt' => 0 ),";

                        $n = 1;
                        foreach ($json as $r) {

                        $datatables = $datatables."
                        array('db' => '".$r->name."', 'dt' => ".$n." ),";

                            $n++;
                        }                       


                        $datatables= $datatables."                        
                        array(
                            'db'        => 'id',
                            'dt'        => ".$n.",
                            'formatter' => function( \$i, \$row ) {
                                \$html = \"
                                <center>
                                    \".link_view('".$moduleName."/view', \$i).\"
                                    \".link_edit('".$moduleName."/edit', \$i).\"
                                    \".link_remove('".$moduleName."/remove',\$i).\"
                                </center>\";
                                return \$html;
                            }
                        ),
                    );

                    \$primaryKey = 'id';

                    \$condition = null;

                    tarkiman_datatable(\$table,\$columns,\$condition,\$primaryKey);


                }

  ";

  // $datatables = "
  //               public function datatables(){
  //                   \$table = 
  //                       \"
  //                       (
  //                       SELECT p.id,p.name,p.uri,p.active
  //                       FROM tarkiman_pages p
  //                       GROUP BY p.id
  //                       ORDER BY p.uri ASC
  //                       ) temp
  //                       \";  

  //                   \$columns = array(
  //                       array('db' => 'id', 'dt' => 0 ),
  //                       array('db' => 'name', 'dt' => 1 ),
  //                       array('db' => 'uri', 'dt' => 2 ),
  //                       array('db' => 'group', 'dt' => 3 ),
  //                       array(
  //                           'db'        => 'active',
  //                           'dt'        => 4,
  //                           'formatter' => function( \$i, \$row ) {
  //                               \$html = active_status(\$i);
  //                               return \$html;
  //                           }
  //                       ),
  //                       array(
  //                           'db'        => 'id',
  //                           'dt'        => 5,
  //                           'formatter' => function( \$i, \$row ) {
  //                               \$html = \"
  //                               <center>
  //                                   \".link_view('".$moduleName."/view', \$i).\"
  //                                   \".link_edit('".$moduleName."/edit', \$i).\"
  //                                   \".link_remove('".$moduleName."/remove',\$i).\"
  //                               </center>\";
  //                               return \$html;
  //                           }
  //                       ),
  //                   );

  //                   \$primaryKey = 'id';

  //                   \$condition = null;

  //                   tarkiman_datatable(\$table,\$columns,\$condition,\$primaryKey);


  //               }

  // ";

  return $datatables;

}


?>
