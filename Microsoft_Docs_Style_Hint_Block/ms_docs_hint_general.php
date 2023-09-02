<?php

/* */
function generateRandomString($length) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    $charactersLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

function ms_like_hint_general($icon, $title, $lightcolor, $darkcolor, $radius, $content){
	// 随机对css命名，防止重名
	$wrapper_style_name = strtolower("ms-docs-wrapper-".generateRandomString(10));
	
	$html = 
	<<<'flink'
	<style>
	.$wrapper_style_name {
		background: $lightcolorb3;
		text-indent: 0 !important;
		margin: 20px 8px !important;
		padding: 0px 20px 0px 30px !important;
		position: relative !important;
		color: #505050;
		box-shadow: 0 1px 30px -4px #e8e8e8;
		border-radius: $radiuspx !important;
		text-indent: 0 !important;
		-webkit-transition: all .8s;
		transition: all .8s;
		border: 1.5px solid #FFFFFF;
	}
	
	body.dark .$wrapper_style_name {
		background: $darkcolor99;
		text-indent: 0 !important;
		color: #FFFFFF;
		box-shadow: 0 1px 20px 2px rgba(26, 26, 26, 0.8);
		-webkit-transition: all .8s;
		transition: all .8s;
		border: 1.5px solid #7d7d7d30;
	}
	
	.$wrapper_style_name:hover {
		background: $lightcolor;
		box-shadow: 0 1px 20px 10px #e8e8e8;
		-webkit-transition: all .8s;
		transition: all .8s;
	}
	
	body.dark .$wrapper_style_name:hover {
		background: $darkcolor;
		box-shadow: 0 1px 30px -2px var(--theme-skin-dark) !important;
		-webkit-transition: all .8s;
		transition: all .8s;
	}
	
	.$wrapper_style_name p {
		text-indent: 0 !important;
		margin-top: 1em;
		margin-bottom: 1em;
	}
	
	body.dark .$wrapper_style_name p {
		color: #bbbbbb !important;
		text-indent: 0 !important;
		margin-top: 1em;
		margin-bottom: 1em;
	}
	
	.$wrapper_style_name p.ms-docs-title {
		color: $darkcolor !important;
		font-weight: bold;
	}
	
	body.dark .$wrapper_style_name p.ms-docs-title {
		color: $lightcolor !important;
		font-weight: bold;
	}
	
	.$wrapper_style_name i {
		color: $darkcolor !important;
		text-indent: 0 !important;
		padding-left: 4px !important;
		padding-right: 16px !important;
		font-size: medium;
	}
	
	body.dark .$wrapper_style_name i {
		color: $lightcolor !important;
		text-indent: 0 !important;
	}
	
	.$wrapper_style_name a {
		padding: 5px !important;
	}
	</style>

	<div class="$wrapper_style_name">
		<p class="ms-docs-title">
			<i class="$icon"></i>
			$title
		</p>
		<p>$content</p>
	</div>
	flink;
	
	$html = str_replace('$wrapper_style_name', $wrapper_style_name, $html);
	$html = str_replace('$icon', $icon, $html);
	$html = str_replace('$title', $title, $html);
	$html = str_replace('$lightcolor', $lightcolor, $html);
	$html = str_replace('$darkcolor', $darkcolor, $html);
	$html = str_replace('$radius', $radius, $html);
	$html = str_replace('$content', $content, $html);	
	return $html;
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
	return ms_like_hint_general($icon, $title, $lightcolor, $darkcolor, $radius, $content);
}

add_shortcode('ms-hint', 'custom_ms_hint_shortcode');
add_shortcode('mshint', 'custom_ms_hint_shortcode');

?>