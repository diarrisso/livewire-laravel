<div class="min-h-screen bg-gray-100 py-10 px-4">
    <div class="max-w-2xl mx-auto bg-black p-6 sm:p-8 rounded-2xl shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">📝 My Todo List</h1>

        <!-- Add Task Form -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-3">Add a Task</h2>
            <form wire:submit.prevent="store" class="space-y-4">
                <input wire:model="title" type="text" placeholder="Task title"
                    class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <textarea wire:model="description" placeholder="Optional description"
                    class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

                <button type="submit"
                    class="w-full bg-blue-600 text-black py-2 rounded-xl hover:bg-blue-700 transition duration-200">
                    ➕ Add Task
                </button>
            </form>
        </div>

        <!-- Filters -->
        <div class="flex justify-center gap-3 mb-6">
            <button wire:click="setFilter('all')"
                class="px-4 py-1 rounded-full text-sm font-medium transition
                {{ $filter === 'all' ? 'bg-blue-500 text-black' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                All
            </button>
            <button wire:click="setFilter('active')"
                class="px-4 py-1 rounded-full text-sm font-medium transition
                {{ $filter === 'active' ? 'bg-blue-500 text-black' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Active
            </button>
            <button wire:click="setFilter('completed')"
                class="px-4 py-1 rounded-full text-sm font-medium transition
                {{ $filter === 'completed' ? 'bg-blue-500 text-black' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Completed
            </button>
        </div>

        <!-- Todo List -->
        <div class="space-y-4">
            @forelse($todos as $todo)
                <div class="bg-gray-50 p-4 rounded-xl shadow-sm flex justify-between items-start {{ $todo->completed ? 'opacity-60' : '' }}">
                    @if($editId !== $todo->id)
                        <div class="flex gap-3">
                            <input type="checkbox" wire:click="toggleTodo({{ $todo->id }})"
                                {{ $todo->completed ? 'checked' : '' }} class="mt-1 accent-blue-600">
                            <div>
                                <h3 class="text-lg font-medium {{ $todo->completed ? 'line-through text-gray-500' : 'text-gray-800' }}">
                                    {{ $todo->title }}
                                </h3>
                                @if($todo->description)
                                    <p class="text-sm text-gray-500">{{ $todo->description }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button wire:click="edit({{ $todo->id }})" title="Edit" class="text-blue-500 hover:underline">
                                <x-heroicon-o-pencil class="w-5 h-5" />
                            </button>
                            <button wire:click="delete({{ $todo->id }})" title="Delete" class="text-red-500 hover:underline">
                                <x-heroicon-o-trash class="w-5 h-5" />
                            </button>
                        </div>
                    @else
                        <!-- Edit Mode -->
                        <form wire:submit.prevent="update" class="w-full space-y-3">
                            <input wire:model="editTitle" type="text"
                                class="w-full p-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500">
                            @error('editTitle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                            <textarea wire:model="editDescription"
                                class="w-full p-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500"></textarea>

                            <div class="flex gap-2 justify-end">
                                <button type="submit"
                                    class="bg-green-500 text-black px-4 py-1 rounded hover:bg-green-600">
                                    ✅ Save
                                </button>
                                <button type="button" wire:click="cancelEdit"
                                    class="bg-gray-300 px-4 py-1 rounded hover:bg-gray-400">
                                    ❌ Cancel
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            @empty
                <div class="text-center text-gray-500">No tasks match the current filter.</div>
            @endforelse
        </div>
    </div>
</div>
