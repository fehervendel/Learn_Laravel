<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            ['name' => 'required|min:3|max:255',],
        );

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Címke sikeresen létrehozva.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find($id);
        $tag->delete();

        return redirect()->route('tags.index')->with('success', ' sikeresen törölve.');
    }
}
