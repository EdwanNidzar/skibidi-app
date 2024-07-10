<x-app-layout>
  <x-slot name="header">
    {{ __('Show Data Partai Politik') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-xs">
    <form action="{{ route('parpols.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
        <div>
          <label for="parpol_number" class="block text-sm font-medium text-gray-700">Nomor Partai</label>
          <input value="{{ $parpol->parpol_number }}" type="text" name="parpol_number" id="parpol_number"
            autocomplete="off"
            class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            readonly>
          @error('parpol_number')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="parpol_name" class="block text-sm font-medium text-gray-700">Nama Partai</label>
          <input value="{{ $parpol->parpol_name }}" type="text" name="parpol_name" id="parpol_name"
            autocomplete="off"
            class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            readonly>
          @error('parpol_name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div x-data="{ parpolPicturePreview: '{{ $parpol->parpol_picture ? asset('/storage/parpols/' . $parpol->parpol_picture) : '' }}' }">
          <label for="parpol_picture" class="block text-sm font-medium text-gray-700">Photo Partai</label>
          @error('parpol_picture')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
          <template x-if="parpolPicturePreview">
            <div class="mt-2">
              <img x-bind:src="parpolPicturePreview" class="h-28 w-h-28 object-cover">
            </div>
          </template>
        </div>
      </div>
      <div class="flex justify-end mt-4">
        <a href="{{ route('parpols.index') }}"
          class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
          Kembali
        </a>
      </div>
    </form>
  </div>

  {{--  Add this script to the end of the file --}}
  <script>
    function fileChosen(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          this.parpolPicturePreview = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    }
  </script>

</x-app-layout>
