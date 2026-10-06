<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CertificationSearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'q' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[A-Za-z0-9\-\/]+$/',
            ],
        ], [
            'q.required' => 'Escribe un CURP o folio.',
            'q.min' => 'La búsqueda debe contener al menos 3 caracteres.',
            'q.max' => 'La búsqueda es demasiado larga.',
            'q.regex' => 'La búsqueda contiene caracteres no permitidos.',
        ]);

        $search = Str::upper(
            trim($validated['q'])
        );

        $results = Certification::query()
            ->select([
                'folio',
                'tipo',
                'codigo',
                'titulo',
                'entidad',
                'siglas',
                'evaluador',
            ])
            ->where(
                function ($query) use ($search): void {
                    $query
                        ->where('folio', $search)
                        ->orWhere('curp', $search);
                }
            )
            ->orderBy('folio')
            ->limit(30)
            ->get();

        return response()->json([
            'data' => $results,
        ]);
    }
}