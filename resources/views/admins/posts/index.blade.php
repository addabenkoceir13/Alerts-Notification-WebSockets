@extends('layouts.app_d')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody id="admin-posts-body">
                        @forelse ($posts as $post)
                        <tr data-id="{{ $post->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td class="td-title">{{ $post->title }}</td>
                            <td class="td-body">{{ $post->body }}</td>
                            <td class="td-status">{{ $post->status }}</td>
                            <td>
                                @if($post->status !== 'approved')
                                <form action="{{ route('admins.posts.approve', $post) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Approve</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr colspan="5">
                                <td>No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
(function() {
    @auth
    function findRow(id) { return document.querySelector(`#admin-posts-body tr[data-id='${id}']`); }
    function insertRow(post) {
        const tbody = document.getElementById('admin-posts-body');
        const tr = document.createElement('tr');
        tr.setAttribute('data-id', post.id);
        tr.innerHTML = `
            <td>new</td>
            <td class="td-title"></td>
            <td class="td-body"></td>
            <td class="td-status"></td>
            <td></td>`;
        tbody.prepend(tr);
        return tr;
    }
    function updateRow(post) {
        let tr = findRow(post.id) || insertRow(post);
        tr.querySelector('.td-title').textContent = post.title;
        tr.querySelector('.td-body').textContent = post.body;
        tr.querySelector('.td-status').textContent = post.status;
    }
    function subscribeAdminPosts() {
        if (!window.Echo) return;
        // Listen for new posts
        window.Echo.private('admins')
            .listen('.post.created', (e) => updateRow(e))
            .listen('.post.approved', (e) => updateRow(e));
        // And for approvals of any post (admins don't get user private channel, but the table updates via approval form submit anyway)
    }
    if (window.Echo) subscribeAdminPosts(); else window.addEventListener('echo:ready', subscribeAdminPosts, { once: true });
    @endauth
})();
</script>
@endpush
