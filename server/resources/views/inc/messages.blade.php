@if($errors->any())
    <div class="tn-box tn-box-color-1">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="tn-box-success tn-box-color-2">
        {{session('success')}}
    </div>
@endif

<script>
    setTimeout(function () {
        $('.tn-box-success').addClass('tn-box-active');
    }, 3000);
</script>
