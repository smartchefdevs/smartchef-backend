<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class CalificationCategory extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'calification_category';

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
     * Un CalificationCategory puede pertenecer a muchos Calification
     * ('Modelo al que se relaciona','Foreign key del modelo con que se relaciona','Primary key del modelo actual')
     */
    public function califications()
    {
        return $this->belongsToMany('App\Calification','category', 'id');
    }
}