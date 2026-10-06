<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CertificationController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim(
            (string) $request->query('q', '')
        );

        $certifications = Certification::query()
            ->when(
                $search !== '',
                function (Builder $query) use ($search): void {
                    $query->where(
                        function (Builder $query) use ($search): void {
                            $query
                                ->where('uuid', 'like', "%{$search}%")
                                ->orWhere('curp', 'like', "%{$search}%")
                                ->orWhere('folio', 'like', "%{$search}%")
                                ->orWhere('tipo', 'like', "%{$search}%")
                                ->orWhere('codigo', 'like', "%{$search}%")
                                ->orWhere('titulo', 'like', "%{$search}%")
                                ->orWhere('entidad', 'like', "%{$search}%")
                                ->orWhere('siglas', 'like', "%{$search}%")
                                ->orWhere('evaluador', 'like', "%{$search}%");
                        }
                    );
                }
            )
            ->orderByDesc('id')
            ->paginate(20);

        $certifications->appends([
            'q' => $search,
        ]);

        $editingCertification = null;

        if ($request->filled('edit')) {
            $editingCertification = Certification::query()
                ->where(
                    'uuid',
                    (string) $request->query('edit')
                )
                ->firstOrFail();
        }

        $creating = $request->boolean('create')
            && $editingCertification === null;

        return view('admin.panel-de-control', [
            'certifications' => $certifications,
            'search' => $search,
            'editingCertification' => $editingCertification,
            'creating' => $creating,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Certification::query()->create(
            $this->validatedData($request)
        );

        return redirect()
            ->route('admin.panel')
            ->with(
                'success',
                'Registro creado correctamente.'
            );
    }

    public function update(
        Request $request,
        Certification $certification
    ): RedirectResponse {
        $certification->update(
            $this->validatedData(
                $request,
                $certification
            )
        );

        return redirect()
            ->route('admin.panel')
            ->with(
                'success',
                'Registro actualizado correctamente.'
            );
    }

    public function destroy(
        Certification $certification
    ): RedirectResponse {
        $certification->delete();

        return redirect()
            ->route('admin.panel')
            ->with(
                'success',
                'Registro eliminado correctamente.'
            );
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(
        Request $request,
        ?Certification $certification = null
    ): array {
        $folioUniqueRule = Rule::unique(
            'certifications',
            'folio'
        );

        if ($certification) {
            $folioUniqueRule->ignore(
                $certification->getKey()
            );
        }

        $data = $request->validate([
            'curp' => [
                'nullable',
                'string',
                'size:18',
                'regex:/^[A-Za-z]{4}\d{6}[HMhm][A-Za-z]{5}[A-Za-z0-9]\d$/',
            ],
            'folio' => [
                'required',
                'string',
                'max:50',
                $folioUniqueRule,
            ],
            'tipo' => [
                'required',
                'string',
                'max:30',
            ],
            'codigo' => [
                'required',
                'string',
                'max:80',
            ],
            'titulo' => [
                'required',
                'string',
                'max:255',
            ],
            'entidad' => [
                'required',
                'string',
                'max:500',
            ],
            'siglas' => [
                'nullable',
                'string',
                'max:80',
            ],
            'evaluador' => [
                'nullable',
                'string',
                'max:500',
            ],
        ], [
            'curp.size' => 'La CURP debe contener exactamente 18 caracteres.',
            'curp.regex' => 'El formato de la CURP no es válido.',
            'folio.unique' => 'Este folio ya se encuentra registrado.',
        ]);

        foreach (
            [
                'curp',
                'folio',
                'tipo',
                'codigo',
                'siglas',
            ] as $field
        ) {
            if (
                array_key_exists($field, $data)
                && $data[$field] !== null
            ) {
                $data[$field] = mb_strtoupper(
                    trim((string) $data[$field])
                );
            }
        }

        foreach (
            [
                'titulo',
                'entidad',
                'evaluador',
            ] as $field
        ) {
            if (
                array_key_exists($field, $data)
                && $data[$field] !== null
            ) {
                $data[$field] = trim(
                    (string) $data[$field]
                );
            }
        }

        if (
            array_key_exists('curp', $data)
            && $data['curp'] === ''
        ) {
            $data['curp'] = null;
        }

        if (
            array_key_exists('siglas', $data)
            && $data['siglas'] === ''
        ) {
            $data['siglas'] = null;
        }

        if (
            array_key_exists('evaluador', $data)
            && $data['evaluador'] === ''
        ) {
            $data['evaluador'] = null;
        }

        return $data;
    }
}