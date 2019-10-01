<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category_food';

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
     * Un FoodCategory puede pertenecer a muchos FoodDish
     * ('Modelo al que se relaciona','Foreign key del modelo con que se relaciona','Primary key del modelo actual')
     */
    public function categories()
    {
        return $this->belongsToMany('App\FoodDish','id_category', 'id');
    }
}