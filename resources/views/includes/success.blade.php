@if (session('success'))
    @include('component.alert', [
        'type' => 'success',
        'message' => session('success'),
    ])
@endif
