<h1>Hi admin</h1>
<p>
    Hai ricevuto un nuovo messaggio, ecco qui i dettagli:<br>
    Nome: {{ $lead->name }}<br>
    Email: {{ $lead->email }}<br>
    Messaggio:<br>
    {{ $lead->message }}
</p>
