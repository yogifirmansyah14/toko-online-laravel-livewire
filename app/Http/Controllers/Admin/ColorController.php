<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(ColorFormRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == True ? '1':'0';
        Color::create($validatedData);

        return redirect('admin/colors')->with('message', 'Color Added Succesfully');
    }

    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(ColorFormRequest $request, int $color_id)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == True ? '1':'0';
        Color::findOrFail($color_id)->update($validatedData);

        return redirect('admin/colors')->with('message', 'Color Updated Succesfully');
    }

    public function destroy(int $color_id)
    {
        $color = Color::findOrFail($color_id);
        $color->delete();

        return redirect()->back()->with('message', 'Color Deleted Succesfully');
    }
}
