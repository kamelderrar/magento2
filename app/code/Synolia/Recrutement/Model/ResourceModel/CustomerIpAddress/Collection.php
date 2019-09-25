<?php
namespace Synolia\Recrutement\Model\ResourceModel\CustomerIpAddress;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'synolia_recrutement_customer_ip_address_collection';
    protected $_eventObject = 'customer_ip_address_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Synolia\Recrutement\Model\CustomerIpAddress', 'Synolia\Recrutement\Model\ResourceModel\CustomerIpAddress');
    }

}