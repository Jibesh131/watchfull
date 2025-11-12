@extends('creator.layout.app')
@push('cdn')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
@endpush

@push('css')
<style>
    /* input{
        border-color: #ddd !important;
    } */
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
    #previewBtn{
        border: 2px solid;
    }

    #previewBtn:hover {
        transform: scale(1.05);
        transition: transform 0.2s ease;
    }
    .cursor-pointer {
        cursor: pointer;
    }
  </style>
@endpush

@section('content')
{{-- <div class="card-header"> </div> --}}

<div class="card-body">
    <div class="col-md-12">
        <label for="ids">Test</label>
        <input type="text" name="asd" id="ids" class="form-control">
    </div>
    <livewire:creator.content-form />
</div>

@endsection

@push('js')
<script>
    function previewThumbnail(event) {
        const file = event.target.files[0];
        const previewBtn = document.getElementById('previewBtn');
        const previewImage = document.getElementById('thumbnailPreviewImage');
        
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewBtn.style.display = 'block';
            };
            
            reader.readAsDataURL(file);
        } else {
            previewBtn.style.display = 'none';
            previewImage.src = '';
        }
    }
</script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    $(document).ready(function () {
        let thumbnail = $('#thumbnail');
        thumbnail.on('change', function () {
            const file = this.files[0];
            if (file) {
                $('#show-thumbnail').attr('src', URL.createObjectURL(file));
            }
        });
    });
</script>

@endpush