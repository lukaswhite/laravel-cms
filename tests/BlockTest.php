<?php

use Lukaswhite\LaravelCms\Model\Block;

//require_once(__DIR__ . '/../../../../app/models/User.php');

class BlockTest extends TestCase {

	/**
	 * Test page creation.
	 *
	 * @return void
	 */
	public function testCreate()
	{
		$block = new Block();

		$block = new Block();
		$block->title = 'Test Block';
		$block->machine_name = 'test_block';
		$block->body = "##Test Block\nThis is a pragraph";

		/**
		$page->user = \User::find(1);

		$this->assertEquals(1, $page->user_id);

		$this->assertInstanceOf('User', $page->user);
		**/

		
		$block->user_id = 1;
		$block->status = Block::PUBLISHED;

		$block->save();

		$this->assertTrue(true);

		/**
		$this->assertFalse($review->save());
		$this->assertTrue(count($review->errors()->toArray()) > 0);
		$this->assertTrue($review->errors()->has('body'));
		$this->assertTrue($review->errors()->has('user_id'));
		$this->assertTrue($review->errors()->has('property_id'));

		$review->body = '<p>Test content</p>';
		$this->assertFalse($review->save());		
		$this->assertFalse($review->errors()->has('body'));
		$this->assertTrue($review->errors()->has('user_id'));
		$this->assertTrue($review->errors()->has('property_id'));

		$review->user_id = 1;
		$this->assertFalse($review->save());				
		$this->assertFalse($review->errors()->has('user_id'));
		$this->assertTrue($review->errors()->has('property_id'));

		$review->property_id = 1;
		$this->assertTrue($review->save());
		**/

	}

	function testDisplay() {

		$block = new Block();
		$block->title = 'Display Test Block';
		$block->machine_name = 'display_test_block';
		$block->body = '###Display Test Block';
		$block->user_id = 1;
		$block->status = 1;
		$block->save();

		//$response = Cms::block('display_test_block');

		//$this->assertNotEquals(0, strlen($response));

	}

}