<?php

namespace App\Http\Controllers\Modules\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articles\ArticleUser;
use App\Models\Utils\File;

class ArticleUsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Create article user
     * POST /admin/articles/users
     */
    public function create(Request $request)
    {
        /** validate */
        $request->validate([
            'article_id' => 'required|integer',
            'article_role_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        $articleUser = ArticleUser::where('article_id', $request->article_id)
            ->where('article_role_id', $request->article_role_id)
            ->where('user_id', $request->user_id)
            ->first();

        if ($articleUser) {
            return $this->responseJson(
                false,
                'the user and role already exist.',
                []
            );
        }

        $new = new ArticleUser($request->all());
        $new->save();

        return $this->responseJson(true, 'article created.', $new);
    }

    /**
     * Delete article user
     * DELETE /admin/articles/users
     */
    public function delete(Request $request)
    {
        $request->validate([
            '_id' => 'required|integer',
        ]);

        $articleUser = ArticleUser::where('id', $request->_id)->first();
        if (!$articleUser) {
            return $this->responseJson(
                false,
                'the user and role not exist.',
                []
            );
        }

        $articleUser->delete();

        return $this->responseJson(true, 'article users deleted.', []);
    }

    /**
     * List article users
     * POST /admin/article/users/list
     */
    public function list(Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $orderByColumn = $request->get('_order_by_column') ?? 'su.id';
        $orderByType = $request->get('_order_by_type') ?? 'DESC';

        $articleUsers = ArticleUser::select(
            'su.id',
            'u.id as user_id',
            'u.first_name as user_first_name',
            'u.last_name as user_last_name',
            'u.image as file',
            'sr.id as role_id',
            'sr.name as role_name'
        )
            ->from('article_users as su')
            ->join('article_roles as sr', 'su.article_role_id', 'sr.id')
            ->join('agendapropia_users.users as u', 'su.user_id', 'u.id')
            ->where('su.article_id', $request->_id)
            ->orderBy($orderByColumn, $orderByType)
            ->paginate($row);

        $articleUsers = File::setPathAndImageDefault($articleUsers, 2);

        return $this->responseJson(true, 'list article users', $articleUsers);
    }
}
