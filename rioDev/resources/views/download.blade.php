<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <title>KIA Vibrant</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="{{ URL::asset('libs/jquery/jquery-3.1.1.min.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('styles/login.css') }}"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>

        <div class="container">

            <div class="row" id="pwd-container">
                <div class="jumbotron">
                    <h1>Bienvenido</h1>
                    <p>Descarga los usuarios que han entrado en la aplicacion vibrant</p>
                    <p><a class="btn btn-primary btn-lg" href="{{route("descargar")}}" target="_blank" role="button">Descargar</a></p>
                </div> 
            </div>
            <script type="text/javascript" src="{{ URL::asset('libs/login.js')  }}"></script>
    </body>
</html>