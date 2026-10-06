<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Certification extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'curp',
        'folio',
        'tipo',
        'codigo',
        'titulo',
        'entidad',
        'siglas',
        'evaluador',
    ];

    protected static function booted(): void
    {
        static::creating(function (Certification $certification): void {
            if (! $certification->uuid) {
                $certification->uuid = (string) Str::uuid();
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}