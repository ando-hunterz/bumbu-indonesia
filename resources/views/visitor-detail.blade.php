<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Visitor {{ $visitor->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-3xl font-bold mb-8">{{ $visitor->name }}</h3>
                    <h4 class="mb-10">IP : {{ $visitor->ip }}</h4>
                    <button name="delete-button" id="visitor-{{$visitor->id}}" type="button" class="rounded px-4 py-2 bg-red-400 text-white">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @push('js')
    <script>
        let x = document.getElementsByName('delete-button');
        x.forEach((el) => {
            el.addEventListener('click', (e) => {
            const id = e.target.id.replace('visitor-','');
            axios
                .delete(route('visitor-delete', {visitor: id}))
                .then((res) => {
                    console.log(res)
                    window.location = route('visitor')
                })
                .catch((err) => {
                    window.alert(err)
                })
            })
        })
    </script>
    @endpush
</x-app-layout>



