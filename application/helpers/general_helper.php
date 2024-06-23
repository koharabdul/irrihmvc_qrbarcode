<?php
/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {

    function dump($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' .
            $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        } else {
            return $output;
        }
    }
}

if (!function_exists('dump_exit')) {

    function dump_exit($var, $label = 'Dump', $echo = TRUE)
    {
        dump($var, $label, $echo);
        exit();
    }
}

function textile_sanitize($string)
{
    $whitelist = '/[^a-zA-Z0-9а-яА-ЯéüртхцчшщъыэюьЁуфҐ \.\*\+\\n|#;:!"%@{} _-]/';
    return preg_replace($whitelist, '', $string);
}

function escape($string)
{
    return textile_sanitize($string);
}

if (!function_exists('currency_format')) {

    function currency_format($number)
    {
        return 'Rp ' . number_format($number, 0, '.', ',');
    }
}

if (!function_exists('number_format')) {

    function number_format($number)
    {
        return number_format($number, 0, '.', ',');
    }
}

function date_convert($date,$time=false)
{
    $_time = ($time) ? date_format(date_create($date),"H:i:s") : "";
    $date = date('Y-m-d', strtotime($date)); // ubah sesuai format penanggalan

    // standart
    $bulan = array(
        '01' => 'Januari', // array bulan konversi
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    );
    $date = explode('-', $date); // ubah string menjadi array dengan parameter
    // '-'

    return $date[2] . ' ' . $bulan[$date[1]] . ' ' . $date[0] . ' ' .$_time; // hasil yang di
    // kembalikan
}

function getMonthName($date)
{
    $ret = '';
    switch ($date) {
        case '1':
            $ret = 'Januari';
            break;
        case '2':
            $ret = 'Februari';
            break;
        case '3':
            $ret = 'Maret';
            break;
        case '4':
            $ret = 'April';
            break;
        case '5':
            $ret = 'Mei';
            break;
        case '6':
            $ret = 'Juni';
            break;
        case '7':
            $ret = 'Juli';
            break;
        case '8':
            $ret = 'Agustus';
            break;
        case '9':
            $ret = 'September';
            break;
        case '10':
            $ret = 'Oktober';
            break;
        case '11':
            $ret = 'November';
            break;
        case '12':
            $ret = 'Desember';
            break;
        case '':
            $ret = '-';
        default:
            $ret = "-";
            break;
    }
    return $ret;
}

function url($path)
{
    echo base_url($path);
}

function asset_front($path)
{
    echo base_url('asset/frontend-template/' . $path);
}

function asset_back($path)
{
    echo base_url('asset/backend-template/' . $path);
}

function userPermission($permissionId)
{
    $CI = &get_instance();
    if ($CI->session->userdata('current_user_id')) {
        $CI->load->model('user_m');
        $CI->user_m->userPermission($CI->session->userdata('currentUserId'), $permissionId);
    }
}

function load_list_menu($uri = '/', $name = '',$icon = '')
{
    //echo '<li><a href="' . base_url($uri) . '">' . $name . '</a></li>';
    echo '<li><a href="' . base_url($uri) . '"><span class="' . $icon . '"></span>' . $name . '</a></li>';
}

function send_error_message($msg = null)
{
    $CI = &get_instance();
    $msg = ($msg == null) ? 'Failed to Save Data' : $msg;
    $CI->session->set_flashdata('error', $msg);
}

function send_success_message($msg = null)
{
    $CI = &get_instance();
    $msg = ($msg == null) ? 'Success to Save Data' : $msg;
    $CI->session->set_flashdata('success', $msg);
}

function notifikasi($pesan,$aksi,$nama){
    $CI = &get_instance();
    $CI->session->set_flashdata('pesan',$pesan);
    $CI->session->set_flashdata('aksi',$aksi);
    $CI->session->set_flashdata('name',$nama);
}

function slugify($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}