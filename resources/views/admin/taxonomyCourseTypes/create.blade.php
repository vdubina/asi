@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.taxonomyCourseType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.taxonomy-course-types.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taxonomyCourseType.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourseType.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.taxonomyCourseType.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourseType.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_offsiteid">{{ trans('cruds.taxonomyCourseType.fields.field_offsiteid') }}</label>
                <input class="form-control {{ $errors->has('field_offsiteid') ? 'is-invalid' : '' }}" type="number" name="field_offsiteid" id="field_offsiteid" value="{{ old('field_offsiteid', '') }}" step="1" required>
                @if($errors->has('field_offsiteid'))
                    <span class="text-danger">{{ $errors->first('field_offsiteid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourseType.fields.field_offsiteid_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_adsubscribable') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_adsubscribable" value="0">
                    <input class="form-check-input" type="checkbox" name="field_adsubscribable" id="field_adsubscribable" value="1" {{ old('field_adsubscribable', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_adsubscribable">{{ trans('cruds.taxonomyCourseType.fields.field_adsubscribable') }}</label>
                </div>
                @if($errors->has('field_adsubscribable'))
                    <span class="text-danger">{{ $errors->first('field_adsubscribable') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourseType.fields.field_adsubscribable_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_custom_course_layout') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_custom_course_layout" value="0">
                    <input class="form-check-input" type="checkbox" name="field_custom_course_layout" id="field_custom_course_layout" value="1" {{ old('field_custom_course_layout', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_custom_course_layout">{{ trans('cruds.taxonomyCourseType.fields.field_custom_course_layout') }}</label>
                </div>
                @if($errors->has('field_custom_course_layout'))
                    <span class="text-danger">{{ $errors->first('field_custom_course_layout') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourseType.fields.field_custom_course_layout_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn100 btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
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
                xhr.open('POST', '{{ route('admin.taxonomy-course-types.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $taxonomyCourseType->id ?? 0 }}');
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
