@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@push('styles')
<style>
.small-icon{
    width: 15px;
}

.btn-primary-custom {
    background-color: #DA0037;
    color: #fff !important;
}

.btn-primary-custom:hover {
    background-color: #DA0037;
}

.btn-danger-custom {
  background-color: #444444;
  color: #fff !important;
}
</style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card card-table">
                <div class="card-header">
                    List of Members
                </div>
                <div class="card-body position-relative">
                    <div class="table-responsive mt-4">
                        
                        <div class="float-right">
                            <button class="btn-primary" id='btn-add' type='button'>Tambah</button>
                        </div>

                        <table id='table-members' class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Address</th>
                                    <th>Telephone</th>
                                    <th>Identity Number</th>
                                    <th>Date of Joined</th>
                                    <th>Is Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- AKAN DIISI OLEH BACKEND --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-addLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal-addLabel">Tambah Member</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id='form-add'>
                @csrf
                <div class="form-group required">
                    <label>Name</label>
                    <input
                        class="form-control"
                        name="name"
                        type="text"
                        placeholder="Input member name"
                    />
                </div>
                <div class="form-group required">
                    <label>Age</label>
                    <input
                        class="form-control"
                        name="age"
                        type="text"
                        placeholder="Input member age"
                    />
                </div>
                <div class="form-group required">
                    <label>Address</label>
                    <input
                        class="form-control"
                        name="address"
                        type="text"
                        placeholder="Input member address"
                    />
                </div>
                <div class="form-group required">
                    <label>Telephone</label>
                    <input
                        class="form-control"
                        name="telephone"
                        type="text"
                        placeholder="Input member telephone"
                    />
                </div>
                <div class="form-group required">
                    <label>Identity Number</label>
                    <input
                        class="form-control"
                        name="identity_number"
                        type="text"
                        placeholder="Input member identity number"
                    />
                </div>
                <div class="form-group required">
                    <label>Date of Joined</label>
                    <input
                        class="form-control"
                        name="date_of_joined"
                        type="text"
                        placeholder="Input member date of joined"
                    />
                </div>
                <div class="form-group required">
                    <label>Is Active</label>
                    <input
                        class="form-control"
                        name="is_active"
                        type="text"
                        placeholder="Input member is active"
                    />
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="btn-submit-create" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-addLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal-addLabel">Edit Member</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id='form-edit'>
                @csrf
                <input type="hidden" name="member-id" />
                <div class="form-group required">
                    <label>Name</label>
                    <input
                        class="form-control"
                        name="name"
                        type="text"
                        placeholder="Edit member name"
                    />
                </div>
                <div class="form-group required">
                    <label>Age</label>
                    <input
                        class="form-control"
                        name="age"
                        type="text"
                        placeholder="Edit member age"
                    />
                </div>
                <div class="form-group required">
                    <label>Address</label>
                    <input
                        class="form-control"
                        name="address"
                        type="text"
                        placeholder="Edit member address"
                    />
                </div>
                <div class="form-group required">
                    <label>Telephone</label>
                    <input
                        class="form-control"
                        name="telephone"
                        type="text"
                        placeholder="Edit member telephone"
                    />
                </div>
                <div class="form-group required">
                    <label>Identity Number</label>
                    <input
                        class="form-control"
                        name="identity_number"
                        type="text"
                        placeholder="Edit member identity number"
                    />
                </div>
                <div class="form-group required">
                    <label>Date of Joined</label>
                    <input
                        class="form-control"
                        name="date_of_joined"
                        type="text"
                        placeholder="Edit member date of joined"
                    />
                </div>
                <div class="form-group required">
                    <label>Is Active</label>
                    <input
                        class="form-control"
                        name="is_active"
                        type="text"
                        placeholder="Edit member is active"
                    />
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="btn-submit-update" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-addLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal-addLabel">Delete Member</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="delete-url" />
            Are you sure you want to delete this data ?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button id="btn-submit-delete" type="button" class="btn btn-primary">Delete</button>
        </div>
      </div>
    </div>
</div>
@endsection

@push('scripts')
    @include('members.scripts')
@endpush




