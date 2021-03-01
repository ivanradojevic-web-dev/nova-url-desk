<?php

namespace Ivanradojevic\Urldesk\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use HasFactory;

    protected $fillable = [
        'redirect_from',
        'redirect_to',
        'status_code',
    ];

    public function scopeTable($query, $search)
    {
        return $query->where('redirect_from', 'like', '%' . $search . '%')
            ->orWhere('redirect_to', 'like', '%' . $search . '%')
            ->latest();
    }
}
