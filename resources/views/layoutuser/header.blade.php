  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
      <div class="container d-flex justify-content-between align-items-center">
          <div class="logo text-center text-white"
              style="display: flex; align-items: center; justify-content: center; gap: 10px;">
              <a href="#">
                  <img src="{{ asset('assets/logo.png') }}" alt="Sony Nursery Logo" class="img-fluid"
                      style="max-width: 100px;">
              </a>
              <p style="margin: 0; font-weight: bold;">Sony Nursery</p>
          </div>

          <nav id="navbar" class="navbar">
              <ul class="d-lg-flex align-items-center flex-column flex-lg-row text-center d-none" id="nav-menu">
                  <li><a class="{{ Route::is('homeuser') ? 'active' : '' }}" href="{{ route('homeuser') }}">Beranda</a>
                  </li>
                  <li><a class="{{ Route::is('aboutuser') ? 'active' : '' }}" href="{{ route('aboutuser') }}">Tentang
                          Kami</a></li>
                  <li><a class="{{ Route::is('serviceUser') ? 'active' : '' }}"
                          href="{{ route('serviceUser') }}">Layanan</a></li>
                  <li><a class="{{ Route::is('pesananUser') ? 'active' : '' }}"
                          href="{{ route('pesananUser') }}">Pesanan
                          Saya</a></li>
                  <li><a class="{{ Route::is('contactUser') ? 'active' : '' }}"
                          href="{{ route('contactUser') }}">Kontak</a></li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle getstarted scrollto {{ Route::is('login') ? 'active' : '' }}"
                          href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                          aria-expanded="false">
                          Account
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="{{ route('profileUser') }}">Profile</a></li>
                          <li>
                              <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                  @csrf
                                  <button type="submit" class="dropdown-item"
                                      style="border: none; background: none; cursor: pointer;">
                                      Logout
                                  </button>
                              </form>
                          </li>
                      </ul>
                  </li>
              </ul>
              <i class="bi bi-list mobile-nav-toggle"></i>
          </nav>

          <!-- .navbar -->
      </div>
  </header>
  <!-- End Header -->

  <script>
      document.addEventListener("DOMContentLoaded", function() {
          const toggle = document.querySelector(".mobile-nav-toggle");
          const menu = document.querySelector("#nav-menu");

          toggle.addEventListener("click", function() {
              menu.classList.toggle("d-none");
          });
      });
  </script>
