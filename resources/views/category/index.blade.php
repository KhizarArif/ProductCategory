<x-guests>
    <div class="continer mt-5">
        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="table-responsive">
                    <div class="justify-content-between">
                        <h2> Category Table </h2>
                        <a href="{{route('category.create')}}" class="text-white m-2"><button class="btn btn-primary my-2"> Add </button> </a>
                    </div>
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col"> Category Name</th>
                                <th scope="col"> Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name}} </td>
                                <td> {{$category->status}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-guests>