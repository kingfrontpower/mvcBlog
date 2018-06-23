@if(Session::has('success'))
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success" role="alert">
                <strong>功能:</strong>{{ Session::get('success') }}
            </div>

            @endif


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

        </div>        
    </div>
</div>


