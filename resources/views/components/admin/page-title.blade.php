@props([
    'pageTitle',
    'btnRoute',
    'btnIcon',
    'btnText',
    'btnType' => 'secondary'
])

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title text-secondary">
                <h4>{{ $pageTitle }}</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $pageTitle }}
                    </li>
                </ol>
            </nav>
        </div>
        @isset($btnRoute)
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route($btnRoute) }}" class="btn {{ isset($btnType) ? 'btn-'.$btnType : '' }}">
                    @isset($btnIcon)
                        <i class="{{ $btnIcon }}"></i>
                    @endisset
                    {{ isset($btnText) ? $btnText : '' }}
                </a>
            </div>
        @endisset
    </div>
</div>
