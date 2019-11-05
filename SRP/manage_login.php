<?php
require("include/conn.php");
require("public_param.php");
include("function.php");

if($_SESSION['u_id']!=""){
    if(isset($_REQUEST['logout'])){
        $sql = "UPDATE gmi_user 
				SET last_login = login_time,
					last_logout = '".time()."' 
				WHERE id = '".$_SESSION['u_id']."'";
        if(mysql_query($sql)){
            session_destroy();

            if($_REQUEST['logout']==1){
                setcookie("response", "logout", time() + 60, '/');
                save_log('logout','成功登出');
            }
            else if($_REQUEST['logout']==2){
                setcookie("response", "timeout", time() + 60, '/');
                save_log('logout','超时登出');
            }
            else{
                setcookie("response", "unknown", time() + 60, '/');
                save_log('logout','未知错误');
            }
            header("Location:"._BASE_URL_);
            exit;
        }
    }
    else{
        $referer = (isset($_COOKIE['referer']))?$_COOKIE['referer']:_BASE_URL_;
        $referer = ($referer!="")?$referer:"model/home/";
        header("Location:".$referer);
        exit;
    }
}
else if($_POST['action']=="login"){
    if(!isset($_SESSION['u_id']) || $_SESSION['u_id']==""){//log in
        $hex_encrypt_data = trim($_POST['account']);  //十六进制数据
        $encrypt_data = pack("H*", $hex_encrypt_data); //对十六进制数据进行转换
        $login_account = openssl_private_decrypt($encrypt_data, $decrypt_data, $private_key); //解密数据
        $login_account = $decrypt_data;

        $hex_encrypt_data = trim($_POST['password']);  //十六进制数据
        $encrypt_data = pack("H*", $hex_encrypt_data); //对十六进制数据进行转换
        $login_password = openssl_private_decrypt($encrypt_data, $decrypt_data, $private_key); //解密数据
        $encrypted_pass = sha1($decrypt_data.SALT);

        $sql = "SELECT * 
				FROM shop_user 
				WHERE (mobile='$login_account' OR email='$login_account') AND password = '$encrypted_pass'";
        $get_user = mysql_query($sql);
        if(mysql_num_rows($get_user) > 0){
            $row = mysql_fetch_array($get_user);
            $status = $row['status'];
            if($status==1){
                $_SESSION['u_id'] = $row['id'];
                $_SESSION['u_name'] = $row['name'];
                $_SESSION['u_img'] = $row['avatar'];
                $_SESSION['level'] = $row['level'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['department'] = $row['department'];

                $branch = $row['branch'];
                $branch = json_decode($branch, true);
                $_SESSION['park'] = $branch;

                $auth_ctrl = $row['auth_ctrl'];
                $auth_ctrl_arr = json_decode($auth_ctrl, true);
                foreach($GLOBALS['user_auth'] as $auth => $value){
                    $_SESSION['auth_'.$auth] = $auth_ctrl_arr['auth_'.$auth];
                    if($_SESSION['level']==3)$_SESSION['auth_'.$auth] = 2;
                }

                $sql = "UPDATE gmi_user SET login_time='".time()."' WHERE id='".$_SESSION['u_id']."'";
                if(mysql_query($sql)){
                    save_log('login','成功登录');
                    $referer = $_COOKIE['referer'];
                    if($referer!=""){
                        $arr = array(
                            'success'=>1,
                            'referer'=>$referer
                        );
                    }
                    else{
                        $arr = array(
                            'success'=>1,
                            'referer'=>'home/'
                        );
                    }
                }
            }
            else{
                if($status==2)$error = "您的账号已被禁用，请联系系统管理员。";
                if($status==0 || $status==4)$error = "您的账号尚未激活，请联系系统管理员。";
                $arr = array(
                    'success'=>0,
                    'error'=>$error
                );
            }
        }
        else{
            $arr = array(
                'success'=>0,
                'error'=>'电邮/手机与密码不匹配，请重新输入。'
            );
        }
        echo json_encode($arr);
        exit;
    }
}
else{
    session_destroy();
    setcookie("response", "logout", time() + 60, '/');
    header("Location:"._BASE_URL_);
    exit;
}