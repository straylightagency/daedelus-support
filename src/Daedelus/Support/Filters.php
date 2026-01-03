<?php

namespace Daedelus\Support;

/**
 *
 */
class Filters
{
	/**
	 * @param string $hook_name
	 * @param ...$arg
	 *
	 * @return mixed
	 */
	public static function apply(string $hook_name, ...$arg): mixed
	{
		return apply_filters( $hook_name, ...$arg );
	}

	/**
	 * @param string $hook_name
	 * @param array $args
	 *
	 * @return mixed
	 */
	public static function applyWithRef(string $hook_name, array $args): mixed
	{
		return apply_filters_ref_array( $hook_name, $args );
	}

	/**
	 * @param string|array $hook_name
	 *
	 * @return FilterableHook
	 */
	public static function when(string|array $hook_name): FilterableHook
	{
		return new FilterableHook( $hook_name );
	}

	/**
	 * @param array|string $hook_name
	 * @param callable $callback
	 * @param int $priority
	 * @param int $accepted_args
	 *
	 * @return void
	 */
	public static function add(array|string $hook_name, callable $callback, int $priority = 10, int $accepted_args = 1):void
	{
		self::when( $hook_name )->do( $callback )->at( $priority )->acceptedArgs( $accepted_args )->set();
	}

	/**
	 * @param string $hook_name
	 * @param mixed $callback
	 * @param int $priority
	 *
	 * @return bool
	 */
	public static function remove(string $hook_name, mixed $callback, int $priority = 10): bool
	{
		return remove_filter( $hook_name, $callback, $priority );
	}

    /**
     * @param string $hook_name
     * @param callable|false|array|string $callback
     * @return bool
     */
	public static function has(string $hook_name, callable|false|array|string $callback = false): bool
	{
		return has_filter( $hook_name, $callback );
	}
}