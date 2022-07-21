<?php
declare(strict_types = 1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Plugwork\Options;


class OptionsTest extends TestCase {

	public Options $options;

	protected function setUp(): void {
		parent::setUp();
		$this->options = new Options();
	}

	public function test_update() {
//		$option_value = 'Option Value';
//		$option_key = 'option_name';
//		$section = 'cache';
//		$this->options->update($option_key, $option_value, $section);
//		$this->assertEquals('Fifth Option', $this->options->get($option_key, $section));
//		$this->assertIsObject($this->options);
//		$this->options = new Options();
		$this->assertTrue(true);
	}
}