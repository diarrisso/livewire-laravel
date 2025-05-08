<div class="min-h-screen bg-gray-100 py-10 px-4">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-2xl shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">📝 Ma Todo List</h1>

        <!-- Formulaire d'ajout -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-3">Ajouter une tâche</h2>
            <form wire:submit.prevent="store" class="space-y-4">
                <input wire:model="title" type="text" placeholder="Titre de la tâche"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <textarea wire:model="description" placeholder="Description (optionnel)"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    ➕ Ajouter
                </button>
            </form>
        </div>

        <!-- Filtres -->
        <div class="flex justify-center gap-3 mb-6">
            <button wire:click="setFilter('all')"
                class="px-4 py-1 rounded-full text-sm font-medium transition
                {{ $filter === 'all' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Toutes
            </button>
            <button wire:click="setFilter('active')"
                class="px-4 py-1 rounded-full text-sm font-medium transition
                {{ $filter === 'active' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                À faire
            </button>
            <button wire:click="setFilter('completed')"
                class="px-4 py-1 rounded-full text-sm font-medium transition
                {{ $filter === 'completed' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Terminées
            </button>
        </div>

        <!-- Liste des tâches -->
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
                            <button wire:click="edit({{ $todo->id }})" class="text-blue-500 hover:underline"><x-heroicon-o-pencil class="w-5 h-5 text-blue-500" /></button>
                            <button wire:click="delete({{ $todo->id }})" class="text-red-500 hover:underline"><x-heroicon-o-trash class="w-5 h-5 text-red-500" /></button>
                        </div>
                    @else
                        <!-- Mode édition -->
                        <form wire:submit.prevent="update" class="w-full space-y-3">
                            <input wire:model="editTitle" type="text"
                                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400">
                            @error('editTitle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                            <textarea wire:model="editDescription"
                                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400"></textarea>

                            <div class="flex gap-2 justify-end">
                                <button type="submit"
                                    class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">
                                    ✅ Enregistrer
                                </button>
                                <button type="button" wire:click="cancelEdit"
                                    class="bg-gray-300 px-4 py-1 rounded hover:bg-gray-400">
                                    ❌ Annuler
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            @empty
                <div class="text-center text-gray-500">Aucune tâche correspondant au filtre actuel</div>
            @endforelse
        </div>
    </div>
</div>
