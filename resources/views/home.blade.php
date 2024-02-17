<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">

    <title>Clima</title>
    <link rel="shortcut icon" href="weather.ico">

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
</head>

<body>
    <div class="d-flex justify-content-center mt-5">
        <div class="mb-3">
            <form action="{{ route('weather') }}" method="GET">
                <label class="form-label">Insertá el nombre de la ciudad o sus coordenadas</label>
                <input type="text" class="form-control fs-3" name="city" placeholder="San Miguel, Buenos Aires" />
                <button class="btn btn-primary mt-2 container">Enviar</button>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        @if ($errors->any())
        <div class="alert alert-important alert-danger mt-3 alert-dismissible" role="alert">
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
        @endif
    </div>


</body>

</html>