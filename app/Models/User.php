<?php

namespace App\Models;

use App\Notifications\UserAviso;
use App\Notifications\UserCreado;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Orchid\Platform\Models\User as Authenticatable;

use LdapRecord\Laravel\Auth\LdapAuthenticatable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Orchid\Platform\Models\User as PlatformUser;

use Illuminate\Database\Eloquent\Factories\HasFactory ;
use Orchid\Support\Facades\Alert;

class User extends PlatformUser implements LdapAuthenticatable
{
    use Notifiable;
    use  Filterable;
  
    use AsSource;
    use HasFactory;


    use AuthenticatesWithLdap;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [


        'email',
        'name',
        'guid',
        'domain',
       'locale',
        'password',
        'permissions',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',

        'email',
        'permissions',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',

        'email',
        'updated_at',
        'created_at',
    ];
    
    protected $observables = ['activado'];

    protected static function boot()
    {
        parent::boot();
      
       
    }

    public function activado(){
        $this->fireModelEvent('activado',false);
    }
}
