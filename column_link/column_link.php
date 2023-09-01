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
		<a class="column_link-frame-size no-underline column_link-frame-style desktop" href="$link">
			<div class="text-wrapper">
				<div class="name-date-wrapper">
					<p class="column_link-name">$name</p>
					<p class="column_link-add-date">$num 篇文章</p>
				</div>
				<div class="name-date-wrapper">
					<p class="column_link-description">$description</p>
				</div>
			</div>
		</a>
		<a class="column_link-frame-size-mo no-underline column_link-frame-style mobile" href="$link">
			<div class="avatar-date-star-wrapper-mo">
				<div class="date-star-wrapper-mo">
					<p class="column_link-add-date">$num 篇文章</p>
				</div>
			</div>
			<div class="name-description-wrapper-mo">
				<p class="column_link-name">$name</p>
				<p class="column_link-description">$description</p>
			</div>
		</a>
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