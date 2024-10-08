<aside class="z-20 hidden w-64 overflow-y-auto bg-white md:block flex-shrink-0">
  <div class="py-4 text-gray-500">
    <a class="flex items-center ml-6 text-lg font-bold " href="{{ route('dashboard') }}">
      <img src="{{ asset('images/logo-bawaslu.png') }}" alt="Logo Kalsel" width="50" height="50">
      <span class="ml-4">BAWASLU</span>
    </a>

    <ul class="mt-6">
      <li class="relative px-6 py-3">
        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
          <x-slot name="icon">
            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
              <path
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
              </path>
            </svg>
          </x-slot>
          {{ __('Dashboard') }}
        </x-nav-link>
      </li>

      @if (auth()->user()->hasRole('bawaslu-provinsi'))
        <li class="relative px-6 py-3">
          <x-nav-link href="{{ route('parpols.index') }}" :active="request()->routeIs('parpols.*')">
            <x-slot name="icon">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
              </svg>
            </x-slot>
            {{ __('Partai Politik') }}
          </x-nav-link>
        </li>
      @endif

      @if (auth()->user()->hasRole('bawaslu-provinsi'))
        <li class="relative px-6 py-3">
          <x-nav-link href="{{ route('jenispelanggarans.index') }}" :active="request()->routeIs('jenispelanggarans.*')">
            <x-slot name="icon">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
              </svg>
            </x-slot>
            {{ __('Jenis Pelanggaran') }}
          </x-nav-link>
        </li>
      @endif

      @if (auth()->user()->hasRole('bawaslu-provinsi') ||
              auth()->user()->hasRole('bawaslu-kabupaten-kota') ||
              auth()->user()->hasRole('panwaslu-kecamatan'))
        <li class="relative px-6 py-3">
          <x-nav-link href="{{ route('suratkerjas.index') }}" :active="request()->routeIs('suratkerjas.*')">
            <x-slot name="icon">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path
                  d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                </path>
              </svg>
            </x-slot>
            {{ __('Surat Kerja') }}
          </x-nav-link>
        </li>

        <li class="relative px-6 py-3">
          <x-nav-link href="{{ route('pelanggarans.index') }}" :active="request()->routeIs('pelanggarans.*')">
            <x-slot name="icon">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path
                  d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                </path>
              </svg>
            </x-slot>
            {{ __('Pelanggaran') }}
          </x-nav-link>
        </li>

        <li class="relative px-6 py-3">
          <x-nav-link href="{{ route('laporanpelanggarans.index') }}" :active="request()->routeIs('laporanpelanggarans.*')">
            <x-slot name="icon">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path
                  d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                </path>
              </svg>
            </x-slot>
            {{ __('Laporan Pelanggaran') }}
          </x-nav-link>
        </li>
      @endif

      @if (auth()->user()->hasRole('bawaslu-provinsi'))
        <li class="relative px-6 py-3">
          <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
            <x-slot name="icon">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
              </svg>
            </x-slot>
            {{ __('Users') }}
          </x-nav-link>
        </li>
      @endif

      <li class="relative px-6 py-3">
        <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
          <x-slot name="icon">
            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
              <path
                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
              </path>
            </svg>
          </x-slot>
          {{ __('About us') }}
        </x-nav-link>
      </li>
    </ul>
  </div>
</aside>
