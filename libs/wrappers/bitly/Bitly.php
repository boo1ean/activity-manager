<?php

namespace app\libs\wrappers\bitly;

use InvalidArgumentException;
use Exception;

if (!function_exists('curl_init')) {
    throw new Exception('CURL PHP extension required.');
}

if (!function_exists('json_decode')) {
    throw new Exception('JSON PHP extension required.');
}

/**
 * @class Bitly is the wrapper on Bitly API Version 3 @link http://dev.bitly.com
 */
class Bitly {

    const BITLY_SHORTEN = 'shorten';
    const BITLY_EXPAND  = 'expand';
    /**
     * @var array Available methods map
     */
    protected $_methods = array(
        self::BITLY_SHORTEN => 'http://api.bit.ly/v3/shorten?',
        self::BITLY_EXPAND  => 'http://api.bit.ly/v3/expand?'
    );

    /**
     * @var array Default options list
     */
    private $_defaultOptions = array(
        'format' => 'json',
        'login'  => null,
        'apiKey' => null
    );

    public function __construct($login, $apiKey) {
        $this->_defaultOptions['login']  = $login;
        $this->_defaultOptions['apiKey'] = $apiKey;
    }

    public function __call($method, $args) {
        if (array_key_exists($method, $this->_methods) && isset($args[0])) {
            return $this->_callMethod($method, $args[0]);
        }

        throw new InvalidArgumentException("Call to undefined method $method.");
    }

    /**
     * Validate method options
     *
     * @param $options
     * @throws InvalidArgumentException
     */
    protected function _validateOptions($options) {
        if (!is_array($options)) {
            throw new InvalidArgumentException('Options should be an array.');
        }
    }

    /**
     * Call API method defined in _methods
     *
     * @param $method
     * @param $args
     * @return mixed
     */
    protected function _callMethod($method, $args) {
        $this->_validateOptions($args);
        $options = $this->_getOptions($args);

        return $this->_process($options, $method);
    }

    /**
     * Combine options for API call
     *
     * @param $options
     * @return array
     */
    protected function _getOptions($options) {
        return array_merge($this->_defaultOptions, $options);
    }

    /**
     * Perform API method call by query string
     *
     * @param $options
     * @param $method
     * @return mixed
     * @throws Exception
     */
    protected function _process($options, $method) {
        $query = $this->_buildQuery($options);
        $url   = $this->_methods[$method] . $query;

        $responseJson = $this->_getCurl($url);
        $responseObj = json_decode($responseJson);

        if ($responseObj->status_code == 200) {
            if ($method == self::BITLY_SHORTEN) {
                return $responseObj->data;
            } elseif ($method == self::BITLY_EXPAND) {
                return $responseObj->data->expand[0];
            }

        } else {
            throw new Exception("Error occured. Bitly API status code {$responseObj->status_code}");
        }
    }

    /**
     * Construct query string
     *
     * @param $options
     * @return string
     */
    protected function _buildQuery($options) {
        return http_build_query($options);
    }

    /**
     * Get data via cURL
     *
     * @param $url
     * @return mixed|null
     */
    protected function _getCurl($url) {
        $response = null;

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($ch);
            curl_close($ch);

        } catch(Exception $e) {
            // Handle exception
        }

        return $response;
    }
}