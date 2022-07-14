<?php

namespace App\Http\Controllers\Modules\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articles\AlliedMedia;
use App\Models\Articles\Article;
use App\Models\Articles\ArticleContent;
use App\Models\Utils\File;
use App\Models\Utils\Language;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleContentsController extends Controller
{
    const FROM_TABLE_MAIN = 'article_contents as sc';
    const LANGUAGE_DEFAULT = 1;
    const STATUS_EDIT = 2;
    const STATUS_OK = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the module allied media.
     * GET /admin/articles/allied-media
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($articleSlug)
    {
        $article = Article::where('slug', $articleSlug)->first();
        if (!$article) {
            return redirect()->route('module-article');
        }

        $languages = Language::get();

        return view(
            'pages.admin.articles.contents.index',
            compact('article', 'languages')
        );
    }

    /**
     * Data modal update
     * GET /admin/articles/{$slug}/contents/update
     */
    public function updateInfo($slug, Request $request)
    {
        $request->validate([
            '_language_id' => 'integer|required',
        ]);

        $article = Article::where('slug', $slug)->first();
        if (!$article) {
            return redirect()->route('module-article');
        }

        $content = ArticleContent::where('article_id', $article->id)
            ->where('language_id', $request->_language_id)
            ->first();

        if (!$content) {
            $articleContent = new ArticleContent();
            $articleContent->status_id = self::STATUS_EDIT;
            $articleContent->article_id = $article->id;
            $articleContent->language_id = $request->_language_id;
            $articleContent->title = $article->name;
            $articleContent->save();

            $content = $articleContent;
        }

        $data = [
            'content' => $content,
        ];

        return $this->responseJson(true, 'update information', $data);
    }

    /**
     * Update
     * PUT /admin/articles/{$slug}/contents
     */
    public function update($slug, Request $request)
    {
        $request->validate([
            '_language_id' => 'integer|required',
            '_content' => 'string|nullable',
            '_title' => 'string|nullable',
            '_subtitle' => 'string|nullable',
            '_summary' => 'string|nullable',
            '_status_id' => 'required|integer',
        ]);

        $article = Article::where('slug', $slug)->first();
        if (!$article) {
            return $this->responseJson(false, 'article not found');
        }

        $content = ArticleContent::where('article_id', $article->id)
            ->where('language_id', $request->_language_id)
            ->first();
        if (!$content) {
            return $this->responseJson(false, 'article content not found');
        }

        $content->content = $request->_content;
        $content->title = $request->_title;
        $content->subtitle = $request->_subtitle;
        $content->summary = $request->_summary;
        $content->status_id = $request->_status_id;
        $content->save();

        return $this->responseJson(true, 'article content update');
    }

    /**
     * Copy content
     * PUT /admin/articles/{$slug}/contents/copies
     */
    public function copy($slug, Request $request)
    {
        $request->validate([
            'language_id' => 'integer|required',
            'article_content_id' => 'required|integer',
        ]);

        $article = Article::where('slug', $slug)->first();
        if (!$article) {
            return $this->responseJson(false, 'article not found');
        }

        $content = ArticleContent::where('article_id', $article->id)
            ->where('language_id', $request->language_id)
            ->first();
        if (!$content) {
            return $this->responseJson(false, 'article content not found');
        }

        $contentByCopy = ArticleContent::where(
            'id',
            $request->article_content_id
        )->first();
        if (!$contentByCopy) {
            return $this->responseJson(false, 'article content copy not found');
        }

        $content->content = $contentByCopy->content;
        $content->title = $contentByCopy->title;
        $content->subtitle = $contentByCopy->subtitle;
        $content->summary = $contentByCopy->summary;
        $content->save();

        return $this->responseJson(true, 'article content update');
    }

    /**
     * GET search by autocomplete
     * POST /admin/articles/contents/search-by-autocomplete
     */
    public function searchByAutocomplete(Request $request)
    {
        $search = $request->get('_search');
        $row = $request->get('_row') ?? 10;
        $contents = ArticleContent::select(
            'sc.id',
            DB::raw('CONCAT(sc.title, " (", l.name, ")") as name')
        )
            ->from(self::FROM_TABLE_MAIN)
            ->join(
                'agendapropia_utils.languages as l',
                'l.id',
                'sc.language_id'
            )
            ->search($search)
            ->limit($row)
            ->get();

        return $this->responseJson(true, 'list contents', $contents);
    }

    /**
     * list allied media files
     * GET /admin/articles/allied-media/files
     */
    public function files(Request $request)
    {
        $request->validate([
            '_id' => 'required|integer',
        ]);

        $files = AlliedMedia::select(
            'am.id',
            'f.name',
            'f.name_tmp',
            'f.creator_user_id as author_id',
            'f.author as author_name',
            'f.description',
            'f.ext'
        )
            ->from(self::FROM_TABLE_MAIN)
            ->join('agendapropia_utils.files as f', 'f.name_tmp', 'am.image')
            ->where('am.id', $request->_id)
            ->get();

        return $this->responseJson(true, 'files', $files);
    }

    /**
     * Create allied media files
     * POST /admin/articles/allied-media/files
     */
    public function createFiles(Request $request)
    {
        $request->validate([
            'external_id' => 'required|integer',
            'source_id' => 'required|integer',
            'files' => 'required|nullable',
            'files_delete' => 'required|nullable',
        ]);

        $user = Auth::user();
        $id = $request->get('id');

        /** delete files */
        foreach (json_decode($request->get('files_delete')) as $file) {
            $fileDelete = AlliedMedia::findOrFail($file);
            $fileDelete->image = File::IMAGE_DEFAULT;
            $fileDelete->save();
        }

        /** create new files */
        foreach (json_decode($request->get('files')) as $file) {
            if ($file->type == 1) {
                File::createFile($file, $user, true);

                $alliedMediaUpdate = AlliedMedia::findOrFail($id);
                $alliedMediaUpdate->image = $file->name_tmp;
                $alliedMediaUpdate->save();
            } else {
                $alliedMediaUpdate = AlliedMedia::findOrFail($id);
                $alliedMediaUpdate->image = $file->name_tmp;
                $alliedMediaUpdate->save();

                File::updateFile(false, $file->name_tmp, $file);
            }
        }

        return $this->responseJson(true, 'files created.', []);
    }
}
