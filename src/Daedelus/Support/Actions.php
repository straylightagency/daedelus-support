<?php

namespace Daedelus\Support;

/**
 *
 */
class Actions
{
	/**
	 * @param string $hook_name
	 * @param ...$arg
	 *
	 * @return void
	 */
	public static function do(string $hook_name, ...$arg): void
	{
		do_action( $hook_name, ...$arg );
	}

	/**
	 * @param string $hook_name
	 * @param array $args
	 *
	 * @return void
	 */
	public static function doWithRef(string $hook_name, array $args): void
	{
		do_action_ref_array( $hook_name, $args );
	}

	/**
	 * @param string|array $hook_name
	 *
	 * @return ActionableHook
	 */
	public static function when(string|array $hook_name): ActionableHook
	{
		return new ActionableHook( $hook_name );
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
	 * @param callable $callback
	 * @param int $priority
	 *
	 * @return bool
	 */
	public static function remove(string $hook_name, callable $callback, int $priority = 10): bool
	{
		return remove_action( $hook_name, $callback, $priority );
	}

    /**
     * @param string $hook_name
     * @param callable|false|array|string $callback
     * @return bool
     */
    public static function has(string $hook_name, callable|false|array|string $callback = false): bool
    {
        return has_action( $hook_name, $callback );
    }
}