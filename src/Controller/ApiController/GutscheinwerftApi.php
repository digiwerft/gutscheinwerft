<?php

namespace Digiwerft\Gutscheinwerft\Controller\ApiController;

use Contao\System;
use Exception;
use Psr\Log\LogLevel;
use Symfony\Component\HttpClient\HttpClient;

class GutscheinwerftApi
{

    private $client;
    private $url;
    private $token;
    private $user;
    private $pw;

    static $LIVE = "https://gutscheinwerft.server1.digiwerft.de";
    static $DEV = "https://gutscheinwerft.dev.digiwerft.de";

    function __construct($user, $pw, $dev = false)
    {
        $this->client = HttpClient::create([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        if ($dev) {
            $this->url = self::$DEV;
        } else {
            $this->url = self::$LIVE;
        }
        $this->user = $user;
        $this->pw = $pw;
        $this->signin();
    }

    protected function signin()
    {
        $strAPIPath = '/auth/signin';
        $response = $this->request($strAPIPath, [
            'body' => json_encode([
                'username' => $this->user,
                'password' => $this->pw
            ])
        ], 'POST');
        if (!$response) {
            return false;
        }
        $this->token = $response->accessToken;
    }

    protected function request($strAPIPath, $arrOptions, $method = 'GET')
    {
        try {
            $result = $this->client->request($method, $this->url . $strAPIPath, array_merge(
                $arrOptions,
                ['headers' => [
                    'Authorization' => 'Bearer ' . $this->token
                ]]
            ));
            return json_decode($result->getContent(), false);
        } catch (Exception $e) {
            $level = LogLevel::ERROR;
            $logger = System::getContainer()->get('monolog.logger.contao');
            $logger->log($level, $e->getMessage(), array('dockyard_api' => $e->getFile()));
            return false;
        }
    }

    public function listCategories()
    {
        $strAPIPath = '/backoffice/category/list';
        $response = $this->request($strAPIPath, [], 'GET');
        return $response;
    }
}