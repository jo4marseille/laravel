<?php

namespace App\Http\Livewire;

use App\Models\Asso;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class AssoForm extends Component
{
    use WithFileUploads;

    public $asso_id;
    public $slug;
    public $name;
    public $link;
    public $image;
    public $old_image;
    public $logo;
    public $old_logo;
    public $description;
    public $indicator_label_1;
    public $indicator_value_1;
    public $indicator_unit_1;
    public $indicator_label_2;
    public $indicator_value_2;
    public $indicator_unit_2;
    public $indicator_label_3;
    public $indicator_value_3;
    public $indicator_unit_3;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        $rules = [
            'name' => 'required|max:255|unique:assos,name,' . $this->asso_id,
            'link' => 'url|nullable',
            'description' => 'required',
            'indicator_label_1' => 'required',
            'indicator_value_1' => 'required|numeric',
            'indicator_value_2' => 'numeric|nullable',
            'indicator_value_3' => 'numeric|nullable',
        ];
        if ($this->logo) {
            $rules['logo'] = 'nullable'; // 2MB Max
        } else {
            $rules['logo'] = 'required|mimes:jpg,jpeg,png,svg,gif|max:2048'; // 2MB Max
        }
        if ($this->image) {
            $rules['image'] = 'nullable'; // 2MB Max
        } else {
            $rules['image'] = 'mimes:jpg,jpeg,png,svg,gif|max:2048|nullable'; // 2MB Max
        }
        return $rules;
    }

    public function mount($assoId)
    {
        if ($assoId) {
            $asso = Asso::find($assoId);
            $this->asso_id = $asso->id;
            $this->slug = $asso->slug;
            $this->link = $asso->link;
            $this->name = $asso->name;
            $this->image = $asso->image;
            $this->old_image = $asso->image;
            $this->logo = $asso->logo;
            $this->old_logo = $asso->logo;
            $this->description = $asso->description;
            $this->indicator_label_1 = $asso->indicator_label_1;
            $this->indicator_value_1 = $asso->indicator_value_1;
            $this->indicator_unit_1 = $asso->indicator_unit_1;
            $this->indicator_label_2 = $asso->indicator_label_2;
            $this->indicator_value_2 = $asso->indicator_value_2;
            $this->indicator_unit_2 = $asso->indicator_unit_2;
            $this->indicator_label_3 = $asso->indicator_label_3;
            $this->indicator_value_3 = $asso->indicator_value_3;
            $this->indicator_unit_3 = $asso->indicator_unit_3;
        }
    }

    public function submit()
    {
        $this->validate();

        // Execution doesn't reach here if validation fails.

        if ($this->image instanceof TemporaryUploadedFile) {
            // $pathImage = $this->image->store('images_assos', 'public');
            $path = Storage::disk('s3')->put('images_assos', $this->image);
            $pathImage = Storage::disk('s3')->url($path);
        }
        if ($this->logo instanceof TemporaryUploadedFile) {
            // $pathLogo = $this->logo->store('logos_assos', 'public');
            $path = Storage::disk('s3')->put('logos_assos', $this->logo);
            $pathLogo = Storage::disk('s3')->url($path);
        }

        Asso::updateOrCreate([
            'name' => $this->name,
        ],
        [
            'slug' => Str::slug($this->name),
            'image' => isset($pathImage) ? $pathImage : $this->image,
            'logo' => isset($pathLogo) ? $pathLogo : $this->logo,
            'description' => $this->description,
            'link' => $this->link,
            'indicator_label_1' => $this->indicator_label_1,
            'indicator_value_1' => $this->indicator_value_1,
            'indicator_unit_1' => $this->indicator_unit_1,
            'indicator_label_2' => $this->indicator_label_2,
            'indicator_value_2' => $this->indicator_value_2,
            'indicator_unit_2' => $this->indicator_unit_2,
            'indicator_label_3' => $this->indicator_label_3,
            'indicator_value_3' => $this->indicator_value_3,
            'indicator_unit_3' => $this->indicator_unit_3,
        ]);

        return redirect()->route('assos');
    }

    public function render()
    {
        return view('livewire.asso-form');
    }
}
