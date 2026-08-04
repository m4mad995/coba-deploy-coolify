<x-layouts.app>
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Todo List</h1>

        <form action="{{ route('todos.store') }}" method="POST" class="flex gap-2 mb-6">
            @csrf
            <input
                type="text"
                name="title"
                placeholder="Tambah todo baru..."
                required
                class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-lg transition"
            >
                Tambah
            </button>
        </form>

        @error('title')
            <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
        @enderror

        @if ($todos->isEmpty())
            <p class="text-gray-400 text-center py-8">Belum ada todo.</p>
        @else
            <ul class="divide-y divide-gray-200">
                @foreach ($todos as $todo)
                    <li class="py-3 flex items-center gap-3 group">
                        <form action="{{ route('todos.update', $todo) }}" method="POST" class="shrink-0">
                            @csrf
                            @method('PATCH')
                            <input
                                type="hidden"
                                name="completed"
                                value="{{ $todo->completed ? '0' : '1' }}"
                            >
                            <button type="submit" class="w-5 h-5 rounded border-2 flex items-center justify-center transition
                                {{ $todo->completed ? 'bg-green-500 border-green-500' : 'border-gray-300 hover:border-green-400' }}">
                                @if ($todo->completed)
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                @endif
                            </button>
                        </form>

                        <form action="{{ route('todos.update', $todo) }}" method="POST" class="flex-1">
                            @csrf
                            @method('PATCH')
                            <input
                                type="text"
                                name="title"
                                value="{{ $todo->title }}"
                                class="w-full border border-transparent hover:border-gray-300 focus:border-blue-400 rounded px-2 py-1 -ml-2 focus:outline-none transition
                                    {{ $todo->completed ? 'line-through text-gray-400' : 'text-gray-800' }}"
                                onchange="this.form.submit()"
                            >
                        </form>

                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="shrink-0 opacity-0 group-hover:opacity-100 transition">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                onclick="return confirm('Hapus todo ini?')"
                                class="text-red-400 hover:text-red-600 transition p-1"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>

            <p class="text-sm text-gray-400 mt-4 text-right">
                {{ $todos->where('completed')->count() }} / {{ $todos->count() }} selesai
            </p>
        @endif
    </div>
</x-layouts.app>
