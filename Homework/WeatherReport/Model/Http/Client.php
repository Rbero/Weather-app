<?php
declare(strict_types=1);

namespace Homework\WeatherReport\Model\Http;

use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Client
 * @package Homework\WeatherReport\Model\Http
 */
class Client
{
    const API_HOST_CONFIG_PATH = 'api/config/url';
    const API_KEY_CONFIG_PATH = 'api/config/key';
    const QUERY_STRING_PREFIX = '?q=';
    const QUERY_STRING_SEPARATOR = '&';
    const QUERY_STRING_APP_ID = 'appid';
    const QUERY_STRING_UNITS = 'units';
    const QUERY_STRING_UNIT_METRIC = 'metric';
    const SUCCESS_RESPONSE_CODE = 200;
    const QUERY_API_HOST = 'http://api.openweathermap.org/data/2.5/weather';
    const QUERY_API_KEY = '07a06686ea37183f46aa964b4258c811';

    /**
     * @var Curl
     */
    protected $curl;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Client constructor.
     * @param Curl $curl
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Curl $curl,
        ScopeConfigInterface $scopeConfig

    )
    {
        $this->curl = $curl;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param $city
     * @param $country
     * @return false|string
     */
    public function getWeatherDataForCity($city, $country)
    {
        $url = $this->createApiUrl($city, $country);
        if ($url) {
            $this->curl->get($url);
            $response = $this->curl->getBody();
            if ($this->curl->getStatus() == self::SUCCESS_RESPONSE_CODE) {
                return $response;
            }
        }
        return false;
    }

    /**
     * @param $city
     * @return false|string
     */
    private function createApiUrl($city, $country)
    {
//        $apiHost = $this->scopeConfig->getValue(self::API_HOST_CONFIG_PATH);
//        $apiKey = $this->scopeConfig->getValue(self::API_KEY_CONFIG_PATH);
        $city = urlencode($city);
        return self::QUERY_API_HOST .
            self::QUERY_STRING_PREFIX . $city . ',' . $country .
            self::QUERY_STRING_SEPARATOR . self::QUERY_STRING_UNITS . '=' . self::QUERY_STRING_UNIT_METRIC .
            self::QUERY_STRING_SEPARATOR . self::QUERY_STRING_APP_ID . '=' . self::QUERY_API_KEY;
    }

}
