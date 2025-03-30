
<nav class="navbar navbar-expand-lg navbg shadow p-3 mx-3 mt-2 rounded-2 fixed-top">
        <div class="container-fluid shadows d-flex justify-content-between">

            <a href="#Home" class="navbar-brand"><img src="./src/img/PLSP.png" alt="PLSP Enrollment System" width="40"></a>
            <!--Branding-->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navlinks"
                aria-controls="navlinks" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button> <!--Toggler for navigation bar in mobile view-->



            <div class="collapse navbar-collapse" id="navlinks">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"> <!--Navigation links-->
                    <li class="nav-item">
                        <a href="?page=home" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=ManageDB" class="nav-link">Manage</a>
                    </li>
                </ul>
                <hr class="d-lg-none">
                <div class="text-end">
                    <p class="text-muted mb-0">Philippine Standard Time</p>
                    <h6 id="time" class="text-muted mb-0"></h6> 
                    <!--Time will be displayed here-->
                </div>
            </div>
        </div>
    </nav>