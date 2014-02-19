<?php

use Lukaswhite\LaravelCms\Model\Page;

//require_once(__DIR__ . '/../../../../app/models/User.php');

class PageTest extends TestCase {

	/**
	 * Test page creation.
	 *
	 * @return void
	 */
	public function testCreate()
	{
		$page = new Page();


		$page = new Page();
		$page->title = 'Test Page';

		$page->body = "##Test Page\nThis is a pragraph";

		/**
		$page->user = \User::find(1);

		$this->assertEquals(1, $page->user_id);

		$this->assertInstanceOf('User', $page->user);
		**/

		$page->user_id = 1;
		$page->status = Page::PUBLISHED;

		$page->save();

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

}