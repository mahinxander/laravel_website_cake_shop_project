<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>The Sweet Piece</title>
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/4.0/examples/blog/blog.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/solid.css" integrity="sha384-osqezT+30O6N/vsMqwW8Ch6wKlMofqueuia2H7fePy42uC05rm1G+BUPSd2iBSJL" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/fontawesome.css" integrity="sha384-BzCy2fixOYd0HObpx3GMefNqdbA7Qjcc91RgYeDjrHTIEXqiF00jKvgQG0+zY/7I" crossorigin="anonymous">


    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>

        .hedding {
            font-size: 20px;
            color: #ab8181;
        }

        .main-section {
            position: absolute;
            left: 50%;
            right: 50%;
            transform: translate(-50%, 5%);
        }

        .left-side-product-box img {
            width: 100%;
        }

        .left-side-product-box .sub-img img {
            margin-top: 5px;
            width: 83px;
            height: 100px;
        }

        .right-side-pro-detail span {
            font-size: 15px;
        }

        .right-side-pro-detail p {
            font-size: 25px;
            color: #a1a1a1;
        }

        .right-side-pro-detail .price-pro {
            color: #E45641;
        }

        .right-side-pro-detail .tag-section {
            font-size: 18px;
            color: #5D4C46;
        }

        .pro-box-section .pro-box img {
            width: 100%;
            height: 200px;
        }

        .fa-cart-plus{
            background:#0652DD;
        }

        .addtocart{
            display:block;

            padding:0.5em 1em 0.5em 1em;
            border-radius:100px;
            border:none;
            font-size:1.5em;
            position:relative;
            background:#0652DD;
            cursor:pointer;
            height:2em;
            width:10em;
            overflow:hidden;
            transition:transform 0.1s;
            z-index:1;
        }
        .addtocart:hover{
            transform:scale(1.1);
        }
        .pretext{
            color:#fff;
            background:#0652DD;
            position:absolute;
            top:0;
            left:0;
            height:100%;
            width:100%;
            display:flex;
            justify-content:center;
            align-items:center;
            /*font-family: 'Quicksand', sans-serif;*/
        }
        /*i{*/
        /*    margin-right:10px;*/
        /*}*/

        @media (min-width:360px) and (max-width:640px) {
            .pro-box-section .pro-box img {
                height: auto;
            }
        }
    </style>
</head>

<body >


@include('partials.navbartwo')

@yield('contents')

<main role="main" class="container">
    <div class="row">
        <div class="col-md-12 blog-main">
            @yield('content')
        </div><!-- /.blog-main -->
    </div><!-- /.row -->

</main><!-- /.container -->


<footer class="blog-footer">
    <p>This website is built by <a href="#">Md. Mahin Rahman</a>.</p>
    <p>
        <a href="#">Back to top</a>
    </p>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/holder.min.js"></script>
<script>
    Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
    });
</script>
</body>
</html>
