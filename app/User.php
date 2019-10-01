<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements JWTSubject, AuthenticatableContract, AuthorizableContract{

    use Authenticatable, Authorizable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

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
        'id_profile',
        'full_name',
        'image_url',
        'pass',
        'mail',
        'birthday',
        'address'
    ];

    /**
     * ManyToOne Relationship
     * Un User puede tener a un Profile
	 * ('Modelo al que se relaciona','Primary Key del modelo con que se relaciona','Foreign Key del modelo actual que se relaciona')
     */
    public function profile()
    {
        return $this->HasOne('App\Profile','id', 'id_profile');
    }

    /**
     * ManyToOne Relationship
     * Un User puede tener a un UserState
	 * ('Modelo al que se relaciona','Primary Key del modelo con que se relaciona','Foreign Key del modelo actual que se relaciona')
     */
    public function state()
    {
        return $this->HasOne('App\UserState','id', 'id_state');
    }

    /**
     * OneToMany Relationship
     * Un User (profile costumer) puede realizar uno o muchos Calification
     * ('Modelo al que se relaciona','Foreign key del modelo con que se relaciona','Primary key del modelo actual')
     */
    public function calificationsCommented()
    {
        return $this->belongsToMany('App\Calification','id_costumer', 'id');
    }

    /**
     * OneToMany Relationship
     * Un User (profile chef) puede recibir uno o muchos Calification
     * ('Modelo al que se relaciona','Foreign key del modelo con que se relaciona','Primary key del modelo actual')
     */
    public function califications()
    {
        return $this->belongsToMany('App\Calification','id_chef', 'id');
    }

    /**
     * OneToMany Relationship
     * Un User (profile chef) puede ofrecer uno o muchos Event
     * ('Modelo al que se relaciona','Foreign key del modelo con que se relaciona','Primary key del modelo actual')
     */
    public function events()
    {
        return $this->belongsToMany('App\Event','id_chef', 'id');
    }

    /**
     * OneToMany Relationship
     * Un User (profile costumer) puede generar uno o muchos EventReservation
     * ('Modelo al que se relaciona','Foreign key del modelo con que se relaciona','Primary key del modelo actual')
     */
    public function reservations()
    {
        return $this->belongsToMany('App\EventReservation','id_costumer', 'id');
    }

    /**
     * JWT Identifier key
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
