<x-guests>
    <div class="continer mt-5">
        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="table-responsive">
                    <div class="justify-content-between">
                        <h2> Sub Category Table </h2>
                        <button class="btn btn-primary my-2">
                            <a href="{{route('subcategory.create')}}" class="text-white m-2"> Add </a>
                        </button>
                    </div>
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col"> Sub Category Name</th>
                                <th scope="col"> Category ID </th>
                                <th scope="col"> Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategories as $subcategory)
                            <tr>
                                <td>{{ $subcategory->name}} </td>
                                <td> {{$subcategory->cat_id}} </td>
                                <td> {{$subcategory->status}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-guests>