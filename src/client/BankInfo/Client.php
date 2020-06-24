<?php

namespace purchase\CmbBankClient\BankInfo;

use purchase\CmbBankClient\Application;
use purchase\CmbBankClient\Base\BaseClient;
use purchase\CmbBankClient\Base\Exceptions\ClientError;

/**
 * 银行基本数据查询请求客户端.
 */
class Client extends BaseClient
{
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    /**
     * 汇率查询.
     *
     * @throws ClientError
     */
    public function exchangeRateQuery(array $infos)
    {
        $this->setParams($infos);

        return $this->httpPostJson('/MID101/GZ0003');
    }

    /**
     * 账户获取.
     *
     * @throws ClientError
     */
    public function accountQuery(array $infos)
    {
        $this->setParams($infos);

        return $this->httpPostJson('/MID102/GZ0003');
    }

    /**
     * 银行信息查询.
     *
     * @throws ClientError
     */
    public function BankMessageQuery(array $infos)
    {
        $this->setParams($infos);

        return $this->httpPostJson('/MID103/GZ0003');
    }
}
