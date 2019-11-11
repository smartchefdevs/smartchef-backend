<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodDish extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'food_dish';

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
        'id_category',
        'id_state',
        'image_url',
        'name',
        'description'
    ];

    /**
     * ManyToOne Relationship
     * Un FoodDish puede tener un CategoryFood
	 * ('Modelo al que se relaciona','Primary Key del modelo con que se relaciona','Foreign Key del modelo actual que se relaciona')
     */
    public function category()
    {
        return $this->hasOne('App\CategoryFood','id', 'id_category');
    }

    /**
     * ManyToOne Relationship
     * Un FoodDish puede tener un FoodDishState
	 * ('Modelo al que se relaciona','Primary Key del modelo con que se relaciona','Foreign Key del modelo actual que se relaciona')
     */
    public function state()
    {
        return $this->hasOne('App\FoodDishState','id', 'id_state');
    }

    /**
     * ManyToMany Relationship
     * ('Modelo al que se relaciona','tabla muchos a muchos','Primary Key del modelo actual que se relaciona','Foreign Key de la tabla muchos a muchos con que se relaciona')
     */
    public function events()
    {
        return $this->belongsToMany('App\Event', 'food_dish_x_event', 'id', 'id_event');
    }
}
