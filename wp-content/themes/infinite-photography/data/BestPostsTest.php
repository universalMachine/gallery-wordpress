<?php
/**
 * Created by PhpStorm.
 * User: extend
 * Date: 18-4-15
 * Time: 下午2:22
 */

use PHPUnit\Framework\TestCase;
require_once "BestPosts.php";
require_once "../../../../wp-config.php";
require_once "../../../../wp-settings.php";
class BestPostsTest extends TestCase {

	private $BestPosts;

	public function setUp() {

		$this->BestPosts = new BestPosts();
	}



	public function testThe_post() {
		//$this->BestPosts = new BestPosts();
		$this->BestPosts->have_posts();
	}

	public function testHave_posts() {
		//$this->BestPosts = new BestPosts();
		$this->BestPosts->the_post();
	}

	public function testGetInstance() {
		BestPosts::getInstance()->the_post();

		BestPosts::getInstance();
		//$this->BestPosts->the_post();
	}

	public function testIsDev(){
		$this->assertEquals(true,$this->BestPosts->isDev());
	}
}
