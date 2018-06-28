@foreach (['danger', 'warning', 'success', 'info'] as $key)
@if(Session::has($key))
<p class="alert alert-{{ $key }}">{{ Session::get($key) }}</p>
@endif
@endforeach

<!--
@if(Session::has('success'))

<div class="alert alert-success" role="alert">
<strong>功能:</strong>{{ Session::get('success') }}
</div>

@endif

-->  
@if(count($errors) > 0)

<div class="alert alert-danger" role="alert">
    <strong>Errors:</strong>{{ Session::get('success') }}
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif



