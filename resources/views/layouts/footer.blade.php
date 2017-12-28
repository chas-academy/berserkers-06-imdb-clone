<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{asset('css/footer2.css')}}" rel="stylesheet">
</head>

<body>
    <footer>
        <div class="is-hidden-mobile">
            <div class="columns is-multiline" id="column-container">
                <div class="column is-2" id="foot-1"></div>
                <div class="column is-2 is-offset-8" id="foot-2"></div>
                <div class="column is-3" id="foot-3">
                    <a href="#" id="to-top">Back to the top!</a>
                </div>
                <div class="column is-3 is-offset-6" id="foot-4"></div>
                <div class="column is-12" id="foot-5">
                    <p id="social-p">Stay in touch :)</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script></script>
</body>

</html>