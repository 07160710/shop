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

/**
 * @param $object_id
 * @param $object
 * @param $content
 * @param string $u_id
 * 获取记录日志
 */
function save_log($object_id,$object,$content,$u_id=""){
    $u_id = ($u_id!="")?$u_id:$_SESSION['u_id'];
    $sql = "INSERT INTO gmi_log(
				u_id,
				object,
				object_id,
				content,
				log_time,
				ip
			) VALUES(
				'$u_id',
				'$object',
				'$object_id',
				'$content',
				'".time()."',
				'".$_SERVER['REMOTE_ADDR']."'
			)";
    if(!mysql_query($sql)){
        echo "保存日志出错: ".mysql_error();
        exit;
    }
}

/**
 * @param $type
 * @param $skts
 * 密码加密方式
 */
function password_crypt($type){
    if ($type == ""){

    }
}

