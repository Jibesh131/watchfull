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

<div class="card-body">
    <livewire:creator.content-form />
</div>

@endsection

@push('js')
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

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
    document.addEventListener("livewire:init", () => {
        function initTagify() {
            document.querySelectorAll("[data-tagify]").forEach(input => {
                if (input._tagify) return;

                const tagify = new Tagify(input);
                input._tagify = tagify;

                tagify.on("change", e => {
                    input.value = e.detail.value;
                    input.dispatchEvent(new Event("input"));
                });
            });
        }

        function initTagifyDropdown() {
            document.querySelectorAll("[data-tagify-dropdown]").forEach(input => {
                if (input._tagify) return;

                let list = [];
                try { list = JSON.parse(input.dataset.tagifyDropdown || "[]"); } 
                catch { console.error("Invalid Tagify JSON"); }

                const tagify = new Tagify(input, {
                    whitelist: list,
                    dropdown: { enabled: 1, closeOnSelect: false }
                });

                input._tagify = tagify;

                tagify.on("focus", () => tagify.dropdown.show());
                input.addEventListener("click", () => tagify.dropdown.show());

                tagify.on("change", e => {
                    input.value = e.detail.value;  
                    input.dispatchEvent(new Event("input"));
                });
            });
        }

        initTagify();
        initTagifyDropdown();

        Livewire.hook("morph.updated", () => {
            initTagify();
            initTagifyDropdown();
        });

    });
</script>

@endpush