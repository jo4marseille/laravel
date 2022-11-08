<?php
namespace App\Http\Traits;

trait HelperTrait 
{
    private function getSelectsAsso($aFields)
    {
        if (empty($aFields)) {
            return [
                'assos.id',
                'assos.name',
                'assos.slug',
                'assos.link',
                'assos.image',
                'assos.logo',
                'assos.description',
                'assos.indicator_label_1',
                'assos.indicator_value_1',
                'assos.indicator_unit_1',
                'assos.indicator_label_2',
                'assos.indicator_value_2',
                'assos.indicator_unit_2',
                'assos.indicator_label_3',
                'assos.indicator_value_3',
                'assos.indicator_unit_3',
                'assos.created_at',
            ];
        }
        $aSelect = ['assos.id', 'assos.slug'];
        foreach ($aFields as $field) {
            switch ($field) {
                case 'name' :
                    $aSelect[] = 'assos.name';
                    break;
                case 'image' :
                    $aSelect[] = 'assos.image';
                    break;
                case 'link' :
                    $aSelect[] = 'assos.link';
                    break;
                case 'logo' :
                    $aSelect[] = 'assos.logo';
                    break;
                case 'description' :
                    $aSelect[] = 'assos.description';
                    break;
                case 'indicator_1' :
                    $aSelect[] = 'assos.indicator_label_1';
                    $aSelect[] = 'assos.indicator_value_1';
                    $aSelect[] = 'assos.indicator_unit_1';
                    break;
                case 'indicator_2' :
                    $aSelect[] = 'assos.indicator_label_2';
                    $aSelect[] = 'assos.indicator_value_2';
                    $aSelect[] = 'assos.indicator_unit_2';
                    break;
                case 'indicator_3' :
                    $aSelect[] = 'assos.indicator_label_3';
                    $aSelect[] = 'assos.indicator_value_3';
                    $aSelect[] = 'assos.indicator_unit_3';
                    break;
                case 'created_at' :
                    $aSelect[] = 'assos.created_at';
                    break;
            }
        }
        return $aSelect;
    }

    private function getJsonAsso($aFields, $model)
    {
        if (empty($aFields)) {
            return [
                'id' => $model->id,
                'name' => $model->name,
                'slug' => $model->slug,
                'image' => $model->image,
                'logo' => $model->logo,
                'link' => $model->link,
                'description' => $model->description,
                'indicators' => [
                    [
                        'label' => $model->indicator_label_1,
                        'value' => $model->indicator_value_1,
                        'unit' => $model->indicator_unit_1,
                    ],
                    [
                        'label' => $model->indicator_label_2,
                        'value' => $model->indicator_value_2,
                        'unit' => $model->indicator_unit_2,
                    ],
                    [
                        'label' => $model->indicator_label_3,
                        'value' => $model->indicator_value_3,
                        'unit' => $model->indicator_unit_3,
                    ],
                ],
                'created_at' => $model->created_at,
            ];
        }
        $json['id'] = $model->id;
        $json['slug'] = $model->slug;
        foreach ($aFields as $field) {
            switch($field) {
                case "name":
                    $json['name'] = $model->name;
                    break;
                case "link":
                    $json['link'] = $model->link;
                    break;
                case "image":
                    $json['image'] = $model->image;
                    break; 
                case "description":
                    $json['description'] = $model->description;
                    break; 
                case "logo": 
                    $json['logo'] = $model->logo;
                    break;
                case "indicator_1":
                    $json['indicators'][0]['label'] = $model->indicator_label_1;
                    $json['indicators'][0]['value'] = $model->indicator_value_1;
                    $json['indicators'][0]['unit'] = $model->indicator_unit_1;
                    break;
                case "indicator_2":
                    $json['indicators'][1]['label'] = $model->indicator_label_2;
                    $json['indicators'][1]['value'] = $model->indicator_value_2;
                    $json['indicators'][1]['unit'] = $model->indicator_unit_2;
                    break;
                case "indicator_3":
                    $json['indicators'][2]['label'] = $model->indicator_label_3;
                    $json['indicators'][2]['value'] = $model->indicator_value_3;
                    $json['indicators'][2]['unit'] = $model->indicator_unit_3;
                    break;
                case "created_at": 
                    $json['created_at'] = $model->created_at;
            }
        }
        return $json;
    }

    private function getSelectsSite($aFields)
    {
        if (empty($aFields)) {
            return [
                'sites.id',
                'sites.name',
                'sites.image',
                'sites.link',
                'sites.description',
                'sites.video',
                'sites.status',
                'sites.git_depo',
                'sites.desc_techno',
                'sites.app_link_android',
                'sites.app_link_ios',
                'sites.created_at',
            ];
        }
        $aSelect = ['sites.id'];
        foreach ($aFields as $field) {
            switch ($field) {
                case 'name' :
                    $aSelect[] = 'sites.name';
                    break;
                case 'image' :
                    $aSelect[] = 'sites.image';
                    break;
                case 'link' :
                    $aSelect[] = 'sites.link';
                    break;
                case 'description' :
                    $aSelect[] = 'sites.description';
                    break;
                case 'video' :
                    $aSelect[] = 'sites.video';
                    break;
                case 'status' :
                    $aSelect[] = 'sites.status';
                    break;
                case 'git_depo' :
                    $aSelect[] = 'sites.git_depo';
                    break;
                case 'desc_techno' :
                    $aSelect[] = 'sites.desc_techno';
                    break;
                case 'app_link_android' :
                    $aSelect[] = 'sites.app_link_android';
                    break;
                case 'app_link_ios' :
                    $aSelect[] = 'sites.app_link_ios';
                    break;
                case 'created_at' :
                    $aSelect[] = 'sites.created_at as site_created_at';
                    break;
            }
        }
        return $aSelect;
    }

    private function getJsonSite($aFields, $model)
    {
        if (empty($aFields)) {
            return [
                'id' => $model->id,
                'name' => $model->name,
                'image' => $model->image,
                'link' => $model->link,
                'description' => $model->description,
                'video' => $model->video,
                'status' => $model->status,
                'git_depo' => $model->git_depo,
                'desc_techno' => $model->desc_techno,
                'app_link_android' => $model->app_link_android,
                'app_link_ios' => $model->app_link_ios,
                'created_at' => $model->created_at,
            ];
        }
        $json['id'] = $model->id;
        foreach ($aFields as $field) {
            switch($field) {
                case "name":
                    $json['name'] = $model->name;
                    break;
                case "link":
                    $json['link'] = $model->link;
                    break;
                case "image":
                    $json['image'] = $model->image;
                    break; 
                case "description":
                    $json['description'] = $model->description;
                    break; 
                case "video": 
                    $json['video'] = $model->video;
                    break;
                case "status":
                    $json['status'] = $model->status;
                    break;
                case "git_depo":
                    $json['git_depo'] = $model->git_depo;
                    break; 
                case "desc_techno":
                    $json['desc_techno'] = $model->desc_techno;
                    break; 
                case "app_link_android": 
                    $json['app_link_android'] = $model->app_link_android;
                    break;
                case "app_link_ios": 
                    $json['app_link_ios'] = $model->app_link_ios;
                    break;
                case "created_at": 
                    $json['created_at'] = $model->created_at;
            }
        }
        return $json;
    }
}