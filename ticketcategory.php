<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketCategory extends Model
{
    protected $table = 'ticket_categories';
    protected $fillable = ['category_name', 'price', 'stock'];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'ticket_category_id');
    }
}