<?php

namespace App\Controller;

use Interop\Container\ContainerInterface;

class LegalController {
    protected $ci;
    public function __construct(ContainerInterface $ci) {
       $this->ci = $ci;
    }

    public function mentions($request, $response, $args) {
        $this->ci->get('renderer')->render($response, "mentions.html", $args);
    }

    public function plan($request, $response, $args) {
        $this->ci->get('renderer')->render($response, "plan.html", $args);
    }
}
