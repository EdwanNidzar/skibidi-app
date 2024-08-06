<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Custom CSS -->
  <style>
    .navbar-custom {
      background-color: #0056b3;
    }

    .hero-carousel {
      height: 100vh;
    }

    .carousel-item {
      height: 100%;
      background: no-repeat center center;
      background-size: cover;
    }

    .carousel-caption {
      bottom: 20%;
    }

    .section-header {
      margin-top: 5rem;
      text-align: center;
    }

    .map-section {
      height: 500px;
      background-color: #f8f9fa;
    }

    .footer-custom {
      background-color: #0056b3;
    }

    .navbar-brand {
      display: flex;
      align-items: center;
    }

    .navbar-brand img {
      margin-right: 10px;
    }

    /* Minimalist Scrollbar for WebKit Browsers (Chrome, Safari, Edge) */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
      background: #888;
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #555;
    }

    .small-chart {
      width: 800px;
      height: 500px;
      margin: 0 auto;
    }

    .pie-chart {
      width: 50%;
      height: 50%;
      margin: 0 auto;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="{{ asset('images/logo-bawaslu.png') }}" alt="Logo" width="50" height="50">
        BAWASLU
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#politicalParties">Partai Politik</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#violationTypes">Jenis Pelanggaran</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#dapil">Status Dan Dapil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#map">Map</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Carousel -->
  <section class="hero-carousel">
    <div id="home" class="carousel slide carousel-fade h-100" data-bs-ride="carousel" data-bs-interval="3000">
      <div class="carousel-inner h-100">
        <div class="carousel-item active" style="background-image: url('{{ asset('images/FTM05191.JPG') }}');">
          <div class="carousel-caption d-none d-md-block text-center">
            <h1 class="display-4">Badan Pengawas Pemilihan Umum Kalimantan Selatan</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit optio facere vel, vero doloremque rem
              nobis provident accusamus ipsum, aliquam ex quas perspiciatis officia aliquid est assumenda nostrum.
              Rerum, blanditiis.</p>
          </div>
        </div>
        <div class="carousel-item" style="background-image: url('{{ asset('images/FTM04942.JPG') }}');">
          <div class="carousel-caption d-none d-md-block text-center">
            <h1 class="display-4">Badan Pengawas Pemilihan Umum Kalimantan Selatan</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit optio facere vel, vero doloremque rem
              nobis provident accusamus ipsum, aliquam ex quas perspiciatis officia aliquid est assumenda nostrum.
              Rerum, blanditiis.</p>
          </div>
        </div>
        <div class="carousel-item" style="background-image: url('{{ asset('images/FTM04945.JPG') }}');">
          <div class="carousel-caption d-none d-md-block text-center">
            <h1 class="display-4">Badan Pengawas Pemilihan Umum Kalimantan Selatan</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit optio facere vel, vero doloremque rem
              nobis provident accusamus ipsum, aliquam ex quas perspiciatis officia aliquid est assumenda nostrum.
              Rerum, blanditiis.</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#home" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#home" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>

  <!-- Political Parties Section -->
  <section id="politicalParties" class="py-5 section-header">
    <div class="container">
      <h2>Partai Politik</h2>
      <canvas id="parpolChart" class="small-chart"></canvas>
    </div>
  </section>

  <!-- Violation Types Section -->
  <section id="violationTypes" class="py-5 section-header">
    <div class="container">
      <h2>Jenis Pelanggaran</h2>
      <canvas id="jenisPelanggaranChart" class="pie-chart"></canvas>
    </div>
  </section>

  <!-- Dapil Section -->
  <section id="dapil" class="py-5 section-header">
    <div class="container">
      <h2>Status Peserta Pemilu per Dapil</h2>
      <canvas id="dapilStatusChart" class="small-chart"></canvas>
    </div>
  </section>

  <!-- Map Section -->
  <section id="map" class="map-section">
    <div class="container">
      <h2 class="text-center py-5">Maps Pelanggaran</h2>
      <!-- Example map integration -->
      <div id="map" style="height: 100%;"></div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer-custom text-white py-4 text-center">
    <p>&copy; 2024 BAWASLU KALSEL. All Rights Reserved.</p>
  </footer>


  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


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
</body>

</html>
