Click here to verify your account:
<h3>{{config('app.name')}}</h3>
<p>Sua conta foi criada!!!</p>
<p>
    Clique <a href="{{ route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email) }}"> aqui </a> para verificar sua conta
</p>
<p>
    Não responder este email, ele é gerado automaticamente
</p>