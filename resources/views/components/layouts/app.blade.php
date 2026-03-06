<x-layouts.app.sidebar :title="$title ?? null">
    <div class="[grid-area:main] [[data-flux-container]_&]:px-0 flex" data-flux-main="">
        {{ $slot }}
    </div>
</x-layouts.app.sidebar>