@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.taxonomyCourse.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.taxonomy-courses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taxonomyCourse.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourse.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.taxonomyCourse.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourse.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_available') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_available" value="0">
                    <input class="form-check-input" type="checkbox" name="field_available" id="field_available" value="1" {{ old('field_available', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_available">{{ trans('cruds.taxonomyCourse.fields.field_available') }}</label>
                </div>
                @if($errors->has('field_available'))
                    <span class="text-danger">{{ $errors->first('field_available') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourse.fields.field_available_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_placeholder') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_placeholder" value="0">
                    <input class="form-check-input" type="checkbox" name="field_placeholder" id="field_placeholder" value="1" {{ old('field_placeholder', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_placeholder">{{ trans('cruds.taxonomyCourse.fields.field_placeholder') }}</label>
                </div>
                @if($errors->has('field_placeholder'))
                    <span class="text-danger">{{ $errors->first('field_placeholder') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourse.fields.field_placeholder_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_dental_report_text">{{ trans('cruds.taxonomyCourse.fields.field_dental_report_text') }}</label>
                <input class="form-control {{ $errors->has('field_dental_report_text') ? 'is-invalid' : '' }}" type="text" name="field_dental_report_text" id="field_dental_report_text" value="{{ old('field_dental_report_text', '') }}">
                @if($errors->has('field_dental_report_text'))
                    <span class="text-danger">{{ $errors->first('field_dental_report_text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourse.fields.field_dental_report_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_course_type_id">{{ trans('cruds.taxonomyCourse.fields.field_course_type') }}</label>
                <select class="form-control select2 {{ $errors->has('field_course_type') ? 'is-invalid' : '' }}" name="field_course_type_id" id="field_course_type_id">
                    @foreach($field_course_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('field_course_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_course_type'))
                    <span class="text-danger">{{ $errors->first('field_course_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourse.fields.field_course_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_additional_information">{{ trans('cruds.taxonomyCourse.fields.field_additional_information') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('field_additional_information') ? 'is-invalid' : '' }}" name="field_additional_information" id="field_additional_information">{!! old('field_additional_information') !!}</textarea>
                @if($errors->has('field_additional_information'))
                    <span class="text-danger">{{ $errors->first('field_additional_information') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourse.fields.field_additional_information_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.taxonomy-courses.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $taxonomyCourse->id ?? 0 }}');
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
