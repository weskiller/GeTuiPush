<?php

namespace Weskiller\GeTuiPush\Protobuf\Type;


use Weskiller\GeTuiPush\Protobuf\PBMessage;

/**
 * @author Nikolai Kordulla
 */
class PBSignedInt extends PBScalar
{
	protected int $wired_type = PBMessage::WIRED_VARINT;

	/**
	 * Parses the message for this type
	 *
	 * @param array
	 */
	public function ParseFromArray() :void
	{
		parent::ParseFromArray();

		$saved = $this->value;
		$this->value = round($this->value / 2);
		if ($saved % 2 === 1)
		{
			$this->value = -($this->value);
		}
	}

	/**
	 * Serializes type
	 * @param int $rec
	 * @return string
	 */
	public function SerializeToString($rec = -1) :string
	{
		// now convert signed int to int
		$save = $this->value;
		if ($this->value < 0)
		{
			$this->value = abs($this->value)*2-1;
		}
		else 
		{
			$this->value *= 2;
		}
		$string = parent::SerializeToString($rec);
		// restore value
		$this->value = $save;

		return $string;
	}
}