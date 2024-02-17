<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
   
    <title>Clima en {{ $data['location']['name'] }}</title>

    @if ($data['current']['is_day'])
    <link rel="shortcut icon" href="sun.ico">
    @else
    <link rel="shortcut icon" href="moon.ico">
    @endif

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
</head>

<body class="d-flex flex-column text-{{$color}} cover justify-content-start" style="background-image: url('{{$background}}.jpg'); background-size: cover;  background-repeat: no-repeat; background-position: center;">
    <div class="container mt-5">
        <a href="/" class="btn btn-{{$background}}">Buscar otra ciudad <svg xmlns="http://www.w3.org/2000/svg" class="m-1 icon icon-tabler icon-tabler-arrow-narrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l14 0" />
                <path d="M5 12l4 4" />
                <path d="M5 12l4 -4" />
            </svg></a>
    </div>
    <div class="card border-0 container mt-5 w-auto justify-content-around  text-{{$color}} bg-{{$background}}" style="min-width: 300px;">
        <div class="card-body p-2">
            <div class="d-flex justify-content-between align-items-center">
                <img src="{{ $data['current']['condition']['icon'] }}" alt="Icono de {{ $data['current']['condition']['text'] }}" />
                <p class="mb-0" style="font-size:40px"> {{ $data['current']['temp_c'] }}°</p>
            </div>
            <h3 class="card-title">{{ $data['location']['name'] }}, {{ $data['location']['country'] }}</h3>
            <p class="card-title">{{ date('H:i', strtotime($data['location']['localtime'])) }}</p>
            <p class="text-{{$color}}">{{ $data['current']['condition']['text'] }}</p>
        </div>
    </div>
    <div class="card-body  container mt-5">
        <div id="table-default" class="table-responsive bg-{{$background}}">
            <table class="table">
                <thead>
                    <tr>
                        <th class="bg-{{$background}} text-{{$color}}">
                            <p class="m-0 p-0">Dia</p>
                        </th>
                        <th class="bg-{{$background}} text-{{$color}}">
                            <p class="m-0 p-0">Máxima</p>
                        </th>
                        <th class="bg-{{$background}} text-{{$color}}">
                            <p class="m-0 p-0">Mínima</p>
                        </th>
                        <th class="bg-{{$background}} text-{{$color}}">
                            <p class="m-0 p-0">Viento</p>
                        </th>
                        <th class="bg-{{$background}} text-{{$color}}">
                            <p class="m-0 p-0">Condición</p>
                        </th>
                        <th class="bg-{{$background}} text-{{$color}}">
                            <p class="m-0 p-0">Humedad</p>
                        </th>
                    </tr>
                </thead>
                <tbody class="table-tbody">
                    @foreach ($data['forecast']['forecastday'] as $forecastday)
                    <tr>
                        <td>{{ date('d-m-y', strtotime($forecastday['date'])) }}</td>
                        <td>{{ $forecastday['day']['maxtemp_c'] }}°</td>
                        <td>{{ $forecastday['day']['mintemp_c'] }}°</td>
                        <td>{{ $forecastday['day']['maxwind_kph'] }} km/h</td>
                        <td>{{ $forecastday['day']['condition']['text'] }}</td>
                        <td class="sort-progress" data-progress="30">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-auto">{{ $forecastday['day']['avghumidity']}}%</div>
                                <!--    <div class="col">
                                    <div class="progress" style="width: 5rem">
                                        <div class="progress-bar" style="width: {{ $forecastday['day']['avghumidity']}}%">
                                        </div>
                                    </div>
                                </div> -->
                                <!-- La barra de progreso anda pero tira error por eso está comentada -->
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>