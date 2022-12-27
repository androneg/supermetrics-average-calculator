<?php

$url = 'https://api.supermetrics.com/assignment/register';

$data = array(
    'client_id' => 'ju16a6m81mhid5ue1z3v2g0uh',
    'email'     => 'balasanyan@gmail.com',
    'name'      => 'Andranik Balasanyan');

class pullRequest
{
    private string $url;
    private array $data;

    public function __construct($url, $data)
    {
        $this->url = $url;
        $this->data = $data;
    }

    private function getUrl(): string
    {
        return $this->url;
    }

    private function getData(): array
    {
        return $this->data;
    }

    private function getHeader($query): array
    {
        return array(
            "Content-Type: application/x-www-form-urlencoded",
            "Content-Length: " . strlen($query)
        );
    }

    private function getQuery(): string
    {
        return http_build_query($this->getData());
    }

    private function getFileContent(): string|bool
    {
        $query = $this->getQuery();
        $options = array(
            'http' => array('method' => 'POST',
                'content' => $query,
                'header' => implode("\r\n", $this->getHeader($query))));

        // Create a context stream with the given options
        $stream = stream_context_create($options);

        try
        {
            return  file_get_contents($this->getUrl(), false, $stream);
        }
        catch (Exception $e)
        {
            die("Error : " . $e->getMessage() . "\n");
        }
    }

    public function getToken(): string | NULL
    {
        $tokenInfo = json_decode($this->getFileContent(), true);
        return is_array($tokenInfo) ? $tokenInfo['data']['sl_token'] : NULL;
    }

}

$obj = new pullRequest($url, $data);
print("Token : " . $obj->getToken());

