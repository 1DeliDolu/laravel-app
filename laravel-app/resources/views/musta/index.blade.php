<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mustafa's Page</title>
</head>
<body>
    <h2>Currently Available Musta</h2>
    <p>{{ $greeting }}</p>

    @if($greeting == 'Hello')
        <p>Hi from inside the if statement</p>
    @endif

    <ul>
        @foreach($mustas as $musta)
            <li>
                <p>{{ $musta['name'] }}</p>
                <a href="/musta/{{ $musta['id'] }}">View Details</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
