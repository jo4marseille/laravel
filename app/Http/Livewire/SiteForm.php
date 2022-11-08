<?php

namespace App\Http\Livewire;

use App\Models\Asso;
use App\Models\Site;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class SiteForm extends Component
{
    use WithFileUploads;

    public $site_id;
    public $name;
    public $image;
    public $old_image;
    public $link;
    public $description;
    public $video;
    public $status;
    public $git_depo;
    public $desc_techno;
    public $app_link_android;
    public $app_link_ios;
    public $asso;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        $rules = [
            'name' => 'required|max:255|unique:sites,name,'.$this->site_id,
            'link' => 'url|nullable',
            'description' => 'required',
            'video' => 'url|nullable',
            'git_depo' => 'required|url',
            'desc_techno' => 'required',
            'app_link_android' => 'url|nullable',
            'app_link_ios' => 'url|nullable',
            'asso' => 'required',
        ];
        if ($this->image) {
            $rules['image'] = 'nullable'; // 2MB Max
        } else {
            $rules['image'] = 'required|mimes:jpg,jpeg,png,svg,gif|max:2048'; // 2MB Max
        }
        return $rules;
    }

    public function mount($siteId)
    {
        if ($siteId) {
            $site = Site::find($siteId);
            $this->site_id = $site->id;
            $this->name = $site->name;
            $this->image = $site->image;
            $this->old_image = $site->image;
            $this->link = $site->link;
            $this->description = $site->description;
            $this->video = $site->video;
            $this->status = $site->status;
            $this->git_depo = $site->git_depo;
            $this->desc_techno = $site->desc_techno;
            $this->app_link_android = $site->app_link_android;
            $this->app_link_ios = $site->app_link_ios;
            $this->asso = $site->asso_id;
        }
    }

    public function submit()
    {
        $this->validate();

        // Execution doesn't reach here if validation fails.
        if ($this->image instanceof TemporaryUploadedFile) {
            $pathImage = $this->image->store('images_sites', 'public');
        }
        

        Site::updateOrCreate([
            'name' => $this->name,
        ],
        [
            'slug' => Str::slug($this->name),
            'image' => isset($pathImage) ? env('APP_URL') . '/storage/' . $pathImage : $this->image,
            'description' => $this->description,
            'link' => $this->link,
            'video' => $this->video,
            'status' => $this->status,
            'git_depo' => $this->git_depo,
            'desc_techno' => $this->desc_techno,
            'app_link_android' => $this->app_link_android,
            'app_link_ios' => $this->app_link_ios,
            'asso_id' => $this->asso,
        ]);


        return redirect()->route('sites');
    }

    public function render()
    {
        $assos = Asso::all();
        return view('livewire.site-form', compact('assos'));
    }
}
