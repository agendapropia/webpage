<?php

namespace App\Http\Controllers\Modules\Admin\Specials;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specials\SpecialAlliedMedia;
use App\Models\Specials\SpecialAlliedMediaRole;
use App\Models\Utils\File;
use stdClass;

class SpecialAlliedMediaController extends Controller
{
    const FROM_TABLE_MAIN = 'special_allied_media as sam';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Create special allied media
     * POST /admin/specials/allied-media/internal
     */
    public function create(Request $request)
    {
        /** validate */
        $request->validate([
            'special_id' => 'required|integer',
            'special_allied_media_role_id' => 'required|integer',
            'allied_media_id' => 'required|integer',
        ]);

        $specialUser = SpecialAlliedMedia::where(
            'special_id',
            $request->special_id
        )
            ->where(
                'special_allied_media_role_id',
                $request->special_allied_media_role_id
            )
            ->where('allied_media_id', $request->allied_media_id)
            ->first();

        if ($specialUser) {
            return $this->responseJson(
                false,
                'the allied media and role already exist.',
                []
            );
        }

        $new = new SpecialAlliedMedia($request->all());
        $new->save();

        return $this->responseJson(true, 'special allied media created.', $new);
    }

    /**
     * Delete special allied media
     * DELETE /admin/specials/allied-media/internal
     */
    public function delete(Request $request)
    {
        $request->validate([
            '_id' => 'required|integer',
        ]);

        $specialAlliedMedia = SpecialAlliedMedia::where(
            'id',
            $request->_id
        )->first();
        if (!$specialAlliedMedia) {
            return $this->responseJson(
                false,
                'the user and role not exist.',
                []
            );
        }

        $specialAlliedMedia->delete();

        return $this->responseJson(true, 'special allied media deleted.', []);
    }

    /**
     * List special allied media
     * POST /admin/special/allied-media/list-internal
     */
    public function list(Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $orderByColumn = $request->get('_order_by_column') ?? 'am.id';
        $orderByType = $request->get('_order_by_type') ?? 'DESC';

        $alliedMedia = SpecialAlliedMedia::select(
            'sam.id',
            'am.id as allied_media_id',
            'am.name as allied_media_name',
            'am.image as file',
            'samr.id as role_id',
            'samr.name as role_name'
        )
            ->from(self::FROM_TABLE_MAIN)
            ->join('allied_media as am', 'sam.allied_media_id', 'am.id')
            ->join(
                'special_allied_media_roles as samr',
                'sam.special_allied_media_role_id',
                'samr.id'
            )
            ->where('sam.special_id', $request->_id)
            ->orderBy($orderByColumn, $orderByType)
            ->paginate($row);

        $alliedMedia = File::setPathAndImageDefault($alliedMedia);

        return $this->responseJson(
            true,
            'list special allied media',
            $alliedMedia
        );
    }

    /**
     * List special roles
     * POST /admin/specials/allied-media/roles
     */
    public function get(Request $request)
    {
        $data = new stdClass();
        $data->roles = SpecialAlliedMediaRole::get();

        return $this->responseJson(
            true,
            'list special allied media roles',
            $data
        );
    }
}
