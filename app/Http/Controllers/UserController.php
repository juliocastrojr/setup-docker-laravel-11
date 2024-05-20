<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
    public function update(UserUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            if ($request->hasFile('imagem_profile')) {
                $this->deleteExistingPhoto($user);
                $photoDetails = $this->storeNewPhoto($request->file('imagem_profile'));
                $request->merge($photoDetails);
            }

            $user->update($request->all());

            return response()->json([
                "success" => true,
                "message" => "Usuário atualizado com sucesso!"
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage(), [
                'user_id' => $id,
                'request' => $request->all(),
                'exception' => $e
            ]);

            return response()->json([
                "success" => false,
                "message" => "Ocorreu um erro ao atualizar o usuário."
            ], 500);
        }
    }

    private function deleteExistingPhoto(User $user): void
    {
        if ($user->photo) {
            Storage::delete('images/' . $user->photo);
        }
    }

    private function storeNewPhoto($image): array
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('images', $imageName);
        $imagePath = asset("api/images/" . $imageName);

        return [
            'photo' => $imageName,
            'path_image' => $imagePath
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
