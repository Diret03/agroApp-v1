<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="top-0 bg-cover z-index-n1 min-height-100 max-height-200 h-25 position-absolute w-100 start-0 end-0"
            style="background-color: #F9FAFB ; background-position: bottom;">
        </div>
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid ">
            <form action="{{ route('profile.update', auth()->user()->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-5 mb-5 mt-lg-9 row justify-content-center">
                    <div class="col-lg-9 col-12">
                        <div class="card card-body" style="box-shadow: 2px 3px 25px -2px rgb(43, 51, 95);"
                            id="profile">
                            <div class="row z-index-2 justify-content-center align-items-center">
                                <div class="col-sm-auto col-4">
                                    <div class="avatar avatar-xl position-relative">
                                        <img class="w-100 h-100 object-fit-cover border-radius-lg shadow-sm"
                                            src="{{ Auth::user()->profile_photo ? asset('storage/profile_photos/' . Auth::user()->profile_photo) : asset('storage/profile_photos/default.jpg') }}"
                                            id="profileImage" style="cursor:pointer;">
                                    </div>
                                </div>
                                <div class="col-sm-auto col-8 my-auto">
                                    <div class="h-100">
                                        <h5 class="mb-1 font-weight-bolder">
                                            {{ auth()->user()->name }} {{ auth()->user()->last_name }}
                                        </h5>
                                        <p class="mb-0 font-weight-bold text-sm">
                                            @if (auth()->user()->roles->isNotEmpty())
                                                {{ auth()->user()->roles->pluck('name')->implode(', ') }}
                                            @else
                                                Sin roles asignados
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-12">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert" id="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" role="alert" id="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mb-5 row justify-content-center">
                    <div class="col-lg-9 col-12 ">
                        <div class="card " id="basic-info">
                            <div class="card-header">
                                <h5>Información Básica</h5>
                            </div>
                            <div class="pt-0 card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ old('name', auth()->user()->name) }}" class="form-control">
                                        @error('name')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="email">Correo Electrónico</label>
                                        <input type="email" name="email" id="email" readonly
                                            value="{{ old('email', auth()->user()->email) }}" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="last_name">Apellido</label>
                                        <input type="text" name="last_name" id="last_name"
                                            value="{{ old('last_name', auth()->user()->last_name) }}"
                                            class="form-control">
                                        @error('last_name')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="phone">Teléfono</label>
                                        <input type="text" name="phone" id="phone"
                                            value="{{ old('phone', auth()->user()->phone) }}" class="form-control">
                                        @error('phone')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label for="about">Sobre Mí</label>
                                    <textarea name="about" id="about" rows="5" class="form-control">{{ old('about', auth()->user()->about) }}</textarea>
                                    @error('about')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" id="two_factor_enabled"
                                        name="two_factor_enabled"
                                        {{ auth()->user()->two_factor_enabled ? 'checked' : '' }}>
                                    <label class="form-check-label" for="two_factor_enabled">Activar Autenticación de Dos Factores</label>
                                </div>
                                <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Guardar Cambios</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>
