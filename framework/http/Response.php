<?php

namespace Yelarys\Framework\Http;

class Response
{
    public function __construct(
        private string $content,
        private int $statusCode=200,
    )
    {
    }
    public function send()
    {
        echo $this->content;
    }

}