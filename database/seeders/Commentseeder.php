<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Comment;
use App\Models\Product;

class Commentseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $users = User::all();
        $products = Product::all();

        // 5 main comments
        foreach(range(1,50) as $i){
            $comment = Comment::create([
                'product_id' => $products->random()->id,
                'user_id' => $users->random()->id,
                'comment' => 'This is main comment #' . $i,
                'rating' => rand(1,5),
                'parent_id' => null,
                'status' => 'active',
            ]);

            foreach(range(1, rand(1,2)) as $j){
                Comment::create([
                    'product_id' => $comment->product_id,
                    'user_id' => $users->random()->id,
                    'comment' => 'Reply #' . $j . ' to comment #' . $i,
                    'rating' => null,
                    'parent_id' => $comment->id,
                    'status' => 'active',
                ]);
            }
        }
    }
}
