<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nama
 * @property string|null $alamat
 * @property string|null $email
 * @property string|null $nomor_telepon
 */
class RumahSakit extends Model
{
    protected $table = 'rumah_sakit';

    protected $fillable = [
        'nama',
        'alamat',
        'email',
        'nomor_telepon',
    ];
}
