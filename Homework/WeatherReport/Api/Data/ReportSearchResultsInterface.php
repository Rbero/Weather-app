<?php
declare(strict_types=1);

namespace Homework\WeatherReport\Api\Data;

interface ReportSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Report list.
     * @return \Homework\WeatherReport\Api\Data\ReportInterface[]
     */
    public function getItems();

    /**
     * Set id list.
     * @param \Homework\WeatherReport\Api\Data\ReportInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

