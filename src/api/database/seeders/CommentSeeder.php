<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'user_id' => 2,
                'anime_id' => 88,
                'comment' => 'コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメント',
                'stars' => 3,
            ],
            [
                'user_id' => 2,
                'anime_id' => 88,
                'comment' => 'コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメント',
                'stars' => 4,
            ],
            [
                'user_id' => 2,
                'anime_id' => 88,
                'comment' => 'コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメント',
                'stars' => 3,
            ],
            [
                'user_id' => 2,
                'anime_id' => 88,
                'comment' => 'コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメント',
                'stars' => 5,
            ],
            [
                'user_id' => 2,
                'anime_id' => 88,
                'comment' => 'コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメント',
                'stars' => 2,
            ],
        ]);
    }
}
