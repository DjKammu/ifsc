<form action="{{ route('admin.post.branches.import') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header">
          {{-- <strong>Select Excel Sheet</strong> --}}
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="name">Select Excel Sheet</label>
                <input class="form-control" id="name" name="import" type="file" required>
                @if($errors->has('product_entities'))
                @foreach($errors->get('product_entities') as $message)
                  <label class="control-label" for="inputError" style="color: red;"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
                @endforeach
              @endif
                <button style="background-color: indigo;border: none;color: #ffff;padding: 12px 14px;border-radius: 10px;margin: 10px;">Import</button>
              </div>
            </div>
          </div>
          <!-- /.row-->
        </div>
      </div>
    </div>
  </div>
</form>
