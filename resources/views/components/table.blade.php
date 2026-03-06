<div class="p-6 bg-[#111] w-full text-white font-mono">
    <div class="flex justify-between">
        <h2 class="text-4xl mb-6 font-bold tracking-tight">{{ ucfirst($name)}}</h2>
        @unless(request()->is('routes'))
        <flux:button id="openDialog" class="justify-start hover:bg-zinc-10 hover:cursor-pointer text-xl">
            Create
        </flux:button>
        @endunless
    </div>

    <div class="w-full overflow-hidden rounded-lg bg-zinc-800/50 border border-zinc-700">
        @if (!empty($data))
            <table class="w-full text-left text-sm">
                <thead class="border-b border-zinc-600 bg-zinc-800 text-zinc-100">
                    <tr>
                        @foreach (array_keys($data[array_key_first($data)]) as $header)
                            <th class="px-4 py-3 font-medium border-r border-zinc-600 text-center">{{ $header }}</th>
                        @endforeach
                        <th class="w-12">

                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-zinc-700">
                    @foreach ($data as $row)
                        <tr>
                            @foreach ($row as $cell)
                                <td class="text-center">{{$cell}}</td>
                            @endforeach
                            <td class="text-center flex justify-center">
                                <form action="{{ route($name . '.destroy', ['id' => $row['id']]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="trashcan hover:cursor-pointer mt-1">
                                        <img src="{{ Vite::asset('resources/svg/trash.svg') }}" alt="Trash">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <div class="flex justify-center items-center h-20">
                <h2 class="text-2xl">No data</h2>
            </div>
        @endif
    </div>
</div>