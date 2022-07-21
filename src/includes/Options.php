<?php

namespace Plugwork\includes;

defined( 'ABSPATH' ) || exit;

class Options {

	private string $prefix;

	private array $defaults;

	/**
	 * @param string $prefix
	 * @param array $defaults
	 */
	public function __construct(string $prefix, array $defaults = [])	{
		$this->prefix = $prefix;
		$this->defaults = $defaults;
	}

	public function get($key, $section = 'settings'): mixed
	{
		return true;
	}

	public function add()
	{

	}

	public function update($option_key, $option_value, $section='settings')
	{
//		update_option($option_key, $option_value);
	}

	public function delete()
	{

	}

	public function getAll()
	{

	}

	public function reset()
	{

	}
}
