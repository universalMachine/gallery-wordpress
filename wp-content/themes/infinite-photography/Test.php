<?php
/**
 * Created by PhpStorm.
 * User: extend
 * Date: 18-4-5
 * Time: 上午11:52
 */

use PHPUnit\Framework\TestCase;
require_once "../../../wp-config.php";
require_once "../../../wp-settings.php";
require_once "functions.php";
class Test extends TestCase {
	function testP(){
		$this->assertEquals(false,isComposition("do"));
		$this->assertEquals(true,isComposition("composition:"));

	}
}
