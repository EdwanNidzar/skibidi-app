<x-app-layout>
    <x-slot name="header">
      {{ __('Show Data Jenis Pelanggaran') }}
    </x-slot>
  
    <div class="p-4 bg-white rounded-lg shadow-xs">
      <form action="{{ route('jenispelanggarans.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
         
          <div>
            <label for="jenis_pelanggaran" class="block text-sm font-medium text-gray-700">Jenis Pelanggaran</label>
            <input type="text" name="jenis_pelanggaran" id="jenis_pelanggaran" value="{{ $jenis_pelanggaran->jenis_pelanggaran }}" autocomplete="off" readonly
              class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('jenis_pelanggaran')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
  
        </div>
        <div class="flex justify-end mt-4">
          <a href="{{ route('jenispelanggarans.index') }}"
            class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
            Kembali
          </a>
        </div>
      </form>
    </div>
  
  
  </x-app-layout>
  