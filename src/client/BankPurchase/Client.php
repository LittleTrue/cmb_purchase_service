<?php

namespace purchase\CmbBankClient\BankPurchase;

use purchase\CmbBankClient\Application;
use purchase\CmbBankClient\Base\BaseClient;
use purchase\CmbBankClient\Base\Exceptions\ClientError;

/**
 * 银行购付汇发起请求客户端.
 */
class Client extends BaseClient
{
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    /**
     * 购付汇申请.
     *
     * @throws ClientError
     */
    public function purchase(array $infos,string $gz)
    {
        $this->setParams($infos);

        return $this->httpPostJson('/MID104'.'/'.$gz);
    }
}
