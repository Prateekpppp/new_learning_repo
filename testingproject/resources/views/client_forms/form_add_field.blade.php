@extends('includes.base')

@section('body')

<h1 class="text-center">Register and Create Form Fields</h1>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <form>
                @foreach ($columns as $k=>$v)
                    @if ($k>0 && $k<5)

                        <div class="mb-3">
                            <label for="{{$v}}" class="form-label text-capitalize">{{$v}}</label><br>
                            @if ($v == 'status')
                                <input type="radio" name="{{$v}}" value="1"><label for="html">Active</label><br>
                                <input type="radio" name="{{$v}}" value="0"><label for="html">Inactive</label>
                            @else
                            <input type="text" name="{{$v}}" class="form-control" id="{{$v}}">
                            @endif
                        </div>

                    @endif
                @endforeach

                <button type="submit" class="btn btn-primary submit_form">Register</button>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <h2 class="form-label text-capitalize text-center mt-3 mb-4">Add Your Form Fields</h2>
                <div class="container">
                    <div class="d-flex flex-column">
                        <div class="add_fields">
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-success add_fields_btn">Add form fields</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('add_js')

<script>

$('.add_fields_btn').click(function(){
    add_form_fields('add_fields');
});

$('.submit_form').on('click',(function(e){
    e.preventDefault();
    if($('.add_fields input').length >0){
        var field_names = [];
        $('.add_fields input').each(function(index, element){

            field_names.push($(element).val());

        });
    }
    submit_form('form',field_names,'post','add_client/client','after_submit');


}));

function after_submit(res) {
    console.log('res',res);
}

</script>

@endsection
