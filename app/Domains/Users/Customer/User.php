<?php

namespace App\Domains\Users\Customer;

use App\Domains\Persons\Person;
use App\Domains\Companies\Company;
use App\Domains\Users\Customer\Presenters\UserViewPresenter;
use App\Domains\Users\Customer\Rules\UserRules;
use App\Domains\Abstracts\Users\User as AbstractUser;
use App\Domains\Users\Customer\Database\Seeders\UserSeeder;
use App\Domains\Users\Customer\Notifications\Auth\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class User extends AbstractUser
{
    protected $columnTitle          = 'name';
    protected $entityDomainAlias    = 'customer_users';
    protected $entityTranslationKey = 'user';
    protected $entityGender         = 'M';
    protected $entityIcon           = 'fa fa-fw fa-user';
    protected $authProvider         = 'customer';
    protected $entityRouteAlias     = 'users_customer';
    protected $entityViewsAlias     = 'users.customer';
    protected $entityRoutePrefix    = 'customer-users';
    protected $table                = 'customer_users';
    protected $mediaCategorySlug    = 'customer_users';
    protected $rulesFrom            = UserRules::class;
    protected $seederFrom           = UserSeeder::class;
    protected $presenter            = UserViewPresenter::class;

    protected $entityAllowedMedias   = [
        'images',
        'videos',
        'audios',
        'documents',
    ];

    protected $dates = [
        'password_updated_at',
        'email_verified_at',
        'banned_at',
        'last_login',
        'last_activity',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'username',
        'email',
        'password',
        'password_updated_at',
        'remember_token',
        'profile_id',
        'profile_type',
        'role',
        'status',
        'email_verified',
        'email_verified_at',
        'banned',
        'banned_at',
        'last_login',
        'last_activity',
        'active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = ['profile'];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        if ($this->profile) {
            return $this->isPerson() ? $this->profile->nome : $this->profile->nome_fantasia;
        }
        return null;
    }

    public function profile() : morphTo
    {
        return $this->morphTo();
    }

    public function isCompany() : bool
    {
        return $this->profile_type ? $this->profile_type == Company::class : null;
    }

    public function isPerson() : bool
    {
        return $this->profile_type ? $this->profile_type == Person::class : null;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}