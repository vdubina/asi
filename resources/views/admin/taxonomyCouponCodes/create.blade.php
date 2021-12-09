@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.taxonomyCouponCode.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.taxonomy-coupon-codes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taxonomyCouponCode.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCouponCode.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.taxonomyCouponCode.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCouponCode.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_offsiteid">{{ trans('cruds.taxonomyCouponCode.fields.field_offsiteid') }}</label>
                <input class="form-control {{ $errors->has('field_offsiteid') ? 'is-invalid' : '' }}" type="number" name="field_offsiteid" id="field_offsiteid" value="{{ old('field_offsiteid', '') }}" step="1" required>
                @if($errors->has('field_offsiteid'))
                    <span class="text-danger">{{ $errors->first('field_offsiteid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCouponCode.fields.field_offsiteid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_value">{{ trans('cruds.taxonomyCouponCode.fields.field_value') }}</label>
                <input class="form-control {{ $errors->has('field_value') ? 'is-invalid' : '' }}" type="number" name="field_value" id="field_value" value="{{ old('field_value', '') }}" step="1" required>
                @if($errors->has('field_value'))
                    <span class="text-danger">{{ $errors->first('field_value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCouponCode.fields.field_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_type">{{ trans('cruds.taxonomyCouponCode.fields.field_type') }}</label>
                <input class="form-control {{ $errors->has('field_type') ? 'is-invalid' : '' }}" type="number" name="field_type" id="field_type" value="{{ old('field_type', '') }}" step="1" required>
                @if($errors->has('field_type'))
                    <span class="text-danger">{{ $errors->first('field_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCouponCode.fields.field_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_max_uses">{{ trans('cruds.taxonomyCouponCode.fields.field_max_uses') }}</label>
                <input class="form-control {{ $errors->has('field_max_uses') ? 'is-invalid' : '' }}" type="number" name="field_max_uses" id="field_max_uses" value="{{ old('field_max_uses', '0') }}" step="1" required>
                @if($errors->has('field_max_uses'))
                    <span class="text-danger">{{ $errors->first('field_max_uses') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCouponCode.fields.field_max_uses_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_inactive') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_inactive" value="0">
                    <input class="form-check-input" type="checkbox" name="field_inactive" id="field_inactive" value="1" {{ old('field_inactive', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_inactive">{{ trans('cruds.taxonomyCouponCode.fields.field_inactive') }}</label>
                </div>
                @if($errors->has('field_inactive'))
                    <span class="text-danger">{{ $errors->first('field_inactive') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCouponCode.fields.field_inactive_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.taxonomyCouponCode.fields.field_exclusive') }}</label>
                @foreach(App\Models\TaxonomyCouponCode::FIELD_EXCLUSIVE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('field_exclusive') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="field_exclusive_{{ $key }}" name="field_exclusive" value="{{ $key }}" {{ old('field_exclusive', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="field_exclusive_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('field_exclusive'))
                    <span class="text-danger">{{ $errors->first('field_exclusive') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCouponCode.fields.field_exclusive_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_date_start">{{ trans('cruds.taxonomyCouponCode.fields.field_date_start') }}</label>
                <input class="form-control date {{ $errors->has('field_date_start') ? 'is-invalid' : '' }}" type="text" name="field_date_start" id="field_date_start" value="{{ old('field_date_start') }}">
                @if($errors->has('field_date_start'))
                    <span class="text-danger">{{ $errors->first('field_date_start') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCouponCode.fields.field_date_start_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_date_end">{{ trans('cruds.taxonomyCouponCode.fields.field_date_end') }}</label>
                <input class="form-control date {{ $errors->has('field_date_end') ? 'is-invalid' : '' }}" type="text" name="field_date_end" id="field_date_end" value="{{ old('field_date_end') }}">
                @if($errors->has('field_date_end'))
                    <span class="text-danger">{{ $errors->first('field_date_end') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCouponCode.fields.field_date_end_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
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
                xhr.open('POST', '{{ route('admin.taxonomy-coupon-codes.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $taxonomyCouponCode->id ?? 0 }}');
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