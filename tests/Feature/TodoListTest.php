<?php

use App\Models\Todo;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can add a todo', function () {
    Livewire::test('todo-list')
        ->set('title', 'Créer un test Pest')
        ->call('store');

    expect(Todo::where('title', 'Créer un test Pest')->exists())->toBeTrue();
});

it('validates title as required', function () {
    Livewire::test('todo-list')
        ->set('title', '')
        ->call('store')
        ->assertHasErrors(['title' => 'required']);
});

it('shows existing todos', function () {
    Todo::create(['title' => 'Ma tâche existante']);

    Livewire::test('todo-list')
        ->assertSee('Ma tâche existante');
});


it('can edit a todo', function () {
    $todo = \App\Models\Todo::create(['title' => 'Ancien titre']);

    Livewire::test('todo-list')
        ->call('edit', $todo->id)
        ->set('editTitle', 'Nouveau titre')
        ->call('update');

    expect($todo->fresh()->title)->toBe('Nouveau titre');
});


it('can delete a todo', function () {
    $todo = \App\Models\Todo::create(['title' => 'À supprimer']);

    Livewire::test('todo-list')
        ->call('delete', $todo->id);

    expect(\App\Models\Todo::find($todo->id))->toBeNull();
});

it('can toggle completed status', function () {
    $todo = \App\Models\Todo::create(['title' => 'À cocher', 'completed' => false]);

    Livewire::test('todo-list')
        ->call('toggleTodo', $todo->id);

    expect($todo->fresh()->completed)->toBeTrue();
});
