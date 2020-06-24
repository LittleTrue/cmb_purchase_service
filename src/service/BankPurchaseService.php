<?php

namespace purchase\CmbBankService;

use purchase\CmbBankClient\Application;
use purchase\CmbBankClient\Base\Exceptions\ClientError;
use purchase\CmbBankClient\Purchase\Client as Purchase;

/**
 * 银行购付汇发起请求客户端.
 */
class BankPurchaseService
{
    /**
     * @var BankPurchase
     */
    private $_bankPurchaseClient;

    public function __construct(Application $app)
    {
        $this->_bankPurchaseClient = $app['bank_purchase'];
    }

    /**
     * 购付汇申请.
     *
     * @throws ClientError
     * @throws \Exception
     */
    public function purchase(array $infos)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_bankPurchaseClient->purchase($infos);
    }
}
