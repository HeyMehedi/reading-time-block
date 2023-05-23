<?php
$post_id = get_the_ID();
if ( ! $post_id ) {
	return;
}

$content = get_the_content();

echo RTB_Helper::get_reading_time( $content, $attributes );