<?php
declare(strict_types=1);

namespace Homework\WeatherReport\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ReportRepositoryInterface
{

    /**
     * Save Report
     * @param \Homework\WeatherReport\Api\Data\ReportInterface $report
     * @return \Homework\WeatherReport\Api\Data\ReportInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Homework\WeatherReport\Api\Data\ReportInterface $report
    );

    /**
     * Retrieve Report
     * @param string $reportId
     * @return \Homework\WeatherReport\Api\Data\ReportInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($reportId);

    /**
     * Retrieve Report matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Homework\WeatherReport\Api\Data\ReportSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Report
     * @param \Homework\WeatherReport\Api\Data\ReportInterface $report
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Homework\WeatherReport\Api\Data\ReportInterface $report
    );

    /**
     * Delete Report by ID
     * @param string $reportId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($reportId);
}
