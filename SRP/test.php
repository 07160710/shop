<?php
$arr = array(
    "cmd"=>"OK",
    "token"=>"TOKEN"
);

//echo json_encode($arr);

/**
 * @param $input
 * @return string
 * 防止SQL注入
 */
function clean($input)
{
    if (is_array($input))
    {
        foreach ($input as $key => $val)
        {
            $output[$key] = clean($val);
            // $output[$key] = $this->clean($val);
        }
    }
    else
    {
        $output = (string) $input;
        // if magic quotes is on then use strip slashes
        if (get_magic_quotes_gpc())
        {
            $output = stripslashes($output);
        }
        // $output = strip_tags($output);
        $output = htmlentities($output, ENT_QUOTES, 'UTF-8');
    }
// return the clean text
    return $output;
}

$test = "<script>alert(1)</script>";
$text = clean($text);
echo $text.",";

/**
 * @param $url
 * @return string
 * 获取页面源代码
 */
function display_sourcecode($url)
{
    $lines = file($url);
    $output = "";
    foreach ($lines as $line_num => $line) {
        // loop thru each line and prepend line numbers
        $output.= "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "\n";
    }
    return $output;
}


//$url = "https://www.baidu.com/";
//$source = display_sourcecode($url);
//echo $source;

/**
 * @return mixed
 * 获取用户真实的IP
 */
function getRealIpAddr()
{
    if (!emptyempty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!emptyempty($_SERVER['HTTP_X_FORWARDED_FOR']))
        //to check ip is pass from proxy
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//$ip = getRealIpAddr();
//echo $ip;

/**
 * @param $text
 * @return string
 * 转换URL:从字符串变成超链接
 */
function makeClickableLinks($text)
{
    $text = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_+.~#?&//=]+)',
        '<a href="\1">\1</a>', $text);
    $text = eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_+.~#?&//=]+)',
        '\1<a href="http://\2">\2</a>', $text);
    $text = eregi_replace('([_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3})',
        '<a href="mailto:\1">\1</a>', $text);

    return $text;
}

$text = "This is my first post on http://blog.koonk.com";
$text = makeClickableLinks($text);
echo $text;

/*
if ( !file_exists('blocked_ips.txt') ) {
    $deny_ips = array(
        '127.0.0.1',
        '192.168.1.1',
        '83.76.27.9',
        '192.168.1.163'
    );
} else {
    $deny_ips = file('blocked_ips.txt');
}
// read user ip adress:
$ip = isset($_SERVER['REMOTE_ADDR']) ? trim($_SERVER['REMOTE_ADDR']) : '';

// search current IP in $deny_ips array
if ( (array_search($ip, $deny_ips))!== FALSE ) {
    // address is blocked:
    echo 'Your IP adress ('.$ip.') was blocked!';
    exit;
}
*/



exit;

