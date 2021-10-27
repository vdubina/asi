<script>
    Dropzone.options.{{ lcfirst(str_replace(" ","",Str::headline($key))) }}Dropzone = {
        url: '{{ route('admin.'.$route.'.storeMedia') }}',
        maxFilesize: 2, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: {{ $size ?? 2 }},
            width: {{ $width ?? 4096 }},
            height: {{ $height ?? 4096 }}
        },
        success: function (file, response) {
            $('form').find('input[name="{{ $key }}"]').remove()
            $('form').append('<input type="hidden" name="{{ $key }}" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="{{ $key }}"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        init: function () {
            @if(isset($current))
            var file = {!! json_encode($current) !!}
            this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="{{ $key }}" value="' + file.file_name + '">')
            this.options.maxFiles = this.options.maxFiles - 1
            @endif
        },
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    }
</script>
