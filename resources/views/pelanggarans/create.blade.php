<x-app-layout>
  <x-slot name="header">
    {{ __('Tambah Data Pelanggaran') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-xs">
    <form action="{{ route('pelanggarans.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div x-data="fileHandler()">
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
          {{-- input field for partai politik id --}}
          <div>
            <label for="parpol_id" class="block text-sm font-medium text-gray-700">Partai</label>
            <select id="parpol_id" name="parpol_id"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option value="disable">Pilih Partai</option>
              @foreach ($parpol as $party)
                <option value="{{ $party->id }}" {{ old('parpol_id') == $party->id ? 'selected' : '' }}>
                  {{ $party->parpol_name }}</option>
              @endforeach
            </select>
            @error('parpol_id')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          {{-- end input field for partai politik id --}}

          {{-- input field for jenis pelanggaran id --}}
          <div>
            <label for="jenis_pelanggaran_id" class="block text-sm font-medium text-gray-700">Jenis Pelanggaran</label>
            <select id="jenis_pelanggaran_id" name="jenis_pelanggaran_id"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option value="disable">Pilih Jenis Pelanggaran</option>
              @foreach ($jenispelanggaran as $jp)
                <option value="{{ $jp->id }}" {{ old('jenis_pelanggaran_id') == $jp->id ? 'selected' : '' }}>
                  {{ $jp->jenis_pelanggaran }}</option>
              @endforeach
            </select>
            @error('jenis_pelanggaran_id')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          {{-- end input field for jenis pelanggaran id --}}

          {{-- input field for status_peserta_pemilu --}}
          <div>
            <label for="status_peserta_pemilu" class="block text-sm font-medium text-gray-700">Status Peserta
              Pemilu</label>
            <select id="status_peserta_pemilu" name="status_peserta_pemilu"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option value="disable">Pilih Status Peserta Pemilu</option>
              <option value="DPR RI" {{ old('status_peserta_pemilu') == 'DPR RI' ? 'selected' : '' }}>DPR RI</option>
              <option value="DPRD Provinsi" {{ old('status_peserta_pemilu') == 'DPRD Provinsi' ? 'selected' : '' }}>
                DPRD Provinsi</option>
              <option value="DPRD Kabupaten/Kota"
                {{ old('status_peserta_pemilu') == 'DPRD Kabupaten/Kota' ? 'selected' : '' }}>DPRD Kabupaten/Kota
              </option>
              <option value="DPD RI" {{ old('status_peserta_pemilu') == 'DPD RI' ? 'selected' : '' }}>DPD RI</option>
            </select>
            @error('status_peserta_pemilu')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          {{-- end status_peserta_pemilu --}}

          {{-- input field for nama_bacaleg --}}
          <div>
            <label for="nama_bacaleg" class="block text-sm font-medium text-gray-700">Nama Bacaleg</label>
            <input type="text" name="nama_bacaleg" id="nama_bacaleg"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              placeholder="Nama Bacaleg" value="{{ old('nama_bacaleg') }}">
            @error('nama_bacaleg')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          {{-- end nama_bacaleg --}}

          {{-- input field for dapil --}}
          <div>
            <label for="dapil" class="block text-sm font-medium text-gray-700">Dapil</label>
            <select id="dapil" name="dapil"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option value="disable" disabled selected>Pilih Dapil</option>
            </select>
            @error('dapil')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          {{-- end dapil --}}

          {{-- input field for tanggal_input --}}
          <div>
            <label for="tanggal_input" class="block text-sm font-medium text-gray-700">Tanggal Input</label>
            <input type="date" name="tanggal_input" id="tanggal_input"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              value="{{ old('tanggal_input') }}">
          </div>
          {{-- end input field for tanggal_input --}}
        </div>

        {{-- input field for keterangan --}}
        <div class="grid-cols-1 gap-6 mt-4">
          <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
          <textarea id="keterangan" name="keterangan" rows="3"
            class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="Keterangan">{{ old('keterangan') }}</textarea>
          @error('keterangan')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
          {{-- end keterangan --}}

          {{-- multi input image --}}
          <div class="grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <label for="image" class="block text-sm font-medium text-gray-700">Bukti Pelanggaran</label>
            <input id="image" name="image[]" type="file" multiple
              class="file-input file-input-bordered w-full max-w-xs" @change="fileChosen">
            @error('image')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <div class="mt-2 grid grid-cols-3 gap-3">
              <template x-for="(image, index) in PicturePreview" :key="index">
                <div class="relative">
                  <img :src="image" class="h-50 w-50 object-cover">
                </div>
              </template>
            </div>
          </div>
          {{-- end multi input image --}}

          {{-- handle suratkerja --}}
          @if ($suratKerja)
            <input type="hidden" name="surat_kerja_id" value="{{ $suratKerja->id }}">
          @endif
          @error('surat_kerja_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
          {{-- end handle suratKerja --}}

          {{-- btn action --}}
          <div class="col-span-2 flex justify-end mt-4">
            <button type="submit"
              class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
              Simpan
            </button>
            <a href="{{ route('pelanggarans.index') }}"
              class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
              Kembali
            </a>
          </div>
          {{-- end btn action --}}
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const dapilOptions = {
        'DPR RI': [{
            value: '',
            label: 'PILIH DPR RI'
          },
          {
            value: 'Kalimantan Selatan 1',
            label: 'Kalimantan Selatan 1'
          },
          {
            value: 'Kalimantan Selatan 2',
            label: 'Kalimantan Selatan 2'
          }
        ],
        'DPRD Provinsi': [{
            value: '',
            label: 'PILIH DPRD Provinsi'
          },
          {
            value: 'Kalimantan Selatan 1',
            label: 'Kalimantan Selatan 1'
          },
          {
            value: 'Kalimantan Selatan 2',
            label: 'Kalimantan Selatan 2'
          },
          {
            value: 'Kalimantan Selatan 3',
            label: 'Kalimantan Selatan 3'
          },
          {
            value: 'Kalimantan Selatan 4',
            label: 'Kalimantan Selatan 4'
          },
          {
            value: 'Kalimantan Selatan 5',
            label: 'Kalimantan Selatan 5'
          },
          {
            value: 'Kalimantan Selatan 6',
            label: 'Kalimantan Selatan 6'
          }, {
            value: 'Kalimantan Selatan 7',
            label: 'Kalimantan Selatan 7'
          }
        ],
        'DPRD Kabupaten/Kota': [{
            value: '',
            label: 'PILIH DPRD Kabupaten/Kota'
          },
          {
            value: '',
            label: '--Kabupaten Kotabaru--'
          },
          {
            value: 'Tanah Laut 1',
            label: 'Tanah Laut 1'
          },
          {
            value: 'Tanah Laut 2',
            label: 'Tanah Laut 2'
          },
          {
            value: 'Tanah Laut 3',
            label: 'Tanah Laut 3'
          },
          {
            value: 'Tanah Laut 4',
            label: 'Tanah Laut 4'
          },
          {
            value: '',
            label: '--Kabupaten Kotabaru--'
          },
          {
            value: 'Kotabaru 1',
            label: 'Kotabaru 1'
          },
          {
            value: 'Kotabaru 2',
            label: 'Kotabaru 2'
          },
          {
            value: 'Kotabaru 3',
            label: 'Kotabaru 3'
          },
          {
            value: 'Kotabaru 4',
            label: 'Kotabaru 4'
          },
          {
            value: '',
            label: '--Kabupaten Banjar--'
          },
          {
            value: 'Banjar 1',
            label: 'Banjar 1'
          },
          {
            value: 'Banjar 2',
            label: 'Banjar 2'
          },
          {
            value: 'Banjar 3',
            label: 'Banjar 3'
          },
          {
            value: 'Banjar 4',
            label: 'Banjar 4'
          },
          {
            value: 'Banjar 5',
            label: 'Banjar 5'
          },
          {
            value: '',
            label: '--Kabupaten Tapin--'
          },
          {
            value: 'Tapin 1',
            label: 'Tapin 1'
          },
          {
            value: 'Tapin 2',
            label: 'Tapin 2'
          },
          {
            value: 'Tapin 3',
            label: 'Tapin 3'
          },
          {
            value: '',
            label: '--Kabupaten HSS--'
          },
          {
            value: 'HSS 1',
            label: 'HSS 1'
          },
          {
            value: 'HSS 2',
            label: 'HSS 2'
          },
          {
            value: 'HSS 3',
            label: 'HSS 3'
          },
          {
            value: '',
            label: '--Kabupaten HST--'
          },
          {
            value: 'HST 1',
            label: 'HST 1'
          },
          {
            value: 'HST 2',
            label: 'HST 2'
          },
          {
            value: 'HST 3',
            label: 'HST 3'
          },
          {
            value: 'HST 4',
            label: 'HST 4'
          },
          {
            value: 'HST 5',
            label: 'HST 5'
          },
          {
            value: '',
            label: '--Kabupaten HSU--'
          },
          {
            value: 'HSU 1',
            label: 'HSU 1'
          },
          {
            value: 'HSU 2',
            label: 'HSU 2'
          },
          {
            value: 'HSU 3',
            label: 'HSU 3'
          },
          {
            value: 'HSU 4',
            label: 'HSU 4'
          },
          {
            value: '',
            label: '--Kabupaten Tabalong--'
          },
          {
            value: 'Tabalong 1',
            label: 'Tabalong 1'
          },
          {
            value: 'Tabalong 2',
            label: 'Tabalong 2'
          },
          {
            value: 'Tabalong 3',
            label: 'Tabalong 3'
          },
          {
            value: 'Tabalong 4',
            label: 'Tabalong 4'
          },
          {
            value: '',
            label: '--Kabupaten Tanah Bumbu--'
          },
          {
            value: 'Tanah Bumbu 1',
            label: 'Tanah Bumbu 1'
          },
          {
            value: 'Tanah Bumbu 2',
            label: 'Tanah Bumbu 2'
          },
          {
            value: 'Tanah Bumbu 3',
            label: 'Tanah Bumbu 3'
          },
          {
            value: 'Tanah Bumbu 4',
            label: 'Tanah Bumbu 4'
          },
          {
            value: '',
            label: '--Kabupaten Balangan--'
          },
          {
            value: 'Balangan 1',
            label: 'Balangan 1'
          },
          {
            value: 'Balangan 2',
            label: 'Balangan 2'
          },
          {
            value: 'Balangan 3',
            label: 'Balangan 3'
          },
          {
            value: '',
            label: '--Kota Banjarmasin--'
          },
          {
            value: 'Banjarmasin 1',
            label: 'Banjarmasin 1'
          },
          {
            value: 'Banjarmasin 2',
            label: 'Banjarmasin 2'
          },
          {
            value: 'Banjarmasin 3',
            label: 'Banjarmasin 3'
          },
          {
            value: 'Banjarmasin 4',
            label: 'Banjarmasin 4'
          },
          {
            value: 'Banjarmasin 5',
            label: 'Banjarmasin 5'
          },
          {
            value: '',
            label: '--Kota Banjarbaru--'
          },
          {
            value: 'Banjarbaru 1',
            label: 'Banjarbaru 1'
          },
          {
            value: 'Banjarbaru 2',
            label: 'Banjarbaru 2'
          },
          {
            value: 'Banjarbaru 3',
            label: 'Banjarbaru 3'
          },
          {
            value: 'Banjarbaru 4',
            label: 'Banjarbaru 4'
          },


        ],
        'DPD RI': [{
            value: 'Kalimantan Selatan',
            label: 'Kalimantan Selatan'
          },

        ],
      };

      const dapilSelect = document.getElementById('dapil');
      const statusPesertaPemiluSelect = document.getElementById('status_peserta_pemilu');

      statusPesertaPemiluSelect.addEventListener('change', function() {
        const selectedStatus = this.value;
        const options = dapilOptions[selectedStatus] || [];

        // Clear existing options
        dapilSelect.innerHTML = '';

        // Add new options
        options.forEach(option => {
          const optionElement = document.createElement('option');
          optionElement.value = option.value;
          optionElement.textContent = option.label;
          dapilSelect.appendChild(optionElement);
        });
      });
    });
  </script>

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
