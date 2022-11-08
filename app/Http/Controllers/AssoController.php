<?php

namespace App\Http\Controllers;

use App\Http\Traits\HelperTrait;
use App\Models\Asso;
use App\Models\ModelTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AssoController extends Controller
{
    use HelperTrait;

    public function index(Request $request)
    {
        $fields = $request->get('fields');
        
        if (!$fields) {
            $aFields = [];
        } else {
            $aFields = explode(',', $fields);
        }
        $aSelect = $this->getSelectsAsso($aFields);
        
        $assos = DB::table('assos')
            ->select($aSelect)
            ->get();            

        $json = [];
        foreach ($assos as $key => $asso) {
            if (empty($aFields)) {
                $json[] = $this->getJsonAsso($aFields, $asso);
            } else {
                $json[$key] = $this->getJsonAsso($aFields, $asso);
            }
        }
        return response()->json($json);

    }

    public function show($slug, Request $request)
    {
        $fields = $request->get('fields');

        if (!$fields) {
            $aFields = [];
        } else {
            $aFields = explode(',', $fields);
        }
        $aSelect = $this->getSelectsAsso($aFields);

        $asso = DB::table('assos')
            ->select($aSelect)
            ->where('slug', $slug)
            ->get()
            ->first();

        if (!$asso) {
            return response()->json(['error' => "Cette association n'existe pas." ], 404);
        }

        $sitesIdFromAsso = DB::table('sites')
            ->select('id')
            ->where('asso_id', $asso->id)
            ->where('status' ,true)
            ->orderBy('created_at', 'desc')
            ->get()->pluck('id');
        
        $json = $this->getJsonAsso($aFields, $asso);
        $json['sites'] = $sitesIdFromAsso;
        
        return response()->json($json);
    }


    public function search(Request $request)
    {
        $search = $request->get('s');
        if (!$search || strlen($search) < 3) {
            return response()->json([]);
        }

        $fields = $request->get('fields');
        if (!$fields) {
            $aFields = [];
        } else {
            $aFields = explode(',', $fields);
        }
        $aSelect = $this->getSelectsAsso($aFields);

        $assos = DB::table('assos')
            ->leftJoin('sites', function($join) {
                $join->on('assos.id', '=', 'sites.asso_id');
                $join->where('sites.status', 1);
            })
            ->leftJoin('model_tags as sites_tags', function($join) {
                $join->on('sites_tags.model_id', '=', 'sites.id');
                $join->where('sites_tags.model_name', '=', 'sites');
            })
            ->leftJoin('model_tags as assos_tags', function($join) {
                $join->on('assos_tags.model_id', '=', 'assos.id');
                $join->where('assos_tags.model_name', '=', 'assos');
            })
            ->leftJoin('tags as sites_tags_detail', 'sites_tags_detail.id', '=', 'sites_tags.tag_id')
            ->leftJoin('tags as assos_tags_detail', 'assos_tags_detail.id', '=', 'assos_tags.tag_id')
            ->where(function($query) use($search) {
                $query->where('sites_tags_detail.name', 'LIKE', '%' . $search . '%')
                ->orWhere('assos_tags_detail.name', 'LIKE', '%' . $search . '%')
                ->orWhere('sites.name', 'LIKE', '%' . $search . '%')
                ->orWhere('sites.description', 'LIKE', '%' . $search . '%')
                ->orWhere('assos.name', 'LIKE', '%' . $search . '%')
                ->orWhere('assos.description', 'LIKE', '%' . $search . '%')
                ->orWhere('assos.indicator_label_1', 'LIKE', '%' . $search . '%')
                ->orWhere('assos.indicator_label_2', 'LIKE', '%' . $search . '%')
                ->orWhere('assos.indicator_label_3', 'LIKE', '%' . $search . '%');
            })
            ->select($aSelect)
            ->distinct()
            ->get()
        ;


        $json = [];
        foreach ($assos as $key => $asso) {
            if (empty($aFields)) {
                $json[] = $this->getJsonAsso($aFields, $asso);
            } else {
                $json[$key] = $this->getJsonAsso($aFields, $asso);
            }
        }

        return response()->json($json);
    }


    public function indexAdmin()
    {
        $assos = Asso::all();
        return view('admin.assos.index', [
            'assos' => $assos,
        ]);
    }

    public function create()
    {
        return response()->view('assos.edit', ['tags' => Tag::all()]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:assos|max:255',
            'image' => 'mimes:jpg,jpeg,png,svg,gif|max:2048|nullable', // 2MB Max
            'logo' => ' required|mimes:jpg,jpeg,png,svg,gif|max:2048', // 2MB Max
            'link' => 'url|nullable',
            'description' => 'required',
            'indicator_label_1' => 'required',
            'indicator_value_1' => 'required|numeric',
            'indicator_value_2' => 'numeric|nullable',
            'indicator_value_3' => 'numeric|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->route('assos.create')
                ->withErrors($validator)
                ->withInput();
        }


        if ($request->file('image')) {
            // $pathImage = $request->file('image')->store('images_assos', 'public');
            $path = Storage::disk('s3')->put('images_assos', $request->file('image'));
            $pathImage = Storage::disk('s3')->url($path);
        }
        $path = Storage::disk('s3')->put('logos_assos', $request->file('logo'));
        $pathLogo = Storage::disk('s3')->url($path);
        // $pathLogo = $request->file('logo')->store('logos_assos', 'public');

        $tags = [];
        if ($request->get('tags')) {
            $tags = $request->get('tags');
        }
        
        foreach ($tags as $tag) {
            if (!is_numeric($tag)) {
                $tagExists = Tag::where('name', $tag)->get();
                if ($tagExists->empty()) {
                    Tag::create([
                        'name' => $tag,
                    ]);
                }
            }
        }

        $input = $request->all();

        $newAsso = Asso::create([
            'name' => $input['name'],
            'slug' => Str::slug($input['name'], '-'),
            'image' => isset($pathImage) ? $pathImage : null,
            'logo' => $pathLogo,
            'description' => $input['description'],
            'link' => $input['link'],
            'indicator_label_1' => $input['indicator_label_1'],
            'indicator_value_1' => $input['indicator_value_1'],
            'indicator_unit_1' => $input['indicator_unit_1'],
            'indicator_label_2' => $input['indicator_label_2'],
            'indicator_value_2' => $input['indicator_value_2'],
            'indicator_unit_2' => $input['indicator_unit_2'],
            'indicator_label_3' => $input['indicator_label_3'],
            'indicator_value_3' => $input['indicator_value_3'],
            'indicator_unit_3' => $input['indicator_unit_3'],
        ]);

        foreach ($tags as $tag) {
            $currentTag = Tag::where('name', $tag)->orWhere('id', $tag)->get()->first();
            $currentLinkTagModelExists = ModelTag::where('model_id', $newAsso->id)
                ->where('model_name', 'assos')
                ->where('tag_id', $currentTag->id)
                ->get()
                ->first()
            ;
            if (!$currentLinkTagModelExists) {
                ModelTag::create([
                    'model_id' => $newAsso->id,
                    'model_name' => 'assos',
                    'tag_id' => $currentTag->id,
                ]);
            }
        }

        Cookie::queue(
            'validation',
            'true',
            1,
            null,
            '.eco4marseille.fr', 
            false, 
            false
        );

        return redirect(env('APP_FRONT_URL'));

    }

    public function createAdmin()
    {
        return view('admin.assos.edit', ['assoId' => 0]);
    }

    public function edit($assoId)
    {
        return view('admin.assos.edit', ['assoId' => $assoId]);
    }

    public function delete(Asso $asso)
    {
        $asso->delete();
        return redirect()->route('assos');
    }

}
