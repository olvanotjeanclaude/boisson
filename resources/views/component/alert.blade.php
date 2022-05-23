@if (isset($type) && isset($message))
    @switch($type)
        @case('primary')
            <div class="alert alert-icon-left alert-arrow-left alert-primary alert-dismissible mb-2" role="alert">
                <span class="alert-icon"><i class="la la-heart"></i></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {!! $message !!}
            </div>
        @break

        @case('success')
            <div class="alert alert-icon-left alert-arrow-left alert-success alert-dismissible mb-2" role="alert">
                <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {!! $message !!}
            </div>
        @break

        @case('danger')
            <div class="alert alert-icon-left alert-arrow-left alert-danger alert-dismissible mb-2" role="alert">
                <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {!! $message !!}
            </div>
        @break

        @case('warning')
            <div class="alert alert-icon-right alert-arrow-right alert-warning alert-dismissible mb-2" role="alert">
                <span class="alert-icon"><i class="la la-warning"></i></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {!! $message !!}
            </div>
        @break

        @case('info')
            <div class="alert alert-icon-right alert-arrow-right alert-info alert-dismissible mb-2" role="alert">
                <span class="alert-icon"><i class="la la-info-circle"></i></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {!! $message !!}
            </div>
        @break

        @default
    @endswitch
@endif
