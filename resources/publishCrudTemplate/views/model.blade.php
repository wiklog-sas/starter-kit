@extends('layouts.app')

@section('extraHead')
    {{-- {!! cdnCss('bootstrap-select') !!} --}}
    {{-- {!! cdnCss('bootstrap-datepicker') !!} --}}
@endsection

@section('content')
    <div class="container-fluid min-vh-100 px-md-5">

        @include('commun.admin-breadcrumb', [
            'breadcrumb_items' => [
                new BreadcrumbItem('livre', lien: route('livre.index')),
                new BreadcrumbItem($livre?->title ?? 'Ajout d’un livre', isActive: true),
            ],
        ])

        <form action="{{ $livre == null ? route('livre.store') : route('livre.update', ['livre' => $livre->id]) }}"
            method="POST">
            @csrf

            <input type="hidden" name="_method" value="{{ $livre == null ? 'POST' : 'PUT' }}" />
            <input name="id" type="hidden" value="{{ $livre?->id }}">

            <h2>Livre</h2>

            <div class="row">
                <h3>Information générale</h3>
                <div class="col-4">
                    <x-inputs.input-text property="title" :entity="$livre" label="Titre" :disabled="$disabled" required />
                </div>
                <div class="col-4">
                    <x-inputs.input-text property="author" :entity="$livre" label="Autheur" :disabled="$disabled" required />
                </div>
                <div class="col-4">
                    <x-inputs.input-textarea property="description" :entity="$livre" label="Description" :disabled="$disabled" required />
                </div>
                <div class="col-4">
                    <x-inputs.input-bootstrap-datepicker property="release_date" label="Date d'effet"
                    :old="$livre?->release_date->format('d/m/Y')" :disabled="$disabled" />
                </div>

                <div class="col-4">
                    <x-inputs.input-number property="price" :entity="$livre" label="Prix" currency  :disabled="$disabled" />
                </div>

                {{-- <div class="col-4">
                    <x-inputs.input-selectpicker property="genre_id" :entity="$livre"  :values="$genres" itemLabel="libelle" label="Genre du livre" :disabled="$disabled" required />
                </div> --}}
                {{-- <div class="col-4">
                    <x-inputs.input-selectpicker property="livre_id" :values="$livres" itemLabel="title" label="Livre" :disabled="$disabled" />
                </div> --}}

                {{-- Select2 --}}
                <div class="col-4">
                    <div class="form-floating mb-3 ">
                        <select id="selectpicker2" 
                            name="selectpicker2" title="Select2"  
                            class="selectpicker form-control form-control-sp" 
                            style="" 
                        >
                            <option></option>
                            <option id="1" value="1">One</option>
                            <option id="2" value="2">Two</option>
                            <option id="3" value="3">Three</option>
                            <option id="4" value="4">Le ptit prince</option>
                        </select>
                        <label for="selectpicker2">Livre</label>
                    </div>
                </div>

                <div class="col-4">
                    {{-- <x-inputs.input-selectpicker property="livre_id" :values="$livres" itemLabel="title" label="Livre" :disabled="$disabled" /> --}}
                </div>
            </div>

            {{-- <div id="editor"></div> --}}

            <div class="pb-5 w-100">
                @include('commun.admin-pied-de-page', ['retour' => 'accueil', 'texte_validation' => 'Enregistrer'])
            </div>
        </form>
    </div>
    @include('commun.js.needs-validation') 
@endsection

@section('endScripts')
    {{-- {!! cdnJs('bootstrap-select') !!} --}}
    {{-- {!! cdnJS('bootstrap-datepicker') !!} --}}

    {{-- <script type="module">
        CKEditor.create( document.querySelector( '#editor' ), {
            language: 'fr',
        })
        .catch( error => {
            console.error( error );
        } );
    </script> --}}
    
    <script type="module">
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'fr',
            orientation: 'bottom right'
        });
    </script>

    <script type="module">
        var selecteur = $('#selectpicker2').select2({
            language: 'fr', 
            theme: 'bootstrap-5', 
            allowClear: true, 
            placeholder: 'Select2', 
        });
        selecteur.data('select2')
        .$selection
            .css('height', '58px')
            .css('display', 'flex')
            .css('align-items', 'flex-end')

    </script> 
@endsection
