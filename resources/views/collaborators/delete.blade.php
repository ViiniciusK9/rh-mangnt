<x-layout-app page-title="Delete colaborator">

    <div class="w-25 p-4">

        <h3>Delete colaborator</h3>

        <hr>

        <p>Are you sure you want to delete this colaborator?</p>
        
        <div class="text-center">
            <form action="{{ route('collaborators.destroy') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $collaborator->id }}">
                <h3 class="my-5">{{ $collaborator->name }}</h3>
                <p>{{ $collaborator->email }}</p>
                <a href="{{ route('collaborators') }}" class="btn btn-secondary px-5">No</a>
                <button type="submit" class="btn btn-danger px-5">Yes</button>
            </form>
        </div>

    </div>

</x-layout-app>