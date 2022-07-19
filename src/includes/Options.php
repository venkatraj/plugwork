<?php
defined( 'ABSPATH' ) || exit;

final class Options {

	private string $prefix;

	private array $defaults;

	/**
	 * @param string $prefix
	 * @param array $defaults
	 */
	public function __construct(string $prefix = 'plugwork_', array $defaults = []) {
		$this->prefix = $prefix;
		$this->setDefaults($defaults);
	}


	/**
	 * Returns Plugin option value.
	 *
	 * @param string $key  Option name.
	 * @param bool $default
	 * @param string $section Section name the option belongs to
	 * @return mixed
	 */
	public function get(string $key = '', bool $default = false, string $section = ''): mixed {
		$options = $this->get_options($section);
		if (empty($key)) {
			return $options;
		} else {
			return $options[$key] ?? $default;
		}
	}

	private function get_options(string $section = '') {
		if (is_multisite()) {
			$options = get_site_option($this->prefix, array());
		} else {
			$options = get_option($this->prefix, array());
		}
		$options = wp_parse_args($options, $this->getDefaults());
		if (empty($section)) return $options;
		return $options[$section] ?? array();
	}

	/**
	 * Update Plugin option value.
	 *
	 * @param string $key Option name.
	 * @param mixed  $value  Option value.
	 * @param string $section Section name where option belongs to
	 * @return bool
	 */
	public function update(string $key, mixed $value, string $section = ''): bool {
		$options = $this->get_options();
		if (empty($section)) {
			$options[$key] = $value;
		} else {
			$options[$section][$key] = $value;
		}
		return $this->updateAll($options);
	}

	private function updateAll($options): bool {
		if (is_multisite()) {
			return update_site_option($this->prefix, $options);
		} else {
			return update_option($this->prefix, $options);
		}
	}

	/**
	 * Delete FW option.
	 *
	 * @param string $key Option name.
	 * @param string $section Section name where option belongs to
	 */
	public function delete(string $key, string $section = ''): bool {
		$options = $this->get_options();
		if (empty($section)) {
			unset($options[$key]);
		} else {
			unset($options[$section][$key]);
		}
		return $this->updateAll($options);
	}

	/**
	 * Reset all options
	 *
	 * @return bool
	 */
	public function reset(): bool {
		if (is_multisite()) {
			return delete_site_option($this->prefix);
		} else {
			return delete_option($this->prefix);
		}
	}

	/**
	 * @return array
	 */
	public function getDefaults(): array {
		return $this->defaults;
	}

	/**
	 * @param array $defaults
	 */
	public function setDefaults(array $defaults): void {
		$this->defaults = $defaults;
	}
}
