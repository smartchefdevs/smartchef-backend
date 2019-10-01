<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Calification extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'calification';

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
        'category',
        'id_costumer',
        'id_chef',
        'commentary',
        'date_calification'
    ];

    /**
     * ManyToOne Relationship
     * Un Calification puede ser realizado por a un User (profile costumer)
	 * ('Modelo al que se relaciona','Primary Key del modelo con que se relaciona','Foreign Key del modelo actual que se relaciona')
     */
    public function costumer()
    {
        return $this->HasOne('App\User','id', 'id_costumer');
    }

    /**
     * ManyToOne Relationship
     * Un Calification puede pertenecer a un User (profile chef)
	 * ('Modelo al que se relaciona','Primary Key del modelo con que se relaciona','Foreign Key del modelo actual que se relaciona')
     */
    public function chef()
    {
        return $this->HasOne('App\User','id', 'id_chef');
    }

    /**
     * ManyToOne Relationship
     * Un Calification puede tener un CalificationCategory
	 * ('Modelo al que se relaciona','Primary Key del modelo con que se relaciona','Foreign Key del modelo actual que se relaciona')
     */
    public function category()
    {
        return $this->HasOne('App\CalificationCategory','id', 'category');
    }    
}