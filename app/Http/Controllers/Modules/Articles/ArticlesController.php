<?php

namespace App\Http\Controllers\Modules\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articles\Article;
use App\Models\Articles\ArticleAlliedMedia;
use App\Models\Articles\ArticleCountry;
use App\Models\Articles\ArticleRegion;
use App\Models\Articles\ArticleStatus;
use App\Models\Articles\ArticleTag;
use App\Models\Articles\ArticleType;
use App\Models\Articles\Template;
use App\Models\Specials\Special;
use stdClass;

class ArticlesController extends Controller
{
    const FROM_TABLE_MAIN = 'articles as a';
    const STATUS_EDITING = 2;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the module articles.
     * GET /admin/articles
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $specials = Special::getDataBasic()->get();
        $statuses = ArticleStatus::get();

        return view(
            'pages.admin.articles.module.index',
            compact('specials', 'statuses')
        );
    }

    /**
     * List articles
     * POST /admin/articles/list
     */
    public function list(Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $search = $request->get('_search');
        $specialId = $request->get('_special_id');
        $statusId = $request->get('_status_id');

        $articles = Article::select(
            'a.id',
            'a.name',
            'a.publication_date',
            'a.slug',
            'a.article_type_id',
            'at.name as article_type_name',
            'a.number_views',
            'as.id as status_id',
            'as.name as status_name',
            'as.label as status_label'
        )
            ->from(self::FROM_TABLE_MAIN)
            ->join('article_status as as', 'as.id', 'a.status_id')
            ->join('article_types as at', 'at.id', 'a.article_type_id')
            ->search($search)
            ->special($specialId)
            ->status($statusId)
            ->orderBy('a.id', 'DESC')
            ->paginate($row);

        return $this->responseJson(true, 'list articles', $articles);
    }

    /**
     * Data modal create article
     * GET /admin/articles/create
     */
    public function createInfo(Request $request)
    {
        $data = new stdClass();
        $data->articleTypes = ArticleType::get();
        $data->specials = Special::getDataBasic()->get();

        return $this->responseJson(true, 'create information', $data);
    }

    /**
     * Create user
     * POST /admin/articles
     */
    public function create(Request $request)
    {
        /** validate */
        $request->validate([
            'name' => 'required|max:255',
            'publication_date' => 'required',
            'special_id' => 'integer|nullable',
            'article_type_id' => 'integer|required',
            'country_ids' => 'string|nullable',
            'region_ids' => 'string|nullable',
            'tags_ids' => 'string|nullable',
        ]);

        /** article creation */
        $article = new Article($request->all());
        $article->slug = $this->_getUuidArticle($request->name);
        $article->status_id = self::STATUS_EDITING;
        $article->special_id = $request->special_id ?? 1;
        $article->number_views = 0;
        $article->save();

        if ($request->region_ids) {
            $this->_setArticleRegions(
                $article->id,
                explode(',', $request->region_ids)
            );
        }
        if ($request->country_ids) {
            $this->_setArticleCountries(
                $article->id,
                explode(',', $request->country_ids)
            );
        }
        if ($request->tags_ids) {
            $this->_setArticleTags(
                $article->id,
                explode(',', $request->tags_ids)
            );
        }

        return $this->responseJson(true, 'article created', $article);
    }

    /**
     * Data modal status special
     * PATCH /admin/articles/status
     */
    public function status(Request $request)
    {
        /** validate */
        $request->validate([
            'id' => 'required|integer',
            'status_id' => 'required|integer',
        ]);

        $status = ArticleStatus::find($request->status_id);
        if (!$status) {
            return $this->responseJson(false, 'status not found');
        }

        if (
            $request->status_id == ArticleStatus::PUBLISHED_STATUS &&
            !$request
                ->user()
                ->hasPermissionTo(ArticleStatus::PUBLISHED_PERMISSION)
        ) {
            return $this->responseJson(
                false,
                'El usuario no tiene permisos para esta acción'
            );
        }

        $article = Article::find($request->id);
        if (!$article) {
            return $this->responseJson(false, 'article not found');
        }

        $article->status_id = $request->status_id;
        $article->save();

        return $this->responseJson(true, 'update information');
    }

    /**
     * Data modal url article
     * PATCH /admin/articles/slug
     */
    public function slug(Request $request)
    {
        /** validate */
        $request->validate([
            'id' => 'required|integer',
            'slug' => 'required|string',
        ]);

        $article = Article::find($request->id);
        if (!$article) {
            return $this->responseJson(false, 'article not found');
        }

        if ($article->slug == $request->slug) {
            return $this->responseJson(true, 'update information');
        }

        $articleRepeat = Article::where('slug', $request->slug)->first();
        if ($articleRepeat) {
            return $this->responseJson(
                false,
                'El nombre de URL ya se encuentra ocupado'
            );
        }

        $article->slug = $request->slug;
        $article->save();

        return $this->responseJson(true, 'update information');
    }

    /**
     * Data modal update
     * GET /admin/articles/update
     */
    public function updateInfo(Request $request)
    {
        $request->validate([
            '_id' => 'required',
        ]);

        $articleTags = ArticleTag::select('t.id', 't.name')
            ->from('article_tags as st')
            ->join('agendapropia_utils.tags as t', 'st.tag_id', 't.id')
            ->where('st.article_id', $request->_id)
            ->get();
        $articleCountries = ArticleCountry::select('c.id', 'c.name')
            ->from('article_countries as sc')
            ->join('agendapropia_users.countries as c', 'sc.country_id', 'c.id')
            ->where('sc.article_id', $request->_id)
            ->get();
        $articleRegions = ArticleRegion::select('r.id', 'r.name')
            ->from('article_regions as ar')
            ->join('agendapropia_utils.regions as r', 'ar.region_id', 'r.id')
            ->where('ar.article_id', $request->_id)
            ->get();

        $article = Article::where('id', $request->_id)->first();
        $articleTypes = ArticleType::get();
        $specials = Special::getDataBasic()->get();

        $data = new stdClass();
        $data->article = $article;
        $data->specials = $specials;
        $data->articleTypes = $articleTypes;
        $data->tags = $articleTags;
        $data->countries = $articleCountries;
        $data->regions = $articleRegions;

        return $this->responseJson(true, 'update information', $data);
    }

    /**
     * Update
     * PUT /admin/articles
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|max:255',
            'publication_date' => 'required',
            'special_id' => 'integer|nullable',
            'article_type_id' => 'integer|required',
            'country_ids' => 'string|nullable',
            'region_ids' => 'string|nullable',
            'tags_ids' => 'string|nullable',
        ]);

        $article = Article::find($request->id);
        if (!$article) {
            $this->responseJson(false, 'article not found');
        }

        $article->fill($request->all());
        $article->special_id = $request->special_id ?? 1;
        $article->save();

        $this->_validateArticleRegions(
            $request->id,
            $request->region_ids ? explode(',', $request->region_ids) : []
        );
        $this->_validateArticleTags(
            $request->id,
            $request->tags_ids ? explode(',', $request->tags_ids) : []
        );
        $this->_validateArticleCountries(
            $request->id,
            $request->country_ids ? explode(',', $request->country_ids) : []
        );

        return $this->responseJson(true, 'article update', $article);
    }

    /** -------------------- PRIVATE -------------------- */
    protected function _getUuidArticle($name)
    {
        $name = strtolower($name);

        $slug = str_replace(' ', '-', $name);
        $slug = preg_replace('([^A-Za-z0-9-])', '', $slug);

        $validate = false;
        $slug_query = $slug;
        for ($i = 1; $i < 21; $i++) {
            if (
                !Article::select('id')
                    ->where('slug', $slug_query)
                    ->first()
            ) {
                $validate = true;
                $slug = $slug_query;
                break;
            } else {
                $slug_query = $slug . '-' . $i;
            }
        }

        return $validate ? $slug : false;
    }

    protected function _validateArticleCountries(int $id, array $array)
    {
        $field = 'country_id';
        $currentArray = ArticleCountry::select($field)
            ->where('article_id', $id)
            ->get();

        $arrayAdd = [];
        $arrayRemove = [];
        foreach ($array as $am) {
            if (!$currentArray->where($field, $am)->first() && $am != '') {
                $arrayAdd[] = $am;
            }
        }

        foreach ($currentArray->toArray() as $cam) {
            $need = (string) $cam[$field];
            if (!in_array($need, $array)) {
                $arrayRemove[] = $need;
            }
        }
        if ($arrayAdd) {
            $this->_setArticleCountries($id, $arrayAdd);
        }
        if ($arrayRemove) {
            $this->_removeArticleCountries($id, $arrayRemove);
        }
    }
    protected function _setArticleCountries(int $articleId, array $countries)
    {
        foreach (array_unique($countries) as $country) {
            $item = new ArticleCountry();
            $item->country_id = $country;
            $item->article_id = $articleId;
            $item->save();
        }
    }
    protected function _removeArticleCountries(int $articleId, array $countries)
    {
        foreach (array_unique($countries) as $country) {
            ArticleCountry::where('country_id', $country)
                ->where('article_id', $articleId)
                ->delete();
        }
    }

    protected function _validateArticleTags(int $id, array $array)
    {
        $field = 'tag_id';
        $currentArray = ArticleTag::select($field)
            ->where('article_id', $id)
            ->get();

        $arrayAdd = [];
        $arrayRemove = [];
        foreach ($array as $am) {
            if (!$currentArray->where($field, $am)->first() && $am != '') {
                $arrayAdd[] = $am;
            }
        }

        foreach ($currentArray->toArray() as $cam) {
            $need = (string) $cam[$field];
            if (!in_array($need, $array)) {
                $arrayRemove[] = $need;
            }
        }

        if ($arrayAdd) {
            $this->_setArticleTags($id, $arrayAdd);
        }
        if ($arrayRemove) {
            $this->_removeArticleTags($id, $arrayRemove);
        }
    }
    protected function _setArticleTags(int $articleId, array $tags)
    {
        foreach (array_unique($tags) as $tag) {
            $item = new ArticleTag();
            $item->tag_id = $tag;
            $item->article_id = $articleId;
            $item->save();
        }
    }
    protected function _removeArticleTags(int $articleId, array $tags)
    {
        foreach (array_unique($tags) as $tag) {
            ArticleTag::where('tag_id', $tag)
                ->where('article_id', $articleId)
                ->delete();
        }
    }

    protected function _validateArticleRegions(int $id, array $array)
    {
        $field = 'region_id';
        $currentArray = ArticleRegion::select($field)
            ->where('article_id', $id)
            ->get();

        $arrayAdd = [];
        $arrayRemove = [];
        foreach ($array as $am) {
            if (!$currentArray->where($field, $am)->first() && $am != '') {
                $arrayAdd[] = $am;
            }
        }

        foreach ($currentArray->toArray() as $cam) {
            $need = (string) $cam[$field];
            if (!in_array($need, $array)) {
                $arrayRemove[] = $need;
            }
        }

        if ($arrayAdd) {
            $this->_setArticleRegions($id, $arrayAdd);
        }

        if ($arrayRemove) {
            $this->_removeArticleRegions($id, $arrayRemove);
        }
    }
    protected function _setArticleRegions(int $articleId, array $regions)
    {
        foreach (array_unique($regions) as $region) {
            $item = new ArticleRegion();
            $item->region_id = $region;
            $item->article_id = $articleId;
            $item->save();
        }
    }
    protected function _removeArticleRegions(int $articleId, array $regions)
    {
        foreach (array_unique($regions) as $region) {
            ArticleRegion::where('region_id', $region)
                ->where('article_id', $articleId)
                ->delete();
        }
    }
}
