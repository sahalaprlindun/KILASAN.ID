<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'reported_at',
        'nama',
        'kontak',
        'wilayah',
        'jenis_kelamin',
        'usia',
        'tingkat_khawatir',
        'kategori',
        'jenis_pelapor',
        'tempat_kejadian',
        'waktu_kejadian',
        'pelaku',
        'kronologi',
        'saran',
        'status',
        'handled_by',
    ];

    protected function casts(): array
    {
        return [
            'reported_at' => 'date',
        ];
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(ComplaintAttachment::class);
    }

    public function handler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by');
    }
}
