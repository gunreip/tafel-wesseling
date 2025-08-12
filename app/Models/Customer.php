<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Customer extends Model
{
    use LogsActivity;

    protected $fillable = [
        'first_name',
        'last_name',
        'street',
        'zipcode',
        'city',
        'phone',
        'email',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('customers')          // Log-Stream-Name (innen en-US)
            ->logOnly([
                'first_name',
                'last_name',
                'street',
                'zipcode',
                'city',
                'phone',
                'email',
            ])                                  // nur diese Felder loggen
            ->logOnlyDirty()                    // nur Änderungen, nicht jedes Save
            ->dontSubmitEmptyLogs();            // keine leeren Einträge
    }
}
