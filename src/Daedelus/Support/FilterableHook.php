<?php

namespace Daedelus\Support;

use Illuminate\Support\Arr;

/**
 *
 */
class FilterableHook
{
	/** @var callable */
	protected $callback;

	/** @var int */
	protected int $priority;

	/** @var array */
	protected array $data;

	/** @var int */
	protected int $acceptedArgs = 10;

	/** @var bool */
	protected bool $isSet = false;

	/**
	 * Constructor.
	 */
	public function __construct(protected array|string $name)
	{
	}

	/**
	 * @param callable $callback
	 *
	 * @return $this
	 */
	public function do(callable $callback): static
	{
		$this->callback = $callback;

		return $this;
	}

	/**
	 * @param int $priority
	 *
	 * @return $this
	 */
	public function at(int $priority): static
	{
		$this->priority = $priority;

		return $this;
	}

	/**
	 * @param int $args
	 *
	 * @return $this
	 */
	public function acceptedArgs(int $args): static
	{
		$this->acceptedArgs = $args;

		return $this;
	}

	/**
	 * @return void
	 */
	public function set():void
	{
		if ( $this->isSet ) {
			return;
		}

		foreach ( Arr::wrap( $this->name ) as $name ) {
			add_filter( $name, $this->callback, $this->priority, $this->acceptedArgs );
		}

		$this->isSet = true;
	}
}