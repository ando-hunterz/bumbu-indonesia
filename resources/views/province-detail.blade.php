<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            province {{ $province->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-3xl font-bold mb-8">{{ $province->name }}</h3>
                    <h4 class="mb-4 font-semibold">Spice List:</h4>
                    @foreach ($province->spices as $spice)
                        <a href="{{route('spice-detail', ['spice' => $spice['id']])}}" class="hover:text-gray-500">{{$spice['name']}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



