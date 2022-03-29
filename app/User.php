<?php
/*

=========================================================
* Argon Dashboard PRO - v1.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro-laravel
* Copyright 2018 Creative Tim (https://www.creative-tim.com) & UPDIVISION (https://www.updivision.com)

* Coded by www.creative-tim.com & www.updivision.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'picture' ,'role_id', 'google_calendar_id',
        'image', 'color'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the role of the user
     *
     * @return \App\Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the path to the profile picture
     *
     * @return string
     */
    public function profilePicture()
    {


         return $this->picture;
    }

    /**
     * Check if the user has admin role
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->role_id == 1;
    }

    /**
     * Check if the user has creator role
     *
     * @return boolean
     */
    public function isCreator()
    {
        return $this->role_id == 2;
    }

    /**
     * Check if the user has user role
     *
     * @return boolean
     */
    public function isMember()
    {
        return $this->role_id == 3;
    }

    public function atendimento()
    {

        return $this->hasMany(Atendimento::class,'user_id');
    }

    public function observacoes()
    {
        return $this->hasMany(ObservacaoAtendimento::class,'user_id');
    }

    // ...
    public function googleAccounts()
    {
        return $this->hasMany(GoogleAccount::class);
    }

    public function events()
    {


        return $this->hasMany(Event::class,'user_id');


//        return Event::whereHas('calendar', function ($calendarQuery) {
//            $calendarQuery->whereHas('googleAccount', function ($accountQuery) {
//                $accountQuery->whereHas('user', function ($userQuery) {
//                    $userQuery->where('id', $this->id);
//                });
//            });
//        });
    }


}
