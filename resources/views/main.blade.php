<x-layout>

    <div class="grid grid-cols-2">

        {{-- UPLOAD IMAGE --}}
        <div class="relative flex items-center min-h-screen justify-center overflow-hidden">
            <form action="{{ route('main.store') }}" method="POST" class="shadow p-12" enctype="multipart/form-data">
                @csrf
                <label class="block mb-4" x-data="showImage()">
                    <span class="sr-only">Choose File</span>
                    <input type="file" name="image" @change="showPreview(event)"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />

                    <img id="preview" class="object-cover h-32 mt-2 w-60">

                </label>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-indigo-600 rounded">Submit</button>
            </form>
        </div>

        {{-- RANDOM IMAGE --}}
        <div class="relative flex items-center min-h-screen justify-center overflow-hidden">
            <form method="GET" action="randomimage/{{ $image_id }}">
                @csrf
                <label class="block mb-4">
                    <div class="block mb-4">
                        <a href="randomimage"
                            class="block w-48 text-sm font-medium text-blue-700 hover:text-slate-100 bg-blue-300 hover:bg-blue-600 rounded-xl border border-black px-4 py-2">
                            Immagine random
                        </a>
                    </div>
                    @isset($image)
                        <p>{{ $image_id }}</p>
                        <img class="w-96" src="{{ asset($image) }}" />
                        {{-- <p>{{ $author }} <span> <a href="{{ $author_link }}">{{ $author_link }}</a></span></p> --}}
                    @endisset
                    @empty($image)
                        <img class="object-cover h-32 mt-2 w-60">
                    @endempty
                    @error('image')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </label>
                <button type="submit" class="px-4 py-2 text-sm text-white bg-indigo-600 rounded">Submit</button>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function showImage() {
                return {
                    showPreview(event) {
                        // console.log('showPreview called!');
                        if (event.target.files.length > 0) {
                            var src = URL.createObjectURL(event.target.files[0]);
                            var preview = document.getElementById("preview");
                            preview.src = src;
                            preview.style.display = "block";
                        }
                    }
                }
            }
        </script>
    @endpush

</x-layout>
