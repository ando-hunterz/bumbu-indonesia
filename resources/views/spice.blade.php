<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            spices
        </h2>
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full mx-auto text-center rounded-t-lg my-5">
                        <tr class="bg-blue-50 mb-10">
                          <th class="py-2">ID</th>
                          <th class="py-2">Name</th>
                          <th class="py-2">Translated Name</th>
                          <th class="py-2">Description</th>
                          <th class="py-2">ProvinceID</th>
                        </tr>
                        @foreach ($spices as $spice)
                        <tr id="spice-container-{{$spice->id}}">
                            <td class="py-2">{{ $spice->name }}</td>
                            <td class="py-2">{{ $spice->name_translate}}</td>
                            <td class="py-2">{{ $spice->description }}</td>
                            <td class="py-2"><a href="{{ route('province-detail', ['province' => $spice['provinces'][0]['id']]) }}" class="hover:text-gray-400">{{ $spice['provinces'][0]['id'] }}</a></td>
                            <td class="py-2">
                                <a href="{{ route('spice-detail', ['spice'=> $spice->id]) }}" class="rounded px-4 py-2 bg-blue-500 text-white">Show spice Details</a>
                                <button name="delete-button" id="spice-{{$spice->id}}" type="button" class="rounded px-4 py-2 bg-red-400 text-white">Delete</button>
                            </td>
                          </tr>
                         @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('js')
    <script>
        let x = document.getElementsByName('delete-button');
        x.forEach((el) => {
            el.addEventListener('click', (e) => {
            const id = e.target.id.replace('spice-','');
            axios
                .delete(route('spice-delete', {spice: id}))
                .then((res) => {
                    console.log(res)
                    document.getElementById('spice-container-'+id).remove()
                })
                .catch((err) => {
                    window.aler(err)
                })
            })
        })
    </script>
    @endpush
</x-app-layout>



