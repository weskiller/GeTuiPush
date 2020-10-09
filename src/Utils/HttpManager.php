<?php

namespace Weskiller\GeTuiPush\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use JsonException;
use Throwable;
use function GuzzleHttp\Psr7\str;

class HttpManager
{
    private static ?Client $client = null;

    public static function retryDecider(): callable
    {
        return static function (
            $retries,
            Request $request,
            Response $response = null,
            RequestException $exception = null
        ) {
            // 超过最大重试次数，不再重试
            if ($retries >= 3) {
                return false;
            }

            // 请求失败，继续重试
            if ($exception instanceof ConnectException) {
                return true;
            }

            // 如果请求有响应，但是状态码大于等于500，继续重试(这里根据自己的业务而定)
            if ($response && $response->getStatusCode() >= 500) {
                return true;
            }

            return false;
        };
    }

    /**
     * @return Client
     */
    public static function getClient(): Client
    {
        if(self::$client === null) {
            $handler = HandlerStack::create();
            $handler->push(Middleware::retry(self::retryDecider()));
            self::$client = new Client(['config' => compact('handler')]);
        }
        return self::$client;
    }

    /**
     * @param Client $client
     */
    public static function setClient(Client $client): void
    {
        self::$client = $client;
    }

    /**
     * @param $url
     * @param $data
     * @param $gzip
     * @param $action
     * @return null|string
     */
    private static function httpPost($url, $data, $gzip, $action)
    {
        static $default = null;
        if($default === null) {
            $default = [
                'headers' => [
                    'User-Agent'=> 'getui client',
                    'Content-Type' => 'text/html;charset=UTF-8',
                    'Connection' => 'Keep-Alive',
                ],
                'timeout' => 30,
                'curl' => [
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_FORBID_REUSE => 0,
                    CURLOPT_FRESH_CONNECT => 0,
                    CURLOPT_CONNECTTIMEOUT_MS => GTConfig::getHttpConnectionTimeOut(),
                    CURLOPT_PROXY => GTConfig::getHttpProxyIp(),
                    CURLOPT_PROXYPORT => GTConfig::getHttpProxyPort(),
                    CURLOPT_PROXYUSERNAME => GTConfig::getHttpProxyUserName(),
                    CURLOPT_PROXYPASSWORD => GTConfig::getHttpProxyPasswd(),
                    CURLOPT_FOLLOWLOCATION => 1,
                    CURLOPT_MAXREDIRS => 7
                ],
            ];
        }
        $options = $default;
        if($gzip) {
            $options['headers']['Content-Encoding'] = 'gzip';
            $options['body'] = gzencode($data);
        } else {
            $options['body'] = $data;
        }
        if($action !== null) {
            $options['headers']['Gt-Action'] = $action;
        }
        try {
            $resp = self::getClient()->post($url, $options);
            str($resp);
            if ($resp && $resp->getStatusCode() === 200) {
                return (string) $resp->getBody();
            }
        } catch (Throwable $e) {
        }
        return null;
    }
	
	public static function httpHead($url)
    {
        static $options = null;
        if ($options === null) {
            $options = [
                'headers' => [
                    'User-Agent' => 'getui client',
                    'Content-Type' => 'text/html;charset=UTF-8',
                ],
                'timeout' => 30,
                'curl' => [
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_PROXY => GTConfig::getHttpProxyIp(),
                    CURLOPT_PROXYPORT => GTConfig::getHttpProxyPort(),
                    CURLOPT_PROXYPASSWORD => GTConfig::getHttpProxyPasswd(),
                    CURLOPT_FOLLOWLOCATION => 1,
                    CURLOPT_MAXREDIRS => 7
                ]
            ];
        }
        try {
            $resp = self::getClient()->request('HEAD',$url,$options);
            if ($resp && $resp->getStatusCode() === 200) {
                return (string)$resp->getBody();
            }
        } catch (Throwable $e) {
        }
        return null;
    }

    /**
     * @param $url
     * @param $params
     * @param $gzip
     * @return array | false
     * @throws JsonException
     */
    public static function httpPostJson($url, $params, $gzip)
    {
        if(!isset($params["version"])) {
            $params["version"] = GTConfig::getSDKVersion();
        }
        $action = $params["action"];
        $resp = self::httpPost($url, Json::encode($params), $gzip, $action);
        return $resp ? Json::decode($resp) : null;
    }
}