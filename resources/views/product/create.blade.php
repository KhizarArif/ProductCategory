<x-guests>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center border-rounded">
                        <h4 class="mb-0">Product Form</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('products.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="category"> Categories </label>
                                <select class="form-control" id="category" name="cat_id">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category"> Sub Categories </label>
                                <select class="form-control" id="subcategory" name="subcat_id">
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price">
                            </div>
                            <!-- <div class="form-group">
                                <label for="qty">Photo</label>
                                <input type="text" class="form-control" id="photo" name="photo" placeholder="Enter ">
                            </div> -->
                            <div class="form-group">
                                <label for="photo">Qty</label>
                                <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter Quantity">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="draft" value="draft">
                                    <label class="form-check-label" for="draft">Draft</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="publish" value="publish">
                                    <label class="form-check-label" for="publish">Publish</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
            var subcategorySelect = $('#subcategory');
            console.log(categoryId);
            $.ajax({
                type: "GET",
                data: {
                    'id': categoryId
                },
                url: "{{route('getsubcategory')}}",
                success: function(data) {
                    subcategorySelect.empty();
                    console.log(data);
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
    })
</script>