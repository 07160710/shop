<?php
session_start();

define('SITE_NAME','商铺管理后台');
define('SESSION_TIMEOUT',60*60);
define('SALT','ZK-GD');
define('_ROOT_URL_','../');

$modulus = "D4A0B2A648B389840674F13287828682DED12BE9344858A71EE6EEFAB41CF3680D20B57930AB45B8AF4CDA9A80C11F7668FB09CAC911D173E2AAE92C33B301B256DEC52923877093AB124F252F280A3B0224DEC4C0BA7EAB0E3F3342F39714C096E92DAB2897D84F9762E65AAA598869078EFDFA7CA8817D788B05A072A572CB";

$imagecreatefrom = array(
    'image/gif'	=> 'imagecreatefromgif',
    'image/jpeg'=> 'imagecreatefromjpeg',
    'image/png'	=> 'imagecreatefrompng',
    'image/bmp'	=> 'imagecreatefromwbmp'
);
$imageto = array(
    'image/gif'	=> 'imagegif',
    'image/jpeg'=> 'imagejpeg',
    'image/png'	=> 'imagepng',
    'image/bmp'	=> 'imagewbmp'
);

define('MAX_UPLOAD_SIZE',20*1024*1024);//max file size 10M
define('FULL_MAX_WIDTH',980);
define('THUMB_MAX_WIDTH',320);
define('THUMB_MAX_HEIGHT',120);
define('IMAGE_QUALITY',100);
define('THUMB_QUALITY',100);

//所属行业大概分成
$GLOBALS['category_trade'] = array(
    1 => '计算机软件/硬件',
    2 => '计算机系统/维修',
    3 => '通信(设备/运营/服务)',
    4 => '互联网/电子商务',
    6 => '电子/半导体/集成电路',
    7 => '仪器仪表/工业自动化',
    8 => '会计/审计',
    9 => '金融(投资/证券',
    10 => '金融(银行/保险)',
    11 => '贸易/进出口',
    12 => '批发/零售',
    13 => '消费品(食/饮/烟酒)',
    14 => '服装/纺织/皮革',
    15 => '家具/家电/工艺品/玩具',
    16 => '办公用品及设备',
    17 => '机械/设备/重工',
    18 => '汽车/摩托车/零配件',
    19 => '制药/生物工程',
    20 => '医疗/美容/保健/卫生',
    21 => '医疗设备/器械',
    22 => '广告/市场推广',
    23 => '会展/博览',
    24 => '影视/媒体/艺术/出版',
    25 => '印刷/包装/造纸',
    26 => '房地产开发',
    27 => '建筑与工程',
    28 => '家居/室内设计/装潢',
    29 => '物业管理/商业中心',
    30 => '中介服务/家政服务',
    31 => '专业服务/财会/法律',
    32 => '检测/认证',
    33 => '教育/培训',
    34 => '学术/科研',
    35 => '餐饮/娱乐/休闲',
    36 => '酒店/旅游',
    37 => '交通/运输/物流',
    38 => '航天/航空',
    39 => '能源(石油/化工/矿产)',
    40 => '能源(采掘/冶炼/原材料)',
    41 => '电力/水利/新能源',
    42 => '政府部门/事业单位',
    43 => '非盈利机构/行业协会',
    44 => '农业/渔业/林业/牧业',
    45 => '其他行业'
);