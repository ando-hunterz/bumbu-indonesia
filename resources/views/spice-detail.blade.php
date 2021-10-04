<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/basic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Spice {{ $spice->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="spice-container-detail">
                        <h3 class="text-3xl font-bold mb-8">{{ $spice->name }}</h3>
                        <h4 class="mb-4"><span class="font-semibold">Translated Name :</span> {{ $spice->name_translate }}</h4>
                        <div class="mb-4">
                            <h4 class="mb-2 font-semibold">Description :</h4>
                            <p>{{$spice->description}}</p>
                        </div>
                        <h4 class="mb-8"><span class="font-semibold">Province : </span><a href="{{ route('province-detail', ['province' => $spice['provinces'][0]['id']]) }}" class="hover:text-gray-400">{{ $spice['provinces'][0]['id'] }}</a></h4>
                        <div>
                            <button name="edit-button" id="spice-{{$spice->id}}" type="button" class="rounded px-4 py-2 bg-blue-400 text-white">Edit Spice</button>
                            <button name="delete-button" id="spice-{{$spice->id}}" type="button" class="rounded px-4 py-2 bg-red-400 text-white">Delete</button>
                        </div>
                    </div>
                    <div id="spice-container-form" class="hidden" x-data="spiceForm()">
                        <input class="text-3xl font-bold mb-8 border-none outline-none shadow rounded" name="name" x-model="name" type="text">
                        <div class="mb-4"><span class="font-semibold">Translated Name :</span><input class="ml-2 border-none outline-none shadow rounded" type="text" name="translated_name" x-model="name_translate"></div>
                        <div class="mb-4">
                            <h4 class="mb-2 font-semibold">Description :</h4>
                            <textarea class="border-none outline-none shadow rounded w-2/3 h-2/3" x-model="description"></textarea>
                        </div>
                        <h4 class="mb-4">
                            <span class="font-semibold">Province : </span>
                            <select x-model="province" class="border-none outline-none shadow rounded">
                                @foreach ($provinces as $province)
                                    <option value="{{$province['id']}}">{{$province['id']}}</option>
                                @endforeach
                            </select>
                        </h4>
                        <form action="/file-upload"
                            class="dropzone mb-8 rounded shadow "
                            id="photo-dropzone"
                            style="border:none"></form>
                        <div>
                            <button name="save-button" id="spice-{{$spice->id}}" type="button" class="rounded px-4 py-2 bg-red-400 text-white">Save Spice</button>
                            <button name="cancel-button" id="spice-{{$spice->id}}" type="button" class="rounded px-4 py-2 bg-red-400 text-white">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover = false
        let photoDropzone = new Dropzone("#photo-dropzone");
        const photos = [];
        @foreach ($spice->photo as $photo)
           photos.push("{{$photo["photo_url"]}}")
        @endforeach
        photos.forEach((item) => {
            let photoFile = { name: item.replace('/storage/spice/','') };
            photoDropzone.displayExistingFile(photoFile, item);
        })
        // let mockFile = { name: "Filename", size: 12345 };
        // photoDropzone.displayExistingFile(mockFile, 'https://alpinejs.dev/alpine_long.svg');
        function spiceForm() {
            return {
                
                name: "{{$spice->name}}",
                name_translate: "{{$spice->name_translate}}",
                description: "{{$spice->description}}",  
                province: "{{$spice['provinces'][0]['id']}}"  
            }
        }
        let x = document.getElementsByName('delete-button');
        x.forEach((el) => {
            el.addEventListener('click', (e) => {
            const id = e.target.id.replace('spice-','');
            axios
                .delete(route('spice-delete', {spice: id}))
                .then((res) => {
                    console.log(res)
                    window.location = route('spice')
                })
                .catch((err) => {
                    window.alert(err)
                })
            })
        })
        document.getElementsByName('edit-button')[0].addEventListener('click', () => {
            document.getElementById('spice-container-detail').classList.add('hidden')
            document.getElementById('spice-container-form').classList.remove('hidden')
        });
        document.getElementsByName('cancel-button')[0].addEventListener('click', () => {
            document.getElementById('spice-container-detail').classList.remove('hidden')
            document.getElementById('spice-container-form').classList.add('hidden')
        });
    </script>
    @endpush
</x-app-layout>


