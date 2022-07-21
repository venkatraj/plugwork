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

	/**
	 * @param string $optionName Option name.
	 * @param mixed  $optionValue  Option value.
	 * @param string $section Section name where option belongs to
	 *
	 * @return bool
	 */
	public function update(string $optionName, mixed $optionValue, string $section = 'settings'): bool
	{
		$options = $this->getAll();

		$options[$section][$optionName] = $optionValue;

		if (is_multisite()) {
			return update_site_option($this->prefix, $options);
		} else {
			return update_option($this->prefix, $options);
		}
	}

	/**
	 * @param string $optionName Option name.
	 * @param string $section Section name where option belongs to
	 */
	public function delete(string $optionName, string $section = 'settings'): void
	{
		$options = $this->getAll();
		unset($options[$section][$optionName]);
	}

	public function getAll(): array
	{
		if (is_multisite()) {
			$options = get_site_option($this->prefix, array());
		} else {
			$options = get_option($this->prefix, array());
		}

		return wp_parse_args($options, $this->getDefaults());
	}

	/**
	 * @return bool
	 */
	public function reset(): bool
	{
		if (is_multisite()) {
			return delete_site_option($this->prefix);
		} else {
			return delete_option($this->prefix);
		}
	}

	private function getDefaults(): array
	{
		return $this->defaults;
	}
}
