<x-layout-app page-title="Delete collaborator">

    <div class="w-25 p-4">

        <h3>Delete collaborator</h3>

        <hr>

        <form action="{{ route('rh.collaborators.destroy') }}" method="post">

            @csrf

            <input type="hidden" name="id" value="{{ $collaborator->id }}">
            
            <div class="mb-3">
                <label for="name" class="form-label">Collaborator name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $collaborator->name }}" readonly>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Collaborator email</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $collaborator->email }}" readonly>
            </div>

            <div class="mb-3">
                <p class="text-danger">Are you sure you want to remove this collaborator?</p>
            </div>

            <div class="mb-3">
                <a href="{{ route('rh.collaborators') }}" class="btn btn-sm btn-outline-primary p-2 me-3">Cancel</a>
                <button type="submit" class="btn btn-sm btn-danger p-2">Delete collaborator</button>
            </div>

        </form>

    </div>

</x-layout-app>
