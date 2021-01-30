<div>

  @if (session()->has('message'))
  <div class="alert alert-success" style="margin-top:30px;">
    {{ session('message') }}
  </div>
  @endif
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Category</h3>
    <button class="btn btn-success float-sm-right" onclick="modalOpen()"><i
        class="fa fa-plus"></i> New</button>
  </div>


  <!-- /.card-header -->
  <div class="card-body">
    <table id="table" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Desc</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $row)
        <tr>
          <td>{{$counter++}}</td>
          <td>{{$row->name}}</td>
          <td>{{$row->desc}}</td>
          <td>
            <button type="button" wire:click="delete({{ $row->id }})" class="btn btn-danger">Delete</button>
            <button type="button" data-toggle="modal" data-target="#exampleModal" wire:click="edit({{ $row->id }})" class="btn btn-warning">Edit</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true close-btn">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="store" id="form">
          <input type="hidden" wire:model="categoryId">
          <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control"  placeholder="Enter Name" wire:model="name">
            @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput2">Description</label>
            <input type="text" class="form-control" placeholder="Enter Description" wire:model="desc">
            @error('desc') <span class="text-danger error">{{ $message }}</span>@enderror
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-btn" onclick="modalClose()">Close</button>
        <button type="submit" class="btn btn-primary close-modal">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>

</div>