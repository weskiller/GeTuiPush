<?php

namespace Weskiller\GeTuiPush\Protobuf\Type;

use Weskiller\GeTuiPush\Protobuf\PBMessage;

/**
 * @author Nikolai Kordulla
 */
class PBBool extends PBInt
{
	protected $wired_type = PBMessage::WIRED_VARINT;

	/**
	 * Parses the message for this type
	 *
	 * @param array
	 */
	public function ParseFromArray()
	{
		$this->value = $this->reader->next();
		$this->value = ($this->value !== 0) ? 1 : 0;
	}

}
?>
