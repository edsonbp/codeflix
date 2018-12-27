<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;

class DefaultResetPasswordNotification extends ResetPassword
{
    use Queueable;

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("Redefinição de Senha")
                    ->line('Você está recebendo este email porque uma redefinição de senha foi requisitada.')
                    ->action('Redefinir senha', route('password.reset', $this->token))
                    ->line('Se você não solicitou a redefinição, por favor desconsidere esta mensagem.');
    }

   
}
