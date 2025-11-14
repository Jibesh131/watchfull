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
(() => {
    const initTagify = () => {
        const inputs = document.querySelectorAll('input[data-tagify], textarea[data-tagify]');
        if (!inputs.length || !window.Tagify) return;

        inputs.forEach(el => {
            if (el.__tagify_attached) return;

            try {
                new Tagify(el, {
                    dropdown: {
                        enabled: 0,
                        position: 'input'
                    }
                });
                el.__tagify_attached = true;
            } catch (e) {
                console.error('Tagify init failed:', e, el);
            }
        });
    };

    document.addEventListener('DOMContentLoaded', initTagify);

    document.addEventListener('livewire:init', () => {
        initTagify();
        Livewire.hook('morph.after', () => setTimeout(initTagify, 50));
    });

    new MutationObserver(() => setTimeout(initTagify, 100))
        .observe(document.body, { childList: true, subtree: true });
})();
</script>

<script>
(() => {
    const initTagify = () => {
        const elements = document.querySelectorAll('[data-tagify-dropdown]');
        elements.forEach(el => {
            if (el.__tagify_attached) return;

            let whitelist = [];
            try {
                whitelist = JSON.parse(el.getAttribute('data-tagify-dropdown') || "[]");
            } catch (e) {
                console.error('Invalid whitelist JSON:', el.getAttribute('data-tagify-dropdown'));
            }
            const tagify = new Tagify(el, {
                whitelist: whitelist,
                enforceWhitelist: false,
                dropdown: {
                    enabled: 1,
                    closeOnSelect: false,
                    position: 'input',
                    maxItems: 100,
                    highlightFirst: false,
                    originalInputWidth: true
                }
            });
            tagify.on('focus', () => {
                tagify.dropdown.show.call(tagify, "");
            });
            el.addEventListener('click', () => {
                tagify.dropdown.show.call(tagify, "");
            });
            el.__tagify_attached = tagify;
        });
    };
    document.addEventListener('DOMContentLoaded', initTagify);
    document.addEventListener('livewire:init', () => {
        initTagify();
        Livewire.hook('morph.after', () => {
            setTimeout(initTagify, 50);
        });
    });
    new MutationObserver(() => setTimeout(initTagify, 100)).observe(document.body, { childList: true, subtree: true });

})();
</script>
@endpush