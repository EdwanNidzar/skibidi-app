<x-app-layout>
  <x-slot name="header">
    {{ __('Show Data Pelanggaran') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-xs">
    <form action="{{ route('pelanggarans.store', $pelanggaran->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div x-data="fileHandler()">

        {{-- input field for suratKerja --}}
        <div>
          <label for="nomor_surat_kerja" class="block text-sm font-medium text-gray-700">Nomor Surat Kerja</label>
          <input type="text" name="nomor_surat_kerja" id="nomor_surat_kerja" readonly
            class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            value="{{ $pelanggaran->suratKerja->nomor_surat_kerja }}">
        </div>
        {{-- end input field for suratKerja --}}

        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
          {{-- input field for partai politik id --}}
          <div>
            <label for="parpol_id" class="block text-sm font-medium text-gray-700">Partai</label>
            <input type="text" name="parpol_id" id="parpol_id" value="{{ $pelanggaran->parpol->parpol_name }}"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              readonly>
          </div>
          {{-- end input field for partai politik id --}}

          {{-- input field for jenis pelanggaran id --}}
          <div>
            <label for="jenis_pelanggaran_id" class="block text-sm font-medium text-gray-700">Jenis Pelanggaran</label>
            <input type="text" name="jenis_pelanggaran_id" id="jenis_pelanggaran_id"
              value="{{ $pelanggaran->jenisPelanggaran->jenis_pelanggaran }}"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              readonly>
          </div>
          {{-- end input field for jenis pelanggaran id --}}

          {{-- input field for status_peserta_pemilu --}}
          <div>
            <label for="status_peserta_pemilu" class="block text-sm font-medium text-gray-700">Status Peserta
              Pemilu</label>
            <input type="text" name="status_peserta_pemilu" id="status_peserta_pemilu"
              value="{{ $pelanggaran->status_peserta_pemilu }}"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              readonly>
          </div>
          {{-- end status_peserta_pemilu --}}

          {{-- input field for nama_bacaleg --}}
          <div>
            <label for="nama_bacaleg" class="block text-sm font-medium text-gray-700">Nama Bacaleg</label>
            <input type="text" name="nama_bacaleg" id="nama_bacaleg"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              readonly value="{{ $pelanggaran->nama_bacaleg }}">
            @error('nama_bacaleg')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          {{-- end nama_bacaleg --}}

          {{-- input field for dapil --}}
          <div>
            <label for="dapil" class="block text-sm font-medium text-gray-700">Dapil</label>
            <input type="text" name="dapil" id="dapil" value="{{ $pelanggaran->dapil }}"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              readonly>
          </div>
          {{-- end dapil --}}

          {{-- input field for tanggal_input --}}
          <div>
            <label for="tanggal_input" class="block text-sm font-medium text-gray-700">Tanggal Input</label>
            <input type="text" name="tanggal_input" id="tanggal_input"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              value="{{ $pelanggaran->tanggal_input }}" readonly>
          </div>
          {{-- end input field for tanggal_input --}}
        </div>


        {{-- input field for keterangan --}}
        <div>
          <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
          <textarea name="keterangan" id="keterangan"
            class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            readonly>{{ $pelanggaran->keterangan }}</textarea>
        </div>
        {{-- end input field for keterangan --}}

        {{-- multi input image --}}
        <div class="col-span-2" x-data="fileHandler()">
          <label for="image" class="block text-sm font-medium text-gray-700">Bukti Pelanggaran</label>
          <div class="grid grid-cols-3 gap-3 mt-2">
            @foreach ($pelanggaran->pelanggaranImages as $image)
              <div class="relative">
                <img src="{{ asset('/storage/pelanggarans/' . $image->image) }}" alt="{{ $image->image }}"
                  class="h-50 w-50 object-cover">
              </div>
            @endforeach
          </div>
        </div>
        {{-- end multi input image --}}

        {{-- btn action --}}
        <div class="col-span-2 flex justify-end mt-4">
          <a href="{{ route('pelanggarans.index') }}"
            class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
            Kembali
          </a>
        </div>
        {{-- end btn action --}}
      </div>
    </form>
  </div>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('fileHandler', () => ({
        PicturePreview: [],
        fileChosen(event) {
          this.PicturePreview = [];
          const files = event.target.files;
          for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            reader.onload = (e) => {
              this.PicturePreview.push(e.target.result);
            };
            reader.readAsDataURL(file);
          }
        }
      }));
    });
  </script>
</x-app-layout>
