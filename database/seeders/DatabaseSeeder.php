<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $tenant1 = Tenant::create([
            'name' => 'BBC News',
            'slug' => 'bbc-news',
            'domain' => 'bbc.localhost',
        ]);

        $tenant2 = Tenant::create([
            'name' => 'CNN News',
            'slug' => 'cnn-news',
            'domain' => 'cnn.localhost',
        ]);

        $this->call(RolePermissionSeeder::class);



        $admin1 = User::create([
            'name' => 'BBC Admin',
            'email' => 'admin@bbc.com',
            'password' => bcrypt('password'),
            'tenant_id' => $tenant1->id,
        ]);
        $admin1->assignRole('admin');

        $editor1 = User::create([
            'name' => 'BBC Editor',
            'email' => 'editor@bbc.com',
            'password' => bcrypt('password'),
            'tenant_id' => $tenant1->id,
        ]);
        $editor1->assignRole('editor');

        $author1 = User::create([
            'name' => 'BBC Author',
            'email' => 'author@bbc.com',
            'password' => bcrypt('password'),
            'tenant_id' => $tenant1->id,
        ]);
        $author1->assignRole('author');

        $admin2 = User::create([
            'name' => 'CNN Admin',
            'email' => 'admin@cnn.com',
            'password' => bcrypt('password'),
            'tenant_id' => $tenant2->id,
        ]);
        $admin2->assignRole('admin');

        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'derekoduro222@gmail.com',
            'password' => bcrypt('Derek.419'),
            'tenant_id' => null,
        ]);
        $superAdmin->assignRole('super-admin');

        $cat1 = Category::create([
            'name' => 'Technology',
            'slug' => 'technology',
            'tenant_id' => $tenant1->id,
        ]);

        $cat2 = Category::create([
            'name' => 'Sports',
            'slug' => 'sports',
            'tenant_id' => $tenant1->id,
        ]);


        $cat3 = Category::create([
            'name' => 'Politics',
            'slug' => 'politics',
            'tenant_id' => $tenant2->id,
        ]);

        Post::create([
            'title' => 'Latest Tech News',
            'body' => 'This is the latest technology news from BBC.',
            'user_id' => $admin1->id,
            'category_id' => $cat1->id,
            'tenant_id' => $tenant1->id,
        ]);

        Post::create([
            'title' => 'Sports Update',
            'body' => 'Breaking sports news from around the world.',
            'user_id' => $editor1->id,
            'category_id' => $cat2->id,
            'tenant_id' => $tenant1->id,
        ]);

        Post::create([
            'title' => 'Political Headlines',
            'body' => 'Latest political developments from CNN.',
            'user_id' => $admin2->id,
            'category_id' => $cat3->id,
            'tenant_id' => $tenant2->id,
        ]);
    }
}
