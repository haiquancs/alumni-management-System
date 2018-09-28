

<!DOCTYPE html>
<html>
<head>
    <title>Error Status Code</title>
    <link rel="stylesheet" href="{{asset('css/error/style.css')}}">
</head>
<body>
<section id="not-found">
    <div id="title"> Error Status Code</div>
    <div class="circles">

        <p>{{$statusCode}}<br>
            <small>Error Status Code</small>
        </p>
        <span class="circle big"></span>
        <span class="circle med"></span>
        <span class="circle small"></span>
    </div>
</section>
</body>

</html>