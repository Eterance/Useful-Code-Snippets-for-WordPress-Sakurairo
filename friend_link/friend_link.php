<?php

function friendly_link_shortcode($attr)
{
	extract ( shortcode_atts ( array (###
		'link' => "",
		"img" => "",
		"name" => "",
		"desc" => "",
		"date" => "",
		"star" => "",
   ) , $attr ) ) ; // 提取短代码参数
	$html = <<<'flink'
	<div>
		<a class="friendly-link-frame-size no-underline friendly-link-frame-style desktop" href="$link">
			<div class="avatar-wrapper">
				<img src="$img" class="friendly-link-avatar" />
			</div>
			<div class="text-wrapper">
				<div class="name-date-wrapper">
					<p class="friendly-link-name">$name</p>
					<p class="friendly-link-add-date">$date</p>
				</div>
				<div class="name-date-wrapper">
					<p class="friendly-link-description">$description</p>
					<p class="friendly-link-add-date">$star</p>
				</div>
			</div>
		</a>
		<a class="friendly-link-frame-size-mo no-underline friendly-link-frame-style mobile" href="$link">
			<div class="avatar-date-star-wrapper-mo">
				<img src="$img" class="friendly-link-avatar-mo" />
				<div class="date-star-wrapper-mo">
					<p class="friendly-link-add-date">$date</p>
					<p class="friendly-link-add-date">$star</p>
				</div>
			</div>
			<div class="name-description-wrapper-mo">
				<p class="friendly-link-name">$name</p>
				<p class="friendly-link-description">$description</p>
			</div>
		</a>
	</div>
	flink;
	$html = str_replace('$name', $name, $html);
	$html = str_replace('$link', $link, $html);
	$html = str_replace('$img', $img, $html);
	$html = str_replace('$description', $desc, $html);
	$html = str_replace('$date', $date, $html);
	$html = str_replace('$star', $star, $html);
	return $html;
}

add_shortcode('flink', 'friendly_link_shortcode');

?>