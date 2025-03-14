<x-layout-app page-title="Collaborators">

    <div class="w-100 p-4">
        <h3>All collaborators</h3>

        <hr>

        @if ($collaborators->count() === 0)
            <hr>

            <div class="text-center my-5">
                <p>No collaborators found.</p>
            </div>
        @else
            <hr>

            <table class="table" id="table">
                <thead class="table-dark">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Active</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>Admission date</th>
                    <th>Salary</th>
                    <th></th>
                </thead>
                <tbody>

                    @foreach ($collaborators as $collaborator)
                        @php
                            $permissions = json_decode($collaborator->permissions);
                        @endphp
                        <tr>
                            <td>{{ $collaborator->name }}</td>
                            <td>{{ $collaborator->email }}</td>

                            <td>
                                @empty($collaborator->email_verified_at)
                                    <span class="badge bg-danger">Inactive</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endempty
                            </td>

                            <td>{{ $collaborator->department->name }}</td>

                            <td>{{ $collaborator->role }}</td>
                            <td>{{ $collaborator->detail->admission_date }}</td>
                            <td>{{ $collaborator->detail->salary }}</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    <a href="#" class="btn btn-sm btn-outline-success"><i
                                            class="fas fa-eye me-2"></i>Details</a>
                                    <a href="#" class="btn btn-sm btn-outline-danger"><i
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
