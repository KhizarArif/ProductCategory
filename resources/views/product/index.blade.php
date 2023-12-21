<x-guests>
    <div class="continer mt-5">
        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="table-responsive">
                    <div class="justify-content-between">
                        <h2> Product Table </h2>
                        <a href="{{ route('products.create') }}" class="text-white m-2"><button class="btn btn-primary my-2"> Add </button></a>
                    </div>
                    <table class="table table-primary ">
                        <thead>
                            <tr>
                                <th scope="col"> Product Name</th>
                                <th scope="col"> Category ID </th>
                                <th scope="col"> Sub Category ID </th>
                                <th scope="col"> Price </th>
                                <th scope="col"> Qty </th>
                                <th scope="col"> Status </th>
                                <th scope="col"> Photo </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td> {{ $product->name }} </td>
                                <td>
                                    {{$product->category->name}}
                                </td>
                                <td> {{ $product->subcat_id }} </td>
                                <td> {{ $product->price }} </td>
                                <td> {{ $product->qty }} </td>
                                <td> {{ $product->status }} </td>
                                <td>
                                    <div class="w-100 d-inline-block overflow-hidden " style="height: 100px;">
                                        @if ($product->productImages->isNotEmpty())
                                        @foreach ($product->productImages as $productImg ) 
                                            <img src="{{asset ('storage/' . $productImg->path) }}" alt="Product Image">
                                        @endforeach
                                        @endif

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-guests>


{{-- --}}