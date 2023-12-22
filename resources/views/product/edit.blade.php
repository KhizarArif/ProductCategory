<x-guests>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center border-rounded">
                        <h4 class="mb-0">Edit Product Form</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('products.update', $product->id) }}" class="form" id="submitForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Category Name" value="{{$product->name}}">
                            </div>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <!-- Price  -->
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" value="{{$product->price}}">
                            </div>
                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter Quantity" value="{{$product->qty}}">
                            </div>
                            <div class="form-group">
                                <label for="inputFileMultiple"> Image </label>
                                @foreach ($product->productImages as $productImg)
                                <div class="image-item" data-id="{{ $productImg->id }}">
                                    <input type="file" class="form-control" data-image-id="{{ $productImg->id }}" accept="image/*" style="display: none;">
                                    <img src="{{ asset('storage/' . $productImg->path) }}" alt="Product Image" name="image" data-id="{{ $productImg->id }}" class="product-image">
                                    <label class="btn btn-primary change-image-btn">Change Image</label>
                                </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="draft" value="{{$product->status}}">
                                    <label class="form-check-label" for="draft">Draft</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="publish" value="{{$product->status}}">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var imageItem = document.querySelectorAll('.image-item')
            imageItem.forEach(item => {
                item.addEventListener('click', function() {
                    var imageId = this.dataset.id;
                    var input = document.querySelector(`input[data-image-id="${imageId}"]`);
                    input.click();

                    input.addEventListener('change', function() {
                        const file = this.files[0];

                        if (file) {
                            const reader = new FileReader(); 
                            reader.onload = function(e) {
                                var imgElemt = document.querySelector(`img[data-id = "${imageId}"]`);
                                if (imgElemt) {
                                    imgElemt.src = e.target.result;
                                }
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                })
            })
        })
    </script>


</x-guests>