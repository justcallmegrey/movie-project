@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card card-table">
                <div class="card-header">
                    List of Movies
                </div>
                <div class="card-body position-relative">
                    <div class="table-responsive mt-4">
                        
                        <div class="float-right">
                            <button class="btn-primary" id='btn-add' type='button'>Tambah</button>
                        </div>

                        <table id='table-movies' class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Genre</th>
                                    <th>Available</th>
                                    <th>Released Date</th>
                                    {{-- <th>Action</th> --}}
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
          <h1 class="modal-title fs-5" id="modal-addLabel">Tambah Movie</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id='form-add'>
                @csrf
                <div class="form-group required">
                    <label>Title</label>
                    <input
                        class="form-control"
                        name="title"
                        type="text"
                        placeholder="Input movie title"
                    />
                </div>
                <div class="form-group required">
                    <label>Genre</label>
                    <input
                        class="form-control"
                        name="genre"
                        type="text"
                        placeholder="Input movie genre"
                    />
                </div>
                <div class="form-group required">
                    <label>Released Date</label>
                    <input
                        class="form-control"
                        name="released_date"
                        type="text"
                        placeholder="Input movie release date"
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
@endsection

@push('scripts')
    @include('movies.scripts')
@endpush




