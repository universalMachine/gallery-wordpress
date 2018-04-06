<?php
/**
 * Created by PhpStorm.
 * User: extend
 * Date: 18-4-6
 * Time: 上午10:47
 */

use PHPUnit\Framework\TestCase;
require_once "../../../wp-config.php";
require_once "../../../wp-settings.php";
require_once "functions.php";
class ResolveObjTest extends TestCase {

	function testIsComposition(){
		$this->assertEquals(false,ResolveObj::isComposition("do"));
		$this->assertEquals(true,ResolveObj::isComposition("composition:"));
	}

	function testGetKey(){
		$this->assertEquals("wo",ResolveObj::getKey("wo:fdfd;xy:fdf"));
		$this->assertEquals("thumb",ResolveObj::getKey("thumb:fdfd"));
		$this->assertEquals("full",ResolveObj::getKey("full:fdfd"));
		$this->expectException(Exception::class);
		$this->assertEquals("",ResolveObj::getKey("34"));
	}

	function testGetValue(){
		$this->assertEquals("wang",ResolveObj::getValue("wo:wang"));
		$this->assertEquals("wang",ResolveObj::getValue("wo:wang;mei:ww"));
		$this->expectException(Exception::class);
		$this->assertEquals("",ResolveObj::getKey("34"));
	}

	function  testRmLen(){
		$this->assertEquals("mei:ww",ResolveObj::removeLen("wo:wang;mei:ww",8));
		$this->assertNotEquals("wo:ww",ResolveObj::removeLen("wo:wang;mei:ww",8));
		$this->assertEquals("",ResolveObj::removeLen("wo:wang;mei:ww",14));
		$this->assertEquals("",ResolveObj::removeLen("wo:wang;mei:ww",108));
	}

	function testDecode_obj(){
		$this->assertEquals(array("wo"=>"wang","mei"=>"ww"),ResolveObj::decode_object("wo:wang;mei:ww"));
		$this->assertEquals(array("wo"=>"wang","mei"=>"ww","ha"=>""),ResolveObj::decode_object("wo:wang;mei:ww;ha:"));
		$this->assertEquals(array("wo"=>"wang","mei"=>"ww","ha"=>"","la"=>"meizi"),ResolveObj::decode_object("wo:wang;mei:ww;ha:;la:meizi"));
		$this->assertEquals(array(),ResolveObj::decode_object(""));
	}

	 function test_decode_composition_invalidArgument(){
		$this->expectException(InvalidArgumentException::class);
		$this->assertEquals(array("wo"=>"wang","mei"=>"ww"),ResolveObj::decode_composition("wo:wang;mei:ww"));
	}

	function test_decode_compostion(){
		$this->assertEquals(array("wo"=>"wang","mei"=>"ww"),ResolveObj::decode_composition("composition:wo:wang;mei:ww"));
		$this->assertEquals(array("wo"=>"wang","mei"=>"ww","ha"=>""),ResolveObj::decode_composition("composition:wo:wang;mei:ww;ha:"));
		$this->assertEquals(array("wo"=>"wang","mei"=>"ww","ha"=>"","la"=>"meizi"),ResolveObj::decode_composition("composition:wo:wang;mei:ww;ha:;la:meizi"));
		$this->assertEquals(array(),ResolveObj::decode_object(""));
	}

	function test_resolve_key(){
		$this->assertEquals("wang",ResolveObj::resolve_key("wo:wang;mei:ww","wo"));
		$this->assertEquals("",ResolveObj::resolve_key("wo:wang;mei:ww;ha:","ha"));
		$this->assertEquals("wo:wang",ResolveObj::resolve_key("composition:wo:wang;mei:ww;ha:;la:meizi","composition"));


		$this->expectException(InvalidArgumentException::class);
		$this->assertEquals("wo:wang;mei:ww;ha:;la:meizi",ResolveObj::resolve_key("",""));

	}

	function test_resolve_composition(){
		$this->assertEquals("wang",ResolveObj::resolve_composition_key("composition:wo:wang;mei:ww","wo"));
		$this->assertEquals("",ResolveObj::resolve_composition_key("composition:wo:wang;mei:ww;ha:","ha"));
		$this->assertEquals("meizi",ResolveObj::resolve_composition_key("composition:wo:wang;mei:ww;ha:;la:meizi","la"));
		$this->assertEquals("",ResolveObj::resolve_composition_key("",""));
	}

	function test_resolve_thumb(){
		$this->assertEquals("wang",ResolveObj::resolve_thumb("composition:thumb:wang;mei:ww"));
		$this->assertEquals("",ResolveObj::resolve_thumb("composition:wo:wang;mei:ww;thumb:"));
		$this->assertEquals("meizi",ResolveObj::resolve_thumb("composition:wo:wang;mei:ww;ha:;thumb:meizi"));
		$this->assertEquals("",ResolveObj::resolve_thumb(""));
	}

	function test_resolve_full(){
		$this->assertEquals("wang",ResolveObj::resolve_full("composition:full:wang;mei:ww"));
		$this->assertEquals("",ResolveObj::resolve_full("composition:wo:wang;mei:ww;full:"));
		$this->assertEquals("meizi",ResolveObj::resolve_full("composition:wo:wang;mei:ww;ha:;full:meizi"));
		$this->assertEquals("",ResolveObj::resolve_full(""));
		$this->assertEquals("content",ResolveObj::resolve_full("content"));
	}

}

