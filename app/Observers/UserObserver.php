<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\User;
use App\Notifications\UserAviso;
use App\Notifications\UserCreado;
use Illuminate\Support\Facades\Notification;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Toast;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //notificar al administrador que un nuevo usuario Ldap ha accedido y hay que asignar permisos
        $role =  Role::where('name', 'admin')->first();
        $users = $role->getUsers();

          
        $notificacion = new UserCreado(__('Un nuevo usuario ha accedido al sistema, debe asignar el rol correspondiente al usuario'), $user);


        Notification::send($users, $notificacion);

        //notificar al usuario que debe espaerar para acceder
        $notificacion = new UserAviso(__('El administrador ha sido notificado, recibirá un correo cuando se le asignen los permisos'),$user);
        $user->notify($notificacion);
    }

    /**
     * Handle the User "creating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        if ($user->permissions === null) {
        // if tags are not provided on creation
            $user->permissions=  ['home' => true];  // set empty json array

            
         
    }
//
    }

    /**
     * Handle the User "updating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function saved(User $user)
    {
       
    }
/**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function activado(User $user)
    {
        $notificacion = new UserAviso(__('El administrador ha actualizado su perfil.'),$user);
        $user->notify($notificacion);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
