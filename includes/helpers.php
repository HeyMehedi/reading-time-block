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
		
		$words_per_min    = is_numeric( $words_per_min ) ? $words_per_min : 200;
		$stripped_content = strip_tags( $content );
		$total_word       = self::mb_str_word_count( $stripped_content );
		$reading_minute   = floor( $total_word / $words_per_min );
		$reading_seconds  = floor( $total_word % $words_per_min / ( $words_per_min / 60 ) );

		if ( ! $reading_minute ) {
			$reading_time = $reading_seconds;
			$unit_name    = __( 'secs', 'reading-time-block' );
		} else {
			$reading_time = $reading_minute;
			$unit_name    = __( 'mins', 'reading-time-block' );
		}

		$reading_time_html = sprintf(
			'<%s> %s %s %s %s </%s>',
			esc_html( $wrapper_tag ),
			esc_html( $before_text ),
			esc_html( $reading_time ),
			esc_html( $unit_name ),
			esc_html( $after_text ),
			esc_html( $wrapper_tag )
		);

		return $reading_time_html;
	}

	public static function mb_str_word_count( $string, $format = 0, $charlist = '[]' ) {
		$string = trim( $string );
		if ( empty( $string ) ) {
			$words = array();
		} else {
			$words = preg_split( '~[^\p{L}\p{N}\']+~u', $string );
		}

		switch ( $format ) {
			case 0:
				return count( $words );
				break;
			case 1:
			case 2:
				return $words;
				break;
			default:
				return $words;
				break;
		}
	}
}
