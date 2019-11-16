<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventReservation extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event_reservation';

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
        'id_event',
        'id_state',
        'id_costumer',
        'date_reservation'
    ];

    /**
     * ManyToOne Relationship
     * Un EventReservation puede tener un Event
	 * ('Modelo al que se relaciona','Primary Key del modelo con que se relaciona','Foreign Key del modelo actual que se relaciona')
     */
    public function event()
    {
        return $this->HasOne('App\Event','id', 'id_event');
    }

    /**
     * ManyToOne Relationship
     * Un EventReservation puede tener un EventReservationState
	 * ('Modelo al que se relaciona','Primary Key del modelo con que se relaciona','Foreign Key del modelo actual que se relaciona')
     */
    public function state()
    {
        return $this->HasOne('App\EventReservationState','id', 'id_state');
    }

    /**
     * ManyToOne Relationship
     * Un EventReservation puede tener un User (profile costumer)
	 * ('Modelo al que se relaciona','Primary Key del modelo con que se relaciona','Foreign Key del modelo actual que se relaciona')
     */
    public function costumer()
    {
        return $this->HasOne('App\User','id', 'id_costumer');
    }
}
