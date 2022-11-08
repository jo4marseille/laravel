<?php

namespace App\Http\Controllers;

use App\Http\Traits\HelperTrait;
use App\Models\Asso;
use App\Models\ModelTag;
use App\Models\Site;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    use HelperTrait;


    public function show(Site $site, Request $request)
    {
        $fields = $request->get('fields');

        if (!$fields) {
            $aFields = [];
        } else {
            $aFields = explode(',', $fields);
        }

        if (!$site) {
            return response()->json(['error' => "Cette association n'existe pas." ], 404);
        }
        
        $json = $this->getJsonSite($aFields, $site);
        
        return response()->json($json);
    }

    public function create()
    {
        return response()->view('sites.edit', ['assos' => Asso::all(), 'tags' => Tag::all()]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:sites|max:255',
            'image' => 'required|mimes:jpg,jpeg,png,svg,gif|max:2048|nullable', // 2MB Max
            'link' => 'nullable',
            'description' => 'required',
            'git_depo' => 'required',
            'desc_techno' => 'required',
            'video' => 'url|nullable',
            'app_link_android' => 'url|nullable',
            'app_link_ios' => 'url|nullable',
            'asso' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('sites.create')
                ->withErrors($validator)
                ->withInput();
        }
        
        // $pathImage = $request->file('image')->store('images_sites', 'public');
        $path = Storage::disk('s3')->put('images_assos', $request->file('image'));
        $pathImage = Storage::disk('s3')->url($path);
        
        $tags = $request->get('tags');
        
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
    
        $newSite = Site::create([
            'name' => $input['name'],
            'image' => $pathImage,
            // 'link' => $input['link'],
            'description' => $input['description'],
            'video' => $input['video'],
            'git_depo' => $input['git_depo'],
            'desc_techno' => $input['desc_techno'],
            'app_link_android' => $input['app_link_android'],
            'app_link_ios' => $input['app_link_ios'],
            'asso_id' => $input['asso']
        ]);

        foreach ($tags as $tag) {
            $currentTag = Tag::where('name', $tag)->orWhere('id', $tag)->get()->first();
            $currentLinkTagModelExists = ModelTag::where('model_id', $newSite->id)
                ->where('model_name', 'sites')
                ->where('tag_id', $currentTag->id)
                ->get()
                ->first()
            ;
            if (!$currentLinkTagModelExists) {
                ModelTag::create([
                    'model_id' => $newSite->id,
                    'model_name' => 'sites',
                    'tag_id' => $currentTag->id,
                ]);
            }
        }

        
    
        return redirect(env('APP_FRONT_URL'));
    }

    public function indexAdmin()
    {
        $sites = Site::all();
        return view('admin.sites.index', [
            'sites' => $sites,
        ]);
    }

    public function createAdmin()
    {
        return view('admin.sites.edit', ['siteId' => 0]);
    }

    public function edit($siteId)
    {
        return view('admin.sites.edit', ['siteId' => $siteId]);
    }

    public function delete(Site $site)
    {
        $site->delete();
        return redirect()->route('sites');
    }

    // public function index(Request $request)
    // {
    //     $fields = $request->get('fields');
    //     if (!$fields) {
    //         $aSelect = [
    //             'sites.id as site_id',
    //             'sites.name as site_name',
    //             'sites.slug',
    //             'sites.image as site_image',
    //             'sites.link',
    //             'sites.description as site_description',
    //             'sites.video',
    //             'sites.status',
    //             'sites.git_depo',
    //             'sites.desc_techno',
    //             'sites.app_link_android',
    //             'sites.app_link_ios',
    //             'sites.created_at as site_created_at',
    //             'assos.id as asso_id',
    //             'assos.name as asso_name',
    //             'assos.image as asso_image',
    //             'assos.logo as asso_logo',
    //             'assos.description as asso_description',
    //             'assos.indicator_label_1 as asso_indicator_label_1',
    //             'assos.indicator_value_1 as asso_indicator_value_1',
    //             'assos.indicator_unit_1 as asso_indicator_unit_1',
    //             'assos.indicator_label_2 as asso_indicator_label_2',
    //             'assos.indicator_value_2 as asso_indicator_value_2',
    //             'assos.indicator_unit_2 as asso_indicator_unit_2',
    //             'assos.indicator_label_3 as asso_indicator_label_3',
    //             'assos.indicator_value_3 as asso_indicator_value_3',
    //             'assos.indicator_unit_3 as asso_indicator_unit_3',
    //             'assos.created_at as asso_created_at',
    //         ];
    //         $aFields = [];
    //     } else {
    //         $aFields = explode(',', $fields);
    //         $aSelect = ['sites.id as site_id', 'assos.id as asso_id', 'sites.slug'];
    //         foreach ($aFields as $field) {
    //             switch ($field) {
    //                 case 'name_sites' :
    //                     $aSelect[] = 'sites.name as site_name';
    //                     break;
    //                 case 'image_sites' :
    //                     $aSelect[] = 'sites.image as site_image';
    //                     break;
    //                 case 'link' :
    //                     $aSelect[] = 'sites.link';
    //                     break;
    //                 case 'description_sites' :
    //                     $aSelect[] = 'sites.description as site_description';
    //                     break;
    //                 case 'video' :
    //                     $aSelect[] = 'sites.video';
    //                     break;
    //                 case 'status' :
    //                     $aSelect[] = 'sites.status';
    //                     break;
    //                 case 'git_depo' :
    //                     $aSelect[] = 'sites.git_depo';
    //                     break;
    //                 case 'desc_techno' :
    //                     $aSelect[] = 'sites.desc_techno';
    //                     break;
    //                 case 'app_link_android' :
    //                     $aSelect[] = 'sites.app_link_android';
    //                     break;
    //                 case 'app_link_ios' :
    //                     $aSelect[] = 'sites.app_link_ios';
    //                     break;
    //                 case 'created_at_sites' :
    //                     $aSelect[] = 'sites.created_at as site_created_at';
    //                     break;
    //                 case 'name_assos' :
    //                     $aSelect[] = 'assos.name as asso_name';
    //                     break;
    //                 case 'image_assos' :
    //                     $aSelect[] = 'assos.image as asso_image';
    //                     break;
    //                 case 'logo_assos' :
    //                     $aSelect[] = 'assos.logo as asso_logo';
    //                     break;
    //                 case 'description_assos' :
    //                     $aSelect[] = 'assos.description as asso_description';
    //                     break;
    //                 case 'indicator_1_assos' :
    //                     $aSelect[] = 'assos.indicator_label_1 as asso_indicator_label_1';
    //                     $aSelect[] = 'assos.indicator_value_1 as asso_indicator_value_1';
    //                     $aSelect[] = 'assos.indicator_unit_1 as asso_indicator_unit_1';
    //                     break;
    //                 case 'indicator_2_assos' :
    //                     $aSelect[] = 'assos.indicator_label_2 as asso_indicator_label_2';
    //                     $aSelect[] = 'assos.indicator_value_2 as asso_indicator_value_2';
    //                     $aSelect[] = 'assos.indicator_unit_2 as asso_indicator_unit_2';
    //                     break;
    //                 case 'indicator_3_assos' :
    //                     $aSelect[] = 'assos.indicator_label_3 as asso_indicator_label_3';
    //                     $aSelect[] = 'assos.indicator_value_3 as asso_indicator_value_3';
    //                     $aSelect[] = 'assos.indicator_unit_3 as asso_indicator_unit_3';
    //                     break;
    //                 case 'created_at_assos' :
    //                     $aSelect[] = 'assos.created_at as asso_created_at';
    //                     break;
    //             }
    //         }
    //     }
        
    //     $sites = DB::table('sites')
    //         ->join('assos', 'sites.asso_id', '=', 'assos.id')
    //         ->select($aSelect)
    //         ->where('status' ,true)
    //         ->get();            

    //     $json = [];
    //     foreach ($sites as $key => $site) {
    //         if (empty($aFields)) {
    //             $json[] = [
    //                 'id' => $site->site_id,
    //                 'slug' => $site->slug,
    //                 'name' => $site->site_name,
    //                 'image' => $site->site_image,
    //                 'link' => $site->link,
    //                 'description' => $site->site_description,
    //                 'video' => $site->video,
    //                 'status' => $site->status,
    //                 'git_depo' => $site->git_depo,
    //                 'desc_techno' => $site->desc_techno,
    //                 'app_link_android' => $site->app_link_android,
    //                 'app_link_ios' => $site->app_link_ios,
    //                 'created_at' => $site->site_created_at,
    //                 'asso' => [
    //                     'id' => $site->asso_id,
    //                     'name' => $site->asso_name,
    //                     'image' => $site->asso_image,
    //                     'logo' => $site->asso_logo,
    //                     'description' => $site->asso_description,
    //                     'indicators' => [
    //                         [
    //                             'label' => $site->asso_indicator_label_1,
    //                             'value' => $site->asso_indicator_value_1,
    //                             'unit' => $site->asso_indicator_unit_1,
    //                         ],
    //                         [
    //                             'label' => $site->asso_indicator_label_2,
    //                             'value' => $site->asso_indicator_value_2,
    //                             'unit' => $site->asso_indicator_unit_2,
    //                         ],
    //                         [
    //                             'label' => $site->asso_indicator_label_3,
    //                             'value' => $site->asso_indicator_value_3,
    //                             'unit' => $site->asso_indicator_unit_3,
    //                         ],
    //                     ],
    //                     'created_at' => $site->asso_created_at,
    //                 ],
    //             ];
    //         } else {
    //             $json[$key]['id'] = $site->site_id;
    //             $json[$key]['slug'] = $site->slug;
    //             $json[$key]['asso']['id'] = $site->asso_id;
    //             foreach ($aFields as $field) {
    //                 switch($field) {
    //                     case "name_sites":
    //                         $json[$key]['name'] = $site->site_name;
    //                         break;
    //                     case "link":
    //                         $json[$key]['link'] = $site->link;
    //                         break;
    //                     case "image_sites":
    //                         $json[$key]['image'] = $site->site_image;
    //                         break; 
    //                     case "description_sites":
    //                         $json[$key]['description'] = $site->site_description;
    //                         break; 
    //                     case "video": 
    //                         $json[$key]['video'] = $site->video;
    //                         break;
    //                     case "status":
    //                         $json[$key]['status'] = $site->status;
    //                         break;
    //                     case "git_depo":
    //                         $json[$key]['git_depo'] = $site->git_depo;
    //                         break; 
    //                     case "desc_techno":
    //                         $json[$key]['desc_techno'] = $site->desc_techno;
    //                         break; 
    //                     case "app_link_android": 
    //                         $json[$key]['app_link_android'] = $site->app_link_android;
    //                         break;
    //                     case "app_link_ios": 
    //                         $json[$key]['app_link_ios'] = $site->app_link_ios;
    //                         break;
    //                     case "created_at_sites": 
    //                         $json[$key]['created_at'] = $site->created_at;
        
    //                     case "name_assos":
    //                         $json[$key]['asso']['name'] = $site->asso_name;
    //                         break;
    //                     case "image_assos":
    //                         $json[$key]['asso']['image'] = $site->asso_image;
    //                         break; 
    //                     case "description_assos":
    //                         $json[$key]['asso']['description'] = $site->asso_description;
    //                         break; 
    //                     case "logo_assos": 
    //                         $json[$key]['asso']['logo'] = $site->asso_logo;
    //                         break;
    //                     case "indicator_1_assos":
    //                         $json[$key]['asso']['indicators'][0]['label'] = $site->asso_indicator_label_1;
    //                         $json[$key]['asso']['indicators'][0]['value'] = $site->asso_indicator_value_1;
    //                         $json[$key]['asso']['indicators'][0]['unit'] = $site->asso_indicator_unit_1;
    //                         break;
    //                     case "indicator_2_assos":
    //                         $json[$key]['asso']['indicators'][1]['label'] = $site->asso_indicator_label_2;
    //                         $json[$key]['asso']['indicators'][1]['value'] = $site->asso_indicator_value_2;
    //                         $json[$key]['asso']['indicators'][1]['unit'] = $site->asso_indicator_unit_2;
    //                         break;
    //                     case "indicator_3_assos":
    //                         $json[$key]['asso']['indicators'][2]['label'] = $site->asso_indicator_label_3;
    //                         $json[$key]['asso']['indicators'][2]['value'] = $site->asso_indicator_value_3;
    //                         $json[$key]['asso']['indicators'][2]['unit'] = $site->asso_indicator_unit_3;
    //                         break;
    //                     case "created_at_assos": 
    //                         $json[$key]['asso']['created_at'] = $site->asso_created_at;
    //                 }
    //             }
    //         }
            
    //     }

    //     return response()->json($json);

    // }
    
}


