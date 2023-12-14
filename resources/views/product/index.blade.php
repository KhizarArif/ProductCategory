<x-guests>
    <div class="continer mt-5">
        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="table-responsive">
                    <div class="justify-content-between">
                        <h2> Product Table </h2>
                        <button class="btn btn-primary my-2">
                            <a href="{{route('products.create')}}" class="text-white m-2"> Add </a>
                        </button>
                    </div>
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col"> Product Name</th>
                                <th scope="col"> Category ID </th>
                                <th scope="col"> Sub Category ID </th>
                                <th scope="col"> Price </th>
                                <th scope="col"> Photo </th>
                                <th scope="col"> Qty </th>
                                <th scope="col"> Status </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-guests>