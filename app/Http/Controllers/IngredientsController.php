<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        return response()->view('ingredients.index', [
            'ingredients' => $ingredients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('ingredients.edit', [
            'ingredient' => false,
            'isUpdate' => false
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
        Ingredient::create($data);
        return response()->json('ok', 204);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        return response()->view('ingredients.edit', [
            'ingredient' => $ingredient,
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
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($request->except('_token'));
        return response()->json('ok', 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();
        return response()->json('ok', 204);
    }
}
