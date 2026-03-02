<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        $userId = auth()->id();

        $validated['created_by'] = $userId; 

        $colocationId = auth()->user()->colocations()
            ->wherePivotNull('left_at')
            ->value('colocations.id');

        $validated['colocation_id'] = $colocationId;

        Category::create($validated);
        return redirect()->route('colocations.show', $validated['colocation_id'])->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $userId = auth()->id();
        if ($category->created_by !== $userId) {
            return back()->with('error', 'You can only delete categories you have created!');
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully!');
    }
}
