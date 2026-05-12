<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with('category');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $tasks      = $query->orderBy('deadline')->paginate(10);
        $categories = Category::all();

        return view('tasks.index', compact('tasks', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:pending,completed',
            'deadline'    => 'nullable|date',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task əlavə edildi!');
    }

    public function edit(Task $task)
    {
        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:pending,completed',
            'deadline'    => 'nullable|date',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task yeniləndi!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task silindi!');
    }

    public function toggleStatus(Task $task)
    {
        $task->update([
            'status' => $task->status === 'pending' ? 'completed' : 'pending'
        ]);
        return redirect()->back()->with('success', 'Status dəyişdirildi!');
    }
}