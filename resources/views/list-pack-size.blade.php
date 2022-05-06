@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List Of Pack Sizes</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header">{{ __('Avalaible Pack Sizes (For Flosso Wholesaler)') }}</div>

                <div class="card-body">
                    <table class="table table-dark table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pack Size</th>
                                <th>Date Updated</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $p)
                            <tr>
                                <td>{{$p->id}}</td>
                                <td>{{$p->pack_size}}</td>
                                <td>{{$p->updated_at}}</td>
                                <td>{{$p->created_at}}</td>
                                <td>
                                    <a href="/update/{{$p->id}}" class="btn btn-warning">Update/Modify</a>
                                    <a href="javascript:void(0)" class="btn btn-danger" onclick="deletePackSize({{$p->id}})">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">

    function deletePackSize(id){

        var cnfrm = confirm("Are you sure you want to delete this pack size?");

        if(cnfrm)
        {
            $.ajax({
                url: "/deletePackSize",
                type: "post",
                data: {"id": id, "_token": "{{ csrf_token() }}"},
                success: function (response) {
                    alert(response);
                    location.reload(true);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        return;
        
    }
    

</script>
@endsection

