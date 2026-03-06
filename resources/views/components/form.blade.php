<div x-data="{ open: false }">
    <flux:button @click="open = ! open" class="w-full justify-start group bg-secondary-black hover:bg-zinc-10"
        x-bind:aria-expanded="open">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="mr-2 transition-transform duration-200" x-bind:class="open ? 'rotate-180' : ''">
            <path d="m6 9 6 6 6-6" />
        </svg>
        {{ $name }}
    </flux:button>

    <div x-show="open" class="static w-full my-3">
        <form class="driver-form" data-truck-name="{{ $name }}" action="routes" method="POST">
            @csrf
            @method('POST')
            <input type="hidden" name="truck_id" value="{{ $index }}">
            <div class="flex gap-2">
                <div class="relative w-1/2">
                    <select id="timeMode" name="timeMode"
                        class="w-full h-[44px] rounded-lg bg-zinc-800 px-3 py-3 text-sm font-medium text-white transition hover:bg-zinc-700">
                        <option value="depart_at">Depart at</option>
                        <option value="arrive_by">Arrive by</option>
                    </select>
                </div>

                <input type="time" id="timeValue" value="12:00" name="timeInput"
                    class="w-1/2 rounded-lg bg-zinc-800 px-3 py-3 text-sm font-medium text-white transition hover:bg-zinc-700 [&::-webkit-calendar-picker-indicator]:cursor-pointer [&::-webkit-calendar-picker-indicator]:invert" />

            </div>
            <input type="date" id="dateInput" name="dateInput" value="{{ $today }}" required
                class="w-full rounded-lg bg-zinc-800 py-3 px-3 my-3 text-sm font-medium text-white transition hover:bg-zinc-700" />

            <div id="append">
                <flux:input label="Destinations" name="destination[]" class="mb-2" id="destinationInput{{ $index }}" required />
            </div>

            <div class="flex justify-between">
                <flux:button type="submit">Go</flux:button>
                <flux:button id="addStop{{ $index }}">Add destination</flux:button>
            </div>
        </form>
    </div>
</div>