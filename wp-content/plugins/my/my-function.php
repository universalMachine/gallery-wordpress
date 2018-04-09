
<?php
function my_resolve_content_full($post){
	$content = $post->post_content;

	return '<img src="'.ResolveObj::resolve_full($content).'" alt="beauty asian girl hot asian girl cute aisan girl"/>';
}

function wrap_img($src){
	return "<img src=\"$src\" alt='beauty asian girl hot asian girl cute aisan girl'/>";
}
?>
