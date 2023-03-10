<?php
declare(strict_types=1);

namespace Homework\WeatherReport\Model\ResourceModel\Report;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'report_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Homework\WeatherReport\Model\Report::class,
            \Homework\WeatherReport\Model\ResourceModel\Report::class
        );
    }
}
