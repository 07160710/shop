<?php
require("public/config/config.php");
require("function.php");
//if($_SESSION['u_id']!=""){
//    header("Location:public/manage_login.php");
//    exit;
//}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link href="public/assest/css/style.css" rel="stylesheet" type="text/css" />
    <link href="public/assest/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <script src="public/assest/js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="public/assest/js/basic_fn.js" type="text/javascript"></script>
    <script src="public/assest/js/jsbn.js" type="text/javascript"></script>
    <script src="public/assest/js/prng4.js" type="text/javascript"></script>
    <script src="public/assest/js/rng.js" type="text/javascript"></script>
    <script src="public/assest/js/rsa.js" type="text/javascript"></script>
    <title><?php print SITE_NAME;?></title>
</head>

<body>
<div id="main_content" style="margin:0;background:transparent;">
    <table class="login_container reg" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <div class="content_holder">
                    <div class="login_logo_holder">
                        <img src="public/assest/images/logo.png">
                    </div>
                    <table border="0" cellpadding="0" cellspacing="10" class="login_holder">
                        <tr>
                            <td class="logo_holder" colspan="2">
                                <h1><?php print SITE_NAME;?></h1>
                            </td>
                        </tr>
                        <tr>
                            <td class="title">
                                手机/邮箱
                            </td>
                            <td>
                                <input name="login_account" type="text" id="login_account" class="login_field">
                            </td>
                        </tr>
                        <tr>
                            <td class="title">
                                密码
                            </td>
                            <td>
                                <input name="login_password" type="password" id="login_password" class="login_field" onkeydown="if(event.keyCode==13)cmdEncrypt();">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button style="submit" class="ctrl_btn active login" id="btn_login">
                                    登录
                                </button>
                                <div class="clear"></div>
                                <a id="btn_forgot">
                                    忘记密码？
                                </a>
                            </td>
                        </tr>
                    </table>

                    <table border="0" cellpadding="0" cellspacing="10" class="reset_holder">
                        <tr>
                            <td colspan="2" class="logo_holder">
                                <h1>
                                    重设密码
                                </h1>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="line-height:20px;">
                                请输入您的注册邮箱，点击“重设密码”，新的密码将会发送到您的邮箱。
                            </td>
                        </tr>
                        <tr>
                            <td class="title">
                                电子邮箱
                            </td>
                            <td>
                                <input name="reset_email" type="text" id="reset_email" class="reset_field">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button class="ctrl_btn active reset" id="btn_reset">
                                    重设密码
                                </button>
                                <div class="clear"></div>
                                <a id="btn_back" style="color:#999;">&lt;返回</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</div>

<footer id="footer">
    KAI CHUANG&nbsp;&copy;&nbsp;2018-<?php print date('Y');?>&nbsp;凯创网络科技 版权所有
</footer>

<div id="alert_panel" class="overlay">
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td valign="middle" align="center" class="alert_holder"></td>
        </tr>
    </table>
</div>

</body>
</html>

<script>
    var response = '<?php print $_COOKIE['response'];?>',
        default_lang = '<?php print $_SESSION['u_lang'];?>';
    $(function() {
        if(response!=''){
            switch(response){
                case 'logout': show_alert('成功登出，再见！'); break;
                case 'timeout': show_alert('登录超时，请重新登录！'); break;
                case 'unknown': show_alert('发生未知错误，请重新登录！'); break;
                default: show_alert(response);
            }
        }

        $('#btn_login').click(function(){
            cmdEncrypt();
        });

        $('#btn_reset').click(function(){
            manage_process('reset');
        });

        //重新设置密码
        $('#btn_forgot').click(function(){
            $('.reset_holder').addClass('show');
        });
        $('#btn_back').click(function() {
            $('.reset_holder').removeClass('show');
        });
    });

    function show_alert(msg,type,link){
        if(msg!=''){
            var msg_str = '',
                btn_str = '';
            switch(type){
                case 'load':
                    msg_str = '<div class="loading"><i></i>'+msg+'</div>';
                    break;
                case 'reload':
                    msg_str = '<p>'+msg+'</p>';
                    btn_str = '<p><button class="ctrl_btn active" onclick="window.location.reload();">确定</button></p>';
                    break;
                case 'redirect':
                    msg_str = '<p>'+msg+'</p>';
                    btn_str = '<p><button class="ctrl_btn active" onclick="document.cookie=\'response=;path=./\';window.location.href=\''+link+'\'">确定</button></p>';
                    break;
                default:
                    msg_str = '<p>'+msg+'</p>';
                    btn_str = '<p><button class="ctrl_btn active" onclick="document.cookie=\'response=;path=./\';$(\'.overlay\').hide().setOverlay();">确定</button></p>';
            }

            $('#alert_panel .alert_holder').html(msg_str+btn_str);
            if(!$('#alert_panel').is(':visible'))$('#alert_panel').show().setOverlay();
        }
    }

    function cmdEncrypt() {
        var account = $('#login_account').val(),
            passwd = $('#login_password').val();
        // var rsa = new RSAKey();
        // openssl生成的modulus,十六进制数据
        // var modulus = '<?php //print $modulus;?>';
        // openssl生成秘钥时的e的值(0x10001)
        // var exponent = '10001';
        // rsa.setPublic(modulus, exponent);
        // account = rsa.encrypt(account);
        // passwd = rsa.encrypt(passwd);
        manage_process('login',account,passwd);
    }

    function manage_process(e,account,passwd){
        if(check_fields(e)){
            if(e=='login'){
                show_alert('正在登录，请稍候 ...','load');

                var params = 'action=login&account='+account+'&password='+passwd;
                $.ajax({
                    type: 'post',
                    url: 'manage_login.php',
                    dataType: 'json',
                    data: params,
                    success: function(result){
                        if(result.success==1){
                            //window.location.href = result.referer;
                        }
                        else{
                            show_alert(result.error);
                        }
                    }
                });
            }
            else{
                show_alert('正在发送邮件，请稍候 ...','load');

                var params = 'action=reset_password&email='+encodeURIComponent($('#reset_email').val());
                $.ajax({
                    type: 'post',
                    url: 'public/manage_login.php',
                    dataType: 'json',
                    data: params,
                    success: function(result){
                        if(result.success==1){
                            show_alert('新密码已经发送到您的邮箱，请使用新的密码登录。');
                        }
                        else{
                            show_alert(result.error);
                            $('#reset_email').val('');
                        }
                    }
                });
            }
        }
    }

    function check_fields(e){
        var valid_flag = true;
        $('.'+e+'_field').each(function(){
            if($(this).val()==''){
                show_alert('请填写电子邮箱及密码！');
                valid_flag = false;
            }
        });
        return valid_flag;
    }
</script>