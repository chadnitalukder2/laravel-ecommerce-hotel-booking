@extends('admin.admin_dashboard');
@section('admin') ;
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Add Blog Post</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add Blog Post</li>
							</ol>
						</nav>
					</div>

				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-body p-4">

                <form  id="myForm" class="row g-3" action="{{ route('store.blog.post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <label for="input7" class="form-label">Blog Category</label>
                        <select name="blogcat_id" id="input7" class="form-select form-control">
                            <option selected="">Select Category </option>
                            @foreach ( $blogcat as $cat) 
                            <option value="{{ $cat->id }}" >{{ $cat->category_name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Post Title</label>
                        <input type="text" name="post_title" class="form-control" id="input1"  >
                    </div>


                    <div class="col-md-12 form-group">
                        <label for="input11" class="form-label">Short Description</label>
                        <textarea name="short_descp" class="form-control" id="input11"   rows="3"></textarea>
                    </div>



                    <div class="col-md-12 form-group">
                        <label for="input11" class="form-label">Post Description</label>
                        <textarea name="long_descp" class="form-control" rows="5" ></textarea>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Post Title</label>
                        <input class="form-control" name="post_image" type="file" id="image">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label"> </label>
                        <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="80">
                    </div>




                    <div class="col-md-12 ">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Submit</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
						</div>
					</div>
				</div>
			</div>


 <!------------ validation -------------->
    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    blogcat_id: {
                        required : true,
                    }, 
                    post_title: {
                        required : true,
                    }, 
                    short_descp: {
                        required : true,
                    }, 
                     long_descp: {
                        required : true,
                    }, 
                    post_image: {
                        required : true,
                    }, 
                    
                },
                messages :{
                    blogcat_id: {
                        required : 'Please Enter Category Name',
                     }, 
                     post_title: {
                        required : 'Please Enter Post Title',
                     }, 
                     short_descp: {
                        required : 'Please Enter Short Description',
                     }, 
                      long_descp: {
                        required : 'Please Enter Long Description ',
                     }, 
                     post_image: {
                        required : 'Please Select Post Image',
                     }, 
                     
    
                },
                errorElement : 'span', 
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
        
    </script>


      <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
        </script>   




@endsection