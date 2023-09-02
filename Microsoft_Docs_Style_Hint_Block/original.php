<?php

function generateRandomString($length) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    $charactersLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

function ms_like_hint($icon, $title, $lightcolor, $darkcolor, $radius, $content){
	// 随机对css命名，防止重名
	$title_font_style_name = strtolower(generateRandomString(10)."-titleFont");
	$title_style_name = strtolower(generateRandomString(10)."-titlestyle");
	$frame_style_name = strtolower(generateRandomString(10)."-framestyle");
	$lightcolor_transparent = $lightcolor."b3"; // 十进制为 0.7
	$darkcolor_transparent = $darkcolor."99"; // 十进制为 0.6
	
	// 给标题栏打上id，并且标题栏的样式使用 id选择器
	// 如果用类选择器，优先度不够
	$title_p_id = strtolower(generateRandomString(10));
	
	$out = "<style>\n    ";
	$out .= ' #'.$title_p_id;
	$out .= " {\n font-weight: bold;\n color: ";
	$out .= $darkcolor;// 标题栏内容日间模式前景色
	$out .= " !important;\n}\n\nbody.dark ";
	$out .= ' #'.$title_p_id;
	$out .= " {\n font-weight: bold;\n color: ";
	$out .= $lightcolor;// 标题栏内容夜间模式前景色
	$out .= " !important;\n}\n    .";
	$out .= $title_style_name;
	$out .= "{\n        text-indent: 0 !important;\n    }\n    .";
	$out .= $title_style_name;
	$out .= " i {\n    color: ";
	$out .= $darkcolor;// 标题栏图标日间模式前景色
	$out .= " !important;\n    text-indent: 0 !important;\n    }\n    .";
	$out .= $title_style_name;
	$out .= " p {\n    text-indent: 0 !important;\n    margin-top: 1em;\n    margin-bottom: 1em;\n    }\n    body.dark .";
	$out .= $title_style_name;
	$out .= " {\n        text-indent: 0 !important;\n    }\n    body.dark .";
	$out .= $title_style_name;
	$out .= " p {\n    color: ";
	$out .= "#bbbbbb";// 文字夜间模式前景色
	$out .= " !important;\n    text-indent: 0 !important;\n    margin-top: 1em;\n    margin-bottom: 1em;\n    }\n    body.dark .";
	$out .= $title_style_name;
	$out .= " i {\n    color: ";
	$out .= $lightcolor;// 标题栏图标夜间模式前景色
	$out .= " !important;\n    text-indent: 0 !important;\n    }\n    .";
	$out .= $frame_style_name;
	// 下面的 padding 右边要比左边大，不知为什么一样大实际显示左边更大
	$out .= " {\n        margin: 20px 8px !important;\n        padding: 0px 20px 0px 30px !important;\n        position: relative !important;\n        color: #505050;\n        box-shadow: 0 1px 30px -4px #e8e8e8;\n        background: ";
	$out .= $lightcolor_transparent;// 日间模式背景色
	$out .= ";\n        border-radius: ";
	$out .= $radius;
	$out .= "px !important;\n        text-indent: 0 !important;\n        -webkit-transition: all .8s;\n        transition: all .8s;\n        border: 1.5px solid #FFFFFF;\n      }\n      \n    .";
	$out .= $frame_style_name;
	$out .= ":hover {\n    box-shadow: 0 1px 20px 10px #e8e8e8;\n    background: ";
	$out .= $lightcolor;// 日间模式hover背景色
	$out .= ";\n    -webkit-transition: all .8s;\n    transition: all .8s;\n    }    \n    .";
	$out .= $frame_style_name;
	$out .= " i {\n        padding-left: 4px !important;\n        padding-right: 16px !important;\n        font-size: medium;\n    }    \n    .";
	$out .= $frame_style_name;
	$out .= " a {\n    padding: 5px !important;\n    }\n    body.dark .";
	$out .= $frame_style_name;
	$out .= " {\n        color: #FFFFFF;\n        box-shadow: 0 1px 20px 2px rgba(26, 26, 26, 0.8);\n        background: ";
	$out .= $darkcolor_transparent;// 夜间模式背景色
	$out .= ";\n        -webkit-transition: all .8s;\n        transition: all .8s;\n        border: 1.5px solid #7d7d7d30;\n      }      \n    body.dark .";
	$out .= $frame_style_name;
	$out .= ":hover {\n    box-shadow: 0 1px 30px -2px var(--theme-skin-dark) !important;\n    background: ";
	$out .= $darkcolor;// 夜间模式hover背景色
	$out .= ";\n    -webkit-transition: all .8s;\n    transition: all .8s;\n    }\n</style>";
	
	
	$out .= '<div class="'.$title_style_name.' '.$frame_style_name.'">';
	// http://isres.com/jingyan2/65.html
	// 因为 Sakurairo 主题黑夜模式有 !important; 会覆盖文本颜色
	// 所以这里也要 !important; 强制不被覆盖
	$out .= '<p id="'.$title_p_id.'"><i class="'.$icon.'"></i>'.$title.'</p>';// 图标与标题
	$out .= '<p>' . $content . '</p></div>'; // 正文
	return $out;
}

