Hello {{ $body->to }}, </br></br>

<p>A site administrator in Octane has created an account for you. You may now log in by clicking this <a href='http://10.1.9.59/octane/token/{{ $body->url }}'>URL</a> or copying and pasting it into your browser: http://10.1.9.59/octane/token/{{ $body->url }}.</p>

<p>This link can only be used once to login and this will lead you to a page where you can set your password. After setting your password, you will be able to log in at http://10.1.9.59/octane/account/login in the future using your new account credentials.</p>