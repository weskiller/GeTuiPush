<?php

namespace Weskiller\GeTuiPush;

use RuntimeException;
use Weskiller\GeTuiPush\Library\SingleBatchItem;
use Weskiller\GeTuiPush\Library\SingleBatchRequest;
use Weskiller\GeTuiPush\Utils\GTConfig;

class IGtBatch
{
    protected $batchId;
    protected $innerMsgList = array();
    protected $seqId = 0;
    protected $APPKEY;
    protected $push;
    protected $lastPostData;

    public function __construct($appkey, $push)
    {
        $this->APPKEY = $appkey;
        $this->push = $push;
        $this->batchId = uniqid('', true);

    }

    public function getBatchId()
    {
        return $this->batchId;
    }

    public function add($message, $target)
    {
        if ($this->seqId >= 5000) {
            throw new RuntimeException("Can not add over 5000 message once! Please call submit() first.");
        }

        ++$this->seqId;
        $innerMsg = new SingleBatchItem();
        $innerMsg->set_seqId($this->seqId);
        $innerMsg->set_data($this->createSingleJson($message, $target));
        $this->innerMsgList[] = $innerMsg;
        return $this->seqId . "";
    }

    public function createSingleJson($message, $target)
    {
        $params = $this->push->getSingleMessagePostData($message,$target);
        return json_encode($params);
    }

    public function submit()
    {
        $requestId = uniqid('', true);
        $data = array();
        $data["appkey"]=$this->APPKEY;
        $data["serialize"] = "pb";
        $data["async"] = GTConfig::isPushSingleBatchAsync();
        $data["action"] = "pushMessageToSingleBatchAction";
        $data['requestId'] = $requestId;
        $singleBatchRequest = new SingleBatchRequest();
        $singleBatchRequest->set_batchId($this->batchId);
        foreach ($this->innerMsgList as $index => $innerMsg) {
            $singleBatchRequest->add_batchItem();
            $singleBatchRequest->set_batchItem($index, $innerMsg);
        }
        $data["singleDatas"] = base64_encode($singleBatchRequest->SerializeToString());
        $this->seqId = 0;
        $this->innerMsgList = array();
        $this->lastPostData = $data;
        return $this->push->httpPostJSON(null, $data, true);
    }

    public function retry()
    {
        return $this->push->httpPostJSON(null, $this->lastPostData, true);
    }

    public function setApiUrl($apiUrl) {
    }
}