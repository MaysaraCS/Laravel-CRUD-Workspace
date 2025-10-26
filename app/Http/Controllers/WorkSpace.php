<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkSpace as WorkSpaceModel;

class WorkSpace extends Controller
{
    public function create()
    {
        return view('workspaces.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        WorkSpaceModel::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('home')->with('success', 'Workspace created successfully!');
    }

    public function show($id)
    {
        $workspace = WorkSpaceModel::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $tasks = $workspace->tasks()->paginate(5);
        return view('workspaces.show', compact('workspace', 'tasks'));
    }

    public function edit($id)
    {
        $workspace = WorkSpaceModel::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('workspaces.edit', compact('workspace'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $workspace = WorkSpaceModel::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $workspace->update([
            'name' => $request->name,
        ]);

        return redirect()->route('home')->with('success', 'Workspace updated successfully!');
    }

    public function destroy($id)
    {
        $workspace = WorkSpaceModel::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $workspace->delete();

        return redirect()->route('home')->with('success', 'Workspace deleted successfully!');
    }
}
