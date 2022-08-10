<?php

namespace Core\Middleware;

interface IMiddleware
{
    public function handler($request, $next);
}