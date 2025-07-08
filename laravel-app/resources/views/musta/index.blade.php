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

    <ul>
        @foreach ($mustas as $musta)
            <li>
                <a href="/musta/{{ $musta['id'] }}">
                    {{ $musta['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
