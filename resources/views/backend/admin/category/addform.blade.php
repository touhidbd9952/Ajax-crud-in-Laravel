@extends('layouts.admin_master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Category Entry</div>

                <div class="card-body">
                   

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Categoy Name</label>

                            <div class="col-md-6">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror"  required  autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" onclick="addcateogy()">
                                    Save
                                </button>

                               
                            </div>
                        </div>
                    
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>sl</th>
                        <th>Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="categoryview">
                    
                </tbody>
            </table>

            <div class="card">
                <div class="card-header">Category Edit</div>

                <div class="card-body">
                   

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Categoy Name</label>

                            <div class="col-md-6">
                                <input type="text" name="categoryname" id="categoryname"  class="form-control @error('categoryname') is-invalid @enderror"  required  autofocus>

                                @error('categoryname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" id="categoryid">

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" onclick="categoryUpdate()">
                                    Update
                                </button>

                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        //call when page load
        getcategory();
    })
    //Ajax POST for insert data
    function addcateogy(){
        var name = $('#name').val();
        $.ajax({
            type:'POST',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "categoryname":name,
                },
            url: '/category/add',
            dataType:'json',
            success:function(data){
              //call after insert
              getcategory();

            }
        })
    }

    // Ajax GET
    function getcategory()
    {
        $.ajax({
            type:'GET',
            url: '/category/view',
            dataType:'json',
            success:function(data){
                var tablerow ="";
              $.each(data,function(key,value){
                tablerow += `<tr>
                        <td>${value.id}</td>
                        <td>${value.name}</td>
                        <td>
                            <a href="javascript:" id="${value.id}" class="btn" onclick="categoryEdit(this.id)">Edit</a>
                            <a href="javascript:" id="${value.id}" class="btn" onclick="categoryDelete(this.id)">Delete</a>
                        </td>
                    </tr>`  
              });
              $('#categoryview').html(tablerow);

            }
        })
    }

    //Ajax GET for edit data
    function categoryEdit(id)
    {
        $.ajax({
            type:'GET',
            url: '/category/edit/'+id,
            dataType:'json',
            success:function(data){
                $('#categoryid').val(data.id);
                $('#categoryname').val(data.name);
            }
        })
    }

    function categoryUpdate()
    {
        var id = $('#categoryid').val();
        var name = $('#categoryname').val();
        $.ajax({
            type:'POST',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "categoryname":name,
                },
            url: '/category/update/'+id,
            dataType:'json',
            success:function(data){
              //call after insert
              getcategory();

            }
        })
    }
    //Ajax GET for edit data
    function categoryDelete(id)
    {
        $.ajax({
            type:'GET',
            url: '/category/delete/'+id,
            dataType:'json',
            success:function(data){
                getcategory();
            }
        })
    }


</script>




@endsection
