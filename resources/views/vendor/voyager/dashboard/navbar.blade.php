<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="hamburger btn-link">
                <span class="hamburger-inner"></span>
            </button>
            @section('breadcrumbs')
            <ol class="breadcrumb hidden-xs" style="margin-top: 10px !important">
                @if(count(Request::segments()) == 1)
                    <li class="active light-blue-text"><b><i class="voyager-boat"></i> {{ __('voyager::generic.dashboard') }}</b></li>
                @else
                    <li class="active">
                        <a href="{{ route('voyager.dashboard')}}" class="grey-text" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"><i class="voyager-boat"></i> {{ __('voyager::generic.dashboard') }}</a>
                    </li>
                @endif
                <?php $breadcrumb_url = url(''); ?>
                @for($i = 1; $i <= count(Request::segments()); $i++)
                    <?php $breadcrumb_url .= '/' . Request::segment($i); ?>
                    @if(Request::segment($i) != ltrim(route('voyager.dashboard', [], false), '/') && !is_numeric(Request::segment($i)))

                        @if($i < count(Request::segments()) & $i > 0 && array_search('database',Request::segments())===false)
                            <li class="active">
                                <a href="{{ $breadcrumb_url }}" class="grey-text">{{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}</a>
                            </li>
                        @else
                            <li class="light-blue-text"><b>{{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}</b></li>
                        @endif

                    @endif
                @endfor
            </ol>
            @show
        </div>
        <ul class="nav navbar-nav @if (config('voyager.multilingual.rtl')) navbar-left @else navbar-right @endif">
            <li class="profile" style="border: 0">
                <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button"
                aria-haspopup="true" aria-expanded="false">
                    <img src="{{ $user_avatar }}" class="profile-img">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-animated">
                    <li class="profile-img">
                        <img src="{{ $user_avatar }}" width="58" height="58" class="profile-img image-fluid rounded-circle">
                        <div class="profile-body float-right">
                            <h5><b>{{ Auth::user()->name }}</b></h5>
                            <h5>{{ Auth::user()->email }}</h5>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <?php $nav_items = config('voyager.dashboard.navbar_items'); ?>
                    @if(is_array($nav_items) && !empty($nav_items))
                    @foreach($nav_items as $name => $item)
                    <li {!! isset($item['classes']) && !empty($item['classes']) ? 'class="'.$item['classes'].'"' : '' !!}>
                        @if(isset($item['route']) && $item['route'] == 'voyager.logout')
                        <form action="{{ route('voyager.logout') }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-block hoverable">
                                @if(isset($item['icon_class']) && !empty($item['icon_class']))
                                <i class="{!! $item['icon_class'] !!}"></i>
                                @endif
                                &ensp;
                                <b>{{$name}}</b>
                            </button>
                        </form>
                        @else
                        <a href="{{ isset($item['route']) && Route::has($item['route']) ? route($item['route']) : (isset($item['route']) ? $item['route'] : '#') }}" {!! isset($item['target_blank']) && $item['target_blank'] ? 'target="_blank"' : '' !!}>
                            @if(isset($item['icon_class']) && !empty($item['icon_class']))
                            <i class="{!! $item['icon_class'] !!} blue-grey-text"></i>
                            @endif
                            &ensp;
                            <b class="blue-grey-text">{{$name}}</b>
                        </a>
                        @endif
                    </li>
                    @endforeach
                    @endif
                </ul>
            </li>
        </ul>
    </div>
</nav>
