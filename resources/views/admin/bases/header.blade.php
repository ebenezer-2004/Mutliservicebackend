{{-- filepath: c:\Users\EBENEZER\Desktop\IAEC\resources\views\admin\bases\header.blade.php --}}
<header class="pc-header">
  <div class="header-wrapper">
    <div class="me-auto pc-mob-drp">
      <ul class="list-unstyled">
        <li class="pc-h-item pc-sidebar-collapse">
          <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="pc-h-item pc-sidebar-popup">
          <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
      </ul>
    </div>
    <div class="ms-auto">
      <ul class="list-unstyled">
        <li class="dropdown pc-h-item">
          <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <svg class="pc-icon">
              <use xlink:href="#custom-sun-1"></use>
            </svg>
          </a>
          <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
            <a href="#!" class="dropdown-item" onclick="layout_change('dark')">
              <svg class="pc-icon"><use xlink:href="#custom-moon"></use></svg>
              <span>Dark</span>
            </a>
            <a href="#!" class="dropdown-item" onclick="layout_change('light')">
              <svg class="pc-icon"><use xlink:href="#custom-sun-1"></use></svg>
              <span>Light</span>
            </a>
            <a href="#!" class="dropdown-item" onclick="layout_change_default()">
              <svg class="pc-icon"><use xlink:href="#custom-setting-2"></use></svg>
              <span>Default</span>
            </a>
          </div>
        </li>
        <li class="dropdown pc-h-item">
          <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <svg class="pc-icon"><use xlink:href="#custom-setting-2"></use></svg>
          </a>
          <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
            <a href="" class="dropdown-item"><i class="ti ti-user"></i><span>Profile</span></a>
            <form action="{{route('logout') }}" method="post">
              @csrf
              @method('DELETE')
            <button class="dropdown-item"><i class="ti ti-power"></i><span>Déconnexion</span></button>
            </form>
          </div>
        </li>
        
        
        <li class="dropdown pc-h-item header-user-profile">
          <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
            <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar" />
          </a>
          <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
            {{-- ...profile dropdown code (optionnel)... --}}
          </div>
        </li>
      </ul>
    </div>
  </div>
</header>
