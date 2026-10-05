<?php

namespace App\Traits;

trait HtmxRequest
{
    public function isHxRequest(): bool
    {
        return request()->hasHeader('HX-Request');
    }

    public function isHxBoosted(): bool
    {
        return $this->isHxRequest() && request()->hasHeader('HX-Boosted');
    }

    public function isHxAjax(): bool
    {
        $request = request();
        return $this->isHxRequest() && !$this->isHxBoosted();
    }
}
