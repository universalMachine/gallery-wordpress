<?php
/**
 * Infinite Photography functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Acme Themes
 * @subpackage Infinite Photography
 */

/**
 * require int.
 */
require_once trailingslashit( get_template_directory() ).'acmethemes/init.php';

function has_post_content(){
	$content = get_post_field('post_content');
	return  '' !== $content;
}

function the_post_content_thumbnail( $size = 'post-thumbnail', $attr = '' ) {
	echo wp_get_content_image( null, $size, $attr );

}
function wp_get_content_image($attachment_id, $size = 'thumbnail', $icon = false, $attr = '') {
	$html="";
	$src_file = get_post_field('post_content');
	 @list( $width, $height ) = getimagesize( $src_file );
	 $image=array($src_file,$width,$height);
	if ( $image ) {
		list($src, $width, $height) = $image;
		$hwstring = image_hwstring($width, $height);
		$size_class = $size;
		if ( is_array( $size_class ) ) {
			$size_class = join( 'x', $size_class );
		}
		$attachment = get_post($attachment_id);
		$default_attr = array(
			'src'	=> $src,
			'class'	=> "attachment-$size_class size-$size_class",
			'alt'	=> trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) ),
		);

		$attr = wp_parse_args( $attr, $default_attr );

		// Generate 'srcset' and 'sizes' if not already present.
		if ( empty( $attr['srcset'] ) ) {
			$image_meta = wp_get_attachment_metadata( $attachment_id );

			if ( is_array( $image_meta ) ) {
				$size_array = array( absint( $width ), absint( $height ) );
				$srcset = wp_calculate_image_srcset( $size_array, $src, $image_meta, $attachment_id );
				$sizes = wp_calculate_image_sizes( $size_array, $src, $image_meta, $attachment_id );

				if ( $srcset && ( $sizes || ! empty( $attr['sizes'] ) ) ) {
					$attr['srcset'] = $srcset;

					if ( empty( $attr['sizes'] ) ) {
						$attr['sizes'] = $sizes;
					}
				}
			}
		}

		/**
		 * Filters the list of attachment image attributes.
		 *
		 * @since 2.8.0
		 *
		 * @param array        $attr       Attributes for the image markup.
		 * @param WP_Post      $attachment Image attachment post.
		 * @param string|array $size       Requested size. Image size or array of width and height values
		 *                                 (in that order). Default 'thumbnail'.
		 */
		$attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment, $size );
		$attr = array_map( 'esc_attr', $attr );
		$html = rtrim("<img $hwstring");
		foreach ( $attr as $name => $value ) {
			$html .= " $name=" . '"' . $value . '"';
		}
		$html .= ' />';
	}

	return $html;
}