<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Cartegory;
use App\Models\Country;
use App\Models\Image;
use App\Models\Product;
use App\Models\Role;
use App\Models\Shop;
use App\Models\SubCategory;
use App\Models\User;
use Database\Factories\CartegoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\Constraint\Count;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(4)->hasimage(1)->create();

        // Cartegory::factory(10)->hasimage(1)->create();

        // User::factory(16)
        //     ->has(Cart::factory()
        //         ->has(Product::factory()
        //             ->has(Image::factory()
        //                 ->count(6))
        //             ->count(8))
        //         ->count(1))
        //     ->has(Image::factory()
        //         ->count(1))
        //     ->create();

        Country::factory(6)
            ->has(
                Cartegory::factory()

                    ->has(Product::factory()
                        ->has(Image::factory()
                            ->count(6))

                        ->count(100))
                    ->has(Image::factory()
                        ->count(1))
                    ->count(12)
            )
            ->has(Image::factory()
                ->count(1))
            ->has(User::factory()
                ->has(Image::factory()
                    ->count(1))
                ->count(100))
            ->create();

        $user1 =  User::create([
            'name' => 'demo',
            'email' => 'demo@demo.com',
            'email_verified_at' => null,
            'password' => '$2y$10$DFSbhKcvclUXEQ68Y0zA9ODESp6n6yEr8ygmgillgDDuRwyfH6weO',
            'mobile' => '+254 758153416',
            'country_id' => 1,
            'role' => 'admin',
        ]);

        $user1->image()->create([
            'path' => '/avatar/avatar.png'
        ]);

        $user2 =  User::create([
            'name' => 'demo',
            'email' => 'jamesjoshua@demo.com',
            'email_verified_at' => null,
            'password' => '$2y$10$DFSbhKcvclUXEQ68Y0zA9ODESp6n6yEr8ygmgillgDDuRwyfH6weO',
            'mobile' => '+254 758153416',
            'country_id' => 1,
            'role' => 'admin',
        ]);

        $user2->image()->create([
            'path' => '/avatar/avatar.png'
        ]);

        $shop1 = Shop::create([
            'name' => 'Josh and sons',
            'city' => 'Nairobi',
            'user_id' => $user1->id,
            'region' => 'Eastern',
            'sub_region' => 'Kitui',
            'description' => 'I sell ndundus for income',
            'phone_number' => '+254758153416',
            'email' => 'dodsan@gmail.com',
            'approved' => 1,
            'rejected' => 0,
        ]);

        $shop2 = Shop::create([
            'name' => 'Josh and sons',
            'city' => 'Nairobi',
            'user_id' => $user2->id,
            'region' => 'Eastern',
            'sub_region' => 'Kitui',
            'description' => 'I sell ndundus for income',
            'phone_number' => '+254758153416',
            'email' => 'jamesjoshua@gmail.com',
            'approved' => 1,
            'rejected' => 0,
        ]);

        $products = Product::where('id', '<', '10')->pluck('id');

        foreach ($products as $product) {
            Product::find($product)->shop()->attach(1, ['stock' => $product + 7]);
        }

        $products = Product::where('id', '>', 10)->where('id', '<', 20)->pluck('id');

        foreach ($products as $product) {
            Product::find($product)->shop()->attach(2, ['stock' => $product + 13]);
        }
    }
}
