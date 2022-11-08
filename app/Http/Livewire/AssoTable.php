<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Asso;
use App\Models\ModelTag;
use App\Models\Tag;

class AssoTable extends DataTableComponent
{
    public bool $showSearch = false;
    public bool $paginationEnabled = false;
    public bool $showPerPage = false;
    public bool $responsive = true;


    public function columns(): array
    {
        return [
            Column::make('logo')
                ->format(function($value, $column, $row) {
                    return view('admin.assos.image', ['imageSrc' => $row->logo]);
                // return $this->image($row->logo, $row->name, ['class' => 'img-fluid']);
            }),
            Column::make('name'),
            Column::make('description'),
            Column::make('Indicator 1', null)
                ->format(function ($value, $column, $row) {
                    return view('admin.assos.indicator', [
                        'label' => $row->indicator_label_1,
                        'value' => $row->indicator_value_1,
                        'unit' => $row->indicator_unit_1,
                    ]);
            }),
            Column::make('Indicator 2', null)
                ->format(function ($value, $column, $row) {
                    return view('admin.assos.indicator', [
                        'label' => $row->indicator_label_2,
                        'value' => $row->indicator_value_2,
                        'unit' => $row->indicator_unit_2,
                    ]);
            }),
            Column::make('Indicator 3', null)
                ->format(function ($value, $column, $row) {
                    return view('admin.assos.indicator', [
                        'label' => $row->indicator_label_3,
                        'value' => $row->indicator_value_3,
                        'unit' => $row->indicator_unit_3,
                    ]);
            }),
            Column::make('image')
                ->format(function($value, $column, $row) {
                    return view('admin.assos.image', ['imageSrc' => $row->image]);
                // return $this->image($row->image, $row->name, ['class' => 'img-fluid']);
            }),
            Column::make('Tags', null)
                ->format(function($value, $column, $row) {
                    $tags = ModelTag::where('model_name', 'assos')->where('model_id', $row->id)->get()->pluck('tag_id')->toArray();
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
                    return view('admin.assos.actions', ['asso' => $row]);
                }),
        ];
    }

    public function query(): Builder
    {
        return Asso::query();
    }
}
