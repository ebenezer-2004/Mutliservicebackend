{{-- filepath: c:\Users\EBENEZER\Desktop\IAEC\resources\views\admin\bases\sidebar.blade.php --}}
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
     {{-- <div class="m-header">
      <a href="/admin" class="b-brand text-primary">
        <img src="
        {{ asset('./img/iaec-logo.jpg') }}" class="img-fluid " alt="logo" style="height: 60px;margin-top: 40px;">
        <span class="badge bg-light-success rounded-pill ms-2 theme-version" >{{auth()->user()->email}}</span>
      </a>
    </div>  --}}
    <div class="m-header d-flex justify-content-center align-items-center">
      <a href="/" class="b-brand text-primary">
        <!-- ========   Change your logo from here   ============ -->
        <img src="{{asset('assets/2nmultiservice_logo.png') }}" class="img-fluid " alt="logo" style="height: 60px;margin-top: 40px;margin-bottom: 40px">
      </a>
    </div>
    <div class="card pc-user-card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <img src="../assets/images/user/avatar-1.jpg" alt="user-image" class="user-avtar wid-45 rounded-circle" />
            </div>
            <div class="flex-grow-1 ms-3 me-2">
              <h6 class="mb-0"></h6>
              <small>{{auth()->user()->email}}</small>
            </div>
            <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse" href="#pc_sidebar_userlink">
              <svg class="pc-icon">
                <use xlink:href="#custom-sort-outline"></use>
              </svg>
            </a>
          </div>
          <div class="collapse pc-user-links" id="pc_sidebar_userlink">
            <div class="pt-3">
              <a href="">
                <i class="ti ti-user"></i>
                <span>Profile</span>
              </a>
             
            </div>
          </div>
        </div>
      </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        <li class="pc-item pc-caption">
          <label></label>
        </li>
        <li class="pc-item">
          <a href="/" class="pc-link">
            <span class="pc-micon"><i class="ti ti-home"></i></span>
            <span class="pc-mtext">Tableau de bord</span>
          </a>
        </li>
       
        <li class="pc-item">
          <a href="{{ route('admin.blog') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-book"></i></span>
            <span class="pc-mtext">Publications</span>
          </a>
        </li>
       
        
       
       <li class="pc-item">
  <a href="{{ route('admin.messages') }}" class="pc-link">
    <span class="pc-micon"><i class="ti ti-news"></i></span>
    <span class="pc-mtext">Messages</span>
  </a>
</li>
<li class="pc-item">
  <a href="{{ route('admin.offres') }}" class="pc-link">
    <span class="pc-micon"><i class="ti ti-message-circle-2"></i></span>
    <span class="pc-mtext">Offres</span>
  </a>
</li>

        {{-- Ajoutez d'autres liens selon vos besoins --}}
      </ul>
    </div>
  </div>
</nav>