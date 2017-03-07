<?php
declare (strict_types=1);

namespace Snelling;

class Request
{

    /**
     * @return mixed
     */
    public function cookies()
    {
        return $_COOKIE;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $_GET;
    }

    /**
     * @return bool
     */
    public function gzip(): bool
    {
        $server = $this->server();

        return (isset($server['HTTP_ACCEPT_ENCODING']) && substr_count($server['HTTP_ACCEPT_ENCODING'], 'gzip'));
    }

    /**
     * @return array
     */
    public function headers(): array
    {
        $headers = [];
        $server  = $this->server();
        foreach ($server as $name => $value) {
            if (strpos($name, 'HTTP_') === 0) {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }

        return $headers;
    }

    /**
     * @return string
     */
    public function input()
    {
        return file_get_contents('php://input');
    }

    /**
     * @return string
     */
    public function ip(): string
    {
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['HTTP_X_FORWARDED'] ?? $_SERVER['HTTP_FORWARDED_FOR'] ?? $_SERVER['HTTP_FORWARDED'] ?? $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

        if ($ipAddress === '::1') {
            $ipAddress = '0.0.0.0';
        }

        return $ipAddress;
    }

    /**
     * @return mixed
     */
    public function post()
    {
        return $_POST;
    }

    /**
     * @return mixed
     */
    public function server()
    {
        return $_SERVER;
    }

    /**
     * @return string
     */
    public function subdomain(): string
    {
        $host   = $this->server()['HTTP_HOST'] ?? '';
        $pieces = explode('.', $host);
        if (count($pieces) > 2 && $pieces[0] !== 'www') {
            return $pieces[0];
        }

        return '';
    }

    /**
     * @return string
     */
    public function useragent(): string
    {
        $server = $this->server();

        return $server['HTTP_USER_AGENT'] ?? 'INTERNAL';
    }
}
