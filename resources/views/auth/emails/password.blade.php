Click here to reset your password: <a href="{{ $link = url('reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
