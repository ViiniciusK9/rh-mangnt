<x-layout-app page-title="Delete department">

    <div class="w-25 p-4">

        <h3>Delete department</h3>

        <hr>

        <form action="{{ route('departments.destroy') }}" method="post">

            @csrf

            <input type="hidden" name="id" value="{{ $department->id }}">
            
            <div class="mb-3">
                <label for="name" class="form-label">Department name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}" readonly>
            </div>

            <div class="mb-3">
                <p class="text-danger">Are you sure you want to remove this department?</p>
            </div>

            <div class="mb-3">
                <a href="{{ route('departments') }}" class="btn btn-sm btn-outline-primary p-2 me-3">Cancel</a>
                <button type="submit" class="btn btn-sm btn-danger p-2">Delete department</button>
            </div>

        </form>

    </div>

</x-layout-app>

