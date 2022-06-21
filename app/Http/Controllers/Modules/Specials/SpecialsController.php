<?php

namespace App\Http\Controllers\Modules\Specials;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specials\Special;
use App\Models\Specials\SpecialAlliedMedia;
use App\Models\Specials\SpecialCountry;
use App\Models\Specials\SpecialTag;
use App\Models\Specials\Template;
use stdClass;

class SpecialsController extends Controller
{
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
     * Show the module specials.
     * GET /admin/specials
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.admin.specials.module.index');
    }

    /**
     * List specials
     * POST /admin/specials/list
     */
    public function list(Request $request)
    {
        $row = isset($request->_row) ? $request->_row : 10;
        $search = $request->get('_search');

        $specials = Special::select(
            's.id',
            's.name',
            's.publication_date',
            's.slug',
            's.number_views',
            'ss.id as status_id',
            'ss.name as status_name',
            'ss.label as status_label'
        )
            ->from('specials as s')
            ->join('special_status as ss', 'ss.id', 's.status_id')
            ->search($search)
            ->where('s.hidden', true)
            ->orderBy('s.id', 'DESC')
            ->paginate($row);

        return $this->responseJson(true, 'list specials', $specials);
    }

    /**
     * Data modal create special
     * GET /admin/specials/create
     */
    public function createInfo(Request $request)
    {
        $data = new stdClass();
        $data->templates = Template::get();

        return $this->responseJson(true, 'create information', $data);
    }

    /**
     * Create user
     * POST /admin/specials
     */
    public function create(Request $request)
    {
        /** validate */
        $request->validate([
            'name' => 'required|max:255',
            'publication_date' => 'required',
            'template_id' => 'required',
            'country_ids' => 'string',
            'alliedmedia_ids' => 'string',
            'tags_ids' => 'string',
        ]);

        /** special creation */
        $special = new Special($request->all());
        $special->slug = $this->getUuidSpecial($request->name);
        $special->status_id = self::STATUS_EDITING;
        $special->hidden = true;
        $special->number_views = 0;
        $special->save();

        $this->setSpecialAlliedMedia(
            $special->id,
            explode(',', $request->alliedmedia_ids)
        );
        $this->setSpecialCountries(
            $special->id,
            explode(',', $request->country_ids)
        );
        $this->setSpecialTags($special->id, explode(',', $request->tags_ids));

        return $this->responseJson(true, 'special created', $special);
    }

    /**
     * Data modal update
     * GET /admin/specials/update
     */
    public function updateInfo(Request $request)
    {
        $request->validate([
            '_id' => 'required',
        ]);

        $specialTags = SpecialTag::select('t.id', 't.name')
            ->from('special_tags as st')
            ->join('agendapropia_utils.tags as t', 'st.tag_id', 't.id')
            ->where('st.special_id', $request->_id)
            ->get();
        $specialCountries = SpecialCountry::select('c.id', 'c.name')
            ->from('special_countries as sc')
            ->join('agendapropia_users.countries as c', 'sc.country_id', 'c.id')
            ->where('sc.special_id', $request->_id)
            ->get();
        $specialAlliedMedias = SpecialAlliedMedia::select('am.id', 'am.name')
            ->from('special_allied_media as sam')
            ->join('allied_media as am', 'sam.allied_media_id', 'am.id')
            ->where('sam.special_id', $request->_id)
            ->get();

        $special = Special::where('id', $request->_id)->first();
        $templates = Template::get();

        $data = new stdClass();
        $data->special = $special;
        $data->templates = $templates;
        $data->tags = $specialTags;
        $data->countries = $specialCountries;
        $data->alliedMedia = $specialAlliedMedias;

        return $this->responseJson(true, 'update information', $data);
    }

    /**
     * Update
     * PUT /admin/specials
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|max:255',
            'publication_date' => 'required',
            'template_id' => 'required',
            'country_ids' => 'string|nullable',
            'alliedmedia_ids' => 'string|nullable',
            'tags_ids' => 'string|nullable',
        ]);

        $special = Special::find($request->id);
        if (!$special) {
            $this->responseJson(false, 'special not found');
        }

        $special->fill($request->all());
        $special->save();

        $this->validateSpecialAlliedMedia(
            $request->id,
            explode(',', $request->alliedmedia_ids)
        );
        $this->validateSpecialTags(
            $request->id,
            explode(',', $request->tags_ids)
        );
        $this->validateSpecialCountries(
            $request->id,
            explode(',', $request->country_ids)
        );

        return $this->responseJson(true, 'special update', $special);
    }

    /** -------------------- PRIVATE -------------------- */

    protected function getUuidSpecial($name)
    {
        $name = strtolower($name);

        $slug = str_replace(' ', '-', $name);
        $slug = preg_replace('([^A-Za-z0-9-])', '', $slug);

        $validate = false;
        $slug_query = $slug;
        for ($i = 1; $i < 21; $i++) {
            if (
                !Special::select('id')
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

    protected function validateSpecialCountries(int $id, array $array)
    {
        $field = 'country_id';
        $currentArray = SpecialCountry::select($field)
            ->where('special_id', $id)
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

        $this->setSpecialCountries($id, $arrayAdd);
        $this->removeSpecialCountries($id, $arrayRemove);
    }
    protected function setSpecialCountries(int $specialId, array $countries)
    {
        foreach (array_unique($countries) as $country) {
            $item = new SpecialCountry();
            $item->country_id = $country;
            $item->special_id = $specialId;
            $item->save();
        }
    }
    protected function removeSpecialCountries(int $specialId, array $countries)
    {
        foreach (array_unique($countries) as $country) {
            SpecialCountry::where('country_id', $country)
                ->where('special_id', $specialId)
                ->delete();
        }
    }

    protected function validateSpecialTags(int $id, array $array)
    {
        $field = 'tag_id';
        $currentArray = SpecialTag::select($field)
            ->where('special_id', $id)
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

        $this->setSpecialTags($id, $arrayAdd);
        $this->removeSpecialTags($id, $arrayRemove);
    }
    protected function setSpecialTags(int $specialId, array $tags)
    {
        foreach (array_unique($tags) as $tag) {
            $item = new SpecialTag();
            $item->tag_id = $tag;
            $item->special_id = $specialId;
            $item->save();
        }
    }
    protected function removeSpecialTags(int $specialId, array $tags)
    {
        foreach (array_unique($tags) as $tag) {
            SpecialTag::where('tag_id', $tag)
                ->where('special_id', $specialId)
                ->delete();
        }
    }

    protected function validateSpecialAlliedMedia(int $id, array $array)
    {
        $field = 'allied_media_id';
        $currentArray = SpecialAlliedMedia::select($field)
            ->where('special_id', $id)
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

        $this->setSpecialAlliedMedia($id, $arrayAdd);
        $this->removeSpecialAlliedMedia($id, $arrayRemove);
    }
    protected function setSpecialAlliedMedia(
        int $specialId,
        array $alliedMedias
    ) {
        foreach (array_unique($alliedMedias) as $alliedMedia) {
            $item = new SpecialAlliedMedia();
            $item->allied_media_id = $alliedMedia;
            $item->special_id = $specialId;
            $item->save();
        }
    }
    protected function removeSpecialAlliedMedia(
        int $specialId,
        array $alliedMedias
    ) {
        foreach (array_unique($alliedMedias) as $alliedMedia) {
            SpecialAlliedMedia::where('allied_media_id', $alliedMedia)
                ->where('special_id', $specialId)
                ->delete();
        }
    }
}
