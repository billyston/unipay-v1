<?php

namespace App\Models;

use App\Events\CreateAdminEvent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Model implements JWTSubject, Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    use Notifiable;

    protected $primaryKey   = 'code';
    protected $guarded      = ['id'];

    protected $dispatchesEvents = [
        'creating' => CreateAdminEvent::class
    ];

    /**
     * Encrypt Admin password.
     *
     * @param string $password
     * @return void
     */
    public function setPasswordAttribute( string $password ): void
    {
        $this -> attributes['password'] = bcrypt( $password );
    }

    // Rest omitted for brevity
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
