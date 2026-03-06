<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
  @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
  <flux:sidebar sticky stashable
    class="border-e border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 z-3000! w-[80px] overflow-hidden">
    <x-app-logo />
    <div class="border-t-3 border-zinc-700 pt-2">
 <a href="{{ route('home') }}">
    <img src="{{ Vite::asset('resources/svg/planner.svg') }}" 
         id="plannerView"
         class="size-[48px] rounded-md transition mb-3 {{ request()->routeIs('home') ? 'border-2 border-white bg-zinc-800' : 'hover:bg-zinc-700/50 border-2 border-transparent' }}">
</a>

<a href="{{ route('routes.index') }}" wire:navigate>
    <img src="{{ Vite::asset('resources/svg/routes.svg') }}" 
         id="savedRoutesView"
         class="size-[48px] rounded-md transition my-3 {{ request()->routeIs('routes*') ? 'border-2 border-white bg-zinc-800' : 'hover:bg-zinc-700/50 border-2 border-transparent' }}">
</a>

<a href="{{ route('addresses.index') }}" wire:navigate>
    <img src="{{ Vite::asset('resources/svg/locations.svg') }}" 
         id="locationsView"
         class="size-[48px] rounded-md transition my-3 {{ request()->routeIs('addresses*') ? 'border-2 border-white bg-zinc-800' : 'hover:bg-zinc-700/50 border-2 border-transparent' }}">
</a>

<a href="{{ route('companies.index') }}" wire:navigate>
    <img src="{{ Vite::asset('resources/svg/companies.svg') }}" 
         id="companiesView"
         class="size-[48px] rounded-md transition my-3 {{ request()->routeIs('companies*') ? 'border-2 border-white bg-zinc-800' : 'hover:bg-zinc-700/50 border-2 border-transparent' }}">
</a>

<a href="{{ route('trucks.index') }}" wire:navigate>
    <img src="{{ Vite::asset('resources/svg/truck-thin.svg') }}" 
         id="trucksView"
         class="size-[48px] rounded-md transition mt-3 {{ request()->routeIs('trucks*') ? 'border-2 border-white bg-zinc-800' : 'hover:bg-zinc-700/50 border-2 border-transparent' }}">
</a>
    </div>
  </flux:sidebar>
  {{ $slot }}

  @fluxScripts
</body>

</html>