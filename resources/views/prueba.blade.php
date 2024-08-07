{{-- <a href="{{ route('measurement_units.index') }}"

    class="tw-block tw-max-w-sm tw-p-6 tw-bg-white tw-border tw-border-gray-200 tw-rounded-lg tw-shadow tw-hover:bg-gray-100 tw-dark:bg-gray-800 tw-dark:border-gray-700 tw-dark:hover:bg-gray-700">

    <h5 class="tw-mb-2 tw-text-2xl tw-font-bold tw-tracking-tight tw-text-gray-900 tw-dark:text-white">Medidas de unidad
    </h5>
    <p class="tw-font-normal tw-text-gray-700 tw-dark:text-gray-400">desc.</p>
</a> --}}

<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <a href="{{ route('measurement_units.index') }}">
                <div
                    class="tw-max-w-sm tw-p-6 tw-bg-white tw-border tw-border-gray-200 tw-rounded-lg tw-shadow dark:tw-bg-gray-800 dark:tw-border-gray-700 tw-flex tw-flex-col tw-items-center">
                    <svg class="tw-w-10 tw-h-10 tw-text-gray-500 dark:tw-text-gray-400 tw-mb-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z" />
                    </svg>
                    <h5 class="tw-mb-2 tw-text-2xl tw-font-bold tw-tracking-tight tw-text-gray-900 dark:tw-text-white">
                        Medidas de
                        unidad
                    </h5>
                    <p class="tw-mb-3 tw-font-normal tw-text-gray-500 dark:tw-text-gray-400">descripcion</p>
                </div>
            </a>
        </div>
</x-app-layout>
