<?php

/**
 * Helpers
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RTB_Helper {
	public static function get_reading_time( $content, $attrs ) {
		$defaults = array(
			'wrapper_tag'   => 'div',
			'words_per_min' => 200,
			'before_text'   => '',
			'after_text'    => __( 'read', 'reading-time-block' ),
		);

		$attrs = wp_parse_args( $attrs, $defaults );
		extract( $attrs );

		$stripped_content = strip_tags( $content );
		$total_word       = str_word_count( $stripped_content );
		$reading_minute   = floor( $total_word / $words_per_min );
		$reading_seconds  = floor( $total_word % $words_per_min / ( $words_per_min / 60 ) );

		if ( ! $reading_minute ) {
			$reading_time = $reading_seconds;
			$unit_name    = __( 'secs', 'reading-time-block' );
		} else {
			$reading_time = $reading_minute;
			$unit_name    = __( 'mins', 'reading-time-block' );
		}

		$reading_time_html = sprintf( '<%s> %s %s %s %s </%s>',
			$wrapper_tag,
			$before_text,
			$reading_time,
			$unit_name,
			$after_text,
			$wrapper_tag
		);

		return $reading_time_html;
	}
}
