<x-guests>
    <div class="continer mt-5">

        <div class="row justify-content-center"> 
            <div class="col-md-6"> 
                <div class="table-responsive">
                    <div class="justify-content-between">
                        <h2> Product Table </h2>
                        <a href="{{ route('products.create') }}" class="text-white m-2"><button class="btn btn-primary my-2"> Add </button></a>
                    </div>
                    <table class="table table-primary" id="product_table">
                        <thead>
                            <tr>
                                <th scope="col"> Product Name</th>
                                <th scope="col"> Category ID </th>
                                <th scope="col"> Sub Category ID </th>
                                <th scope="col"> Price </th>
                                <th scope="col"> Qty </th>
                                <th scope="col"> Status </th>
                                <th scope="col"> Photo </th>
                                <th scope="col"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td> {{ $product->name }} </td>
                                <td>
                                    {{$product->category->name}}
                                </td>
                                <td> {{ $product->subcategory ->name }} </td>
                                <td> {{ $product->price }} </td>
                                <td> {{ $product->qty }} </td>
                                <td> {{ $product->status }} </td>
                                <td>
                                    <div class="w-50 d-flex rounded-circle" style="height: 40px;">

                                        @if ($product->productImages->isNotEmpty())
                                        @foreach ($product->productImages as $productImg )
                                        <!-- {{$productImg->path}} -->
                                        <img class="w-100 h-100 rounded-circle" src="{{asset ('storage/' . $productImg->path) }}" alt="Product Image">
                                        @endforeach
                                        @endif

                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('products.edit', $product->id)}}"> <button class="btn btn-primary"> Edit </button> </a>
                                    <form action="{{route('products.delete', $product->id)}}" method="post" class="delete-form">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>

    </div>



</x-guests>