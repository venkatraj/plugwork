<?php

namespace Plugwork;

defined( 'ABSPATH' ) || exit;

final class Options {

	private string $prefix;

	private array $defaults;

	/**
	 * Constructor
	 *
	 * @param string $prefix  Name of the options collection
	 * @param array $defaults Default options
	 */
	public function __construct(string $prefix, array $defaults = [])	{
		$this->prefix = $prefix;
		$this->defaults = $defaults;
	}


	/**
	 * Retrieve value for given option name
	 *
	 * @param string $optionName Option name to retrieve.
	 * @param bool $defaultValue Default value to return, if option name is not found.
	 * @param string $section Section name the option belongs to
	 *
	 * @return mixed
	 */
	public function get(string $optionName, bool $defaultValue = false, string $section = 'settings'): mixed
	{
		$options = $this->getAll();

		if (empty( $optionName) || empty( $section )) return $defaultValue;

		return $options[$section][$optionName] ?? $defaultValue;
	}

	/**
	 * Add an option name and value to collection
	 *
	 * @param string $optionName Option name.
	 * @param mixed $optionValue Option value.
	 * @param string $section Section name the option belongs to
	 *
	 * @return bool
	 */
	public function add(string $optionName, mixed $optionValue, string $section = 'settings'): bool
	{
		$options = $this->getAll();
		$options[$section][$optionName] = $optionValue;

		if (is_multisite()) {
			return add_site_option($this->prefix, $options);
		} else {
			return add_option($this->prefix, $options);
		}
	}

	/**
	 * Update an option
	 *
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
	 * Delete given option name from the collection.
	 *
	 * @param string $optionName Option name.
	 * @param string $section Section name where option belongs to
	 */
	public function delete(string $optionName, string $section = 'settings'): void
	{
		$options = $this->getAll();
		unset($options[$section][$optionName]);
	}

	/**
	 * Retrieve options collection.
	 *
	 * @return array
	 */
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
	 * Delete option collection from options table.
	 *
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

	/**
	 * Get default values for options collection.
	 *
	 * @return array
	 */
	private function getDefaults(): array
	{
		return $this->defaults;
	}
}
