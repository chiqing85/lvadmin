@if(count($errors) > 0)
    <div class="error">
    @foreach($errors->all() as $v)
        <div class="alert alert-danger login animated slideInUp">
            <li> {{ $v }}</li>
        </div>
    @endforeach
    </div>
@endif