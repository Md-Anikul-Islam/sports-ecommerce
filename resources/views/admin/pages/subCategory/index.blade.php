@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Wings</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sub Category</a></li>
                        <li class="breadcrumb-item active">Sub Category!</li>
                    </ol>
                </div>
                <h4 class="page-title">Sub Category!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addNewModalId">Add New</button>
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subCategories as $key=>$subCategoriesData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$subCategoriesData->category->name}}</td>
                            <td>{{$subCategoriesData->name}}</td>
                            <td>{{$subCategoriesData->status==1? 'Active':'Inactive'}}</td>
                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$subCategoriesData->id}}">Edit</button>
                                    <a href="{{route('admin.sub.category.destroy',$subCategoriesData->id)}}"class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$subCategoriesData->id}}">Delete</a>
                                </div>
                            </td>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editNewModalId{{$subCategoriesData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$subCategoriesData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addNewModalLabel{{$subCategoriesData->id}}">Edit</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('admin.sub.category.update',$subCategoriesData->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Category Name</label>
                                                            <select name="category_id" class="form-select">
                                                            @foreach($category as $categoryData)
                                                             <option value="{{$categoryData->id}}" {{ $categoryData->id === $subCategoriesData->category_id ? 'selected' : '' }}>{{$categoryData->name}}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Sub Category Name</label>
                                                            <input type="text" id="name" name="name" value="{{$subCategoriesData->name}}"
                                                                   class="form-control" placeholder="Enter Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Status</label>
                                                            <select name="status" class="form-select">
                                                                <option value="1" {{ $subCategoriesData->status === 1 ? 'selected' : '' }}>Active</option>
                                                                <option value="0" {{ $subCategoriesData->status === 0 ? 'selected' : '' }}>Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Modal -->
                            <div id="danger-header-modal{{$subCategoriesData->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel{{$subCategoriesData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-danger">
                                            <h4 class="modal-title" id="danger-header-modalLabe{{$subCategoriesData->id}}l">Delete</h4>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <a href="{{route('admin.sub.category.destroy',$subCategoriesData->id)}}" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Add Modal -->
    <div class="modal fade" id="addNewModalId" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewModalLabel">Add</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.sub.category.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Category Name</label>
                                    <select name="category_id" class="form-select">
                                    @foreach($category as $categoryData)
                                     <option value="{{$categoryData->id}}">{{$categoryData->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Sub Category Name</label>
                                    <input type="text" id="name" name="name"
                                           class="form-control" placeholder="Enter Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
