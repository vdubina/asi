@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.courseProduct.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.course-products.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.courseProduct.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sku">{{ trans('cruds.courseProduct.fields.sku') }}</label>
                <input class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" type="text" name="sku" id="sku" value="{{ old('sku', '') }}" required>
                @if($errors->has('sku'))
                    <span class="text-danger">{{ $errors->first('sku') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.sku_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="commerce_price">{{ trans('cruds.courseProduct.fields.commerce_price') }}</label>
                <input class="form-control {{ $errors->has('commerce_price') ? 'is-invalid' : '' }}" type="number" name="commerce_price" id="commerce_price" value="{{ old('commerce_price', '') }}" step="0.01" required>
                @if($errors->has('commerce_price'))
                    <span class="text-danger">{{ $errors->first('commerce_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.commerce_price_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="status" value="0">
                    <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ old('status', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">{{ trans('cruds.courseProduct.fields.status') }}</label>
                </div>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_description">{{ trans('cruds.courseProduct.fields.field_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('field_description') ? 'is-invalid' : '' }}" name="field_description" id="field_description">{!! old('field_description') !!}</textarea>
                @if($errors->has('field_description'))
                    <span class="text-danger">{{ $errors->first('field_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.courseProduct.fields.field_course_length') }}</label>
                <select class="form-control {{ $errors->has('field_course_length') ? 'is-invalid' : '' }}" name="field_course_length" id="field_course_length" required>
                    <option value disabled {{ old('field_course_length', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CourseProduct::FIELD_COURSE_LENGTH_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('field_course_length', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_course_length'))
                    <span class="text-danger">{{ $errors->first('field_course_length') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_course_length_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_offsiteid">{{ trans('cruds.courseProduct.fields.field_offsiteid') }}</label>
                <input class="form-control {{ $errors->has('field_offsiteid') ? 'is-invalid' : '' }}" type="number" name="field_offsiteid" id="field_offsiteid" value="{{ old('field_offsiteid', '') }}" step="1" required>
                @if($errors->has('field_offsiteid'))
                    <span class="text-danger">{{ $errors->first('field_offsiteid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_offsiteid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_supplier_code">{{ trans('cruds.courseProduct.fields.field_supplier_code') }}</label>
                <input class="form-control {{ $errors->has('field_supplier_code') ? 'is-invalid' : '' }}" type="text" name="field_supplier_code" id="field_supplier_code" value="{{ old('field_supplier_code', '') }}" required>
                @if($errors->has('field_supplier_code'))
                    <span class="text-danger">{{ $errors->first('field_supplier_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_supplier_code_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_is_ondemand') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_is_ondemand" value="0">
                    <input class="form-check-input" type="checkbox" name="field_is_ondemand" id="field_is_ondemand" value="1" {{ old('field_is_ondemand', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_is_ondemand">{{ trans('cruds.courseProduct.fields.field_is_ondemand') }}</label>
                </div>
                @if($errors->has('field_is_ondemand'))
                    <span class="text-danger">{{ $errors->first('field_is_ondemand') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_is_ondemand_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_disk_availability') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_disk_availability" value="0">
                    <input class="form-check-input" type="checkbox" name="field_disk_availability" id="field_disk_availability" value="1" {{ old('field_disk_availability', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_disk_availability">{{ trans('cruds.courseProduct.fields.field_disk_availability') }}</label>
                </div>
                @if($errors->has('field_disk_availability'))
                    <span class="text-danger">{{ $errors->first('field_disk_availability') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_disk_availability_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_dental_report_text">{{ trans('cruds.courseProduct.fields.field_dental_report_text') }}</label>
                <input class="form-control {{ $errors->has('field_dental_report_text') ? 'is-invalid' : '' }}" type="text" name="field_dental_report_text" id="field_dental_report_text" value="{{ old('field_dental_report_text', '') }}">
                @if($errors->has('field_dental_report_text'))
                    <span class="text-danger">{{ $errors->first('field_dental_report_text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_dental_report_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_download_availability">{{ trans('cruds.courseProduct.fields.field_download_availability') }}</label>
                <input class="form-control {{ $errors->has('field_download_availability') ? 'is-invalid' : '' }}" type="text" name="field_download_availability" id="field_download_availability" value="{{ old('field_download_availability', '') }}">
                @if($errors->has('field_download_availability'))
                    <span class="text-danger">{{ $errors->first('field_download_availability') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_download_availability_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_standard_credit_hours">{{ trans('cruds.courseProduct.fields.field_standard_credit_hours') }}</label>
                <input class="form-control {{ $errors->has('field_standard_credit_hours') ? 'is-invalid' : '' }}" type="number" name="field_standard_credit_hours" id="field_standard_credit_hours" value="{{ old('field_standard_credit_hours', '') }}" step="1">
                @if($errors->has('field_standard_credit_hours'))
                    <span class="text-danger">{{ $errors->first('field_standard_credit_hours') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_standard_credit_hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_course_type_id">{{ trans('cruds.courseProduct.fields.field_course_type') }}</label>
                <select class="form-control select2 {{ $errors->has('field_course_type') ? 'is-invalid' : '' }}" name="field_course_type_id" id="field_course_type_id" required>
                    @foreach($field_course_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('field_course_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_course_type'))
                    <span class="text-danger">{{ $errors->first('field_course_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_course_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_course_credit_type_id">{{ trans('cruds.courseProduct.fields.field_course_credit_type') }}</label>
                <select class="form-control select2 {{ $errors->has('field_course_credit_type') ? 'is-invalid' : '' }}" name="field_course_credit_type_id" id="field_course_credit_type_id" required>
                    @foreach($field_course_credit_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('field_course_credit_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_course_credit_type'))
                    <span class="text-danger">{{ $errors->first('field_course_credit_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_course_credit_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_practice_type_id">{{ trans('cruds.courseProduct.fields.field_practice_type') }}</label>
                <select class="form-control select2 {{ $errors->has('field_practice_type') ? 'is-invalid' : '' }}" name="field_practice_type_id" id="field_practice_type_id" required>
                    @foreach($field_practice_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('field_practice_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_practice_type'))
                    <span class="text-danger">{{ $errors->first('field_practice_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_practice_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_media_provider_id">{{ trans('cruds.courseProduct.fields.field_media_provider') }}</label>
                <select class="form-control select2 {{ $errors->has('field_media_provider') ? 'is-invalid' : '' }}" name="field_media_provider_id" id="field_media_provider_id" required>
                    @foreach($field_media_providers as $id => $entry)
                        <option value="{{ $id }}" {{ old('field_media_provider_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_media_provider'))
                    <span class="text-danger">{{ $errors->first('field_media_provider') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_media_provider_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_media_delivery_type_id">{{ trans('cruds.courseProduct.fields.field_media_delivery_type') }}</label>
                <select class="form-control select2 {{ $errors->has('field_media_delivery_type') ? 'is-invalid' : '' }}" name="field_media_delivery_type_id" id="field_media_delivery_type_id" required>
                    @foreach($field_media_delivery_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('field_media_delivery_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_media_delivery_type'))
                    <span class="text-danger">{{ $errors->first('field_media_delivery_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_media_delivery_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_web_category_id">{{ trans('cruds.courseProduct.fields.field_web_category') }}</label>
                <select class="form-control select2 {{ $errors->has('field_web_category') ? 'is-invalid' : '' }}" name="field_web_category_id" id="field_web_category_id" required>
                    @foreach($field_web_categories as $id => $entry)
                        <option value="{{ $id }}" {{ old('field_web_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_web_category'))
                    <span class="text-danger">{{ $errors->first('field_web_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_web_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_topics_nodes">{{ trans('cruds.courseProduct.fields.field_topics_nodes') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('field_topics_nodes') ? 'is-invalid' : '' }}" name="field_topics_nodes[]" id="field_topics_nodes" multiple>
                    @foreach($field_topics_nodes as $id => $field_topics_node)
                        <option value="{{ $id }}" {{ in_array($id, old('field_topics_nodes', [])) ? 'selected' : '' }}>{{ $field_topics_node }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_topics_nodes'))
                    <span class="text-danger">{{ $errors->first('field_topics_nodes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseProduct.fields.field_topics_nodes_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.course-products.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $courseProduct->id ?? 0 }}');
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
