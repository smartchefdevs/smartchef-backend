<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class EventState extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event_state';

    /**
     * Primary Key
     */
    protected $primaryKey = 'id';

    /**
     * Not timestamped
     */
    public $timestamps = false;

    /**
     * The model's fillable values.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name'
    ];

    /**
     * OneToMany Relationship
     * Un EventState puede pertenecer a muchos Event
     * ('Modelo al que se relaciona','Foreign key del modelo con que se relaciona','Primary key del modelo actual')
     */
    public function events()
    {
        return $this->belongsToMany('App\Event','id_state', 'id');
    }
}