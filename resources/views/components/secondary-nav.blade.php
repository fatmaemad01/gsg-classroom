<nav class="navbar navbar-expand-lg navbar-light bg-light ">
<div class="container-fluid">
    <button type="button" id="sidebarCollapse" class="btn btn-primary">
        <i class="fa fa-bars"></i>
        <span class="sr-only ">Toggle Menu</span>
    </button>
    <button class="btn d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars" style="color: #fff"></i>
    </button>
    <div class="ps-2 pt-1 text-success" style="display: inline; font-size:21px">
        Classroom
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
            {{$slot}}
           
        </ul>
    </div>
</div>
</nav>
