<?php


function ms_like_hint_preset($icon, $color, $title, $content){
	$html = 
	<<<'flink'
	<div class="ms-docs-wrapper $color">
		<p class="ms-docs-title">
			<i class="$icon"></i>
			$title
		</p>
		<p>$content</p>
	</div>
	flink;
	$html = str_replace('$icon', $icon, $html);
	$html = str_replace('$color', $color, $html);
	$html = str_replace('$title', $title, $html);
	$html = str_replace('$content', $content, $html);	
	return $html;
}

function ms_note_shortcode($attr, $content = '')
{
	extract ( shortcode_atts ( array (
		'title' => "备注",
   ) , $attr ) ) ; // 提取短代码参数
	return ms_like_hint_preset("fa-solid fa-circle-exclamation fa-sm", "ms-docs-wrapper-purple", $title, $content);
}
function ms_warning_shortcode($attr, $content = '')
{
	extract ( shortcode_atts ( array (
		'title' => "警告",
   ) , $attr ) ) ; // 提取短代码参数
	return ms_like_hint_preset("fa-solid fa-triangle-exclamation fa-sm fa-fade", "ms-docs-wrapper-yellow", $title, $content);
}
function ms_caution_shortcode($attr, $content = '')
{
	extract ( shortcode_atts ( array (
		'title' => "注意",
   ) , $attr ) ) ; // 提取短代码参数
	return ms_like_hint_preset("fa-solid fa-circle-xmark fa-sm fa-beat-fade", "ms-docs-wrapper-red", $title, $content);
}
function ms_important_shortcode($attr, $content = '')
{
	extract ( shortcode_atts ( array (
		'title' => "重要",
   ) , $attr ) ) ; // 提取短代码参数
	return ms_like_hint_preset("fa-solid fa-circle-info fa-sm", "ms-docs-wrapper-blue", $title, $content);
}
function ms_tip_shortcode($attr, $content = '')
{
	extract ( shortcode_atts ( array (
		'title' => "提示",
   ) , $attr ) ) ; // 提取短代码参数
	return ms_like_hint_preset("fa-solid fa-lightbulb  fa-sm", "ms-docs-wrapper-green", $title, $content);
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