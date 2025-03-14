<x-layout-app page-title="Human resources">

    <div class="w-100 p-4">

        <h3>Human Resources Collaborators</h3>

        @if ($collaborators->count() === 0)
            <hr>

            <div class="text-center my-5">
                <p>No collaborators found.</p>
                <a href="{{ route('rh.collaborators.create') }}" class="btn btn-primary">Create a new collaborator</a>
            </div>
        @else
            <hr>

            <div class="mb-3">
                <a href="{{ route('rh.collaborators.create') }}" class="btn btn-sm btn-primary p-2">Create a new
                    collaborator</a>
            </div>

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
                                    
                                    @empty($collaborator->deleted_at)
                                        <a href="{{ route('rh.collaborators.edit', ['user' => $collaborator->id]) }}" class="btn btn-sm btn-outline-success"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a>
                                        <a href="{{ route('rh.collaborators.delete', ['user' => $collaborator->id]) }}" class="btn btn-sm btn-outline-danger"><i class="fa-regular fa-trash-can me-2"></i>Delete</a>
                                    @else
                                        <form action="{{ route('rh.collaborators.restore') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $collaborator->id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-trash-arrow-up me-2"></i>Restore</button>
                                        </form>
                                    @endempty
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>

</x-layout-app>
