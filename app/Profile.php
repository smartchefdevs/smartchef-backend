<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile';

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
     * Un Profile puede pertenecer a muchos User
     * ('Modelo al que se relaciona','Foreign key del modelo con que se relaciona','Primary key del modelo actual')
     */
    public function users()
    {
        return $this->belongsToMany('App\User','id_profile', 'id');
    }
}