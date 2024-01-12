<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('REGISTRO DE ACTAS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-12 lg:px-12">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 10px">
                <x-acta :operativo="$operativo" :resultados="$resultados" :inspectores="$inspectores" :empresas="$empresas" :conductores="$conductores" :fracumfather="$fracumfather" :fracumson="$fracumson" :fracum="$fracum" :vehiculos="$vehiculos" :pagos="$pagos" :id="$id"/>
            </div>
        </div>
    </div>
</x-app-layout>
