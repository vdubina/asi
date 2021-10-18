<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SampleRepositoryInterface;

class SampleRepository implements SampleRepositoryInterface
{
    public function all()
    {
        return [
            'Hello World'
        ];
    }

}
