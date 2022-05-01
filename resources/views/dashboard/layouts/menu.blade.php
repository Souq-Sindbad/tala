<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route(env('DASH_URL').'.index') }}" class="brand-link">
        <img src="{{ asset('public/w-logo.svg') }}" width="33" height="33"
             alt="{{ $settings->getTranslateTitle(app()->getLocale()) }}" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $settings->getTranslateTitle(app()->getLocale()) }}</span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @if (auth()->user()->hasPermission('features-read'))
                    <li class="nav-item">
                        <a href="{{ route(env('DASH_URL').'.features.index') }}" class="nav-link">
                            <i class="nav-icon fas @lang('icons.features')"></i>
                            <p>
                                @lang('site.features')
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('benefits-read'))
                    <li class="nav-item">
                        <a href="{{ route(env('DASH_URL').'.benefits.index') }}" class="nav-link">
                            <i class="nav-icon fas @lang('icons.benefits')"></i>
                            <p>
                                @lang('site.benefits')
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('partners-read'))
                    <li class="nav-item">
                        <a href="{{ route(env('DASH_URL').'.partners.index') }}" class="nav-link">
                            <i class="nav-icon fas @lang('icons.partners')"></i>
                            <p>
                                @lang('site.partners')
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('projects-read'))
                    <li class="nav-item">
                        <a href="{{ route(env('DASH_URL').'.projects.index') }}" class="nav-link">
                            <i class="nav-icon fas @lang('icons.projects')"></i>
                            <p>
                                @lang('site.projects')
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('statistics-read'))
                    <li class="nav-item">
                        <a href="{{ route(env('DASH_URL').'.statistics.index') }}" class="nav-link">
                            <i class="nav-icon fas @lang('icons.statistics')"></i>
                            <p>
                                @lang('site.statistics')
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('users-read'))
                    <li class="nav-item">
                        <a href="{{ route(env('DASH_URL').'.users.index') }}" class="nav-link">
                            <i class="nav-icon fas @lang('icons.users')"></i>
                            <p>
                                @lang('site.users')
                            </p>
                        </a>
                    </li>
                @endif

                    @if (auth()->user()->hasPermission('settings-read'))
                        <li class="nav-item">
                            <a href="{{ route(env('DASH_URL').'.settings') }}" class="nav-link">
                                <i class="nav-icon fas @lang('icons.settings')"></i>
                                <p>
                                    @lang('site.settings')
                                </p>
                            </a>
                        </li>
                    @endif
            </ul>
        </nav>

    </div>
</aside>
