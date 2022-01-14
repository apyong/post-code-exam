<?php

namespace Database\Seeders;

use App\Models\PostType;
use Illuminate\Database\Seeder;

class PostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postTypes = [
            ['name' => 'Feature Request'],
            ['name' => 'Bug'],
            ['name' => 'Inquiry'],
        ];

        //check if post type is empty
        if (\DB::table('post_types')->count() == 0) {
            foreach ($postTypes as $postType) {
                PostType::create($postType);
            }
        }
    }
}
