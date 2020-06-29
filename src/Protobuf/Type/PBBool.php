<?php

namespace Weskiller\GeTuiPush\Protobuf\Type;

use Weskiller\GeTuiPush\Protobuf\PBMessage;

/**
 * @author Nikolai Kordulla
 */
class PBBool extends PBInt
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
		$this->value = ($this->value !== 0) ? 1 : 0;
	}

}