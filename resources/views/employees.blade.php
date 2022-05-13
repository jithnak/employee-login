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
  <h2>Employees</h2>
   <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                 
                  <div class="card-header">Add Employees</div>
                  <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" id="export"> 
                     <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                      <input type="hidden" name="edit_id" id="edit_id">
                          <div class="row">
                          <div class="col-md-4"> 
                          <label>First Name </label>
                           <div class="group material-input">     
                  
                            <input type="text" id="first_name" class="form-control" name="first_name">
                                
                          <span style="color:red;" id="f_name"></span>
                          </div>
                          </div>
              
  
                         <div class="col-md-4"> 
                          <label>Last Name </label>
                           <div class="group material-input">     
                  
                            <input type="text" id="last_name" class="form-control" name="last_name">
                                
                           <span style="color:red;" id="l_name"></span>
                          </div>
                          </div>

                           <div class="col-md-4"> 
                          <label>Company</label>
                           <div class="group material-input">     
                           <select class="form-control" name="company" id="company">
                             <option value="">Select Company</option>
                             <?php
                             foreach($company as $val)
                            {?>
                             <option value="{{$val->company_id}}">{{$val->company_name}}</option>
                             <?php
                           }
                           ?> 
                           </select>
                           
                                
                          
                          </div>
                          </div>

                           
                           <div class="col-md-4"> 
                          <label>Email </label>
                           <div class="group material-input">     
                          <input type="text" id="email" class="form-control" name="email">
                                
                          
                          </div>
                          </div>

                          <div class="col-md-4"> 
                          <label>Phone</label>
                           <div class="group material-input">     
                  
                            <input type="text" id="phone" class="form-control" name="phone">
                                
                          
                          </div>
                          </div>

                          </div>
                           <br>
                          <div class="row">
                          <div class="col-md-4">
                              <button type="button"  id="add_s" name="add_s" onclick="add()" class="btn btn-primary">
                                  Submit
                              </button>
                                 <button type="button"  id="add1" name="add_up" onclick="update()"class="btn btn-primary" style="display: none;">
                                  Update
                              </button>
                          </div>
                          </div>
                           <div class="row" id="success" style="color:green">
                           </div>
                      </form>


                        
                  </div>
              </div>

              <div class="card">
                  <div class="card-header">Manage Employees</div>
                  <div class="card-body">
                  <table style="margin-left: 10px;width:100%;" class="table table-bordered">
  <thead>
    <tr>
      <th>SL.No</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Company</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i=0;
    foreach($employee as $val)
    {
      $id = $val->employee_id;
      $i++;
    ?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $val->employee_first_name;?></td>
      <td><?php echo $val->employee_last_name;?></td>
      <td><?php echo $val->company_name;?></td>
      <td><?php echo $val->employee_email;?></td>
      <td><?php echo $val->employee_phone;?></td>
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

  {!! $employee->links() !!}
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
  function add()
{
    // alert(1);
   var first_name = $('#first_name').val();
   // alert(first_name);
   var last_name = $('#last_name').val();
   var company = $('#company').val();
   var email = $('#email').val();
   var phone = $('#phone').val();
    if (first_name == "" || first_name == null)
      {                                      
      $('#f_name').text("First Name Required");
       return false;
       }
       else
      {
         $('#f_name').text(" ");                                 
       }
       if (last_name == "" || last_name == null)
      {                                      
      $('#l_name').text("Last Name Required");
       return false;
       }
       else
      {
         $('#l_name').text(" ");                                 
       }
   
     if (first_name !== '' && first_name !== null) {
           $.ajax({
      type:"POST",
      url: '<?php echo url('add_employee') ?>',
     data: {
        "_token": "{{ csrf_token() }}",
        "first_name": first_name,
        "last_name": last_name,
        "company": company,
        "email": email,
        "phone": phone,
        },
      success:function(result){ 
       // alert(1);
         $('#success').text("Employee details are added succesfully");
         location.reload();
      // $('#edit_id').val(result.data.id);
      // $('#name').val(result.data.name);
      // $('#category').val(result.data.category);
      // $('#subcategory').val(result.data.subcategory);
      // $('#cost').val(result.data.cost);
      // $('#prize').val(result.data.prize);
      // $('#quantity').val(result.data.quantity);  

      }
       });  
        }
   
}
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
      url: '<?php echo url('getEmployee') ?>',
     data: {
        "_token": "{{ csrf_token() }}",
        "id": id
        },
      success:function(result){ 
      $('#add_s').hide(); 
      $('#add1').show();  
      $('#edit_id').val(result.data.employee_id);
      $('#first_name').val(result.data.employee_first_name);
      $('#last_name').val(result.data.employee_last_name);
      $('#company').val(result.data.employee_company);
      $("select[name='company']").trigger('change');
      $('#email').val(result.data.employee_email);
      $('#phone').val(result.data.employee_phone);
      
      }
       });  
  } 

  function delet(id)
  {
     // alert(id);
     $.ajax({
      type:"POST",
      url: '<?php echo url('deleteEmployee') ?>',
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

  function update()
{
   // alert(1);
  
   var first_name = $('#first_name').val();
   // alert(first_name);
   var last_name = $('#last_name').val();
   var company = $('#company').val();
   var email = $('#email').val();
   var phone = $('#phone').val();
   var edit_id = $('#edit_id').val();
    if (first_name == "" || first_name == null)
      {                                      
      $('#f_name').text("First Name Required");
       return false;
       }
       else
      {
         $('#f_name').text(" ");                                 
       }
       if (last_name == "" || last_name == null)
      {                                      
      $('#l_name').text("Last Name Required");
       return false;
       }
       else
      {
         $('#l_name').text(" ");                                 
       }
   
     if (first_name !== '' && first_name !== null) {
           $.ajax({
      type:"POST",
      url: '<?php echo url('update_employee') ?>',
     data: {
        "_token": "{{ csrf_token() }}",
        "first_name": first_name,
        "last_name": last_name,
        "company": company,
        "email": email,
        "phone": phone,
        "edit_id": edit_id,
        },
      success:function(result){ 
       // alert(1);
         $('#success').text("Employee details are updated succesfully");
         location.reload();
      // $('#edit_id').val(result.data.id);
      // $('#name').val(result.data.name);
      // $('#category').val(result.data.category);
      // $('#subcategory').val(result.data.subcategory);
      // $('#cost').val(result.data.cost);
      // $('#prize').val(result.data.prize);
      // $('#quantity').val(result.data.quantity);  

      }
       });  
        }
}


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
