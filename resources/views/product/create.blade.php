<x-guests>



    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                @endif -->



                @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
                <div class="card">
                    <div class="card-header bg-primary text-white text-center border-rounded">
                        <h4 class="mb-0">Product Form</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('products.store') }}" class="form" id="submitForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category"> Categories </label>
                                <select class="form-control" id="category" name="cat_id">
                                    <option value="" disabled selected>Select Category...</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category"> Sub Categories </label>
                                <select class="form-control" id="subcategory" name="subcat_id" value="{{old('subcategory')}}">
                                    <option value="" disabled selected>Select Subcategory...</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Category Name" value="{{old('name')}}">
                            </div>
                            <span class="text-danger" id="name_error"></span> 
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Enter Price" value="{{old('price')}}">
                            </div>
                            <span class="text-danger" id="price_error"></span> 
                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="text" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" placeholder="Enter Quantity" value="{{old('qty')}}">
                            </div>
                            <span class="text-danger" id="qty_error"></span> 
                            <div class="form-group">
                                <label for="inputFileMultiple"> Image </label>
                                <input type="file" class="form-control" id="inputFileMultiple" name="files[]" required accept="image/*" multiple>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="draft" value="draft" value="{{old('draft')}}">
                                    <label class="form-check-label" for="draft">Draft</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="publish" value="publish" value="{{old('publish')}}">
                                    <label class="form-check-label" for="publish">Publish</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-submit" id="submitProduct">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guests>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $('.form').on('submit', function(event) {

            event.preventDefault();
            const form = $(this);
            const actionUrl = form.attr('action');


            $.ajax({
                type: "POST",
                url: actionUrl,
                data: new FormData(form[0]),
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data + "Data ");
                    window.location.href = "{{route('products.index')}}"
                },
                error: function(error) { 
                    if (error.status === 422) {
                        var errors = $.parseJSON(error.responseText); 
                        $.each(errors['errors'], function(key, val) { 
                            $("#" + key +"_error").text(val[0]);
                        });
                    } 
                }
            })
        })
    });

    $('#category').change(function() {
        var categoryId = $(this).val();
        console.log(categoryId);
        var subcategorySelect = $('#subcategory');
        subcategorySelect.prop('disabled', false);



        $.ajax({
            type: "GET",
            data: {
                'id': categoryId
            },
            url: "{{ route('getsubcategory') }}",
            success: function(data) {
                subcategorySelect.empty();
                subcategorySelect.append('<option value="" disabled selected>Select Subcategory...</option>');
                $.each(data, function(index, subcategory) {
                    subcategorySelect.append($('<option>', {
                        value: subcategory.id,
                        text: subcategory.name,
                    }))
                })

            },
            error: function(error) {
                alert(error);
                console.error('Error fetching subcategories:', error);
            }
        })
    });
</script>