<?php
namespace Weskiller\GeTuiPush\Protobuf;
use RuntimeException;
use Weskiller\GeTuiPush\Protobuf\Encoding\Base128VarInt;
use Weskiller\GeTuiPush\Protobuf\Reader\PBInputStringReader;
use Weskiller\GeTuiPush\Protobuf\Type\PBInt;
use Weskiller\GeTuiPush\Protobuf\Type\PBString;

/**
 * Abstract Message class
 * @author Nikolai Kordulla
 */
abstract class PBMessage
{
    public const WIRED_VARINT = 0;
    public const WIRED_LENGTH_DELIMITED = 2;
    public const WIRED_START_GROUP = 3;
    public const WIRED_END_GROUP = 4;
    public const WIRED_32BIT = 5;

    protected Base128VarInt $base128;

    // here are the field types
    protected array $fields = array();
    // the values for the fields
    protected array $values = array();

    // type of the class
    protected int $wired_type = 2;

    /**
     * the value of a class
     * @var mixed
     */
    protected $value = null;

    // modus byte or string parse (byte for productive string for better reading and debuging)
    // 1 = byte, 2 = String
    public const MODUS = 1;

    // now use pointer for speed improvement
    // pointer to begin
    protected $reader;

    // chunk which the class not understands
    protected string $chunk = '';

    // variable for Send method
    protected string $_d_string = '';

    /**
     * Constructor - initialize base128 class
     * @param null $reader
     */
    public function __construct($reader = null)
    {
        $this->reader = $reader;
        $this->value = $this;
        $this->base128 = new Base128VarInt(self::MODUS);
    }

    /**
     * Get the wired_type and field_type
     * @param float $number
     * @return array wired_type, field_type
     */
    public function get_types($number)
    {
        $binstring = decbin($number);
        $types = array();
        $low = substr($binstring, strlen($binstring) - 3, strlen($binstring));
        #$high = substr($binstring,0, -3) . '0000';
        $types['wired'] = bindec($low);
        $types['field'] = bindec($binstring) >> 3;
        return $types;
    }


    /**
     * Encodes a Message
     * @param int $rec
     * @return string the encoded message
     */
    public function SerializeToString($rec = -1) :string
    {
        $string = '';
        // wired and type
        if ($rec > -1)
        {
            $string .= $this->base128->set_value($rec << 3 | $this->wired_type);
        }

        $stringinner = '';

        foreach ($this->fields as $index => $field)
        {
            if (is_array($this->values[$index]) && count($this->values[$index]) > 0)
            {
                // make serialization for every array
                foreach ($this->values[$index] as $array)
                {
                    $newstring = '';
                    $newstring .= $array->SerializeToString($index);

                    $stringinner .= $newstring;
                }
            }
            else if ($this->values[$index] != null)
            {
                // wired and type
                $newstring = '';
                $newstring .= $this->values[$index]->SerializeToString($index);

                $stringinner .= $newstring;
            }
        }

        $this->_serialize_chunk($stringinner);

        if ($this->wired_type === PBMessage::WIRED_LENGTH_DELIMITED && $rec > -1)
        {
            $stringinner = $this->base128->set_value(strlen($stringinner) / PBMessage::MODUS) . $stringinner;
        }

        return $string . $stringinner;
    }

    /**
     * Serializes the chunk
     * @param String $stringInner - String where to append the chunk
     * @return void
     */
    public function _serialize_chunk(&$stringInner) :void
    {
        $stringInner .= $this->chunk;
    }

    /**
     * Decodes a Message and Built its things
     *
     * @param string message as stream of hex example '1a 03 08 96 01'
     */
    public function ParseFromString($message) :void
    {
        $this->reader = new PBInputStringReader($message);
        $this->_ParseFromArray();
    }

    /**
     * Internal function
     */
    public function ParseFromArray() :void
    {
        $this->chunk = '';
        // read the length byte
        $length = $this->reader->next();
        // just take the splice from this array
        $this->_ParseFromArray($length);
    }

