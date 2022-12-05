<div class="content-header row">
    <div class="content-header-dark bg-img col-12">
        <div class="row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h3 class="content-header-title white">{{ $page }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.index') }}">Dashboard</a>
                            </li>
                            @forelse ($breadcrumbs as $index => $breadcrumb)
                                @if ($index != count($breadcrumbs) - 1)
                                    <li class="breadcrumb-item">
                                        <a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['text'] }}</a>
                                    </li>
                                @else
                                    <li class="breadcrumb-item active">
                                        {{ $breadcrumb['text'] }}
                                    </li>
                                @endif
                            @empty
                            @endforelse
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content-header-right col-md-3  col-12">
                <div class="btn-group float-md-right">
                    @if (isset($actionBtn) && $actionBtn['show'])
                        @if (isset($actionBtn['type']) && $actionBtn['type'] == 'modalBtn')
                            <button type="button" class="btn text-capitalize btn-primary round box-shadow-2 px-2"
                                data-toggle="modal" data-target="#{{ $actionBtn['modalTarget'] }}">
                                @isset($actionBtn['icon'])
                                    {!! $actionBtn['icon'] !!}
                                @endisset
                                {{ $actionBtn['text'] }}
                            </button>
                        @else
                            <a href="{{ $actionBtn['link'] }}"
                                class="btn text-capitalize btn-primary round box-shadow-2 px-2">
                                @isset($actionBtn['icon'])
                                    {!! $actionBtn['icon'] !!}
                                @endisset
                                {{ $actionBtn['text'] }}
                            </a>
                        @endif
                    @endif
                    <button class="btn btn-light goBack">
                        <i class="la la-arrow-left"></i>
                        Retour
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
