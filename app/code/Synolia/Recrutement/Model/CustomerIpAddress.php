<?php
namespace Synolia\Recrutement\Model;

class CustomerIpAddress extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'synolia_recrutement_customer_ip_address';

    protected $_cacheTag = 'synolia_recrutement_customer_ip_address';

    protected $_eventPrefix = 'synolia_recrutement_customer_ip_address';

    protected function _construct()
    {
        $this->_init('Synolia\Recrutement\Model\ResourceModel\CustomerIpAddress');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}