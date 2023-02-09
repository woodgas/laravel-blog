<?php


//        $query->when($filters['category'] ?? false, fn ($query, $category) =>
//            $query->whereExists(fn ($query) =>
//                    $query
//                        ->from('categories')
//                        ->whereColumn('posts.category_id', 'categories.id')
//                        ->where('categories.slug', '=', $category)
//                ));

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Post extends Model
{
    use HasFactory;

//    protected $guarded =[];
//      protected $guarded = ['*'];

    protected $fillable = [
        'user_id',
        'category_id',
        'slug',
        'thumbnail',
        'title',
        'excerpt',
        'body',
        'status',
        'user_id'
    ];
    protected $with = ['category', 'author'];

    public function scopeFilter(Builder $query, array $filters) {

        $query->when($filters['category'] ?? false, fn ($query, $category) =>
            $query->whereHas('category', fn($query) =>
                $query->where('slug', '=', $category)
        ));

        $query->when($filters['author'] ?? false, fn ($query, $author) =>
        $query->whereHas('author', fn($query) =>
        $query->where('username', '=', $author)
        ));

        $query->when($filters['search'] ?? false, fn($query, $search) =>
        $query->where(fn($query) => // обертка для запросов. Запрос включает оператор OR. Обертка добавляет скобки.
        $query
            ->where('title', 'like', "%{$search}%")
            ->orWhere('body', 'like', "%{$search}%")));
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
