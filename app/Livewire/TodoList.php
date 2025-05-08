<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class TodoList extends Component
{

    public $todos;
    public $title;
    public $description;
    public $editId;
    public $editTitle;
    public $editDescription;
    public $filter = 'all';



    protected $rules = [
        'title' => 'required|min:3',
    ];

    public function mount()
    {
        $this->todos = Todo::all();
    }


    public function render()
    {
        $query = Todo::query();

        if ($this->filter === 'completed') {
            $query->where('completed', true);
        } elseif ($this->filter === 'active') {
            $query->where('completed', false);
        }

        $this->todos = $query->orderBy('created_at', 'desc')->get();

        return view('livewire.todo-list');
    }


    public function store()
    {
        $this->validate();
        Todo::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);
        $this->reset('title', 'description');
    }
    public function edit(Todo $todo)
    {
        $this->editId = $todo->id;
        $this->editTitle = $todo->title;
        $this->editDescription = $todo->description;
    }

    public function update()
    {
        $this->validate([
            'editTitle' => 'required|min:3',
        ]);
        Todo::find($this->editId)->update([
            'title' => $this->editTitle,
            'description' => $this->editDescription,
        ]);
        $this->reset('editId', 'editTitle', 'editDescription');
    }
    public function delete(Todo $todo)
    {
        $todo->delete();
    }
    public function cancelEdit()
    {
        $this->editId = null;
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }


    public function toggleTodo(Todo $todo)
    {
        $todo = Todo::findOrFail($todo->id);

        $todo->update([
            'completed' => !$todo->completed,
        ]);

        $todo->save();
    }


}
