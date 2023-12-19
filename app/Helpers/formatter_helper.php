<?php

/**
 * Credits:
 * DataTables server-side processing for CodeIgniter4
 * A CodeIgniter4 library for building a Datatables server side processing SQL query.
 * URL: https://github.com/sluvanda/codeigniter4-datatables
 * Developer: https://github.com/sluvanda
 */

if (! function_exists('set_status'))
{
	function set_status(string $value, array $row): string
	{
		return $value === '1' ? 'Active' : 'Inactive';
	}
}

if (! function_exists('action_links'))
{
	function action_links(string $value, array $row): string
	{
		return '<a href="'.base_url('users/edit/'.$value).'">View</a>';
	}
}

if (! function_exists('date_only'))
{
	function date_only(string $value, array $row): string
	{
		return date('Y-m-d', strtotime($value));
	}
}