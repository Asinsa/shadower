<?php

namespace App\Http;
use Illuminate\Support\Facades\Http;

class Facts
{
    protected $facts;

    public function __construct() {
        $this->facts = Http::acceptJson()->get('https://uselessfacts.jsph.pl/random.json?language=en')['text'];
    }

    public function getFact() {
        return(Http::acceptJson()->get('https://uselessfacts.jsph.pl/random.json?language=en')['text']);
    }

}