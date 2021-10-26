@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.taxonomyProfession.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.taxonomy-professions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taxonomyProfession.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyProfession.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.taxonomyProfession.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyProfession.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_offsiteid">{{ trans('cruds.taxonomyProfession.fields.field_offsiteid') }}</label>
                <input class="form-control {{ $errors->has('field_offsiteid') ? 'is-invalid' : '' }}" type="number" name="field_offsiteid" id="field_offsiteid" value="{{ old('field_offsiteid', '') }}" step="1" required>
                @if($errors->has('field_offsiteid'))
                    <span class="text-danger">{{ $errors->first('field_offsiteid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyProfession.fields.field_offsiteid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_salutation">{{ trans('cruds.taxonomyProfession.fields.field_salutation') }}</label>
                <input class="form-control {{ $errors->has('field_salutation') ? 'is-invalid' : '' }}" type="text" name="field_salutation" id="field_salutation" value="{{ old('field_salutation', '') }}">
                @if($errors->has('field_salutation'))
                    <span class="text-danger">{{ $errors->first('field_salutation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyProfession.fields.field_salutation_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_allied_professional') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_allied_professional" value="0">
                    <input class="form-check-input" type="checkbox" name="field_allied_professional" id="field_allied_professional" value="1" {{ old('field_allied_professional', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_allied_professional">{{ trans('cruds.taxonomyProfession.fields.field_allied_professional') }}</label>
                </div>
                @if($errors->has('field_allied_professional'))
                    <span class="text-danger">{{ $errors->first('field_allied_professional') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyProfession.fields.field_allied_professional_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_ad_customer_category">{{ trans('cruds.taxonomyProfession.fields.field_ad_customer_category') }}</label>
                <input class="form-control {{ $errors->has('field_ad_customer_category') ? 'is-invalid' : '' }}" type="text" name="field_ad_customer_category" id="field_ad_customer_category" value="{{ old('field_ad_customer_category', '') }}">
                @if($errors->has('field_ad_customer_category'))
                    <span class="text-danger">{{ $errors->first('field_ad_customer_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyProfession.fields.field_ad_customer_category_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.taxonomy-professions.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $taxonomyProfession->id ?? 0 }}');
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
