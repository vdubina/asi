<?php

namespace App\Repositories;

use App\Repositories\Interfaces\AsiMainRepositoryInterface;

class AsiMainRepository implements AsiMainRepositoryInterface
{
    public function courses()
    {
        return [
            ['title'=>'Sample Course'],
            ['title'=>'Sample Course'],
            ['title'=>'Sample Course'],
            ['title'=>'Sample Course'],
        ];
    }

    public function topics()
    {
        return [
            ['title'=>'Sample Topic'],
            ['title'=>'Sample Topic'],
            ['title'=>'Sample Topic'],
            ['title'=>'Sample Topic'],
            ['title'=>'Sample Topic'],
            ['title'=>'Sample Topic'],
            ['title'=>'Sample Topic'],
            ['title'=>'Sample Topic'],
            ['title'=>'Sample Topic'],
            ['title'=>'Sample Topic'],

        ];
    }

    public function taxonomy()
    {
        return [
            ['title'=>'Sample Taxonomy'],
            ['title'=>'Sample Taxonomy'],
            ['title'=>'Sample Taxonomy'],
            ['title'=>'Sample Taxonomy'],
            ['title'=>'Sample Taxonomy'],
            ['title'=>'Sample Taxonomy'],
            ['title'=>'Sample Taxonomy'],
        ];
    }

}
