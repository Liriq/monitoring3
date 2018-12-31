<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>{{ \Laratrust::hasRole('admin') ? _i('Admin dashboard') : _i('Employee dashboard') }}</h1>
            </div>
        </div>
    </div>
    
    @if (count($breadcrumbs))

    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                @foreach ($breadcrumbs as $breadcrumb)

                    @if ($breadcrumb->url && !$loop->last)
                        <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                    @else
                        <li class="active">{{ $breadcrumb->title }}</li>
                    @endif

                @endforeach
                </ol>
            </div>
        </div>
    </div>

    @endif
</div>