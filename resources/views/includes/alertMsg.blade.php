@if (session('success'))
    <div   class="alert-holder bg-success " data-alert="alert-holder">
        <span class="alert-close-icon js-alert-click"><i class="fas fa-window-close"></i></span>
        <span class="alert-content">{{ session('success') }}</span>
    </div>

@else 
    @if ($errors->any())
        <div   class="alert-holder bg-danger " data-alert="alert-holder">
        <span class="alert-close-icon js-alert-click"><i class="fas fa-window-close"></i></span>
        <span class="alert-content">
            <ul>
                @foreach ($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
                @endforeach
            </ul>
        </span>
    </div>
    @endif
@endif

 