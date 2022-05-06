@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Pack Size</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header">{{ __('Add New Pack Size (For Flosso Wholesaler)') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form id="foo" method="POST" action="javascript:void(0)">
                        @csrf
                        <div class="form-group">
                            <label for="tshirts">Enter Pack Size: </label>
                            <input type="text" class="form-control" id="packSize" name="packSize" placeholder="Ex: 1000" minlength="1" maxlength="5" onkeypress="return isNumber(event)">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Add"/>
                    </form>

                    <div class="showList">
                        <span>To check the list of existing sizes. <a href="/list-pack-size">click here</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">

    $("#foo").submit(function(event){
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
            url: "/addNewPackSize",
            type: "post",
            data: values ,
            success: function (response) {
                alert(response);
                location.reload(true);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
        
    });
</script>

@endsection

