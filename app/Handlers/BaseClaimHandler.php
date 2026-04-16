<?php

namespace App\Handlers;

abstract class BaseClaimHandler
{
    protected $next;

    public function setNext(BaseClaimHandler $handler)
    {
        $this->next = $handler;
        return $handler;
    }

    public function handle($claim)
    {
        if ($this->next) {
            return $this->next->handle($claim);
        }
    }
}
