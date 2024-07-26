<x-app-layout>
  <x-slot name="header">
    {{ __('Dashboard') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-md mb-4">
    <div class="mt-2">
      {{ __('Selamat Datang!') }}
    </div>
    <div class="mt-2">
      <span class="font-bold">{{ Auth::user()->name }}</span>
    </div>
    <div class="mt-2">
      {{ __('Roles:') }}
      @foreach (Auth::user()->getRoleNames() as $role)
        <span
          class="inline-block bg-blue-500 text-white text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $role }}</span>
      @endforeach
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
    <div class="p-4 bg-white rounded-lg shadow-md">
      <div>
        {{ __('Partai Politik') }}
        <canvas id="parpolChart"></canvas>
      </div>
    </div>
    <div class="p-4 bg-white rounded-lg shadow-md">
      <div>
        {{ __('Jenis Pelanggaran') }}
        <canvas id="jenisPelanggaranChart"></canvas>
      </div>
    </div>
  </div>

  <div class="p-4 bg-white rounded-lg shadow-md mb-4">
    <div>
      {{ __('Dapil and Status Chart') }}
      <canvas id="dapilStatusChart"></canvas>
    </div>
  </div>

  <div class="p-4 bg-white rounded-lg shadow-md mb-4">
    <div class="mt-2">
      {{ __('Maps!') }}
      <!-- Map container -->
      <div id="map" class="mt-4" style="height: 400px;"></div>
    </div>
  </div>

  <!-- Include Chart.js library -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Include Leaflet.js library -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Function to generate random RGBA color
      function getRandomColor() {
        const r = Math.floor(Math.random() * 255);
        const g = Math.floor(Math.random() * 255);
        const b = Math.floor(Math.random() * 255);
        const a = 0.5;
        return `rgba(${r}, ${g}, ${b}, ${a})`;
      }

      // Function to generate an array of random colors
      function getRandomColors(count) {
        const colors = [];
        for (let i = 0; i < count; i++) {
          colors.push(getRandomColor());
        }
        return colors;
      }

      // Jenis Pelanggaran Chart
      const jenisPelanggaranLabels = {!! json_encode($jenisPelanggaranLabels) !!};
      const jenisPelanggaranValues = {!! json_encode($jenisPelanggaranValues) !!};
      const jenisPelanggaranColors = getRandomColors(jenisPelanggaranLabels.length);

      const ctx1 = document.getElementById('jenisPelanggaranChart').getContext('2d');
      new Chart(ctx1, {
        type: 'pie',
        data: {
          labels: jenisPelanggaranLabels,
          datasets: [{
            label: 'Total Pelanggaran per Jenis Pelanggaran',
            data: jenisPelanggaranValues,
            backgroundColor: jenisPelanggaranColors,
            borderColor: jenisPelanggaranColors.map(color => color.replace('0.5', '1')),
            borderWidth: 1
          }]
        }
      });

      // Partai Politik Chart
      const parpolLabels = {!! json_encode($parpolLabels) !!};
      const parpolValues = {!! json_encode($parpolValues) !!};
      const parpolColors = getRandomColors(parpolLabels.length);

      const ctx2 = document.getElementById('parpolChart').getContext('2d');
      new Chart(ctx2, {
        type: 'bar',
        data: {
          labels: parpolLabels,
          datasets: [{
            label: 'Total Pelanggaran per Partai Politik',
            data: parpolValues,
            backgroundColor: parpolColors,
            borderColor: parpolColors.map(color => color.replace('0.5', '1')),
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });

      // Dapil and Status Chart
      const statusLabels = {!! json_encode($statusLabels) !!};
      const dapilLabels = {!! json_encode($dapilLabels) !!};
      const chartData = {!! json_encode($chartData) !!};
      const dapilStatusColors = getRandomColors(dapilLabels.length);

      const ctx3 = document.getElementById('dapilStatusChart').getContext('2d');
      new Chart(ctx3, {
        type: 'bar',
        data: {
          labels: dapilLabels,
          datasets: statusLabels.map((status, index) => ({
            label: status,
            data: chartData[status],
            backgroundColor: getRandomColor(),
            borderColor: dapilStatusColors[index],
            borderWidth: 1
          }))
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize Leaflet map
      const map = L.map('map').setView([-3.316694, 114.590111], 13);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      // Add markers to map
      const locations = {!! json_encode($locations) !!};
      locations.forEach(location => {
        let popupContent = `<b>Nama:</b> ${location.pelanggaran.nama_bacaleg}<br>
                                <b>Partai Politik:</b> ${location.pelanggaran.parpol.parpol_name}<br>
                                <b>Jenis Pelanggaran:</b> ${location.pelanggaran.jenis_pelanggaran.jenis_pelanggaran}<br>
                                <b>Keterangan:</b> ${location.pelanggaran.keterangan}<br>
                                <b>Bukti-bukti:</b><br>`;

        if (location.pelanggaran.pelanggaran_images && location.pelanggaran.pelanggaran_images.length > 0) {
          popupContent += '<div class="flex">';
          location.pelanggaran.pelanggaran_images.forEach((bukti, index) => {
            const imageUrl = `/storage/pelanggarans/${bukti.image}`;
            popupContent += `<a href="${imageUrl}" target="_blank" class="mr-2 mb-2">
                                    <img src="${imageUrl}" width="100" height="auto">
                                  </a>`;
            if ((index + 1) % 3 === 0) {
              popupContent += '<br>';
            }
          });
          popupContent += '</div>';
        } else {
          popupContent += `Tidak ada bukti yang tersedia.<br>`;
        }

        L.marker([location.latitude, location.longitude]).addTo(map)
          .bindPopup(popupContent);
      });

    });
  </script>
</x-app-layout>
