<?php

namespace Plugwork;

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


	/**
	 * @param string $optionName Option name.
	 * @param bool $defaultValue
	 * @param string $section Section name the option belongs to
	 *
	 * @return mixed
	 */
	public function get(string $optionName, bool $defaultValue = false, string $section = 'settings'): mixed {
		$options = $this->getAll();

		if (empty( $optionName) || empty( $section )) return $defaultValue;

		return $options[$section][$optionName] ?? $defaultValue;
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
