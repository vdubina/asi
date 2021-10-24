<?php

namespace Database\Seeders;

use App\Models\TaxonomyContentBlockType;
use Illuminate\Database\Seeder;

class TaxonomyContentBlockTypeTableSeeder extends Seeder
{
    public function run()
    {
        $blocks = [
            [
                'id'                 => 1,
                'name'               => 'Testimonials',
                'fa_icon'              => 'comments',
            ],
            [
                'id'                 => 2,
                'name'               => 'Questions',
                'fa_icon'              => 'question-circle',
            ],
            [
                'id'                 => 3,
                'name'               => 'Left Column Blocks',
                'fa_icon'              => 'align-left',
            ],
            [
                'id'                 => 4,
                'name'               => 'Right Column Blocks',
                'fa_icon'              => 'align-right',
            ],
            [
                'id'                 => 5,
                'name'               => 'Bottom Blocks',
                'fa_icon'              => 'sort-amount-down',
            ],

        ];

        TaxonomyContentBlockType::insert($blocks);
    }
}
