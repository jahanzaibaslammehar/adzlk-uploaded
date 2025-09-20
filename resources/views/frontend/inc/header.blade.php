      <header class="header">
        <button class="menu-toggle"><i class="fa fa-bars"></i></button>
        <div class="content">
          
            <div class="logo" onclick="location.href='{{ route('home') }}'" style="cursor: pointer;">
                <img src="{{ asset('images/logo-1.png') }}" alt="ADS Logo" class="logo-image">
            </div>

            <div class="website-name" onclick="location.href='{{ route('home') }}'" style="cursor: pointer;">
                <h1>ADZLK.COM</h1>
            </div>

            <div class="btn">
              @if(Auth::guard('poster')->check())
                <button class="btnRefresh" onclick="location.href='{{ route('dashboard') }}'">Post Ad</button>
              @else
                <button class="btnRefresh" onclick="location.href='{{ route('home') }}'">Refresh</button>
                <button class="btnLogin" onclick="location.href='{{ route('login') }}'">Login/Post Ad</button>
              @endif
            </div>
        </div>      
      </header>