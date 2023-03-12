@extends('admin.layouts.app')

@section('title')
    Categories List
@endsection

@section('content')
    <div class="spinner-overlay" id="spinner">
        <div class="spinner"></div>
    </div>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Categories
                        <small>List</small>
                    </h1>
                </div>
                <div id="message"></div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr align="center">
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = ($categories->currentPage() - 1) * $categories->perPage();
                        @endphp
                        @foreach ($categories as $category)
                            <tr id="category-{{ $category->id }}" class="odd gradeX" align="center">
                                <td>{{ ++$i }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td class="center">
                                    <i class="fa fa-trash-o  fa-fw"></i>
                                    <button class="btn btn-danger delete-category"
                                        data-id="{{ $category->id }}">Delete</button>
                                </td>
                                <td class="center">
                                    <i class="fa fa-pencil fa-fw"></i>
                                    <a class="btn btn-warning edit-category"
                                        href="{{ route('admin.category.edit', $category->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $categories->links() !!}
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <script>
        $(document).ready(function() {
            $('.delete-category').click(function() {
                let categoryId = $(this).data('id');

                let result = confirm("Are you sure you want to delete this category?");

                $("#spinner").show();

                var url = "{{ route('admin.category.delete', ':id') }}";
                url = url.replace(':id', categoryId);

                if (result) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: {
                            id: categoryId
                        },
                        success: function(response) {
                            $('#category-' + categoryId).remove();
                            $('#message').addClass('alert alert-success').text(response
                                .success_message);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        },
                        complete: function() {
                            $("#spinner").hide();
                        }
                    })
                }
            });
        })
    </script>
@endsection
