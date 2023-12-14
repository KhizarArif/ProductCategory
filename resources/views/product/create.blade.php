<x-guests>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center border-rounded">
                        <h4 class="mb-0">Product Form</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('subcategory.store')}}">
                            @csrf

                            <div class="form-group">
                                <label for="category"> Categories </label>
                                <select class="form-control" id="category" name="cat_id">
                                    <option value=""> Category </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category"> Sub Categories </label>
                                <select class="form-control" id="category" name="subcat_id">

                                    <option value=""> Sub Category </option>
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
                                <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter Quantity">
                            </div> -->
                            <div class="form-group">
                                <label for="qty">Name</label>
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