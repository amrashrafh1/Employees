<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * Class Employee
 *
 * @property $id
 * @property $name
 * @property $email
 * @property $email_verified_at
 * @property $password
 * @property $avatar
 * @property $company_id
 * @property $remember_token
 * @property $created_at
 * @property $updated_at
 *
 * @property Company $company
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = ['name','email','avatar','company_id', 'password'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        if (Hash::needsRehash($value)) {
            $value = Hash::make($value);
        }

        $this->attributes['password'] = $value;
    }

    public function setAvatarAttribute($file)
    {
        $this->attributes['avatar'] = upload_image($file, 'employees');
    }
   
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    

}
