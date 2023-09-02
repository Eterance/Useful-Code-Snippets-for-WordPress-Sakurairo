<?php

function get_pure_pinyin($sentence, $type='none') {
	// 直接转拼音会吃掉空格
	// 要先按照空格切开，转完再组合回去	
	$sentence_array = explode(' ', $sentence);
	$result_array = array();
	foreach ($sentence_array as $element){
		$pinyin = Overtrue\Pinyin\Pinyin::sentence($element, $type); // https://stackoverflow.com/a/54617556
		array_push($result_array, $pinyin);// 添加到末尾
	}
	return implode(' ', $result_array);
}

function compare_eng($a, $b) {
   return strcmp($a->name, $b->name);
}

function compare_eng_reverse($a, $b) {
   return strcmp($b->name, $a->name);
}

function compare_chs($a, $b) {	
	$a_converted = get_pure_pinyin($a->name, 'number');
	$b_converted = get_pure_pinyin($b->name, 'number');
   return strcmp($a_converted, $b_converted);
}

function compare_chs_reverse($a, $b) {	
	$a_converted = get_pure_pinyin($a->name, 'number');
	$b_converted = get_pure_pinyin($b->name, 'number');
   return strcmp($b_converted, $a_converted);
}

function compare_count($a, $b) {	
	if ($a->count > $b->count){
		return 1;
	} elseif ($a->count < $b->count){
		return -1;
	} else{
		return 0;
	}
}

function compare_count_reverse($a, $b) {	
	return 0 - compare_count($a, $b);
}

function sort_by_name($tag_array, $order){
	$eng_tags = array();
	$chs_tags = array();
	foreach ($tag_array as $tag){
		$first_letter = substr($tag->name, 0, 1);
		if (ctype_alpha($first_letter)) {
			$eng_tags[] = $tag;
		} else {
			$chs_tags[] = $tag;
		}
	}
	if ($order == 'ASC'){
		usort($eng_tags, 'compare_eng');
		usort($chs_tags, 'compare_chs');
	} else {
		usort($eng_tags, 'compare_eng_reverse');
		usort($chs_tags, 'compare_chs_reverse');
	}
	
	return array_merge($eng_tags, $chs_tags);
}

function sort_by_count($tag_array, $order){
	if ($order == 'ASC'){
		usort($tag_array, 'compare_count');
	} else {
		usort($tag_array, 'compare_count_reverse');
	}
	return $tag_array;
}

function tag_categorize($atts) {
	// https://blog.csdn.net/weixin_34413065/article/details/91518968
	extract ( shortcode_atts ( array (
		'orderby' => 'name', // name, count
		'order' => 'ASC', // asc/ASC, desc/DESC
		'show_count' => true, //ture, false
   ) , $atts ) ) ; // 提取短代码参数
	$order = strtoupper($order);
	// echo 会导致使用短代码时文章不能更新
	// https://wordpress.org/support/topic/updating-failed-the-response-is-not-a-valid-json-response-7/
	//echo $orderby;
	// 参数含义
	// https://developer.wordpress.org/reference/functions/get_terms/
	$tags = get_tags(array(
	  'taxonomy' => 'post_tag',
	  'orderby' => 'name',
		'order' => 'ASC',
	  'hide_empty' => true // for development
	));
	// 先对所有 tag 的首字母归类
	$alphabet = array();
	$offset = 63;
	// 第一个是其他字符；第二个是数字；其他的是字母
	for ($i = 0; $i < 28; $i++) {
		$alphabet[$i] = array();
	}
	
	
	foreach ( $tags as $tag ) {
		if(true){			
			$tag_name_purified = get_pure_pinyin($tag->name);
			$first_char = strtoupper(substr($tag_name_purified, 0, 1));
			
			// 判断属于哪里
			if (is_numeric($first_char)) {
				$alphabet[1][] = $tag; // 追加数字
			} elseif (ord($first_char) >= 65 && ord($first_char) <= 90) {
				$index = ord($first_char) - $offset; // 确定字母的索引位置
				$alphabet[$index][] = $tag; // 放置字母
			} else {
				$alphabet[0][] = $tag; // 放置其他字符
			}
			
			//$tag_link = esc_url(get_tag_link( $tag->term_id ));
			//$html .= "<li><a href='{$tag_link}' title='{$tag_name}' class='{$tag->slug}'>";
			//$html .= "{$tag_name}({$tag->count})";
			//$html .= "</a></li>";
		}
	}
	
	$html = '';
	for ($i=0; $i<28; $i++){
		if (count($alphabet[$i]) == 0){
			continue;			
		}
		if ($i == 0){
			$html .= "<h2>符号</h2>";
			if ($order == 'ASC'){
				usort($alphabet[$i], 'compare_chs');
			} else {
				usort($alphabet[$i], 'compare_chs_reverse');
			}
		} elseif ($i == 1){
			$html .= "<h2>0-9</h2>";
			if ($order == 'ASC'){
				usort($alphabet[$i], 'compare_chs');
			} else {
				usort($alphabet[$i], 'compare_chs_reverse');
			}
		} else {
			$html .= "<h2>";
			$html .= chr($i+$offset);
			$html .= "</h2>";
			if ($orderby == 'count'){
				$alphabet[$i] = sort_by_count($alphabet[$i], $order);
			} else{
				$alphabet[$i] = sort_by_name($alphabet[$i], $order);
			}
		}
		$html .= '<ul>';
		foreach ($alphabet[$i] as $tag){
			$tag_link = esc_url(get_tag_link( $tag->term_id ));
			$html .= "<li><a href='{$tag_link}' title='{$tag->name}' class='{$tag->slug}'>";
			$html .= "{$tag->name}";
			if ($show_count){
				$html .= " ({$tag->count})";
			}
			$html .= "</a></li>";
		}
		$html .= '</ul>';		
	}
	return $html; 

} 
// Add a shortcode so that we can use it in widgets, posts, and pages
add_shortcode('tagdir', 'tag_categorize'); 
add_shortcode('标签目录', 'tag_categorize');

?>