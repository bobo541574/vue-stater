<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiClient
{
    protected object $client;

    protected object $request;

    protected array $headers;

    protected string $baseUrl;

    protected string $apiKey;

    protected string $stringBody;

    protected $apiToken;

    protected $response;

    protected $statusCode;

    /**
     * __construct
     *
     * @param  mixed $request
     * @param  mixed $endpoint
     * @param  mixed $apiToken
     * @return void
     */
    public function __construct(Request $request, $endpoint, $apiToken = null)
    {
        $this->client = $this->getGuzzleClient($endpoint);
        $this->request = $request;
        $this->apiToken = $apiToken;
    }

    public function setHeader(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * getGuzzleClient
     *
     * @param  mixed $endpoint
     * @return void
     */
    protected function getGuzzleClient($endpoint)
    {
        $headers = [];

        if (is_array($endpoint)) {
            $headers = $endpoint['headers'];
            $endpoint = $endpoint['url'];
        }

        return new Client([
            'base_uri' => $endpoint,
            "headers" => $headers
        ]);
    }

    /**
     * get
     *
     * @param  mixed $uri
     * @param  mixed $query
     * @param  mixed $options
     * @return void
     */
    public function get(string $uri = "", array $query = [], array $options = [])
    {
        $options['query'] = $query;

        return $this->call("GET", $uri, $options);
    }

    /**
     * post
     *
     * @param  mixed $uri
     * @param  mixed $params
     * @param  mixed $options
     * @return void
     */
    public function post(string $uri = "", array $params = [], array $options = [])
    {
        if (!empty($query)) {
            $options['form_params'] = $params;
        }

        return $this->call("POST", $uri, $options);
    }

    protected function call(string $method, string $uri = "", array $options = [])
    {
        $this->stringBody = "";

        $options["headers"] = $this->getRequestHeaders($options);

        $options["query"] = $this->getQueries($options);

        $options['connect_timeout'] = 10.0;

        return $this->send($method, $uri, $options);
    }

    protected function send(string $method, string $uri, array $options)
    {
        try {
            $this->response = $this->client->request($method, $uri, $options);
            $this->statusCode = $this->response->getStatusCode();
        } catch (ClientException $e) {
            dd($e);
        }

        return $this->response;
    }

    protected function getRequestHeaders(array $options)
    {
        $headers = [];

        if (isset($options['headers'])) {
            $headers = $options['headers'] + $this->getHeaderFromOriginalRequest();
        } else {
            $headers = $this->getHeaderFromOriginalRequest();
        }

        return $this->headers ? $this->headers + $headers : $headers;
    }

    protected function getHeaderFromOriginalRequest()
    {
        $results['content-type'] = "application/x-www-form-urlencode";

        $keys = ['user-agent', 'accept-encoding', 'accept', 'accept-language'];

        $headers = $this->request->header();

        foreach ($keys as $key) {
            if (isset($headers[$key])) {
                $results[$key] = $headers[$key];
            }
        }

        return $results;
    }

    protected function getQueries(array $options)
    {
        if (isset($options['query'])) {
            return $options['query'] + $this->getQueriesFromOriginalRequest();
        } else {
            return $this->getQueriesFromOriginalRequest();
        }
    }

    protected function getQueriesFromOriginalRequest()
    {
        return $this->request->query();
    }
}
