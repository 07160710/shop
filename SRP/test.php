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


$url = "https://www.baidu.com/";
$source = display_sourcecode($url);
echo $source;


exit;
