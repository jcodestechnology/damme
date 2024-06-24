<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="" class="logo d-flex align-items-center">
    <img src="{{URL::asset('imports_dashboard/assets/img/udomlg.png')}}" alt="">
    <span class="d-none d-lg-block" style="color: #000000;">Visual Tour</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<div class="search-bar" style="color: #000000;">
  <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword" style="color: #000000;">
    <button type="submit" title="Search" style="color: #000000;"><i class="bi bi-search" style="color: #000000;"></i></button>
  </form>
</div><!-- End Search Bar -->

<nav class="header-nav ms-auto" style="color: #000000;">
  <ul class="d-flex align-items-center" style="color: #000000;">

    <li class="nav-item d-block d-lg-none" style="color: #000000;">
      <a class="nav-link nav-icon search-bar-toggle " href="#" style="color: #000000;">
        <i class="bi bi-search" style="color: #000000;"></i>
      </a>
    </li><!-- End Search Icon-->

 

   

    <li class="nav-item dropdown pe-3" style="color: #000000;">

    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" style="color: #000000;">
    <img src="{{ Auth::user()->profile}}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2" style="color: #000000;">{{ Auth::user()->name }} </span>
                </a><!-- End Profile Image Icon -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6 style="color: #000000;">{{ Auth::user()->name }} </h6>
                        <span style="color: #000000;">{{ Auth::user()->user_role }} </span> <!-- Assuming user_role is a field in your User model -->
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
        <li>
    
          <a class="dropdown-item d-flex align-items-center" href="profile2">
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


<!-- Your HTML -->
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
    <a class="nav-link " href="dashboard_page">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  </li><!-- End Forms Nav -->

  <li class="nav-item">
    <a class="nav-link " href="post_site">
    <i class="bi bi-geo-alt"></i>

      <span>Post Site</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="postimage">
   <i class="bi bi-star"></i>


      <span>Post images of sites</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="viewsites">
    <i class="bi bi-eye"></i>


      <span>view sites</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="register_admin">
   <i class="bi bi-person"></i>


      <span>Register Admin</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link " href="manage">
   <i class="bi bi-person"></i>


      <span>Manage users</span>
    </a>
  </li>
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-newspaper"></i><span></span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="tables-general.html">
          <i class="bi bi-circle"></i><span></span>
        </a>
      </li>
      <li>
        <a href="jumapili">
          <i class="bi bi-circle"></i><span></span>
        </a>
      </li>
      <li>
        <a href="neno">
          <i class="bi bi-circle"></i><span></span>
        </a>
      </li>
    </ul>
  </li> -->

 
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