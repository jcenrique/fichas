<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Platform\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Layouts\Rows;

class UserPasswordLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        /** @var User $user */
        $user = $this->query->get('user');
        $placeholder = $user->exists
            ? __('Leave empty to keep current password')
            : __('Enter the password to be set');
        $placeholder =  $user->domain==null 
            ? $placeholder 
            : __('El usuario no admite el cambio de contraseña');  ;
        return [
            Password::make('user.password')
                ->placeholder($placeholder)
                ->readonly(!$user->domain==null)
                ->title(__('Password')),
        ];
    }
}
