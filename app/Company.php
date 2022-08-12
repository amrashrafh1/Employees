<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 *
 * @property $id
 * @property $name
 * @property $address
 * @property $logo
 * @property $created_at
 * @property $updated_at
 *
 * @property Employee[] $employees
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Company extends Model
{
    
    static $rules = [
		'name' => 'required',
		'address' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','address','logo'];


    // upload logo
    public function setLogoAttribute($value)
    {
      $this->attributes['logo'] = upload_image($value, 'companies');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany('App\Employee', 'company_id', 'id');
    }
    

}
