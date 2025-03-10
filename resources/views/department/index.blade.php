<x-layout-app page-title="Departments">

    <div class="w-100 p-4">

        <h3>Departments</h3>


        @if ($departments->count() === 0)
            <hr>

            <div class="text-center my-5">
                <p>No departments found.</p>
                <a href="{{ route('departments.create') }}" class="btn btn-primary">Create a new department</a>
            </div>
        @else
            <hr>

            <div class="mb-3">
                <a href="{{ route('departments.create') }}" class="btn btn-sm btn-primary p-2">Create a new department</a>
            </div>

            <table class="table w-50" id="table">
                <thead class="table-dark">
                    <th>Departments</th>
                    <th></th>
                </thead>
                <tbody>

                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->name }}</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    @if ($department->id === 1 || $department->id === 2)
                                        <i class="fas fa-lock"></i>
                                    @else
                                        <a href="{{ route('departments.edit', ['department' => $department->id]) }}" class="btn btn-sm btn-outline-success"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a>
                                        <a href="{{ route('departments.delete', ['department' => $department->id]) }}" class="btn btn-sm btn-outline-danger"><i class="fa-regular fa-trash-can me-2"></i>Delete</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>

</x-layout-app>
