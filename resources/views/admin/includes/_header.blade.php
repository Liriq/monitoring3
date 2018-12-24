<header id="header" class="header">

    <div class="header-menu">

        @include('admin/includes/_menu_toggle')

        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">     
                    {{--               
                    <!-- <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar"> -->
                    --}}
                    <span class="user-avatar rounded-circle">{{ _i('Admin') }}</span>
                </a>

                <div class="user-menu dropdown-menu">
                    <a onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();" class="nav-link" href="#"><i class="fa fa-power-off"></i> {{ _i('Log out') }}</a>
                </div>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            
            <div class="language-select dropdown" id="language-select">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                    <i class="flag-icon flag-icon-{{ \LaravelGettextHelper::getLocaleCountry() }}"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="language">
                    @foreach(Config::get('laravel-gettext.all-locales-languages') as $locale => $lang)
                          <div class="dropdown-item">
                              <a href="/lang/{{$locale}}">
                                  <span class="flag-icon flag-icon-{{ $lang }}"></span>
                              </a>                              
                          </div>                          
                    @endforeach                    
                    <!-- <div class="dropdown-item">
                        <span class="flag-icon flag-icon-fr"></span>
                    </div>
                    <div class="dropdown-item">
                        <i class="flag-icon flag-icon-es"></i>
                    </div>
                    <div class="dropdown-item">
                        <i class="flag-icon flag-icon-us"></i>
                    </div>
                    <div class="dropdown-item">
                        <i class="flag-icon flag-icon-it"></i>
                    </div> -->
                </div>
            </div>
            
        </div>
    </div>

</header><!-- /header -->