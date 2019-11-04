<?php
    require("../../public/config/conn.php");
    require("function.php");
    include_once('../../public/config/config.php');
    $page_name = get_path();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-cache,no-store, must-revalidate">
<!--    <link rel="shortcut icon" href="public/images/favicon.ico" type="image/x-icon" />-->
    <link href="../../public/assest/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../public/assest/fontawesome/css/fontawesome-all.min.css" rel="stylesheet" type="text/css" />
    <link href="../../public/assest/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../../public/assest/js/jedate/skin/jedate.css" rel="stylesheet" type="text/css" />
    <script src="../../public/assest/js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="../../public/assest/js/jedate/src/jedate.js" type="text/javascript"></script>
    <link href="../../public/assest/css/sidebar.css" rel="stylesheet" type="text/css" />
    <link href="../../public/assest/css/account.css" rel="stylesheet" type="text/css" />
    <script src="../../public/assest/js/basic_fn.js" type="text/javascript"></script>
    <script src="../../public/assest/js/jquery-ui-1.10.3.js" type="text/javascript"></script>
    <script src="../../public/assest/js/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
    <script src="../../public/assest/js/datePicker_cn.js" type="text/javascript"></script>
    <script src="../../public/assest/js/public_fn.js" type="text/javascript"></script>

    <?php
    switch($page_name){
        case "home":
            $page_title = "首页";
            print "<link href=\"public/assest/css/content.css\" rel=\"stylesheet\" type=\"text/css\" />";
            print "<script src=\"public/assest/js/ajaxfileupload.js\" type=\"text/javascript\"></script>";
            print "<script src=\"public/assest/js/Jcrop/js/jquery.Jcrop.min.js\" type=\"text/javascript\"></script>";
            print "<link href=\"public/assest/js/Jcrop/css/jquery.Jcrop.min.css\" rel=\"stylesheet\" type=\"text/css\" />";
            break;
        case "order":
            $page_title = "订单管理";
            print "<link href=\"../../public/assest/css/content.css\" rel=\"stylesheet\" type=\"text/css\" />";
//            print "<script src=\"//webapi.amap.com/maps?v=1.4.9&key=".$GLOBALS['amap_key']."\"></script>";
            print "<script src=\"../../public/assest/js/ajaxfileupload.js\" type=\"text/javascript\"></script>";
            print "<script charset=\"utf-8\" src=\"../../public/assest/js/kindeditor/kindeditor-all.js\"></script>";
            print "<script charset=\"utf-8\" src=\"../../public/assest/js/kindeditor/lang/zh-CN.js\"></script>";
            break;
        case "user":
            $page_title = "管理员管理";
            print "<link href=\"public/assest/css/content.css\" rel=\"stylesheet\" type=\"text/css\" />";
            print "<script src=\"public/assest/js/ajaxfileupload.js\" type=\"text/javascript\"></script>";
            print "<script src=\"public/assest/js/Jcrop/js/jquery.Jcrop.min.js\" type=\"text/javascript\"></script>";
            print "<link href=\"public/assest/js/Jcrop/css/jquery.Jcrop.min.css\" rel=\"stylesheet\" type=\"text/css\" />";
            break;
        case "backup":
            $page_title = "备份";
            print "<link href=\"public/assest/css/content.css\" rel=\"stylesheet\" type=\"text/css\" />";
            break;
        default:
            $page_title = SITE_NAME;
            break;
    }
    ?>
    <title><?php print $page_title." | ".SITE_NAME;?></title>
</head>

<body>
<a name="top"></a>
<header>
    <div id="logo_holder"></div>
    <div id="welcome_holder">
        欢迎，<?php print $_SESSION['u_name'];?>！&nbsp;
        <a id="lnk_logout" href="../../public/manage_login.php?logout=1">登出</a>
<!--        ($_SESSION['u_img']!="")?$_SESSION['u_img']:-->
        <img id="user_img" src="<?php print _ROOT_URL_."../public/assest/images/no_profile_image.jpg";?>">
    </div>
</header>

