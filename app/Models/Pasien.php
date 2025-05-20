<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_rumah_sakit
 * @property string $nama
 * @property string|null $alamat
 * @property string|null $nomor_telepon
 */
class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = [
        'id_rumah_sakit',
        'nama',
        'alamat',
        'nomor_telepon',
    ];
}
