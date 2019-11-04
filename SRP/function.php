<?php
/**
 * @return mixed
 * 获取地址锚点
 */
function get_path(){
    $url = $_SERVER['REQUEST_URI'];
    $url_params = parse_url($url);
    $url_arr = explode("/",$url_params['path']);
    //print_r($url_arr);
    $path = $url_arr[count($url_arr)-2];
    // print_r($path);
    // exit;
    return $path;
}