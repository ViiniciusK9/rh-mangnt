<x-layout-app page-title="Edit RH Collaborator">

    <div class="w-100 p-4">

        <h3>Edit Human Resources Collaborator</h3>

        <hr>

        <form action="{{ route('rh.collaborators.update') }}" method="post">

            @csrf

            <div class="d-flex ga-5">
                <p>Collaborator name: <strong>{{ $collaborator->name }}</strong></p>
                <p>Collaborator email: <strong>{{ $collaborator->email }}</strong></p>
            </div>

            <hr>
            
            <input type="hidden" name="id" value="{{ $collaborator->id }}">

            <div class="container-fluid">
                <div class="row gap-3">

                    {{-- User --}}
                    <div class="col border rounded-3 border-black p-4">

                        <div class="col">
                            <div class="mb-3">
                                <label for="salary" class="form-label">Salary</label>
                                <input type="number" class="form-control" id="salary" name="salary" step=".01"
                                    placeholder="0,00" value="{{ old('salary', $collaborator->detail->salary) }}">
                                @error('salary')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="admission_date" class="form-label">Admission Date</label>
                                <input type="text" class="form-control" id="admission_date" name="admission_date"
                                    placeholder="YYYY-mm-dd" value="{{ old('admission_date', $collaborator->detail->admission_date) }}">
                                @error('admission_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    
                </div>

                <div class="mt-3">
                    <a href="{{ route('rh.collaborators') }}"
                        class="btn btn-sm p-2 btn-outline-danger me-3">Cancel</a>
                    <button type="submit" class="btn btn-sm p-2 btn-primary">Update collaborator</button>
                </div>
            </div>
        </form>
    </div>
</x-layout-app>
