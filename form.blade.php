@push('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endpush

<div class="mb-3">
    <label for="name" class="form-label">Product Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" 
           id="name" name="name" value="{{ old('name', $product->name ?? '') }}">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">Product Image</label>
    <input type="file" 
           class="filepond"
           name="image"
           accept="image/png, image/jpeg, image/jpg"
           data-max-file-size="3MB"
           data-max-files="1">
    @error('image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Other form fields -->

@push('scripts')
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<script>
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    FilePond.create(document.querySelector('input[type="file"]'), {
        server: {
            process: '/upload/process',
            revert: '/upload/revert',
            load: '/upload/load',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
</script>
@endpush