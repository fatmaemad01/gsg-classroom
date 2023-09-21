    <nav class="navbar navbar-light" style="height: 75px;">
        <div class="d-flex justify-content-start">
            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
                aria-controls="offcanvasWithBothOptions">
                <i class="fas fa-bars fa-lg ms-4 me-2"></i>
            </button>
            <a href="{{ route('classroom.index')}}">
                <img class="ps-1 mb-1" src="https://www.gstatic.com/classroom/logo_square_rounded.svg" alt=""
                    height="30px" width="37px" />
                <div class="ps-2 pt-1 text-success" style="display: inline; font-size:22px">
                    Classroom
                </div>
            </a>
        </div>


        <div class="content">
            {{ $slot }}
        </div>
        <div style="width: 260px;" class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1"
            id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">
                    <img class="ps-1"
                        src="https://www.gstatic.com/images/branding/googlelogo/svg/googlelogo_clr_74x24px.svg"
                        alt="" />
                    <div class="fs-5 pt-2" style="display: inline; color: #5f6368">
                        Classroom
                    </div>
                </h5>
            </div>
            <div class="offcanvas-body">
                <ul class="nav">
                    <li>
                        <a href="{{ route('classroom.index') }}" class="btn nav-item">
                            <div class="item d-flex justify-content-between">
                                <i class="fas fa-home menu-icon"></i>
                                <span class="menu-title" style="margin-top: 11px;">{{ __('Classrooms') }}</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('classroom.create') }}" class="btn nav-item">
                            <div class="item d-flex justify-content-between">
                                <i class="fas fa-plus menu-icon"></i>
                                <span class="menu-title " style="margin-top: 11px;">{{ __('New Classroom') }}</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('classroom.trashed') }}" class="btn nav-item">
                            <div class="item d-flex justify-content-between">
                                <i class="fas fa-trash menu-icon"></i>
                                <span class="menu-title "
                                    style="margin-top: 11px; ">{{ __('Trashed Classrooms') }}</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="btn nav-item">
                            <div class="item d-flex justify-content-between">
                                <i class="fas fa-gear menu-icon"></i>
                                <span class="menu-title " style="margin-top: 11px;">{{ __('Setting') }}</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="d-flex justify-content-start ms-5 mt-3">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger ">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    {{ __('Logout') }}
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="icons d-flex justify-content-end">
            <div class=" me-5 mt-1">
                <x-user-notification-menu />
            </div>
            {{-- <img src="https://ui-avatars.com/api/?name={{Auth::user()->name}}" class="ms-3 me-4" alt="" height="35px" width="35px" style="border-radius: 50%" /> --}}
        </div>
    </nav>
