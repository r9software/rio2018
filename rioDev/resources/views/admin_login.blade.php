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
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> Usuario no encontrado.
                </div> 
                @endif
                <div class="col-md-4"></div>

                <div class="col-md-4">
                    <section class="login-form">
                        <form method="post" action="{{route("admin_ajax")}}" role="login">
                            <img src="{{ URL::asset('media/pleca-kia.png') }}" class="img-responsive" alt="" />
                            <input type="text" name="user" placeholder="usuario" required class="form-control input-lg" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="password" name="password" class="form-control input-lg" id="password" placeholder="Password" required />


                            <div class="pwstrength_viewport_progress"></div>


                            <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Iniciar</button>
                            <div>

                            </div>

                        </form>

                        <div class="form-links">
                            <a href="#">Aviso de privacidad</a>
                        </div>
                    </section>  
                </div>

                <div class="col-md-4"></div>


            </div>
            <script type="text/javascript" src="{{ URL::asset('libs/login.js') }}"></script>
    </body>
</html>