<?php

namespace App\Repositories;

use App\Repositories\Interfaces\AsiRemoteRepositoryInterface;

class AsiRemoteRepository implements AsiRemoteRepositoryInterface
{
    public function courses()
    {
        return [
            ['title'=>'Sample Course']
        ];
    }

    public function topics()
    {
        return [
            ['title'=>'Sample Topic']
        ];
    }

    public function taxonomy()
    {
        return [
            ['title'=>'Sample Taxonomy']
        ];
    }

}
