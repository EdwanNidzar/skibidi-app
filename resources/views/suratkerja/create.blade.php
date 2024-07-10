<x-app-layout>
  <x-slot name="header">
    {{ __('Tambah Data Surat Kerja') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-xs">
    <form action="{{ route('suratkerjas.store') }}" method="POST">
      @csrf
      <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
        <div>
          <label for="nomorSuratKerja" class="block text-sm font-medium text-gray-700">Nomor Surat Kerja</label>
          <input type="text" name="nomorSuratKerja" id="nomorSuratKerja" autocomplete="off"
            value="{{ old('nomorSuratKerja', $nomorSuratKerja) }}" readonly
            class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          @error('nomorSuratKerja')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700" for="assign_to_id">
            Assign To
          </label>
          <select name="assign_to_id" id="assign_to_id"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <option value="">-- Pilih User --</option>
            @foreach ($userAssignTo as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
          </select>
          @error('assign_to_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="flex justify-end mt-4">
        <button type="submit"
          class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
          Simpan
        </button>
        <a href="{{ route('suratkerjas.index') }}"
          class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
          Kembali
        </a>
      </div>
    </form>
  </div>

</x-app-layout>
