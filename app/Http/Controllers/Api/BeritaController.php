<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeritaCreateRequest;
use App\Http\Requests\BeritaDeleteRequest;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function all() {
        $data = Berita::with('user')->get();

        return response()->json([
            'error' => true,
            'data' => $data
        ]);
    }

    public function getpost($slug) {
        $berita = Berita::with('user')->where('slug', $slug);

        return response()->json([
            'error' => false,
            'data' => $berita
        ]);
    }

    public function create(BeritaCreateRequest $request) {
        $user = auth('api')->user();
        $validated = $request->validated();

        $validated['slug'] = Berita::slugify($validated['judul']);
        $validated['created_by'] = $user->id;

        $response = Berita::create($validated);

        return response()->json([
            'error' => false,
            'data' => $response
        ]);
    }

    public function delete($slug) {
        $berita = Berita::where('slug', $slug);
        if (!$berita) {
            return response()->json([
                'error' => true,
                'message' => 'berita not found'
            ], 404);
        } else {
            $berita->delete();
    
            return response()->json([
                'error' => false,
                'message' => 'berita has been removed from database!'
            ]);
        }
    }
}
