    <nav class="navbar navbar-light" style="height: 75px;">
            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                <i class="fas fa-bars fa-lg ms-4 me-3"></i>
                <img class="ps-1" src="https://www.gstatic.com/images/branding/googlelogo/svg/googlelogo_clr_74x24px.svg" alt="" />
                <div class="fs-5 pt-2" style="display: inline; color: #5f6368">
                    Classroom
                </div>
            </button>

            <div class="content">
                {{$slot}}
            </div>
            <div style="width: 260px;" class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">
                        <img class="ps-1" src="https://www.gstatic.com/images/branding/googlelogo/svg/googlelogo_clr_74x24px.svg" alt="" />
                        <div class="fs-5 pt-2" style="display: inline; color: #5f6368">
                            Classroom
                        </div>
                    </h5>
                </div>
                <div class="offcanvas-body">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="{{route('classroom.index')}}">
                                <div class="item d-flex justify-content-between">
                                    <i class="fas fa-home menu-icon"></i>
                                    <span class="menu-title" style="margin: 11px;">Classrooms</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('classroom.create')}}">
                                <div class="item d-flex justify-content-between">
                                    <i class="fas fa-plus menu-icon"></i>
                                    <span class="menu-title " style="margin: 11px;">New Classroom</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('classroom.trashed')}}">
                                <div class="item d-flex justify-content-between">
                                    <i class="fas fa-trash menu-icon"></i>
                                    <span class="menu-title " style="margin: 11px;">Trashed Classrooms</span>
                                </div>
                            </a>
                        </li>

                        <li>

                            <div class="d-flex justify-content-start ms-5 mt-3">
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger ">
                                        <i class="fas fa-sign-out-alt me-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="icons d-flex justify-content-end">
                <img src="{{asset('./img/pexels-masha-raymers-2726111.jpg')}}" class="me-4" alt="" height="35px" width="35px" style="border-radius: 50%" />
            </div>
    </nav>



