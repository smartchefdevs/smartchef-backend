<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Event extends Model{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event';

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
        'id_state',
        'id_chef',
        'image_url',
        'name',
        'description',
        'price',
        'lat_addr',
        'lon_addr',
        'address'
    ];

    /**
     * ManyToOne Relationship
     * Un Event puede tener un EventState
	 * ('Modelo al que se relaciona','Primary Key del modelo con que se relaciona','Foreign Key del modelo actual que se relaciona')
     */
    public function state()
    {
        return $this->HasOne('App\EventState','id', 'id_state');
    }

    /**
     * ManyToOne Relationship
     * Un Event puede tener un User (profile Chef)
	 * ('Modelo al que se relaciona','Primary Key del modelo con que se relaciona','Foreign Key del modelo actual que se relaciona')
     */
    public function chef()
    {
        return $this->hasOne('App\User','id', 'id_chef');
    }

    /**
     * ManyToMany Relationship
     * ('Modelo al que se relaciona','tabla muchos a muchos','Primary Key del modelo actual que se relaciona','Foreign Key de la tabla muchos a muchos con que se relaciona')
     */
    public function dishes()
    {
        return $this->belongsToMany('App\FoodDish', 'food_dish_x_event', 'id_event', 'id_dish');
    }
}