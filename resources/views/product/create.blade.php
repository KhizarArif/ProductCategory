<x-guests>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center border-rounded">
                        <h4 class="mb-0">Product Form</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('products.store') }}" id="submitForm" enctype="multipart/form-data">
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
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" value="{{old('price')}}">
                            </div>
                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter Quantity" value="{{old('qty')}}">
                            </div>
                            <div class="form-group">
                                <label for="inputFileMultiple"> Image </label>
                                <input type="file" class="form-control" id="inputFileMultiple" name="files[]" multiple>
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
                            <button type="submit" class="btn btn-primary" id="submitProduct">Submit</button>
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
                    console.error('Error fetching subcategories:', error);
                }
            })
        })

        $('#submitProduct').on('click', function(event) {
            event.preventDefault();
            $.ajax({
                type: "post",
                url: "{{route('products.store')}}",
                data: $('#submitForm').serialize(),
                success: function(data) {
                console.log(data);
                    // window.location.href = "{{route('products.index')}}"
                },
                error: function(data) {
                    alert("Error!")
                }
            })
        })
    })
</script>

<!-- 
<script>
    $(document).ready(function() {
       
    })
</script> -->

<!--  -->
