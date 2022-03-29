<?php

namespace App;

use App\Calendar;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{


    protected $fillable = [
        'atendimento_id', 'title', 'description', 'allDay', 'start', 'end','user_id','color'
    ];

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

    public function getStartedAtAttribute($start)
    {
        return $this->asDateTime($start)->setTimezone($this->calendar->timezone);
    }

    public function getEndedAtAttribute($end)
    {
        return $this->asDateTime($end)->setTimezone($this->calendar->timezone);
    }

    public function getDurationAttribute()
    {
        return $this->start->diffForHumans($this->start, true);
    }
}
