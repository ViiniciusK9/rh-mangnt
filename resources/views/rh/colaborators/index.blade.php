<x-layout-app page-title="Human resources">

    <div class="w-100 p-4">

        <h3>Human Resources Colaborators</h3>

        @if ($colaborators->count() === 0)
            <hr>

            <div class="text-center my-5">
                <p>No colaborators found.</p>
                <a href="{{ route('rh.colaborators.create') }}" class="btn btn-primary">Create a new colaborator</a>
            </div>
        @else
            <hr>

            <div class="mb-3">
                <a href="{{ route('rh.colaborators.create') }}" class="btn btn-sm btn-primary p-2">Create a new
                    colaborator</a>
            </div>

            <table class="table" id="table">
                <thead class="table-dark">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Admission date</th>
                    <th>City</th>
                    <th></th>
                </thead>
                <tbody>

                    @foreach ($colaborators as $colaborator)
                        @php
                            $permissions = json_decode($colaborator->permissions);
                        @endphp
                        <tr>
                            <td>{{ $colaborator->name }}</td>
                            <td>{{ $colaborator->email }}</td>
                            <td>{{ $colaborator->role }}</td>
                            <td>{{ implode(', ', $permissions) }}</td>
                            <td>{{ $colaborator->detail->admission_date }}</td>
                            <td>{{ $colaborator->detail->city }}</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    <a href="{{ route('departments.edit', ['department' => $colaborator->id]) }}"
                                        class="btn btn-sm btn-outline-success"><i
                                            class="fa-regular fa-pen-to-square me-2"></i>Edit</a>
                                    <a href="{{ route('departments.delete', ['department' => $colaborator->id]) }}"
                                        class="btn btn-sm btn-outline-danger"><i
                                            class="fa-regular fa-trash-can me-2"></i>Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>

</x-layout-app>
