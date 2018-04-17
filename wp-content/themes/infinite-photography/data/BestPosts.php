<?php
/**
 * Created by PhpStorm.
 * User: extend
 * Date: 18-4-15
 * Time: 上午10:12
 */

class BestPosts {
	private $postCount;
	private $currentPost = 0;
	private $posts = array();
	private static $oneBestPosts;
	private $pageNum;
	//private $postIds = array(352,338,);

	private $postIds = array();

	/**
	 * BestPosts constructor.
	 *
	 * @param $posts
	 */
	public function __construct() {
		global $wp_query;
		//$this->posts = array(WP_Post::get_instance( 352 )338);
		if($this->isDev()){
			$this->postIds= array(387,348,340);
		}else{
			$this->postIds= array(338,350,357);
		}
		$this->initPosts();
		$this->postCount=sizeof($this->postIds);
		$this->query = $wp_query->query;

	}

	function init(){

	}

	function isDev(){
		return preg_match("/^localhost:/i",$_SERVER["HTTP_HOST"]);
	}

	function initPosts(){
		if(is_array($this->postIds)){
			foreach ($this->postIds as $postId){
				array_push($this->posts,WP_Post::get_instance($postId));
			}
		}
	}

	function isHome(){
		return empty($this->query);
	}
	static function getInstance(){
		if(self::$oneBestPosts){
			return self::$oneBestPosts;
		}else{
			return self::$oneBestPosts = new BestPosts();
		}
	}


	function have_posts() {
		if($this->isHome()){
			if ( $this->postCount > $this->currentPost ) {
				return true;
			}else
				return false;
		}
		else
			return have_posts();

	}

	function the_post() {

		if($this->isHome()){
			global $post;

			$post = $this->posts[$this->currentPost];
			$this->currentPost ++;
			return $post;
		}
		else
			return  the_post();


	}

}