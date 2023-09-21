<!DOCTYPE html>
<html dir="{{ App::isLocale('ar') ? 'rtl' : 'ltr' }}" lang="{{ App::currentLocale() }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-...">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @if (App::isLocale('ar'))
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css"
            integrity="sha384-PRrgQVJ8NNHGieOA1grGdCTIt4h21CzJs6SnWH4YMQ6G5F5+IEzOHz67L4SQaF0o" crossorigin="anonymous">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    @endif
    <link rel="stylesheet" href="{{ asset('css/classroom.css') }}" />
    @stack('styles')
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
</head>

<body class="wrapper">

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="active">
            <h1><a href="{{ route('classroom.index') }}" class="logo"> <img class="ps-1 mb-1"
                        src="https://www.gstatic.com/classroom/logo_square_rounded.svg" alt="" height="37px"
                        width="43px" /></a></h1>
            <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="{{ route('classroom.index') }}"><span class="fa fa-home"></span> Home</a>
                </li>
                <li>
                    <a href="{{ route('classroom.create') }}"><span class="fa fa-plus"></span> New</a>
                </li>
                <li>
                    <a href="{{ route('classroom.trashed') }}"><span class="fa fa-archive"></span> Archive</a>
                </li>

                <li>
                    <a href="{{ route('profile.edit') }}"><span class="fa fa-user"></span> Profile</a>
                </li>
                {{-- @can('view-any', ['App\Models\Classwork', $classroom])
                    <x-secondary-nav />
                @endcan --}}
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content2" class="p-4 p-md-5">
            {{ $slot }}
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        const userId = "{{ Auth::id() }}"
        var classroomId
    </script>

    @stack('scripts')
    @vite('resources/js/app.js')

</body>

</html>
