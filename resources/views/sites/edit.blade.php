@extends('layout')

@section('title', 'Site')

@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="text-center card-header font-weight-bold">
            Formulaire de site
        </div>
        <div font size="2">Champs obligatoires<span class="error">*</span></div>
        <div class="card-body">
            <form action="{{ route('sites.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">
                        Nom
                        <span class="error">*</span>
                    </label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required="">
                </div>
                @error('name') <span class="error">{{ $message }}</span> @enderror


                <div class="mt-3 input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Image</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="image">Fichier pour l'image<span class="error">*</span></label>
                    </div>
                </div>
                @error('image') <span class="error">{{ $message }}</span> @enderror

                {{-- <div class="mt-3 form-group">
                    <label for="link">Lien</label>
                    <input type="text" id="link" name="link" class="form-control" value="{{ old('link') }}">
                </div>
                @error('link') <span class="error">{{ $message }}</span> @enderror --}}

                <div class="mt-3 form-group">
                    <label for="video">Lien Video</label>
                    <input type="text" id="video" name="video" class="form-control" value="{{ old('video') }}">
                </div>
                @error('video') <span class="error">{{ $message }}</span> @enderror


                <div class="mt-3 form-group">
                    <label for="description">Description<span class="error">*</span></label>
                    <textarea name="description" class="form-control" required="">{{ old('description') }}</textarea>
                </div>
                @error('description') <span class="error">{{ $message }}</span> @enderror
                
                <div class="mt-3 form-group">
                    <label for="indicator_unit_3">Fichier repo Git <span class="error">*</span></label>
                    <input type="text" id="git_depo" name="git_depo" class="form-control" value="{{ old('git_depo') }}">
                </div>
                @error('git_depo') <span class="error">{{ $message }}</span> @enderror
            
                <div class="mt-3 form-group">
                    <label for="indicator_unit_3">Techno utilisés <span class="error">*</span></label>
                    <input type="text" id="desc_techno" name="desc_techno" class="form-control" value="{{ old('desc_techno') }}" >
                </div>
                @error('desc_techno') <span class="error">{{ $message }}</span> @enderror
              
                <div class="mt-3 form-group">
                    <label for="indicator_unit_3">Lien application Androïd </label>
                    <input type="text" id="app_link_android" name="app_link_android" class="form-control" value="{{ old('app_link_android')}}" >
                </div>

                <div class="mt-3 form-group">
                    <label for="indicator_unit_3">Lien application iOs </label>
                    <input type="text" id="app_link_ios" name="app_link_ios" class="form-control" value="{{ old('app_link_ios')}}">
                </div>

                <div class="mt-3 form-group">
                    <label for="asso">Association<span class="error">*</span></label>
                    <select class="form-control" name="asso">
                        <option value="">Choisissez une association</option>
                        @foreach ($assos as $asso)
                            <option value="{{ $asso->id }}">
                                {{ $asso->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('asso') <span class="error">{{ $message }}</span> @enderror

                <div class="mt-3 form-group">
                    <label for="tags">Tags du site<span class="error">*</span></label>
                    <select id="tags" name="tags[]" class="js-example-basic-multiple form-control" multiple data-live-search="true">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>    
                        @endforeach
                    </select>
                </div>
                    
                <div class="mt-3 form-group container-button">
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </div>
            </form>

        </div>
    </div>
@endsection


@section('js')
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            tags: true,
        });
    });

    document.querySelector('.custom-file-input').addEventListener('change',function(e){
        var fileName = document.getElementById("image").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
    })
</script>
@endsection





