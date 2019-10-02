<header id="header" class="header">

    <div class="header-menu">

        @include('includes._menu_toggle')

        <div class="col-sm-5">        
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
                </div>
            </div>
            
        </div>
    </div>

</header><!-- /header -->