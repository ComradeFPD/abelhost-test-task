<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\Component;
use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;

class CakesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cakes = Cake::with('components')->get();
        return response()->view('cake.index', [
            'cakes' => $cakes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $components = Component::all();
        return response()->view('cake.edit', [
            'components' => $components,
            'cake' => null,
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
        $cake = Cake::create([
            'title' => $data['title']
        ]);
        $cake->components()->sync($data['components']);
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
        $cake = Cake::findOrFail($id);
        $cake->comp = $cake->components->pluck('id');
        $components = Component::all();
        return response()->view('cake.edit', [
            'components' => $components,
            'cake' => $cake,
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
        $cake = Cake::findOrFail($id);
        $data = $request->except('_token');
        $cake->title = $data['title'];
        $cake->save();
        $cake->components()->sync($data['components']);
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
        $cake = Cake::findOrFail($id);
        $cake->delete();
        return response()->json('ok', 204);
    }
}
