<?php

namespace purchase\CmbBankClient\BankPurchase;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['bank_purchase'] = function ($app) {
            return new Client($app);
        };
    }
}
