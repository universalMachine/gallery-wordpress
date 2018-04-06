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

function wp_get_content_image_src( $attachment_id, $size = 'thumbnail', $icon = false ) {
	$content = get_post_field('post_content');
	// get a thumbnail or intermediate image if there is one
	$image = image_downsize( $attachment_id, $size );
	if ( ! $image ) {
		$src = false;

		if ( $icon && $src = wp_mime_type_icon( $attachment_id ) ) {
			/** This filter is documented in wp-includes/post.php */
			$icon_dir = apply_filters( 'icon_dir', ABSPATH . WPINC . '/images/media' );

			$src_file = $content;
			@list( $width, $height ) = getimagesize( $src_file );
		}

		if ( $src && $width && $height ) {
			$image = array( $content, $width, $height );
		}
	}
	/**
	 * Filters the image src result.
	 *
	 * @since 4.3.0
	 *
	 * @param array|false  $image         Either array with src, width & height, icon src, or false.
	 * @param int          $attachment_id Image attachment ID.
	 * @param string|array $size          Size of image. Image size or array of width and height values
	 *                                    (in that order). Default 'thumbnail'.
	 * @param bool         $icon          Whether the image should be treated as an icon. Default false.
	 */
	//return apply_filters( 'wp_get_attachment_image_src', $image, $attachment_id, $size, $icon );

	return array($content);
	//return $image;
}

function wp_get_content_thumb_src( $attachment_id, $size = 'thumbnail', $icon = false ) {
	$content = get_post_field('post_content');
	return array(ResolveObj::resolve_thumb($content));
}

function wp_get_content_full_src( $attachment_id, $size = 'thumbnail', $icon = false ) {
	$content = get_post_field('post_content');
	return array(ResolveObj::resolve_full($content));
}

function wp_get_content_image($attachment_id, $size = 'thumbnail', $icon = false, $attr = '') {
	$html="";
	$src_file = get_post_field('post_content');
	 @list( $width, $height ) = getimagesize( $src_file );
	 $image=array(ResolveObj::resolve_full($src_file),$width,$height);
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



class ResolveObj{
	static private $compositionStr = "composition:";
	static function resolve_full($content){
		return self::resolve_composition_key($content,"full");
	}

	static function resolve_thumb($content){
		return self::resolve_composition_key($content,"thumb");
	}
	static function resolve_composition_key($content,$key){
		if(self::isComposition($content)){
			return self::resolve_key(self::getCompositionBody($content),$key);
		}else{
			return $content;
		}
	}
	static function resolve_key($content,$key){

			$result = self::decode_object($content);
			if(array_key_exists($key,$result)){
				return $result[$key];
			}else{
				throw new InvalidArgumentException("must has $key key");
			}
	}

	static function decode_composition($obj){

		if(self::isComposition($obj)){
			return self::decode_object(self::getCompositionBody($obj));
		}else{
			throw new InvalidArgumentException("decode_composition argument must be compostion");
		}


	}

	static function isComposition($text){
		return stripos($text,ResolveObj::$compositionStr) === 0;
	}


	static function decode_object($obj){
		$result = array();
		try{
			while($obj!="") {
				$result[ ResolveObj::getKey( $obj ) ] = self::getValue( $obj );
				$delimit_pos              = strpos( $obj, ":" );
				$end                      = stripos( $obj, ";", $delimit_pos );
				if ( $end === false ) {
					$obj = "";
				} else {
					$obj = self::removeLen( $obj, $end + 1 );
				}
			}
		}catch (InvalidArgumentException $e){
			print($e);
		}finally{
			return $result;
		}



	}
	static function getCompositionBody($obj){
		return self::removeLen($obj,strlen(self::$compositionStr));
	}

	static function removeLen($item,$rmLen){
		if($rmLen>strlen($item))
			return "";
		else
			return substr($item,$rmLen);
	}

	static function getKey($item){
		if(($delimit_pos = strpos($item,":"))!==false){
			return substr($item,0,$delimit_pos);
		}else{
			throw  new InvalidArgumentException("format error");
		};
	}

	static function getValue($item){
		if(($delimit_pos = strpos($item,":"))!==false) {
			$end = stripos($item,";",$delimit_pos);
			if($end===false){
				return substr($item,$delimit_pos+1);
			}else{
				return substr($item,$delimit_pos+1,($end-1)-$delimit_pos);
			}
		}else {
			throw  new InvalidArgumentException("format error");
		}
	}
}





