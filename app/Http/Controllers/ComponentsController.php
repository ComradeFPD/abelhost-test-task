<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ComponentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $components = Component::with('ingredients')->get()
            ->each(function (Component $component) {
                $component->ingredient = $component->ingredients->pluck('title');
            });
        return response()->view('components.index', [
            'components' => $components
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingredients = Ingredient::all();
        return response()->view('components.edit', [
            'isUpdate' => false,
            'component' => false,
            'ingredients' => $ingredients
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $component = Component::create([
            'title' => $data['title']
        ]);
        $component->ingredients()->sync($data['ingredients']);
        return response()->json('ok', 204);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $component = Component::findOrFail($id);
        $ingredients = Ingredient::all();
        $component->ingredient = $component->ingredients->pluck('id');
        return response()->view('components.edit', [
            'component' => $component,
            'ingredients' => $ingredients,
            'isUpdate' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $component = Component::findOrFail($id);
        $data = $request->except('_token');
        $component->title = $data['title'];
        $component->save();
        $component->ingredients()->sync($data['ingredients']);
        return response()->json('ok', 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $component = Component::findOrFail($id);
        $component->delete();
        return response()->json('ok', 204);
    }
}
