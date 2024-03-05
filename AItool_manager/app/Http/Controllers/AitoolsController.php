<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Aitool;
use App\Models\Tag;

class AitoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request()->query('sort_by', 'name');
        $sort_dir = request()->query('sort_dir', 'asc');
        $aitools = Aitool::with('tags')->orderBy($sort_by, $sort_dir)->paginate(5);
        return view('aitools.index', compact('aitools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('aitools.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hasFreePlan = $request->has('hasFreePlan');
        if ($hasFreePlan) {
            $request->merge(['hasFreePlan' => true]);
        }

        $request->validate([
            'name' => 'required|min:3|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|min:20',
            'link' => 'required|url',
            'hasFreePlan' => 'boolean',
            'price' => 'nullable|numeric',
            ]);

        $aitool = Aitool::create($request->all());
        $aitool->tags()->attach($request->tags);

        return redirect()->route('aitools.index')->with('success', 'Az AI eszköz sikeresen hozzáadva.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $aitool = Aitool::with('tags')->find($id);
      
        return view('aitools.show', compact('aitool'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aitool = Aitool::find($id);
        $categories = Category::all();
        return view('aitools.edit', compact('aitool', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:20|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'nullable|numeric|max:99999',
        ],
        [
        'name.min' => 'Az AItool neve legalább 3 karakter hosszú legyen.',
        'name.required' => 'A név mező kitöltése kötelező.',
        'description.required' => 'A leírás mező kitöltése kötelező.',
        'description.min' => 'Az AItool leírása legalább 20 karakter hosszú legyen.',
        'price.max' => 'Az árat maximum 99999-ig lehet beállítani.',   
        ]);

        $aitool = Aitool::find($id);
        $aitool->name = $request->name;
        $aitool->description = $request->description;
        $aitool->category_id = $request->category_id;
        $aitool->price = $request->price;
        $aitool->save();

        return redirect()->route('aitools.index')->with('success', 'AItool sikeresen módosítva.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aitool = Aitool::find($id);
        $aitool->delete();

        return redirect()->route('aitools.index')->with('success', 'Aitool sikeresen törölve.');
    }
}
