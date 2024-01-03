<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('REGISTRO DE RESOLUCIONES DE SANCION') }}
        </h2>
        <!-- Librería de JavaScript de Bootstrap -->
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12 lg:px-10">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 10px">
                <x-z08_tabla_resoluciones :resoluciones="$resoluciones" :actas="$actas"/>
            </div>
        </div>
    </div>
</x-app-layout>
