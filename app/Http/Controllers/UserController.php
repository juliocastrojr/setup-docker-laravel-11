<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json([$users]);
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
    public function store(Request $request)
    {
        //
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
    public function update(UserUpdateRequest $request, int $id)
    {
        try {

            if ($request->hasFile('imagem_profile')) {
                $imagem = $request->file('imagem_profile');
                $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension();
                $imagem->storeAs('images', $nomeImagem);
                $imagePath = "api/images/".$nomeImagem;
                $request->merge([
                    'photo' => $nomeImagem, 
                    "path_image" => asset($imagePath)
                ]);
            }

            User::find($id)->update($request->all());

            return response()->json([
                "success" => true,
                "message" => "Usuário atualizado com sucesso!"
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
