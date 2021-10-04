<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Visitors
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full mx-auto text-center rounded-t-lg my-5">
                        <tr class="bg-blue-50 mb-10">
                          <th class="py-2">ID</th>
                          <th class="py-2">IP</th>
                          <th class="py-2">Name</th>
                          <th class="py-2">Action</th>
                        </tr>
                        @foreach ($visitors as $visitor)
                        <tr id="visitor-container-{{$visitor->id}}">
                            <td class="py-2">{{ $visitor->id }}</td>
                            <td class="py-2">{{ $visitor->ip}}</td>
                            <td class="py-2">{{ $visitor->name }}</td>
                            <td class="py-2">
                                <a href="{{ route('visitor-detail', ['visitor'=> $visitor->id]) }}" class="rounded px-4 py-2 bg-blue-500 text-white">Show Visitor Details</a>
                                <button name="delete-button" id="visitor-{{$visitor->id}}" type="button" class="rounded px-4 py-2 bg-red-400 text-white">Delete</button>
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
            const id = e.target.id.replace('visitor-','');
            axios
                .delete(route('visitor-delete', {visitor: id}))
                .then((res) => {
                    console.log(res)
                    document.getElementById('visitor-container-'+id).remove()
                })
                .catch((err) => {
                    window.aler(err)
                })
            })
        })
    </script>
    @endpush
</x-app-layout>



