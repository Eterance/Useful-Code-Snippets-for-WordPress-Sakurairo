<?php
function column_link_shortcode($attr)
{
	extract ( shortcode_atts ( array (###
		'id' => "",
		"name" => "",
   ) , $attr ) ) ; // 提取短代码参数
	$tag = get_tag($id);
	$html = <<<'flink'
	<div>
		<a class="column-link-frame-size no-underline column-link-frame-style desktop" href="$link">
			<div class="text-wrapper">
				<div class="column-link-text-wrapper">
					<p class="column-link-name">$name</p>
					<p class="column-link-number">$num 篇文章</p>
				</div>
				<div class="column-link-text-wrapper">
					<p class="column-link-description">$description</p>
				</div>
			</div>
		</a>
		<a class="column-link-frame-size-mo no-underline column-link-frame-style mobile" href="$link">
			<div class="text-wrapper-mo">
				<div class="column-link-text-wrapper-mo">
					<p class="column-link-name">$name</p>
				</div>
				<div class="column-link-text-wrapper-mo">
					<p class="column-link-description-mo">$description</p>
				</div>
				<div class="column-link-text-wrapper-mo">
					<p class="column-link-number-mo">$num 篇文章</p>
				</div>
			</div>
		</a>
		<div class="horizontal-line"></div>
	</div>
	flink;
	$tag_link = esc_url(get_tag_link( $tag->term_id ));
	$html = str_replace('$name', $tag->name, $html);
	$html = str_replace('$link', $tag_link, $html);
	$html = str_replace('$description', $tag->description, $html);
	$html = str_replace('$num', $tag->count, $html);
	return $html;
}

add_shortcode('column_link', 'column_link_shortcode');
?>