    /**
     * Internal function
     * @param int $length
     */
    private function _ParseFromArray($length = 99999999) :void
    {
        $_begin = $this->reader->get_pointer();
        while ($this->reader->get_pointer() - $_begin < $length)
        {
            $next = $this->reader->next();
            if ($next === false)
                break;

            // now get the message type
            $messtypes = $this->get_types($next);

            // now make method test
            if (!isset($this->fields[$messtypes['field']]))
            {
                // field is unknown so just ignore it
                // throw new Exception('Field ' . $messtypes['field'] . ' not present ');
                if ($messtypes['wired'] === PBMessage::WIRED_LENGTH_DELIMITED)
                {
                    $consume = new PBString($this->reader);
                }
                else if ($messtypes['wired'] === PBMessage::WIRED_VARINT)
                {
                    $consume = new PBInt($this->reader);
                }
                else
                {
                    throw new RuntimeException('I dont understand this wired code:' . $messtypes['wired']);
                }

                // perhaps send a warning out
                $_oldpointer = $this->reader->get_pointer();
                $consume->ParseFromArray();
                // now add array from _oldpointer to pointer to the chunk array
                $this->chunk .= $this->reader->get_message_from($_oldpointer);
                continue;
            }

            // now array or not
            if (is_array($this->values[$messtypes['field']]))
            {
                $this->values[$messtypes['field']][] = new $this->fields[$messtypes['field']]($this->reader);
                $index = count($this->values[$messtypes['field']]) - 1;
                if ($messtypes['wired'] !== $this->values[$messtypes['field']][$index]->wired_type)
                {
                    throw new RuntimeException('Expected type:' . $messtypes['wired'] . ' but had ' . $this->fields[$messtypes['field']]->wired_type);
                }
                $this->values[$messtypes['field']][$index]->ParseFromArray();
            }
            else
            {
                $this->values[$messtypes['field']] = new $this->fields[$messtypes['field']]($this->reader);
                if ($messtypes['wired'] !== $this->values[$messtypes['field']]->wired_type)
                {
                    throw new RuntimeException('Expected type:' . $messtypes['wired'] . ' but had ' . $this->fields[$messtypes['field']]->wired_type);
                }
                $this->values[$messtypes['field']]->ParseFromArray();
            }
        }
    }

    /**
     * Add an array value
     * @param int - index of the field
     * @return mixed
     */
    protected function _add_arr_value($index)
    {
        return $this->values[$index][] = new $this->fields[$index]();
    }

    /**
     * Set an array value
     * @param int - index of the field
     * @param int - index of the array
     * @param object - the value
     */
    protected function _set_arr_value($index, $index_arr, $value)
    {
        $this->values[$index][$index_arr] = $value;
    }

    /**
     * Remove the last array value
     * @param int - index of the field
     */
    protected function _remove_last_arr_value($index)
    {
    	array_pop($this->values[$index]);
    }

    /**
     * Set an value
     * @param int - index of the field
     * @param Mixed value
     */
    protected function _set_value($index, $value)
    {
        if (is_object($value))
        {
            $this->values[$index] = $value;
        }
        else
        {
            $this->values[$index] = new $this->fields[$index];
            $this->values[$index]->value = $value;
        }
    }

    /**
     * Get a value
     * @param $index string id of the field
     */
    protected function _get_value($index)
    {
        if ($this->values[$index] == null)
            return null;
        return $this->values[$index]->value;
    }

    /**
     * Get array value
     * @param $index string id of the field
     * @param $value
     */
    protected function _get_arr_value($index, $value)
    {
        return $this->values[$index][$value];
    }

    /**
     * Get array size
     * @param $index string id of the field
     */
    protected function _get_arr_size($index)
    {
        return count($this->values[$index]);
    }

    /**
     * Helper method for send string
     */
    protected function _save_string($string)
    {

        return strlen($string);
    }

    /**
     * Sends the message via post request ['message'] to the url
     * @param $url string the url
     * @param $class mixed the PBMessage class where the request should be encoded
     *
     * @return String - the return string from the request to the url
     */
    public function Send($url, &$class = null)
    {
        $ch = curl_init();
        $this->_d_string = '';

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, array($this, '_save_string'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'message=' . urlencode($this->SerializeToString()));
        #$result = curl_exec($ch);
        curl_exec($ch);
        if ($class !== null) {
            $class->parseFromString($this->_d_string);
        }
        return $this->_d_string;
    }
    
 	/**
     * Fix Memory Leaks with Objects in PHP 5
     * http://paul-m-jones.com/?p=262
     * 
     * thanks to cheton
     * http://code.google.com/p/pb4php/issues/detail?id=3&can=1
     */
    public function _destruct()
    {
        if (isset($this->reader))
        {
            unset($this->reader);
        }
        if (isset($this->value))
        {
            unset($this->value);
        }
        // base128
        if (isset($this->base128))
        {
           unset($this->base128);
        }
        // fields
        if (isset($this->fields))
        {
            foreach ($this->fields as $name => $value)
            {
                unset($this->$name);
            }
            unset($this->fields);
        }
        // values
        if (isset($this->values))
        {
            foreach ($this->values as $name => $value)
            {
                if (is_array($value))
                {
                    foreach ($value as $name2 => $value2)
                    {
                        if (is_object($value2) AND method_exists($value2, '__destruct'))
                        {
                            $value2->__destruct();
                        }
                        unset($value2);
                    }
                    if (isset($name2))
                    	unset($value->$name2);
                }
                else
                {
                    if (is_object($value) AND method_exists($value, '__destruct'))
                    {
                        $value->__destruct();
                    }
                    unset($value);
                }
                unset($this->values->$name);
            }
            unset($this->values);
        }
    }
    
}
?>
