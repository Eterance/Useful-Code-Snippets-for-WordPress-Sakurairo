<?php


function ms_like_hint_note($title, $content){
	$html = 
	<<<'flink'
	<div class="ms-docs-common-titlestyle ms-docs-common-framestyle">
		<p class="ms-docs-common">
			<i class="fa-solid fa-circle-exclamation fa-sm"></i>
			$title
		</p>
		<p>$content</p>
	</div>
	flink;
	$html = str_replace('$title', $title, $html);
	$html = str_replace('$content', $content, $html);	
	return $html;
}

function ms_note_shortcode2($attr, $content = '')
{
	extract ( shortcode_atts ( array (
		'title' => "备注",
   ) , $attr ) ) ; // 提取短代码参数
	return ms_like_hint_note($title, $content);
}


add_shortcode('msnote2', 'ms_note_shortcode2');

?>