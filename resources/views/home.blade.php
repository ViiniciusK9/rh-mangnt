<x-layout-app page-title="Home">
    <p class="display-6 text-center my-5">Home Page</p>

    @can('admin')
        <p class="text-center">You are an admin</p>
    @endcan
    
</x-layout-app>