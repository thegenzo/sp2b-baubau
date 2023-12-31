<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Milon\Barcode\DNS1D;

class Evidence extends Model
{
    use HasFactory;

    protected $fillable = [
        'criminal_perpetrator_id',
        'register_number',
        'name',
        'amount',
        'unit',
        'description',
        'entry_date',
        'storage_location',
        'status',
        'returned_at',
        'terminated_at'
    ];

    public function criminal_perpetrator()
    {
        return $this->belongsTo(CriminalPerpetrator::class);
    }

    public function evidence_photo()
    {
        return $this->hasMany(EvidencePhoto::class);
    }

    public function evidence_transaction()
    {
        return $this->hasMany(EvidenceTransaction::class);
    }

    public function getBarcodeAttribute($value, $w, $h)
    {
        $dns1d = new DNS1D();
        return $dns1d->getBarcodeSVG($value, 'C128', $w, $h);
    }   
}
