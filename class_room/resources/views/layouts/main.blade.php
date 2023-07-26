<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/classroom.css')}}" />
    @stack('styles')
    <title>{{$title}}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@100;300;400;500;700;900&family=Work+Sans:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-light">
        <div class="container">
            <div class="menu-icon m-1">
                <button class="btn"><i class="fas fa-bars fa-lg"></i></button>
                <img class="ps-1" src="https://www.gstatic.com/images/branding/googlelogo/svg/googlelogo_clr_74x24px.svg" alt="" />
                <div class="fs-5 pt-2" style="display: inline; color: #5f6368">
                    Classroom
                </div>
            </div>
            <div class="icons">
                <a href="{{route('classroom.create')}}" class="btn"><i class="fas fa-add fa-lg"></i></a>
                <a href="{{route('classroom.index')}}" class="btn"><i class="fas fa-home fa-lg"></i></a>
                <button class="btn">
                    {{Auth::user()->name}}
                    <img src="{{asset('./img/pexels-masha-raymers-2726111.jpg')}}" alt="" height="35px" width="35px" style="border-radius: 50%" />
                </button>
            </div>
        </div>
    </nav>

    <div class="container">
        {{$slot}}
    </div>

    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/all.min.js')}}"></script>

    @stack('scripts')
</body>

</html>