@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modify / Update Pack Size Information') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form id="updateForm" method="POST" action="javascript:void(0)">
                        @csrf
                        <input type="hidden" name="pack_id" id="pack_id" value="{{$pack_size_info[0]->id}}">
                        <div class="form-group">
                            <label for="tshirts">Edit Pack Size: </label>
                            <input type="text" class="form-control" id="packSize" name="packSize" placeholder="Ex: 1000" minlength="1" maxlength="5" onkeypress="return isNumber(event)" value="{{$pack_size_info[0]->pack_size}}">
                        </div>
                        <input type="submit" id="updateBtn" class="btn btn-primary" value="Update" disabled/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">

    var dbPackSize = <?php echo $pack_size_info[0]->pack_size; ?>;
    $("#packSize").keyup(function(){
        var value =  $("#packSize").val();

        if(value != dbPackSize)
        {
            $("#updateBtn").attr('disabled', false);
        }
        else
        {
            $("#updateBtn").attr('disabled', true);
        }
    });

    $("#updateForm").submit(function(event){
        event.preventDefault();
        var pack_size = $("#packSize").val();

        if(pack_size == '')
        {
            alert('Please Enter Pack Size');
            return;
        }
        
        /* Get from elements values */
        var values = $(this).serialize();
        
        $.ajax({
            url: "/updatePackSize",
            type: "post",
            data: values ,
            success: function (response) {
                alert(response);

                if(response == 'Success')
                    location.href = '/list-pack-size';
                else
                    $("#packSize").focus();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
        
    });
</script>

@endsection

