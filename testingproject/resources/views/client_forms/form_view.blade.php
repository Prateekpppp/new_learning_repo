@extends('includes.base')

@section('body')

<h1 class="text-center">User Registeration Page</h1>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <form>
                @csrf
                @foreach ($columns as $k=>$v)
                    <div class="mb-3">
                        <label for="{{$v}}" class="form-label text-capitalize">{{$v}}</label><br>
                        @if ($v == 'status')
                            <input type="radio" name="{{$v}}" value="1"><label for="html">Active</label><br>
                            <input type="radio" name="{{$v}}" value="0"><label for="html">Inactive</label>
                        @else
                        <input type="text" name="{{$v}}" class="form-control" id="{{$v}}">
                        @endif
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary submit_form">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('add_js')

<script>

$('.submit_form').on('click',(function(e){
    e.preventDefault();

    submit_form('form',null,'post','add_client/add_client_user/{{$client_id}}','after_submit');

}));

function after_submit(res) {
    console.log('res',res);
}

</script>

@endsection
