<?php

namespace purchase\CmbBankService;

use purchase\CmbBankClient\Application;
use purchase\CmbBankClient\Base\Exceptions\ClientError;

/**
 * 银行基本数据查询请求客户端.
 */
class BaseInfoService
{
    /**
     * @var BaseInfo
     */
    private $_bankInfoClient;

    public function __construct(Application $app)
    {
        $this->_bankInfoClient = $app['bank_info'];
    }

    /**
     * 银行汇率查询.
     *
     * @throws ClientError
     * @throws \Exception
     */
    public function exchangeRateQuery(array $infos,string $gz)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_bankInfoClient->exchangeRateQuery($infos,$gz);
    }

    /**
     * 银行账户获取.
     *
     * @throws ClientError
     * @throws \Exception
     */
    public function accountQuery(array $infos,string $gz)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_bankInfoClient->accountQuery($infos,$gz);
    }

    /**
     * 银行信息查询.
     *
     * @throws ClientError
     * @throws \Exception
     */
    public function BankMessageQuery(array $infos,string $gz)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_bankInfoClient->BankMessageQuery($infos,$gz);
    }
}
