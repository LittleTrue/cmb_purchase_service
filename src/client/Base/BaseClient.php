<?php

namespace purchase\CmbBankClient\Base;

use GuzzleHttp\RequestOptions;
use purchase\CmbBankClient\Application;
use purchase\CmbBankClient\Base\Exceptions\ClientError;

/**
 * 底层请求.
 */
class BaseClient
{
    use MakesHttpRequests;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var array
     */
    protected $json = [];

    /**
     * @var string
     */
    protected $language = 'zh-cn';

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Set json params.
     *
     * @param array $json Json参数
     */
    public function setParams(array $json)
    {
        //数据公共格式
        $param = [
            'MsgID'     => $this->generateMessageId(),
            'Data'      => $json,
            'Timestamp' => $this->getTimestamp(13),
            'Appkey'    => $this->app['config']->get('bank_app_key'),
        ];

        ksort($param);
        
        //数据整体加签
        $param['Sign'] = $this->app['credential']->signData($param);

        $this->json = $param;
    }

    /**
     * Set Headers Language params.
     *
     * @param string $language 请求头中的语种标识
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Make a get request.
     *
     * @throws ClientError
     */
    public function httpGet($uri, array $options = [])
    {
        $options = $this->_headers($options);

        return $this->request('GET', $uri, $options);
    }

    /**
     * Make a post request.
     *
     * @throws ClientError
     */
    public function httpPostJson($uri)
    {
        return $this->requestPost($uri, [RequestOptions::JSON => $this->json]);
    }

    /**
     * 获取特定位数时间戳.
     * @return int
     */
    public function getTimestamp(int $digits = 10)
    {
        $digits = $digits > 10 ? $digits : 10;

        $digits = $digits - 10;

        if ((!$digits) || (10 == $digits)) {
            return time();
        }

        return number_format(microtime(true), $digits, '', '') - 50000;
    }

    /**
     * @throws ClientError
     */
    protected function requestPost($uri, array $options = [])
    {
        $options = $this->_headers($options);

        return $this->request('POST', $uri, $options);
    }

    /**
     * 获取报文流水号.
     * @return string
     */
    protected function generateMessageId()
    {
        return date('ymd') . substr(substr(microtime(), 2, 6)
        * time(), 2, 6) . mt_rand(1000, 9999);
    }

    /**
     * set Headers.
     *
     * @return array
     */
    private function _headers(array $options = [])
    {
        $time = time();

        $options[RequestOptions::HEADERS] = [
            'Content-Type' => 'application/json',
            'timestamp'    => $time,
        ];
        return $options;
    }
}
