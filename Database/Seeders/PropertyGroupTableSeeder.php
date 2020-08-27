<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Entities\Mongo\PropertyGroup;

class PropertyGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['name' => 'Hoa gai', 'source_db' => config('mongo.source_db.central'), 'tenant_uid' => null, 'locale' => app()->getLocale(), 'status' => 1];
        PropertyGroup::create($data);
    }
}
