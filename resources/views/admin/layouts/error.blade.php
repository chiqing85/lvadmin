@if(count($errors) > 0)
    <div class="alert alert-danger login animated slideInUp">
        @foreach($errors->all() as $v)
            <li> {{ $v }}</li>
        @endforeach
    </div>
@endif