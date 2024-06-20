<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="" class="logo d-flex align-items-center">
    <!-- <img src="{{URL::asset('imports_dashboard/assets/img/lg.png')}}" alt=""> -->
    <span class="d-none d-lg-block">Virtual Tour</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div><!-- End Search Bar -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon-->

 

   

    <li class="nav-item dropdown pe-3">

    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
    <img src="" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }} </span>
                </a><!-- End Profile Image Icon -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }} </h6>
                        <span>{{ Auth::user()->user_role }} </span> <!-- Assuming user_role is a field in your User model -->
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
        <li>
          <a class="dropdown-item d-flex align-items-center" href="my_profile">
            <i class="bi bi-person"></i>
            <span>My Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

       
        <li>
          <hr class="dropdown-divider">
        </li>
<li>
    <form action="{{ route('logout') }}" method="POST" style="display: none;" id="logout-form">
        @csrf
    </form>
    <a id="logout-link" class="dropdown-item d-flex align-items-center" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i>
        <span>Sign Out</span>
    </a>
</li>




      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="dashboard_member">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

 
  <li class="nav-item">
    <a class="nav-link " href="virtual_sites">
    <i class="bi bi-calendar"></i>
      <span>Virtual sites</span>
    </a>
  </li>
  
  
</ul>

</aside><!-- End Sidebar-->
<script>

document.addEventListener('DOMContentLoaded', function() {
  var signOutLink = document.getElementById('logout-link');

// Add a click event listener to the logout link
signOutLink.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default link behavior

   
    // Use replaceState to replace the current history entry with the login page
    history.replaceState(null, null, '/login'); // Replace 'login.html' with your actual login page URL

    // Redirect the user to the logout page with the user ID as a query parameter
    window.location.href = `/login`; // Replace '/logout' with your actual logout route
});

// Listen for the 'popstate' event to handle back/forward button clicks
window.addEventListener('popstate', function(event) {
    // Redirect the user back to the login page
    window.location.href = '/login'; // Replace 'login.html' with your actual login page URL
});
});

</script>