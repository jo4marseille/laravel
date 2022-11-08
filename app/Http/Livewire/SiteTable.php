<?php

namespace App\Http\Livewire;

use App\Models\Asso;
use App\Models\ModelTag;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Site;
use App\Models\Tag;

class SiteTable extends DataTableComponent
{
    public bool $showSearch = false;
    public bool $paginationEnabled = false;
    public bool $showPerPage = false;
    public bool $responsive = true;

    public array $nameButton;


    public function toggleStatus($id)
    {
        $currentSite = Site::where('id', $id)->get()->first();
        $currentSite->status = !$currentSite->status;
        $currentSite->save();
        return redirect()->route('sites');
    }

    public function columns(): array
    {
        return [
            Column::make('image')
                ->format(function($value, $column, $row) {
                    return view('admin.sites.image', ['imageSrc' => $row->image]);
                // return $this->image($row->image, $row->name, ['class' => 'img-fluid']);
            }),
            Column::make('Association', 'asso_id')
                ->format(function($value, $column, $row) {
                    $asso = Asso::find($row->asso_id);
                    return $asso->name;
            }),
            Column::make('slug'),
            Column::make('name'),
            Column::make('description'),
            Column::make('link'),
            Column::make('video'),
            Column::make('status'),
            Column::make('git_depo'),
            Column::make('desc_techno'),
            Column::make('app_link_android'),
            Column::make('app_link_ios'),
            Column::make('Tags', null)
                ->format(function($value, $column, $row) {
                    $tags = ModelTag::where('model_name', 'sites')->where('model_id', $row->id)->get()->pluck('tag_id')->toArray();
                    $sTagNames = '';
                    if ($tags) {
                        $aTagNames = Tag::whereIn('id', $tags)->get()->pluck('name')->toArray();
                        $sTagNames = implode(', ', $aTagNames);
                    }
                    return $sTagNames   ;
            }),

            Column::make('created_at'),

            Column::make('Actions', null)
                ->format(function($value, $column, $row) {
                    if ($row->status == true) {
                        
                        $this->nameButton[$row->id] = "Désactiver";
                    } else {
                        $this->nameButton[$row->id] = "Activer";
                    }
                    return view('admin.sites.actions', ['site' => $row]);
                }),
        ];
    }

    public function query(): Builder
    {
        return Site::query();
    }
}
