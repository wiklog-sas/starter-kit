@extends('layouts.app')

@section('extraHead')
@endsection

@section('content')
    <div class="container-fluid min-vh-100 px-md-5">

        @include('commun.admin-breadcrumb', [
            'breadcrumb_items' => [new BreadcrumbItem('Livres')],
        ])

        <div class="card w-100">
            <div class="card-header">
                <h3 class="text-normal">Liste des livres</h3>
            </div>
            <div class="card-body bg-white">
                <div class="mb-3 d-flex justify-content-between">
                  @include('commun.js.datatables.corbeille')
                  @can('livre-create')
                    <div id="boutons_actions" class="d-flex mb-2 text-right">
                      <a href="{{ route('livre.create') }}" class="btn btn-sm btn-primary ms-1">Ajouter un livre <i class="fal fa-plus"></i></a>
                    </div>
                  @endcan
                </div>
                <table id="table_id" class="table table-striped w-100">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>Titre</th>
                            <th>Autheur</th>
                            <th>Description</th>
                            <th>Date de sortie</th>
                            <th>Prix</th>

                            <th>created_at</th>
                            <th>user_id_creation</th>
                            <th>updated_at</th>
                            <th>user_id_modification</th>
                            <th>deleted_at</th>
                            <th>Suppresseur</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        
    </div>
@endsection

@section('endScripts')
    <script type="module">
        $(document).ready(function() {

            var col = 0;
            var col_id = col++;

            var col_titre = col++;
            var col_autheur = col++;
            var col_description = col++;
            var col_release_date = col++;
            var col_price = col++;

            var col_user_id_creation = col++;
            var col_user_id_modification = col++;
            var col_user_id_suppression = col++;
            var col_created_at = col++;
            var col_updated_at = col++;
            var col_deleted_at = col++;

            var col_actions = col++;

            let table = new DataTable('#table_id', {
                paging: true,
                fixedHeader: {
                    header: true,
                    footer: true
                },
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
                },
                ajax: {
                    url: "{{ route('livre.json') }}",
                    dataSrc: ""
                },
                columns: [{
                        data: "id"
                    },
                    {
                        data: "title"
                    },
                    {
                        data: "author"
                    },
                    {
                        data: "description"
                    },
                    {
                        data: "release_date"
                    },
                    {
                        data: "price"
                    },
                    {
                        data: "createur"
                    },
                    {
                        data: "modificateur"
                    },
                    {
                        data: "suppresseur"
                    },
                    {
                        data: "created_at"
                    },
                    {
                        data: "updated_at"
                    },
                    {
                        data: "deleted_at"
                    },
                    {
                        data: "Actions"
                    },
                ],
                order: [
                    [col_created_at, 'desc']
                ],
                columnDefs: [
                    {
                        targets: col_id,
                        render: function(data, type, row) {
                            return '#' + data.toString().padStart(5, '0');
                        }
                    },
                    {
                        targets: col_release_date,
                        render: function(data, type, row) {
                            return format_date(data);
                        }
                    },
                    {
                        targets: col_price,
                        render: function(data, type, row) {
                            return format_currency(data);
                        }
                    },
                    {
                        targets: col_deleted_at,
                        render: function(data, type, row) {
                            return traitement(data, row.suppresseur);
                        }
                    },
                    {
                        targets: col_actions,
                        render: function(data, type, row) {
                            let retour = '<div class="d-flex justify-content-end">';

                            if (row.deleted_at == null) {
                                retour += @include('commun.js.datatables.button-show', ['path' => 'livre']);
                                retour += @include('commun.js.datatables.button-edit', ['path' => 'livre']);
                                retour += @include('commun.js.datatables.button-delete', ['path' => 'livre']);
                            } else {
                                retour += @include('commun.js.datatables.button-undelete', ['path' => 'livre']);
                            }

                            return retour + '</div>';
                        }
                    },
                    {
                        targets: [
                            col_user_id_creation,
                            col_user_id_modification,
                            col_user_id_suppression,
                            col_created_at,
                            col_updated_at,
                            col_deleted_at,
                        ],
                        visible: false
                    },
                    {
                        targets: [col_actions],
                        orderable: false,
                    }

                ],
                // dom: 'Blfrtip',
                dom: '<"row"<"col-2"l><"col-7"><"col-3"f>><"#buttons"B>rtip',
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa-solid fa-file-excel" data-bs-toggle="tooltip" title="Export Excel"></i>'
                },
                {
                    extend: 'print',
                    text: '<i class="fa-solid fa-print" data-bs-toggle="tooltip" title="Imprimer"></i>'
                },
                {
                    extend: 'copy',
                    text: '<i class="fa-solid fa-copy" data-bs-toggle="tooltip" title="Copier"></i>'
                }
                ],
                initComplete: function() {
                    // Déplacement des boutons de table vers les actions
                    $("#boutons_actions").prepend($("#buttons"));
                    $(".dt-buttons").addClass('btn-group-sm');
                    $("#buttons").addClass('d-flex justify-content-end');
                    $(".dt-buttons>button").removeClass('btn-secondary').addClass('btn-primary');

                    // Langue du label du filtre général
                    $("#table_id_filter>label")[0].innerHTML += 'Recherche globale';
                }
            }).on('draw.dt', function() {
                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

                setBootstrap5Style();
                let inputFilter = $('#table_id_filter > input');
                inputFilter.on('input', searchChanged);
            }).on('length.dt', function(e, settings, len) {
                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl)).hide()
            });

            inner(table, col_deleted_at);
        });
    </script>
    @include('commun.js.datatables.functions')
@endsection
