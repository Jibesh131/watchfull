@extends('creator.layout.app')

@push('css')
<style>
    input[type='file']{
        border: 2px dashed #ccc;
    }
    .cursor-pointer {
      cursor: pointer;
    }
    .thumbnail img{
        width: 180px;
        height: 180px;
    }
  </style>
@endpush

@section('content')
{{-- <div class="card-header">
    
</div> --}}
<div class="card-body">
    <form action="" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <div class="thumbnail">
					<img src="{{asset('frontend/images/avatar.png')}}" alt="..." class="img-thumbnail">
				</div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="defaultSelect">Select Content Type</label>
                    <select class="form-select form-control" id="defaultSelect">
                        <option>Movie</option>
                        <option>Music</option>
                        <option>Streaming</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group ">
                    <label for="thumbnail">
                        Thumbnail
                        <span tabindex="0" data-bs-toggle="tooltip" title="Image Dropdown Avalable">
                        <i class="fa fa-info-circle cursor-pointer text-warning"></i>
                        </span>
                    </label>
                    <input type="file" class="form-control" id="thumbnail" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="defaultSelect">Select Content Type</label>
                    <select class="form-select form-control" id="defaultSelect">
                        <option>Movie</option>
                        <option>Music</option>
                        <option>Streaming</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email2">Email Address</label>
                    <input type="email" class="form-control" id="email2" placeholder="Enter Email">
                    <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="defaultSelect">Select Content Type</label>
                    <select class="form-select form-control" id="defaultSelect">
                        <option>Movie</option>
                        <option>Music</option>
                        <option>Streaming</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email2">Email Address</label>
                    <input type="email" class="form-control" id="email2" placeholder="Enter Email">
                    <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="defaultSelect">Select Content Type</label>
                    <select class="form-select form-control" id="defaultSelect">
                        <option>Movie</option>
                        <option>Music</option>
                        <option>Streaming</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email2">Email Address</label>
                    <input type="email" class="form-control" id="email2" placeholder="Enter Email">
                    <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
            </div>
        </div>

    </form>
</div>

@endsection

@push('js')
<script>

</script>
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
</script>
@endpush