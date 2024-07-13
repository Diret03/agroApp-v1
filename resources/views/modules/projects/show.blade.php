<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-6">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">

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

                        <div class="card-header pb-0 d-flex justify-content-between">
                            <h3 class="ml-3">Datos Generales</h3>
                            <button type="button" class="btn btn-dark btn-primary mr-3" data-bs-toggle="modal"
                                data-bs-target="#editProjectModal" data-project="{{ json_encode($project) }}">
                                <i class="fas fa-pencil me-2"></i> Editar proyecto
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row ml-2">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th class="font-weight-bold w-25">Nombre:</th>
                                                    <td>{{ $project->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="font-weight-bold">Responsable:</th>
                                                    <td>{{ $project->responsible->name }}
                                                        {{ $project->responsible->last_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="font-weight-bold">Periodo:</th>
                                                    <td>{{ $project->start_date }} - {{ $project->end_date }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="font-weight-bold align-top">Modulos:</th>
                                                    <td>
                                                        <div class="tw-flex tw-flex-wrap tw-gap-1">
                                                            @foreach ($project->modules as $module)
                                                                <span
                                                                    class="tw-bg-gray-200 tw-rounded-full tw-px-3 tw-py-1 tw-text-sm tw-font-semibold tw-text-gray-700">
                                                                    {{ $module->name }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="font-weight-bold">Presupuesto:</th>
                                                    <td>${{ number_format($project->budget, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="font-weight-bold">Porcentaje de compleción:</th>
                                                    <td>
                                                        <div class="tw-w-full tw-max-w-xs">
                                                            <div
                                                                class="tw-mb-1 tw-text-base tw-font-medium tw-text-gray-700 dark:tw-text-gray-400">
                                                                {{ $project->progress }}%
                                                            </div>
                                                            <div
                                                                class="tw-w-full tw-bg-gray-200 tw-rounded-full tw-h-2.5 dark:tw-bg-gray-700">
                                                                <div class="tw-bg-blue-600 tw-h-2.5 tw-rounded-full"
                                                                    style="width: {{ $project->progress }}%"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex justify-content-center pr-5">
                                    <div class="image-container bg-secondary ">
                                        @if (is_null($project->image))
                                            <img src="../assets/img/projects/default.png" class="img-fluid rounded" />
                                        @else
                                            <img src="{{ asset('storage/' . $project->image) }}"
                                                class="img-fluid rounded">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <ul class="nav nav-tabs" id="menu">
                                <li class="nav-item"><a class="nav-link" id="tareas" href="#">Tareas</a></li>
                                <li class="nav-item"><a class="nav-link" id="kardex" href="#">Kardex</a></li>
                                <li class="nav-item"><a class="nav-link" id="descripcion" href="#">Descripción</a>
                                <li class="nav-item"><a class="nav-link" id="inventory" href="#">Inventario</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" id="recursos" href="#">Recursos</a></li>
                            </ul>

                            <div class="tab-content mt-3">
                                <div id="tareas-content" class="tab-pane contents">
                                    <div class="d-flex justify-content-end ">

                                        <button type="button" class="btn btn-dark btn-primary mr-3"
                                            data-bs-toggle="modal" data-bs-target="#createTaskModal">
                                            <i class="fas fa-plus me-2"></i> Agregar tarea
                                        </button>
                                    </div>
                                    <div class="container">

                                        <div class="row">


                                            @if ($project->tasks->isEmpty())
                                                <div class="col-12">
                                                    <div class="alert alert-info" role="alert">
                                                        No hay tareas asociadas a este proyecto.
                                                    </div>
                                                </div>
                                            @else
                                                @foreach ($project->tasks as $task)
                                                    <div class="col-md-3 mb-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div
                                                                    class="d-flex justify-content-between text-center mb-3">
                                                                    @if ($task->status == 'Completado')
                                                                        <img src="{{ asset('assets/img/logos/completed.svg') }}"
                                                                            class="img-fluid" alt="Completado Logo"
                                                                            style="width: 40px;">
                                                                    @else
                                                                        <img src="{{ asset('assets/img/logos/pending.svg') }}"
                                                                            class="img-fluid" alt="Pendiente Logo"
                                                                            style="width: 40px;">
                                                                    @endif
                                                                    <button type="button"
                                                                        class="btn btn-dark btn-primary mr-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editTaskModal"
                                                                        data-task="{{ json_encode($task) }}">
                                                                        <i class="fas fa-pencil me-2"></i>
                                                                    </button>

                                                                </div>
                                                                <h5 class="card-title">{{ $task->name }}</h5>
                                                                <p class="card-text"><strong>Horas:</strong>
                                                                    {{ $task->hours }}</p>
                                                                <p class="card-text"><strong>Fecha:</strong>
                                                                    {{ $task->start_date }} - {{ $task->end_date }}
                                                                </p>
                                                                <p class="card-text"><strong>Porcentaje
                                                                        Proyecto:</strong> {{ $task->percentage }}%</p>
                                                                <p class="card-text"><strong>Estado:</strong>
                                                                    {{ $task->status }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div id="kardex-content" class="tab-pane contents">
                                    @if ($project->kardex->isEmpty())
                                        <div class="col-12">
                                            <div class="alert alert-info" role="alert">
                                                No hay movimientos de kardex asociados a este proyecto.
                                            </div>
                                        </div>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Operacion</th>
                                                        <th>Bodega</th>
                                                        <th>Fecha</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio</th>
                                                        <th>Saldo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($project->kardex as $kardex)
                                                        <tr>
                                                            <td>{{ $kardex->id_kardex }}</td>
                                                            <td>{{ $kardex->operationType->name }}</td>
                                                            <td>{{ $kardex->warehouse->name }}</td>
                                                            <td>{{ $kardex->date }}</td>
                                                            <td>{{ $kardex->quantity }}</td>
                                                            <td>${{ $kardex->price }}</td>
                                                            <td>${{ $kardex->balance }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>

                                <div id="descripcion-content" class="tab-pane contents">
                                    <p class="text-center">{{ $project->description }}</p>
                                </div>

                                <div id="recursos-content" class="tab-pane contents">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th>Descargar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Información del Proyecto</td>
                                                    <td>Archivo de información del proyecto</td>
                                                    <td class="text-center">
                                                        <img src="https://img.icons8.com/ios-filled/50/000000/download.png"
                                                            alt="Descargar" style="width: 20px; height: 20px;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Presupuesto</td>
                                                    <td>Archivo de presupuesto del proyecto</td>
                                                    <td class="text-center">
                                                        <img src="https://img.icons8.com/ios-filled/50/000000/download.png"
                                                            alt="Descargar" style="width: 20px; height: 20px;">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Edit Project Modal -->
    <div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProjectModalLabel">Editar Proyecto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="background-color: red"></button>
                </div>
                <div class="modal-body">
                    <form id="editProjectForm" method="POST"
                        action="{{ route('projects.update', $project->id_pro) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 d-flex">
                            <div class="me-2">
                                <label for="edit_id_responsible" class="form-label">Responsable</label>
                                <select class="form-control" id="edit_id_responsible" name="id_responsible" required>
                                    @foreach ($responsibles as $responsible)
                                        <option value="{{ $responsible->id_responsible }}">
                                            {{ $responsible->name }} {{ $responsible->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="pt-4">
                                <a href="{{ route('responsibles.index') }}" class="btn btn-info">Agregar
                                    Responsable</a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="edit_description" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_modules" class="form-label">Módulos:</label>
                            @foreach ($modules as $module)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $module->id_mod }}"
                                        id="edit_module{{ $module->id_mod }}" name="modules[]">
                                    <label class="form-check-label" for="edit_module{{ $module->id_mod }}">
                                        {{ $module->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Estado:</label>
                            <select class="form-control" id="edit_status" name="status">
                                <option value="initiated">Iniciado</option>
                                <option value="in_progress">En Progreso</option>
                                <option value="cancelled">Cancelado</option>
                                <option value="completed">Completado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_progress" class="form-label">Progreso (%)</label>
                            <input type="number" class="form-control" id="edit_progress" name="progress"
                                min="0" max="100" step="any" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_start_date" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="edit_start_date" name="start_date"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_end_date" class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control" id="edit_end_date" name="end_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_budget" class="form-label">Presupuesto</label>
                            <input type="number" class="form-control" id="edit_budget" name="budget"
                                step="any" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Fotografía</label>
                            <input type="file" class="form-control" id="edit_image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Task Modal -->
    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTaskModalLabel">Agregar tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="background-color: red"></button>
                </div>
                <div class="modal-body">
                    <form id="createTaskForm" method="POST" action="{{ route('tasks.store') }}">
                        @csrf
                        <input type="hidden" name="id_pro" value="{{ $project->id_pro }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="hours" class="form-label">Horas</label>
                            <input type="number" class="form-control" id="hours" name="hours" step="any"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="percentage" class="form-label">Porcentaje</label>
                            <input type="number" class="form-control" id="percentage" name="percentage" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Estado:</label>
                            <select class="form-control" id="status" name="status">
                                <option value="pending">Pendiente</option>
                                <option value="completed">Completado</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Task Modal -->
    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Editar Tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="background-color: red"></button>
                </div>
                <div class="modal-body">
                    <form id="editTaskForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id_pro" value="{{ $project->id_pro }}">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="edit_description" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_hours" class="form-label">Horas</label>
                            <input type="number" class="form-control" id="edit_hours" name="hours"
                                step="any" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_start_date" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="edit_start_date" name="start_date"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_end_date" class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control" id="edit_end_date" name="end_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_percentage" class="form-label">Porcentaje</label>
                            <input type="number" class="form-control" id="edit_percentage" name="percentage"
                                step="any" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Estado:</label>
                            <select class="form-control" id="edit_status" name="status">
                                <option value="pending">Pendiente</option>
                                <option value="completed">Completado</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<style>
    .nav-tabs .nav-link {
        color: #0F172A;
        font-weight: bold;
    }

    .nav-tabs .nav-link:hover,
    .nav-tabs .nav-link.active {
        border-bottom: 2px solid #0F172A;
    }

    .tab-content {
        padding: 20px 0;
    }

    .image-container {
        width: 100%;
        max-width: 400px;
        height: 300px;
        overflow: hidden;
        background-color: rgb(143, 143, 143);
        border-radius: 2%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-container img {
        max-width: 100%;
        max-height: 100%;
        height: auto;
        width: auto;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editProjectModal = document.getElementById('editProjectModal');
        editProjectModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var project = JSON.parse(button.getAttribute('data-project'));

            var modalForm = editProjectModal.querySelector('form');
            modalForm.action = '/info/projects/' + project.id_pro;

            var modalNameInput = editProjectModal.querySelector('#edit_name');
            var modalResponsibleInput = editProjectModal.querySelector('#edit_id_responsible');
            var modalDescriptionInput = editProjectModal.querySelector('#edit_description');
            var modalStatusInput = editProjectModal.querySelector('#edit_status');
            var modalProgressInput = editProjectModal.querySelector('#edit_progress');
            var modalStartDateInput = editProjectModal.querySelector('#edit_start_date');
            var modalEndDateInput = editProjectModal.querySelector('#edit_end_date');
            var modalBudgetInput = editProjectModal.querySelector('#edit_budget');

            modalNameInput.value = project.name;
            modalResponsibleInput.value = project.id_responsible;
            modalDescriptionInput.value = project.description;
            modalStatusInput.value = project.status;
            modalProgressInput.value = project.progress;
            modalStartDateInput.value = project.start_date;
            modalEndDateInput.value = project.end_date;
            modalBudgetInput.value = project.budget;

            var moduleCheckboxes = modalForm.querySelectorAll('input[name="modules[]"]');
            moduleCheckboxes.forEach(function(checkbox) {
                checkbox.checked = project.modules.some(function(mod) {
                    return mod.id_mod === checkbox.value;
                });
            });
        });


        var editTaskModal = document.getElementById('editTaskModal');
        editTaskModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var task = JSON.parse(button.getAttribute('data-task'));

            var modalForm = editTaskModal.querySelector('form');
            modalForm.action = '/info/tasks/' + task.id_task;

            var modalNameInput = editTaskModal.querySelector('#edit_name');
            var modalDescriptionInput = editTaskModal.querySelector('#edit_description');
            var modalHoursInput = editTaskModal.querySelector('#edit_hours');
            var modalStartDateInput = editTaskModal.querySelector('#edit_start_date');
            var modalEndDateInput = editTaskModal.querySelector('#edit_end_date');
            var modalPercentageInput = editTaskModal.querySelector('#edit_percentage');
            var modalStatusInput = editTaskModal.querySelector('#edit_status');

            modalNameInput.value = task.name;
            modalDescriptionInput.value = task.description;
            modalHoursInput.value = task.hours;
            modalStartDateInput.value = task.start_date;
            modalEndDateInput.value = task.end_date;
            modalPercentageInput.value = task.percentage;
            modalStatusInput.value = task.status;
        });

        const menu = document.getElementById('menu');
        const contents = document.querySelectorAll('.tab-pane');
        const menuItems = menu.querySelectorAll('.nav-link');

        function showContent(targetId) {
            menuItems.forEach(item => item.classList.remove('active'));
            contents.forEach(content => content.classList.remove('show', 'active'));

            const selectedItem = document.getElementById(targetId.replace('-content', ''));
            if (selectedItem) {
                selectedItem.classList.add('active');
            }

            const targetContent = document.getElementById(targetId);
            if (targetContent) {
                targetContent.classList.add('show', 'active');
            }
        }

        const lastSelected = localStorage.getItem('lastSelected') || 'tareas-content';
        showContent(lastSelected);

        menu.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('nav-link')) {
                e.preventDefault();
                const targetId = e.target.id + '-content';
                localStorage.setItem('lastSelected', targetId);
                showContent(targetId);
            }
        });
    });
</script>