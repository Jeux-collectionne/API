<?php

namespace App\Service;

use SimpleXMLElement;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BoardGameGeekService {

    private string $apiUrl;

    public function __construct(
        private HttpClientInterface $client
    )
    {
        $this->apiUrl = $_ENV["BGG_URL"];
    }

    public function searchGame(string $query): array
    {
        $url = $this->apiUrl . '/search?query=' . $query;
        try {
            $response = $this->client->request(
                'GET',
                $url
            );
            $content = $response->getContent();
            $xml = new SimpleXMLElement($content);

            // Convertir le XML en tableau récursif
            $result = json_decode(json_encode($xml), true);
        } catch (\Throwable $th) {
            throw $th;
        }
        
        return $result;
    }
}