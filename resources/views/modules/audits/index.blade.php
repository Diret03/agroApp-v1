<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">Auditorías</h5>
                                    <p class="mb-0 text-sm">Aquí puedes visualizar los registros de auditoría.</p>
                                </div>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Mensaje de éxito -->
                        <div id="message"
                            class="tw-hidden tw-bg-green-100 tw-border tw-border-green-400 tw-text-green-700 tw-px-4 tw-py-3 tw-rounded tw-relative"
                            role="alert">
                            <strong class="tw-font-bold">Éxito!</strong>
                            <span class="tw-block sm:tw-inline" id="message-text"></span>
                        </div>

                        <div class="tw-relative tw-overflow-x-auto tw-shadow-md sm:tw-rounded-lg tw-p-5">
                            <div
                                class="tw-flex tw-items-center tw-justify-between tw-flex-column tw-flex-wrap md:tw-flex-row tw-space-y-4 md:tw-space-y-0 tw-pb-4 tw-bg-white dark:tw-bg-gray-900">

                                <label for="table-search" class="tw-sr-only">Buscar</label>
                                <div class="tw-relative">
                                    <div
                                        class="tw-absolute tw-inset-y-0 tw-rtl:tw-inset-r-0 tw-start-0 tw-flex tw-items-center tw-ps-3 tw-pointer-events-none">
                                        <svg class="tw-w-4 tw-h-4 tw-text-gray-500 dark:tw-text-gray-400"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="table-search-audits"
                                        class="tw-block tw-p-2 tw-ps-10 tw-text-sm tw-text-gray-900 tw-border tw-border-gray-300 tw-rounded-lg tw-w-80 tw-bg-gray-50 focus:tw-ring-blue-500 focus:tw-border-blue-500 dark:tw-bg-gray-700 dark:tw-border-gray-600 dark:tw-placeholder-gray-400 dark:tw-text-white dark:focus:tw-ring-blue-500 dark:focus:tw-border-blue-500"
                                        placeholder="Buscar auditoría..."
                                        onkeyup="searchTable('table-search-audits', 'table-audits')">
                                </div>
                            </div>
                            <table id="table-audits"
                                class="tw-w-full tw-text-sm tw-text-left tw-rtl:tw-text-right tw-text-gray-500 dark:tw-text-gray-400">
                                <thead
                                    class="tw-text-xs tw-text-gray-700 tw-uppercase tw-bg-gray-50 dark:tw-bg-gray-700 dark:tw-text-gray-400">
                                    <tr>
                                        <th scope="col" class="tw-px-6 tw-py-3">ID</th>
                                        {{-- <th scope="col" class="tw-px-6 tw-py-3">Tipo de Usuario</th> --}}
                                        <th scope="col" class="tw-px-6 tw-py-3">ID de Usuario</th>
                                        <th scope="col" class="tw-px-6 tw-py-3">Evento</th>
                                        <th scope="col" class="tw-px-6 tw-py-3">Tipo modificado</th>
                                        <th scope="col" class="tw-px-6 tw-py-3">ID registro modificado</th>
                                        <th scope="col" class="tw-px-6 tw-py-3">Cambios</th>
                                        <th scope="col" class="tw-px-6 tw-py-3">IP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($audits as $audit)
                                        <tr id="audit_ids{{ $audit->id }}"
                                            class="tw-bg-white tw-border-b dark:tw-bg-gray-800 dark:tw-border-gray-700 hover:tw-bg-gray-50 dark:hover:tw-bg-gray-600">
                                            <td class="tw-px-6 tw-py-4">{{ $audit->id }}</td>
                                            {{-- <td class="tw-px-6 tw-py-4">{{ $audit->user_type }}</td> --}}
                                            <td class="tw-px-6 tw-py-4">{{ $audit->user_id }}</td>
                                            <td class="tw-px-6 tw-py-4">{{ $audit->event }}</td>
                                            <td class="tw-px-6 tw-py-4">{{ $audit->auditable_type }}</td>
                                            <td class="tw-px-6 tw-py-4">{{ $audit->auditable_id }}</td>
                                            <td class="tw-px-6 tw-py-4">
                                                <button type="button"
                                                    class="tw-text-blue-600 hover:tw-underline tw-font-medium"
                                                    data-bs-toggle="modal" data-bs-target="#changesModal"
                                                    data-old-values="{{ json_encode($audit->old_values) }}"
                                                    data-new-values="{{ json_encode($audit->new_values) }}">
                                                    Ver
                                                </button>
                                            </td>
                                            <td class="tw-px-6 tw-py-4">{{ $audit->ip_address }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div
                                class="tw-flex tw-items-center tw-justify-between tw-px-4 tw-py-3 tw-bg-white tw-border-t tw-border-gray-200 sm:tw-px-6">
                                <div class="tw-flex tw-items-center">
                                    <span class="tw-text-sm tw-text-gray-700 tw-mr-2">Mostrar</span>
                                    <select id="records-per-page"
                                        class="tw-form-select tw-rounded-md tw-shadow-sm tw-text-sm tw-font-medium tw-text-gray-700 tw-bg-white hover:tw-bg-gray-50 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-offset-gray-100 focus:tw-ring-indigo-500">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                    </select>
                                    <span class="tw-text-sm tw-text-gray-700 tw-ml-2">registros</span>
                                </div>
                                <div class="tw-flex tw-items-center">
                                    <span class="tw-text-sm tw-text-gray-700 tw-mr-2">Página</span>
                                    <div id="pagination-numbers" class="tw-flex tw-space-x-2">
                                        <!-- Los números de página se renderizarán aquí -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>

    <!-- Modal para ver cambios -->
    <div class="modal fade" id="changesModal" tabindex="-1" aria-labelledby="changesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changesModalLabel">Cambios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="background-color: red"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-center">
                        <div class="mr-4">
                            <h6>Antes</h6>
                            <pre id="oldValues" class="rounded bg-danger"></pre>
                        </div>
                        <div>
                            <h6>Después</h6>
                            <pre id="newValues" class="rounded bg-success"></pre>
                        </div>
                    </div>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const totalRecords = {{ $audits->count() }};
        const tableId = 'table-audits';
        const paginationContainerId = 'pagination-numbers';
        const defaultRecordsPerPage = 10;

        initPagination(totalRecords, tableId, paginationContainerId, defaultRecordsPerPage);

        // Manejar la apertura del modal
        $('#changesModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var oldValues = button.data('old-values');
            var newValues = button.data('new-values');

            var modal = $(this);
            modal.find('#oldValues').text(JSON.stringify(oldValues, null, 2));
            modal.find('#newValues').text(JSON.stringify(newValues, null, 2));
        });
    });
</script>