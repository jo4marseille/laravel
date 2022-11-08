@extends('layout')

@section('title', 'Association')

@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="text-center card-header font-weight-bold">
            Formulaire d'association
        </div>
        <div>Champs obligatoires<span class="error">*</span></div>
        <div class="card-body">
            <form action="{{ route('assos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nom<span class="error">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required="">
                </div>
                @error('name') <span class="error">{{ $message }}</span> @enderror

                <div class="mt-3 input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Image</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01" value="{{old('image')}}">
                        <label class="custom-file-label" for="image">Fichier pour l'image</label>
                    </div>
                </div>
                @error('image') <span class="error">{{ $message }}</span> @enderror

                <div class="mt-3 input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon02">Logo<span class="error">*</span></span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="logo" name="logo" aria-describedby="inputGroupFileAddon02" value="{{old('logo')}}">
                        <label class="custom-file-label" for="logo">Fichier pour le logo</label>
                    </div>
                </div>
                @error('logo') <span class="error">{{ $message }}</span> @enderror

                <div class="mt-3 form-group">
                    <label for="description">Description<span class="error">*</span></label>
                    <textarea name="description" class="form-control" required="">{{ old('description') }}</textarea>
                </div>
                @error('description') <span class="error">{{ $message }}</span> @enderror

                <div class="mt-3 form-group">
                    <label for="link">Lien du site officiel de l'association</label>
                    <input type="text" id="link" name="link" class="form-control" value="{{ old('link') }}">
                </div>
                @error('link') <span class="error">{{ $message }}</span> @enderror
                <p><strong>Afin de contextualiser vos actions, veuillez renseigner au moins une valeur quantitative témoin de votre impact sur la préservation de l'environnement.</strong></p>
                <div class="mt-3 form-group">
                    <label for="indicator_value_1">Valeur du 1e indicateur <span class="error">*</span> </label>
                    <input type="number" id="indicator_value_1" name="indicator_value_1" value="{{ old('indicator_value_1') }}" class="form-control" required="">
                </div>
                @error('indicator_value_1') <span class="error">{{ $message }}</span> @enderror

                <div class="mt-3 form-group">
                    <label for="indicator_unit_1">Unité du 1e indicateur </label>
                    <input type="text" id="indicator_unit_1" name="indicator_unit_1" value="{{ old('indicator_unit_1') }}" class="form-control" maxlength="5">
                </div>
                @error('indicator_unit_1') <span class="error">{{ $message }}</span> @enderror

                <div class="mt-3 form-group">
                    <label for="indicator_label_1">Libellé du 1e indicateur <span class="error">*</span> </label>
                    <input type="text" id="indicator_label_1" name="indicator_label_1" value="{{ old('indicator_label_1') }}" class="form-control" required="">
                </div>
                @error('indicator_label_1') <span class="error">{{ $message }}</span> @enderror

                <div class="mt-3 form-group">
                    <label for="indicator_value_2">Valeur du 2e indicateur </label>
                    <input type="number" id="indicator_value_2" name="indicator_value_2" value="{{ old('indicator_value_2') }}" class="form-control">
                </div>
                @error('indicator_value_2') <span class="error">{{ $message }}</span> @enderror

                <div class="mt-3 form-group">
                    <label for="indicator_unit_2">Unité du 2e indicateur </label>
                    <input type="text" id="indicator_unit_2" name="indicator_unit_2" value="{{ old('indicator_unit_2') }}" class="form-control" maxlength="5">
                </div>

                <div class="mt-3 form-group">
                    <label for="indicator_label_2">Libellé du 2e indicateur </label>
                    <input type="text" id="indicator_label_2" name="indicator_label_2" value="{{ old('indicator_label_2') }}" class="form-control">
                </div>

                <div class="mt-3 form-group">
                    <label for="indicator_value_3">Valeur du 3e indicateur </label>
                    <input type="number" id="indicator_value_3" name="indicator_value_3" value="{{ old('indicator_value_3') }}" class="form-control">
                </div>
                @error('indicator_value_3') <span class="error">{{ $message }}</span> @enderror

                <div class="mt-3 form-group">
                    <label for="indicator_unit_3">Unité du 3e indicateur </label>
                    <input type="text" id="indicator_unit_3" name="indicator_unit_3" value="{{ old('indicator_unit_3') }}" class="form-control" maxlength="5">
                </div>

                <div class="mt-3 form-group">
                    <label for="indicator_label_3">Libellé du 3e indicateur </label>
                    <input type="text" id="indicator_label_3" name="indicator_label_3" value="{{ old('indicator_label_3') }}" class="form-control">
                </div>

                <div class="mt-3 form-group">
                    <label for="tags">Tags de l'association<span class="error">*</span></label>
                    <select id="tags" name="tags[]" class="js-example-basic-multiple form-control" multiple data-live-search="true">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>    
                        @endforeach
                    </select>
                </div>

                <div class="container-button">
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

    document.querySelectorAll('.custom-file-input').forEach(element => {
        element.addEventListener('change',function(e){
            var fileName = document.getElementById(e.target.id).files[0].name;
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = fileName
        })
    })
</script>
@endsection