<div id="main_content">
    <div class="side-nav">
        <ul>
            <li class="nav-item first">
                <a class="nav-link <?php print ($_SERVER['REQUEST_URI']=="/home/")?"curr":"";?>" href="<?php print _ROOT_URL_;?>home/">
                    <i class="fa fa-home"></i>
                    <span>管理控制台</span>
                </a>
            </li>
            <li class="nav-item	<?php print ($_SERVER['REQUEST_URI']=="/order/" ||
                $_SERVER['REQUEST_URI']=="/order/")?"expand":"";?>">
                <a class="nav-link">
                    <i class="fa fa-pencil"></i>
                    <span>订单管理</span>
                    <i class="fa fa-caret-right fr"></i>
                </a>
                <ul class="nav-menu">
                    <li class="nav-item sub">
                        <a class="nav-link sub <?php print ($_SERVER['REQUEST_URI']=="/order/")?"curr":"";?>" href="<?php print _ROOT_URL_;?>order/">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>订单列表</span>
                        </a>
                    </li>
                    <li class="nav-item sub">
                        <a class="nav-link sub <?php print ($_SERVER['REQUEST_URI']=="/apply/")?"curr":"";?>" href="<?php print _ROOT_URL_;?>apply/">
                            <i class="fa fa-h-square"></i>
                            <span>公共平台申请</span>
                        </a>
                    </li>
                </ul>
            </li>

<!--            <li class="nav-item	--><?php //print ($_SERVER['REQUEST_URI']=="/service/" ||
//                $_SERVER['REQUEST_URI']=="/service_apply/")?"expand":"";?><!--">-->
<!--                <a class="nav-link">-->
<!--                    <i class="fab fa-slideshare"></i>-->
<!--                    <span>服务管理</span>-->
<!--                    <i class="fa fa-caret-right fr"></i>-->
<!--                </a>-->
<!--                <ul class="nav-menu">-->
<!--                    <li class="nav-item sub">-->
<!--                        <a class="nav-link sub --><?php //print ($_SERVER['REQUEST_URI']=="/service/")?"curr":"";?><!--" href="--><?php //print _ROOT_URL_;?><!--service/">-->
<!--                            <i class="fab fa-font-awesome"></i>-->
<!--                            <span>服务项目管理</span>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li class="nav-item sub">-->
<!--                        <a class="nav-link sub --><?php //print ($_SERVER['REQUEST_URI']=="/service_apply/")?"curr":"";?><!--" href="--><?php //print _ROOT_URL_;?><!--service_apply/">-->
<!--                            <i class="fas fa-calendar-check"></i>-->
<!--                            <span>服务申请审核</span>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </li>-->
            <li class="nav-item">
                <a class="nav-link <?php print ($_SERVER['REQUEST_URI']=="/user/")?"curr":"";?>" href="<?php print _ROOT_URL_;?>user/">
                    <i class="fas fa-user-secret"></i>
                    <span>管理员管理</span>
                </a>
            </li>
            <li class="nav-item	<?php print ($_SERVER['REQUEST_URI']=="/backup/" ||
                $_SERVER['REQUEST_URI']=="/setting/")?"expand":"";?>">
                <a class="nav-link">
                    <i class="fa fa-cog"></i>
                    <span>设置管理</span>
                    <i class="fa fa-caret-right fr"></i>
                </a>
                <ul class="nav-menu">
                    <li class="nav-item sub">
                        <a class="nav-link sub <?php print ($_SERVER['REQUEST_URI']=="/backup/")?"curr":"";?>" href="<?php print _ROOT_URL_;?>backup/">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>数据备份</span>
                        </a>
                    </li>
                    <li class="nav-item sub">
                        <a class="nav-link sub <?php print ($_SERVER['REQUEST_URI']=="/setting/")?"curr":"";?>" href="<?php print _ROOT_URL_;?>setting/">
                            <i class="fa fa-h-square"></i>
                            <span>设置</span>
                        </a>
                    </li>
                </ul>
            </li>
<!--            <li class="nav-item">-->
<!--                <a class="nav-link --><?php //print ($_SERVER['REQUEST_URI']=="//")?"curr":"";?><!--" href="--><?php //print _ROOT_URL_;?><!--backup/">-->
<!--                    <i class="fas fa-user-secret"></i>-->
<!--                    <span>设置</span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link --><?php //print ($_SERVER['REQUEST_URI']=="//")?"curr":"";?><!--" href="--><?php //print _ROOT_URL_;?><!--member/">-->
<!--                    <i class="fas fa-user-tie"></i>-->
<!--                    <span>用户管理</span>-->
<!--                </a>-->
<!--            </li>-->
        </ul>
    </div>
