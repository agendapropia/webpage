<?php

namespace App\Models\Articles;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleUser extends Model
{
    const DB_TABLE = 'agendapropia_articles.article_users as au';

    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'article_id', 'user_id', 'article_role_id'];

    // scopes
    public function scopeFromDB($query)
    {
        $query->from(self::DB_TABLE);
    }

    // queries
    public function scopeGetUsersByArticleId($query, $articleId)
    {
        $query
            ->select('u.id', 'u.first_name', 'u.last_name', 'u.image as file')
            ->fromDB()
            ->join(User::DB_TABLE, 'u.id', 'au.user_id')
            ->where('article_id', $articleId);
    }
}
