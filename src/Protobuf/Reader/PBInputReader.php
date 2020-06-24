<?php

namespace Weskiller\GeTuiPush\Protobuf\Reader;

use Weskiller\GeTuiPush\Protobuf\Encoding\Base128VarInt;

/**
 * Abstract class for an input reader
 */
abstract class PBInputReader
{
	protected $base128;
	protected $pointer = 0;
	protected $string = '';


	public function __construct()
	{
		$this->base128 = new Base128VarInt(1);
	}

	/**
	 * Gets the acutal position of the point
	 * @return int the pointer
	 */
	public function get_pointer()
	{
		return $this->pointer;
	}

	/**
	 * Add add to the pointer
	 * @param int $add - int to add to the pointer
	 */
	public function add_pointer($add)
	{
		$this->pointer += $add;
	}

	/**
	 * Get the message from from to actual pointer
	 * @param int from
	 */
	public function get_message_from($from)
	{
		return substr($this->string, $from, $this->pointer - $from);
	}

	/**
	 * Getting the next varint as decimal number
	 */
	public abstract function next();	
}
