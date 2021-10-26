@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.taxonomyWebCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.taxonomy-web-categories.update", [$taxonomyWebCategory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taxonomyWebCategory.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $taxonomyWebCategory->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyWebCategory.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.taxonomyWebCategory.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $taxonomyWebCategory->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyWebCategory.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_offsiteid">{{ trans('cruds.taxonomyWebCategory.fields.field_offsiteid') }}</label>
                <input class="form-control {{ $errors->has('field_offsiteid') ? 'is-invalid' : '' }}" type="number" name="field_offsiteid" id="field_offsiteid" value="{{ old('field_offsiteid', $taxonomyWebCategory->field_offsiteid) }}" step="1" required>
                @if($errors->has('field_offsiteid'))
                    <span class="text-danger">{{ $errors->first('field_offsiteid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyWebCategory.fields.field_offsiteid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_practice_type_id">{{ trans('cruds.taxonomyWebCategory.fields.field_practice_type') }}</label>
                <select class="form-control select2 {{ $errors->has('field_practice_type') ? 'is-invalid' : '' }}" name="field_practice_type_id" id="field_practice_type_id">
                    @foreach($field_practice_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('field_practice_type_id') ? old('field_practice_type_id') : $taxonomyWebCategory->field_practice_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_practice_type'))
                    <span class="text-danger">{{ $errors->first('field_practice_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyWebCategory.fields.field_practice_type_helper') }}</span>
            </div>
            <div class="form-group">
                @include('partials.buttons.save')
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.taxonomy-web-categories.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $taxonomyWebCategory->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection
