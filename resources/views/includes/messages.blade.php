<div class="row">
    <div class="col-12">
        @include('includes.error')
        @if (session('success'))
            @include('component.alert', [
                'type' => 'success',
                'message' => session('success'),
            ])
        @endif
    </div>
</div>