function custom_ms_hint_shortcode($attr, $content = '')
{
	extract ( shortcode_atts ( array (
		'icon' => "fa-solid fa-circle-exclamation fa-sm fa-fade", // 图标
		'title' => "提示",
		'lightcolor' => '#EFD9FD',
		'darkcolor' => '#3B2E58',
		'radius' => 8,
   ) , $attr ) ) ; // 提取短代码参数
	return ms_like_hint($icon, $title, $lightcolor, $darkcolor, $radius, $content);
}

function ms_note_shortcode($attr, $content = '')
{
	extract ( shortcode_atts ( array (
		'title' => "备注",
   ) , $attr ) ) ; // 提取短代码参数
	return ms_like_hint("fa-solid fa-circle-exclamation fa-sm", $title, '#EFD9FD', '#3B2E58', 8, $content);
}

function ms_warning_shortcode($attr, $content = '')
{
	extract ( shortcode_atts ( array (
		'title' => "警告",
   ) , $attr ) ) ; // 提取短代码参数
	return ms_like_hint("fa-solid fa-triangle-exclamation  fa-sm fa-fade", $title, '#fff4ce', '#6a4b16', 8, $content);
}

function ms_caution_shortcode($attr, $content = '')
{
	extract ( shortcode_atts ( array (
		'title' => "注意",
   ) , $attr ) ) ; // 提取短代码参数
	return ms_like_hint("fa-solid fa-circle-xmark  fa-sm fa-beat-fade", $title, '#fde7e9', '#630001', 8, $content);
}

function ms_important_shortcode($attr, $content = '')
{
	extract ( shortcode_atts ( array (
		'title' => "重要",
   ) , $attr ) ) ; // 提取短代码参数
	return ms_like_hint("fa-solid fa-circle-info fa-sm", $title, '#d7eaf8', '#004173', 8, $content);
}

function ms_tip_shortcode($attr, $content = '')
{
	extract ( shortcode_atts ( array (###
		'title' => "提示",
   ) , $attr ) ) ; // 提取短代码参数
	return ms_like_hint("fa-solid fa-lightbulb  fa-sm", $title, '#dff6dd', '#054b16', 8, $content);
}

// all colors
// https://learn.microsoft.com/en-us/contribute/markdown-reference

add_shortcode('ms-hint', 'custom_ms_hint_shortcode');
add_shortcode('mshint', 'custom_ms_hint_shortcode');

add_shortcode('ms-note', 'ms_note_shortcode');
add_shortcode('msnote', 'ms_note_shortcode');
add_shortcode('mspurple', 'ms_note_shortcode');

add_shortcode('ms-warning', 'ms_warning_shortcode');
add_shortcode('mswarning', 'ms_warning_shortcode');
add_shortcode('msyellow', 'ms_warning_shortcode');

add_shortcode('ms-caution', 'ms_caution_shortcode');
add_shortcode('mscaution', 'ms_caution_shortcode');
add_shortcode('msred', 'ms_caution_shortcode');

add_shortcode('ms-tip', 'ms_tip_shortcode');
add_shortcode('mstip', 'ms_tip_shortcode');
add_shortcode('msgreen', 'ms_tip_shortcode');

add_shortcode('ms-important', 'ms_important_shortcode');
add_shortcode('msimportant', 'ms_important_shortcode');
add_shortcode('msblue', 'ms_important_shortcode');

?>