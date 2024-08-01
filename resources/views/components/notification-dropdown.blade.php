<div x-data="{ isOpen: false }" class="relative">
  <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false" class="relative focus:outline-none"
    aria-label="Notifications">
    <svg class="w-6 h-6 text-gray-600" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      viewBox="0 0 24 24" stroke="currentColor">
      <path
        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11c0-2.386-1.575-4.438-3.78-4.92A2.001 2.001 0 0012 4a2.001 2.001 0 00-2.22 2.08C7.575 6.563 6 8.614 6 11v3.158c0 .538-.214 1.052-.595 1.437L4 17h11zM13.73 21a2 2 0 01-3.46 0h3.46z" />
    </svg>
    @if (Auth::user()->unreadNotifications->count())
      <span class="absolute top-0 right-0 block h-2 w-2 rounded-full ring-2 ring-white bg-red-600"></span>
    @endif
  </button>

  <div x-show="isOpen" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" @click.outside="isOpen = false"
    class="absolute right-0 mt-2 w-56 bg-white rounded-md border border-gray-100 shadow-md">
    <ul class="py-1 text-gray-600">
      @forelse (Auth::user()->unreadNotifications as $notification)
        <li>
          @if ($notification->type === 'App\Notifications\SuratKerjaNotification')
            <x-dropdown-link :href="url('/suratkerjas/' . $notification->data['surat_id'])">
              {{ $notification->data['message'] }}
            </x-dropdown-link>
          @elseif($notification->type === 'App\Notifications\LaporanPelanggaranCreated')
            <x-dropdown-link :href="url('/laporanpelanggarans/' . $notification->data['laporan_id'])">
              {{ $notification->data['message'] }}
            </x-dropdown-link>
          @elseif($notification->type === 'App\Notifications\LaporanPelanggaranUpdated')
            <x-dropdown-link :href="url('/laporanpelanggarans/' . $notification->data['laporan_id'])">
              {{ $notification->data['message'] }}
            </x-dropdown-link>
          @elseif($notification->type === 'App\Notifications\LaporanPelanggaranVerified')
            <x-dropdown-link :href="url('/laporanpelanggarans/' . $notification->data['laporan_id'])">
              {{ $notification->data['message'] }}
            </x-dropdown-link>
          @elseif($notification->type === 'App\Notifications\LaporanPelanggaranRejected')
            <x-dropdown-link :href="url('/laporanpelanggarans/' . $notification->data['laporan_id'])">
              {{ $notification->data['message'] }}
            </x-dropdown-link>
          @endif
        </li>
      @empty
        <li class="px-4 py-2 text-sm text-gray-600">
          No new notifications
        </li>
      @endforelse
      <li class="text-right px-4 py-2">
        <a href="{{ route('markAsRead') }}" class="text-blue-500 hover:underline">Clear All</a>
      </li>
    </ul>
  </div>
</div>
