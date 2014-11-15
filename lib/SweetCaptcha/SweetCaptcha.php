<?php

namespace SweetCaptcha;

use Buzz\Client\Curl;
use Buzz\Message\Request;
use Buzz\Message\Response;

/**
 * Class SweetCaptcha
 *
 * @package SweetCaptcha
 */
class SweetCaptcha implements SweetCaptchaInterface
{
    const API_HOSTNAME = 'http://sweetcaptcha.com';
    const API_URL = '/api';

    /** @var string */
    private $appId;

    /** @var string */
    private $appKey;

    /** @var string */
    private $appSecret;

    /** @var Curl */
    private $httpClient;

    /**
     * @param string $appId
     * @param string $appKey
     * @param string $appSecret
     */
    function __construct($appId, $appKey, $appSecret)
    {
        $this->appId = $appId;
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->httpClient = new Curl();
    }

    /**
     * @return string
     */
    public function renderView()
    {
        return $this->request(
            array(
                'method' => 'get_html'
            )
        );
    }

    /**
     * @param string $sckey
     * @param string $scvalue
     * @return boolean
     */
    public function validate($sckey, $scvalue)
    {
        $result = $this->request(
            array(
                'method' => 'check',
                'sckey' => $sckey,
                'scvalue' => $scvalue,
            )
        );

        return strtolower($result) === 'true';
    }

    /**
     * @param array $params
     * @return string
     */
    private function request(array $params)
    {
        $request = new Request(Request::METHOD_POST, self::API_URL, self::API_HOSTNAME);
        $response = new Response();

        $request->setContent(
            http_build_query(
                array_merge(
                    array(
                        'app_id' => $this->appId,
                        'app_key' => $this->appKey,
                    ),
                    $params
                )
            )
        );

        $this->httpClient->send($request, $response);

        return $response->getContent();
    }
}
