<x-app-layout>
  <x-slot name="header">
    {{ __('Tambah Data Laporan Pelanggaran') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-lg">
    <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Include Leaflet Geocoder CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <form action="{{ route('laporanpelanggarans.store') }}" method="POST">
      @csrf
      <div>
        <label for="pelanggaran_id" class="block text-sm font-medium text-gray-700">Pelanggaran</label>
        <select id="pelanggaran_id" name="pelanggaran_id"
          class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          <option value="">Pilih Pelanggaran</option>
          @foreach ($pelanggarans as $pelanggaran)
            <option value="{{ $pelanggaran->id }}">{{ $pelanggaran->nama_bacaleg }} |
              {{ $pelanggaran->jenisPelanggaran->jenis_pelanggaran }}</option>
          @endforeach
        </select>
        @error('pelanggaran_id')
          <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror

        <div id="pelanggaran-details" class="mt-4 my-4">
          <!-- Data Pelanggaran akan muncul di sini -->
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-4">
          <div>
            <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
            <select id="provinsi" name="provinsi_id"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option value="">Pilih Provinsi</option>
              @foreach ($provinces as $provinsi)
                <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
              @endforeach
            </select>
            @error('provinsi_id')
              <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="regency_id" class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
            <select id="regency_id" name="regency_id"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option value="">Pilih Kabupaten/Kota</option>
            </select>
            @error('regency_id')
              <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="district_id" class="block text-sm font-medium text-gray-700">Kecamatan</label>
            <select id="district_id" name="district_id"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option value="">Pilih Kecamatan</option>
            </select>
            @error('district_id')
              <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="village_id" class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
            <select id="village_id" name="village_id"
              class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option value="">Pilih Kelurahan/Desa</option>
            </select>
            @error('village_id')
              <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
        </div>

        {{-- Input field for alamat --}}
        <div class="mt-6">
          <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Pelanggaran</label>
          <textarea id="alamat" name="alamat" rows="3"
            class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="Alamat Pelanggaran"></textarea>
          @error('alamat')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Hidden fields for latitude and longitude -->
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
        @error('latitude')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        @error('longitude')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror

        <!-- Leaflet Map -->
        <div class="mt-6">
          <div id="map" style="height: 400px;"></div>
        </div>

        <div class="flex justify-end mt-4">
          <button type="submit"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
            Simpan
          </button>
          <a href="{{ route('laporanpelanggarans.index') }}"
            class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
            Kembali
          </a>
        </div>
      </div>
    </form>
  </div>

  <!-- Include Leaflet JavaScript -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <!-- Include Leaflet Geocoder JavaScript -->
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

  <!-- Initialize Leaflet Map -->
  <script>
    var map = L.map('map').setView([-3.316694, 114.590111], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
    }).addTo(map);

    var marker;

    function updateLatLng(lat, lng) {
      document.getElementById('latitude').value = lat;
      document.getElementById('longitude').value = lng;
    }

    // Handle map click to add a marker
    map.on('click', function(e) {
      if (marker) {
        map.removeLayer(marker);
      }
      marker = L.marker(e.latlng).addTo(map);
      updateLatLng(e.latlng.lat, e.latlng.lng);
    });

    // Add geocoding control to the map
    var geocoder = L.Control.geocoder({
      defaultMarkGeocode: false
    }).on('markgeocode', function(e) {
      var latlng = e.geocode.center;
      if (marker) {
        map.removeLayer(marker);
      }
      marker = L.marker(latlng).addTo(map);
      updateLatLng(latlng.lat, latlng.lng);
      map.setView(latlng, 13);
    }).addTo(map);
  </script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    const pelanggarans = @json($pelanggarans);

    document.getElementById('pelanggaran_id').addEventListener('change', function() {
      const pelanggaranId = this.value;
      const pelanggaran = pelanggarans.find(p => p.id == pelanggaranId);
      if (pelanggaran) {
        const images = (pelanggaran.pelanggaran_images || []).map(image => `
              <img src="{{ asset('storage/pelanggarans/${image.image}') }}" alt="${image.image}" class="object-cover rounded-lg m-1" style="width: 50%;">
            `).join('');

        document.getElementById('pelanggaran-details').innerHTML = `
            <table class="min-w-full bg-white border border-gray-200">
              <tbody>
                <tr class="border-b">
                  <td class="px-4 py-2 font-semibold">Nama Bacaleg</td>
                  <td>:</td>
                  <td class="px-4 py-2">${pelanggaran.nama_bacaleg}</td>
                </tr>
                <tr class="border-b">
                  <td class="px-4 py-2 font-semibold">Jenis Pelanggaran</td>
                  <td>:</td>
                  <td class="px-4 py-2">${pelanggaran.jenis_pelanggaran.jenis_pelanggaran}</td>
                </tr>
                <tr class="border-b">
                  <td class="px-4 py-2 font-semibold">Status Peserta Pemilu</td>
                  <td>:</td>
                  <td class="px-4 py-2">${pelanggaran.status_peserta_pemilu}</td>
                </tr>
                <tr class="border-b">
                  <td class="px-4 py-2 font-semibold">Daerah Pemilihan (Dapil)</td>
                  <td>:</td>
                  <td class="px-4 py-2">${pelanggaran.dapil}</td>
                </tr>
                <tr class="border-b">
                  <td class="px-4 py-2 font-semibold">Tanggal Input</td>
                  <td>:</td>
                  <td class="px-4 py-2">${pelanggaran.tanggal_input}</td>
                </tr>
                <tr>
                  <td class="px-4 py-2 font-semibold">Keterangan</td>
                  <td>:</td>
                  <td class="px-4 py-2">${pelanggaran.keterangan}</td>
                </tr>
                <tr>
                  <td class="px-4 py-2 font-semibold">Bukti Bukti</td>
                  <td>:</td>
                  <td class="flex flex-wrap gap-2">${images}</td>
                </tr>
              </tbody>
            </table>
          `;
      } else {
        document.getElementById('pelanggaran-details').innerHTML = '';
      }
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#provinsi').change(function() {
        var province_id = $(this).val();
        $('#regency_id').empty().append('<option value="">Pilih Kabupaten/Kota</option>');
        $('#district_id').empty().append('<option value="">Pilih Kecamatan</option>');
        $('#village_id').empty().append('<option value="">Pilih Kelurahan/Desa</option>');

        if (province_id) {
          $.ajax({
            url: '/laporanpelanggarans/regency/' + province_id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              $.each(data, function(key, regency) {
                $('#regency_id').append('<option value="' + regency.id + '">' + regency.name +
                  '</option>');
              });
            }
          });
        }
      });

      $('#regency_id').change(function() {
        var regency_id = $(this).val();
        $('#district_id').empty().append('<option value="">Pilih Kecamatan</option>');
        $('#village_id').empty().append('<option value="">Pilih Kelurahan/Desa</option>');

        if (regency_id) {
          $.ajax({
            url: '/laporanpelanggarans/districts/' + regency_id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              $.each(data, function(key, district) {
                $('#district_id').append('<option value="' + district.id + '">' + district.name +
                  '</option>');
              });
            }
          });
        }
      });

      $('#district_id').change(function() {
        var district_id = $(this).val();
        $('#village_id').empty().append('<option value="">Pilih Kelurahan/Desa</option>');

        if (district_id) {
          $.ajax({
            url: '/laporanpelanggarans/villages/' + district_id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              $.each(data, function(key, village) {
                $('#village_id').append('<option value="' + village.id + '">' + village.name +
                  '</option>');
              });
            }
          });
        }
      });
    });
  </script>
</x-app-layout>
