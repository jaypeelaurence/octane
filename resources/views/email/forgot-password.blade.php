Hello {{ $body->to }} </br></br>

<p>A request to reset the password for your account has been made in Octane. You may now login by clicking this <a href='http://10.1.9.59:8080/token/{{ $body->url }}'>URL</a> or copying and pasting it into your browser: http://10.1.9.59:8080/uid/{{ $body->url }}.</p>

<p>This link can only be used once to log in and will lead you to a page where you  can  set  your  password. It expires after one day and nothing will happen if it's not used.</p>