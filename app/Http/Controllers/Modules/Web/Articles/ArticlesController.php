<?php

namespace App\Http\Controllers\Modules\Web\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articles\Article;
use App\Models\Articles\ArticleContent;
use App\Models\Articles\ArticleFile;
use App\Models\Articles\ArticleStatus;
use App\Models\Articles\ArticleUser;
use App\Models\Specials\Special;
use App\Models\User;
use App\Models\Utils\File;
use App\Models\Utils\Language;

class ArticlesController extends Controller
{
    const FROM_TABLE_MAIN = 'articles as a';
    const STATUS_EDITING = 2;
    const STATUS_APPROVED = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the page article.
     * GET /articles/{slug}
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($articleSlug, Request $request)
    {
        $article = Article::where('slug', $articleSlug)
            ->where('status_id', self::STATUS_APPROVED)
            ->first();
        if (!$article) {
            return redirect()->route('/');
        }

        $content = ArticleContent::where('article_id', $article->id)
            ->where('language_id', 1)
            ->first();

        $users = ArticleUser::getUsersByArticleId($article->id)->get();
        $users = File::setPathAndImageDefault($users, 2);

        $imageCover = ArticleFile::getImageByType(
            $article->id,
            ArticleFile::TYPE_COVER
        )->first();
        if ($imageCover) {
            $imageCover->name_tmp = File::setPathPublicImagen(
                $imageCover->name_tmp,
                2
            );
        }

        return view(
            'pages.web.articles.index',
            compact('article', 'imageCover', 'content', 'users')
        );
    }
}
