<?php

namespace Weskiller\GeTuiPush\Protobuf\Type;

use Weskiller\GeTuiPush\Protobuf\PBMessage;

/**
 * @author Nikolai Kordulla
 */
class PBEnum extends PBScalar
{
    protected int $wired_type = PBMessage::WIRED_VARINT;

	/**
	 * Parses the message for this type
	 *
	 * @param array
	 */
	public function ParseFromArray() :void
	{
		$this->value = $this->reader->next();
	}

    /**
     * Serializes type
     * @param int $rec
     * @return string
     */
	public function SerializeToString($rec=-1) :string
	{
		$string = '';

		if ($rec > -1)
		{
			$string .= $this->base128->set_value($rec << 3 | $this->wired_type);
		}

		$value = $this->base128->set_value($this->value);
		$string .= $value;

		return $string;
	}
}
