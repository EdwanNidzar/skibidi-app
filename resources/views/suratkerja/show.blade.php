<x-app-layout>
  <x-slot name="header">
    {{ __('Show Data Surat Kerja') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-xs">
    <form action="{{ route('suratkerjas.store', $suratKerjas->id) }}" method="POST">
      @csrf
      <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
        <div>
          <label for="nomorSuratKerja" class="block text-sm font-medium text-gray-700">Nomor Surat Kerja</label>
          <input type="text" name="nomorSuratKerja" id="nomorSuratKerja" autocomplete="off"
            value="{{ $suratKerjas->nomor_surat_kerja }}" readonly
            class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700" for="assign_to_id">
            Assign By
          </label>
          <input type="text" name="assign_by" id="assign_by" autocomplete="off"
            value="{{ $suratKerjas->assignBy->name }}" readonly
            class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700" for="assign_to_id">
            Assign To
          </label>
          <input type="text" name="assign_to" id="assign_to" autocomplete="off"
            value="{{ $suratKerjas->assignTo->name }}" readonly
            class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
      </div>

      <div class="flex justify-end mt-4">
        <a href="{{ route('suratkerjas.index') }}"
          class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
          Kembali
        </a>
      </div>
    </form>
  </div>

</x-app-layout>
