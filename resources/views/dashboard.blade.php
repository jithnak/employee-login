@extends('layout')
  
@section('content')
  <style>
table, th, td {
  border: 1px solid black;
},

 

</style>

<div class="sidenav">
  <a href="{{URL::to('/dashboard')}}">Companies</a>
  <a href="{{URL::to('/get-list')}}">Employees</a>
 
</div>

<div class="main">
  <h2>Companies</h2>
   <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                 
                  <div class="card-header">Add Company</div>
                  <div class="card-body">
                    <form action="{{URL::to('/add_company')}}" method="post" enctype="multipart/form-data" id="export"> 
                     <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                      <input type="hidden" name="edit_id" id="edit_id">
                          <div class="row">
                          <div class="col-md-4"> 
                          <label>Name </label>
                           <div class="group material-input">     
                  
                            <input type="text" id="name" class="form-control" name="name">
                                
                          
                          </div>
                          </div>
              
  
                         <div class="col-md-4"> 
                          <label>Email </label>
                           <div class="group material-input">     
                  
                            <input type="text" id="email" class="form-control" name="email">
                                
                          
                          </div>
                          </div>

                           <div class="col-md-4"> 
                          <label>Logo </label>
                           <div class="group material-input">     
                  
                            <div class="input-group col-xs-12">

                <input type="text" value="{{old('logo')}}" class="form-control file-upload-info @error('logo') is-invalid @enderror" disabled="" placeholder="Upload Image">

                <span class="input-group-append">
                <button type="button" class="btn btn-secondary file-upload-browse"><i class="ik ik-share"></i>&nbsp;&nbsp;Upload</button>

                </span>
                <input type="file" value="{{old('logo')}}" style="display:none"  id="logo" name="logo" class="form-control logo @error('logo') is-invalid @enderror">
                <div class="help-block with-errors"></div>

                         

                </div>


              </div>
                                 
                          
                          </div>
                          

                           <div class="col-md-4"> 
                          <label>Website </label>
                           <div class="group material-input">     
                  
                            <input type="text" id="website" class="form-control" name="website">
                                
                          
                          </div>
                          </div>

                          </div>
                           <br>
                          <div class="row">
                          <div class="col-md-4">
                              <button type="submit"  id="add" class="btn btn-primary">
                                  Submit
                              </button>
                               <button type="submit"  id="update" class="btn btn-primary" style="display:none;">
                                  Update
                              </button>
                          </div>
                          </div>
                      </form>


                        
                  </div>
              </div>

              <div class="card">
                  <div class="card-header">Manage Company</div>
                  <div class="card-body">
                  <table style="margin-left: 10px;width:100%;" class="table table-bordered">
  <thead>
    <tr>
      <th>SL.No</th>
      <th>Name</th>
      <th>Email</th>
      <th>logo</th>
      <th>Website</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i=0;
    foreach($company as $val)
    {
      $id = $val->company_id;
      $i++;
    ?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $val->company_name;?></td>
      <td><?php echo $val->company_email;?></td>
      <td><img src="{{asset('public/uploads/company/'.$val->company_logo)}}" style="height:50px; width:80px;"></td>
      <td><?php echo $val->company_website;?></td>
      <td>
        <a href="#" onclick="edit(<?php echo $id; ?>)" data-toggle="modal" data-target="#EDIT_Modal"><i class="fa fa-pencil"></i></a>
        <a onclick="delet(<?php echo $id; ?>)"><i class="fa fa-trash"></i></a>

     
      </td>
    </tr>
    <?php
  }
    ?>
  
  </tbody>
  
</table>

  {!! $company->links() !!}
                    <div>
                      <div>
                        <div>
  
          </div>
      </div>
  </div>
  
</div>


<div></div>


<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
     $('.file-upload-browse').on('click', function() {
      var file = $(this).parent().parent().parent().find('.logo');
      file.trigger('click');
    });
      $('.logo').on('change', function() {
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
 function edit(id)
  {
   // alert(1);
   $.ajax({
      type:"POST",
      url: '<?php echo url('getDataTable') ?>',
     data: {
        "_token": "{{ csrf_token() }}",
        "id": id
        },
      success:function(result){ 
      $('#add').hide(); 
      $('#update').show();  
      $('#edit_id').val(result.data.company_id);
      $('#name').val(result.data.company_name);
      $('#email').val(result.data.company_email);
      $('#website').val(result.data.company_website);
      
      }
       });  
  } 

  function delet(id)
  {
     // alert(id);
     $.ajax({
      type:"POST",
      url: '<?php echo url('delete') ?>',
     data: {
        "_token": "{{ csrf_token() }}",
        "id": id
        },
      success:function(result){        
     // alert(1);
      location.reload();
      
      }
    });
  }

  function company()
  {
    // alert(1);
   $.ajax({
      type:"GET",
      url: '<?php echo url('dashboard') ?>',
     data: {
        "_token": "{{ csrf_token() }}",
        },
      success:function(result){        
     
      
      }
    });
  }   

  function employee()
  {
    // alert(1);
   $.ajax({
      type:"GET",
      url: '<?php echo url('get-list') ?>',
     data: {
        "_token": "{{ csrf_token() }}",
        },
      success:function(result){        
     
      
      }
    });
  }   


// function test()
// {
//   // alert(1);
//    var name = $('#name').val();
//    // alert(name);
//    var email = $('#email').val();
//    var logo = $('#logo').val();
//    alert(logo);
//    var website = $('#website').val();
   
//      if (name !== '' && name !== null) {
//            $.ajax({
//       type:"POST",
//       url: '<?php echo url('add_company') ?>',
//      data: {
//         "_token": "{{ csrf_token() }}",
//         "name": name,
//         "email": email,
//         "logo": logo,
//         "website": website,
//         },
//       success:function(result){ 
//       // $('#edit_id').val(result.data.id);
//       // $('#name').val(result.data.name);
//       // $('#category').val(result.data.category);
//       // $('#subcategory').val(result.data.subcategory);
//       // $('#cost').val(result.data.cost);
//       // $('#prize').val(result.data.prize);
//       // $('#quantity').val(result.data.quantity);  

//       }
//        });  
//         }
   
// }
</script>

<script>
  @if(Session::has('message'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.warning("{{ session('warning') }}");
  @endif
</script>


@endsection
