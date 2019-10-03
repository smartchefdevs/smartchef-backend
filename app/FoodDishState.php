<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class FoodDishState extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'food_dish_state';

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
     * Un FoodDishState puede pertenecer a muchos FoodDish
     * ('Modelo al que se relaciona','Foreign key del modelo con que se relaciona','Primary key del modelo actual')
     */
    public function foodDishes()
    {
        return $this->belongsToMany('App\FoodDish','id_state', 'id');
    }
}