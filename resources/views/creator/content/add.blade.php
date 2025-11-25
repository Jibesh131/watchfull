@extends('creator.layout.app')
@push('cdn')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
@endpush

@push('css')
    <style>
        input[type='file'] {
            border: 2px dashed #ccc;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .thumbnail img {
            width: 180px;
            height: 180px;
        }

        #previewBtn {
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
        <livewire:creator.content-form :id='$id ?? null' />
    </div>
@endsection

@push('js')
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        function previewThumbnail(event, btnId, imgId) {
            const file = event.target.files[0];
            const previewBtn = $('#' + btnId);
            const previewImage = $('#' + imgId);

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    previewImage.attr('src', e.target.result);
                    previewBtn.show();
                };
                reader.readAsDataURL(file);
            } else {
                previewBtn.hide();
                previewImage.attr('src', '');
            }
        }

        // Load existing image on edit (if available)
        document.addEventListener("DOMContentLoaded", function() {
            const btn = $('#thumbnailPreviewBtn');
            const src = btn.data('src');

            if (src) {
                $('#thumbnailPreviewImage').attr('src', src);
                btn.show();
            }
        });
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

                    let list = JSON.parse(input.dataset.tagifyDropdown || "[]");

                    const tagify = new Tagify(input, {
                        whitelist: list,
                        maxTags: 5,
                        valueField: "value",
                        labelField: "name",
                        tagTextProp: "name",
                        dropdown: {
                            enabled: 1,
                            classname: "tags-look",
                            enabled: 0,
                            closeOnSelect: false,
                        },
                        templates: {
                            dropdownItem(item) {
                                return `<div class="tagify__dropdown__item" value="${item.value}" name="${item.name}" mappedvalue="${item.value}" tabindex="0" role="option" data-value="${item.value}"> ${item.name}</div>`;
                            }
                        }
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
    <script>
        document.addEventListener('click', function(e) {
            if (e.target.closest('[data-bs-target="#videoPreviewModal"]')) {
                const btn = e.target.closest('button');
                const src = btn.getAttribute('data-src');
                document.querySelector('#videoPreviewPlayer source').src = src;
                document.querySelector('#videoPreviewPlayer').load();
            }
        });
    </script>
@endpush
