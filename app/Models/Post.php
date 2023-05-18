<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable berfungsi untuk mengizinkan field apa saja yang boleh diisi
    // protected $fillable = [
    //     'title',
    //     'excerpt',
    //     'body',
    // ];

    // protected $guarded berfungsi untuk memberitahukan field apa saja dapat diisi kecuali yang ada pada protected $guarded. Mudahnya merupakan kebalikan dari protected $fillable
    protected $guarded = ['id'];



    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            }
        );
        $query->when(
            $filters['category'] ?? false,
            function ($query, $category) {
                return $query->whereHas(
                    'category',
                    function ($query) use ($category) {
                        $query->where('slug', $category);
                    }
                );
            }
        );

        $query->when(
            $fillters['author'] ?? false,
            fn ($query, $author) =>
            $query->whereHas(
                'author',
                fn ($query) =>
                $query->where('username', $author)
            )
        );
        // $query->when(
        //     $fillters['category'] ?? false,
        //     fn ($query, $category) =>
        //     $query->whereHas(
        //         'category',
        //         fn ($query, $category) =>
        //         $query->where('slug', $category)
        //     )
        // );
    }

    protected $with = ['author', 'category'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // kustomisasi untuk pencarian defult yg sebelumnya id diganti dengan slug
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
