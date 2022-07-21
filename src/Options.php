<?php

namespace Plugwork;

defined( 'ABSPATH' ) || exit;

class Options {

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
