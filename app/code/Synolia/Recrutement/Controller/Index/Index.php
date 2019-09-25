<?php
namespace Synolia\Recrutement\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    protected $_customerIpAddressFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Synolia\Recrutement\Model\CustomerIpAddressFactory $customerIpAddressFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_customerIpAddressFactory = $customerIpAddressFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $customerIpAddress = $this->_customerIpAddressFactory->create();
        $collection = $customerIpAddress->getCollection();
        foreach($collection as $item){
            echo "<pre>";
            print_r($item->getData());
            echo "</pre>";
        }
        exit();
        return $this->_pageFactory->create();
    }
}