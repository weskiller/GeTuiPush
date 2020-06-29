<?php

namespace Weskiller\GeTuiPush\Protobuf\Type;

use Weskiller\GeTuiPush\Protobuf\PBMessage;

/**
 * @author Nikolai Kordulla
 */
class PBString extends PBScalar
{
	protected int $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;

	/**
	 * Parses the message for this type
	 *
	 * @param array
	 */
	public function ParseFromArray() :void
	{
		$this->value = '';
		// first byte is length
		$length = $this->reader->next();

		// just extract the string
		$pointer = $this->reader->get_pointer();
		$this->reader->add_pointer($length);
		$this->value = $this->reader->get_message_from($pointer);
	}

	/**
	 * Serializes type
	 * @param int $rec
	 * @return string
	 */
	public function SerializeToString($rec = -1) :string
	{
		$string = '';

		if ($rec > -1)
		{
			$string .= $this->base128->set_value($rec << 3 | $this->wired_type);
		}

		$string .= $this->base128->set_value(strlen($this->value));
		$string .= $this->value;

		return $string;
	}
}