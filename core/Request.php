<?php

class Request
{
    private string $uri;
    private string $method;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';

        // تنظيف الرابط من / الزائدة
        $this->uri = rtrim($this->uri, '/');

        if ($this->uri === '') {
            $this->uri = '/';
        }
    }

    /**
     * الحصول على الرابط الحالي
     */
    public function uri(): string
    {
        return $this->uri;
    }

    /**
     * الحصول على نوع الطلب
     */
    public function method(): string
    {
        return $this->method;
    }
}