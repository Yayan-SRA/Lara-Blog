<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Sofyan Rizki Afandy',
            'username' => 'kuuhaku',
            'email' => 'yayansra123@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        // User::create([
        //     'name' => 'Risma Irfiyani',
        //     'email' => 'irfiyanirisma123@gmail.com',
        //     'password' => bcrypt('123456'),
        // ]);
        User::factory(5)->create();

        Category::create([
            'name' =>  'Programming',
            'slug' => 'programming'
        ]);

        Category::create([
            'name' =>  'Web Design',
            'slug' => 'web-design'
        ]);

        Category::create([
            'name' =>  'Personal',
            'slug' => 'personal'
        ]);

        Post::factory(20)->create();
        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'category_id' => 1,
        //     'user_id' => 1,
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. A officia aliquam nobis possimus?',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A officia aliquam nobis possimus? Mollitia ab impedit iste. Incidunt dolorem doloremque libero illum quas eum, illo quod, nostrum dicta a excepturi. Vero eligendi ut praesentium ratione officia nemo provident quae, aliquid tempore, repellat minima ipsa delectus reprehenderit quidem. Nisi expedita quam corrupti eligendi eius. </p><p>Expedita accusamus adipisci aliquid sapiente iste obcaecati fugiat voluptate veniam, exercitationem ad dolore ipsum porro nulla tempore facilis corrupti beatae natus necessitatibus? Pariatur atque repudiandae, incidunt perspiciatis cupiditate nihil sit quisquam recusandae a quod officia necessitatibus in voluptates.</p><p> Aliquam labore eaque libero laboriosam tenetur eos amet non tempora, commodi velit voluptatum, sint molestiae perspiciatis dolorem quasi. Nemo necessitatibus, ut sapiente consectetur nam recusandae id assumenda dolorum dignissimos.</p>',
        // ]);

        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'category_id' => 2,
        //     'user_id' => 2,
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. A officia aliquam nobis possimus?',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A officia aliquam nobis possimus? Mollitia ab impedit iste. Incidunt dolorem doloremque libero illum quas eum, illo quod, nostrum dicta a excepturi. Vero eligendi ut praesentium ratione officia nemo provident quae, aliquid tempore, repellat minima ipsa delectus reprehenderit quidem. Nisi expedita quam corrupti eligendi eius. </p><p>Expedita accusamus adipisci aliquid sapiente iste obcaecati fugiat voluptate veniam, exercitationem ad dolore ipsum porro nulla tempore facilis corrupti beatae natus necessitatibus? Pariatur atque repudiandae, incidunt perspiciatis cupiditate nihil sit quisquam recusandae a quod officia necessitatibus in voluptates.</p><p> Aliquam labore eaque libero laboriosam tenetur eos amet non tempora, commodi velit voluptatum, sint molestiae perspiciatis dolorem quasi. Nemo necessitatibus, ut sapiente consectetur nam recusandae id assumenda dolorum dignissimos.</p>',
        // ]);

        // Post::create([
        //     'title' => 'Judul Ketiga',
        //     'category_id' => 3,
        //     'user_id' => 1,
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. A officia aliquam nobis possimus?',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A officia aliquam nobis possimus? Mollitia ab impedit iste. Incidunt dolorem doloremque libero illum quas eum, illo quod, nostrum dicta a excepturi. Vero eligendi ut praesentium ratione officia nemo provident quae, aliquid tempore, repellat minima ipsa delectus reprehenderit quidem. Nisi expedita quam corrupti eligendi eius. </p><p>Expedita accusamus adipisci aliquid sapiente iste obcaecati fugiat voluptate veniam, exercitationem ad dolore ipsum porro nulla tempore facilis corrupti beatae natus necessitatibus? Pariatur atque repudiandae, incidunt perspiciatis cupiditate nihil sit quisquam recusandae a quod officia necessitatibus in voluptates.</p><p> Aliquam labore eaque libero laboriosam tenetur eos amet non tempora, commodi velit voluptatum, sint molestiae perspiciatis dolorem quasi. Nemo necessitatibus, ut sapiente consectetur nam recusandae id assumenda dolorum dignissimos.</p>',
        // ]);
    }
}
