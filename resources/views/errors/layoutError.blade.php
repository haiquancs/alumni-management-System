

        <!DOCTYPE html>
        <html>
        <head>
            <title>{{ $mesError }}</title>
            <link rel="stylesheet" href="{{asset('css/error/style.css')}}">
        </head>
        <body>
        <section id="not-found">
            <div id="title"> {{ $mesError }}</div>
            <div class="circles">

                <p>{{$statusCode}}<br>
                    <small>{{ $mesError }}</small>
                </p>
                <span class="circle big"></span>
                <span class="circle med"></span>
                <span class="circle small"></span>
            </div>
        </section>
        </body>

        </html>