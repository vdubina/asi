@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.courseTopic.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.course-topics.update", [$courseTopic->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.courseTopic.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $courseTopic->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="body">{{ trans('cruds.courseTopic.fields.body') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="body">{!! old('body', $courseTopic->body) !!}</textarea>
                @if($errors->has('body'))
                    <span class="text-danger">{{ $errors->first('body') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.body_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_offsiteid">{{ trans('cruds.courseTopic.fields.field_offsiteid') }}</label>
                <input class="form-control {{ $errors->has('field_offsiteid') ? 'is-invalid' : '' }}" type="number" name="field_offsiteid" id="field_offsiteid" value="{{ old('field_offsiteid', $courseTopic->field_offsiteid) }}" step="1" required>
                @if($errors->has('field_offsiteid'))
                    <span class="text-danger">{{ $errors->first('field_offsiteid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_offsiteid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_speakers">{{ trans('cruds.courseTopic.fields.field_speakers') }}</label>
                <textarea class="form-control {{ $errors->has('field_speakers') ? 'is-invalid' : '' }}" name="field_speakers" id="field_speakers">{{ old('field_speakers', $courseTopic->field_speakers) }}</textarea>
                @if($errors->has('field_speakers'))
                    <span class="text-danger">{{ $errors->first('field_speakers') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_speakers_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_ad_code">{{ trans('cruds.courseTopic.fields.field_ad_code') }}</label>
                <input class="form-control {{ $errors->has('field_ad_code') ? 'is-invalid' : '' }}" type="text" name="field_ad_code" id="field_ad_code" value="{{ old('field_ad_code', $courseTopic->field_ad_code) }}">
                @if($errors->has('field_ad_code'))
                    <span class="text-danger">{{ $errors->first('field_ad_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_ad_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_supplier_code">{{ trans('cruds.courseTopic.fields.field_supplier_code') }}</label>
                <input class="form-control {{ $errors->has('field_supplier_code') ? 'is-invalid' : '' }}" type="text" name="field_supplier_code" id="field_supplier_code" value="{{ old('field_supplier_code', $courseTopic->field_supplier_code) }}">
                @if($errors->has('field_supplier_code'))
                    <span class="text-danger">{{ $errors->first('field_supplier_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_supplier_code_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_on_sale') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_on_sale" value="0">
                    <input class="form-check-input" type="checkbox" name="field_on_sale" id="field_on_sale" value="1" {{ $courseTopic->field_on_sale || old('field_on_sale', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_on_sale">{{ trans('cruds.courseTopic.fields.field_on_sale') }}</label>
                </div>
                @if($errors->has('field_on_sale'))
                    <span class="text-danger">{{ $errors->first('field_on_sale') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_on_sale_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_position">{{ trans('cruds.courseTopic.fields.field_position') }}</label>
                <input class="form-control {{ $errors->has('field_position') ? 'is-invalid' : '' }}" type="text" name="field_position" id="field_position" value="{{ old('field_position', $courseTopic->field_position) }}">
                @if($errors->has('field_position'))
                    <span class="text-danger">{{ $errors->first('field_position') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_position_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_volume">{{ trans('cruds.courseTopic.fields.field_volume') }}</label>
                <input class="form-control {{ $errors->has('field_volume') ? 'is-invalid' : '' }}" type="text" name="field_volume" id="field_volume" value="{{ old('field_volume', $courseTopic->field_volume) }}">
                @if($errors->has('field_volume'))
                    <span class="text-danger">{{ $errors->first('field_volume') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_volume_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_issue">{{ trans('cruds.courseTopic.fields.field_issue') }}</label>
                <input class="form-control {{ $errors->has('field_issue') ? 'is-invalid' : '' }}" type="text" name="field_issue" id="field_issue" value="{{ old('field_issue', $courseTopic->field_issue) }}">
                @if($errors->has('field_issue'))
                    <span class="text-danger">{{ $errors->first('field_issue') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_issue_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_course_type_id">{{ trans('cruds.courseTopic.fields.field_course_type') }}</label>
                <select class="form-control select2 {{ $errors->has('field_course_type') ? 'is-invalid' : '' }}" name="field_course_type_id" id="field_course_type_id" required>
                    @foreach($field_course_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('field_course_type_id') ? old('field_course_type_id') : $courseTopic->field_course_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_course_type'))
                    <span class="text-danger">{{ $errors->first('field_course_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_course_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_course_credit_type_id">{{ trans('cruds.courseTopic.fields.field_course_credit_type') }}</label>
                <select class="form-control select2 {{ $errors->has('field_course_credit_type') ? 'is-invalid' : '' }}" name="field_course_credit_type_id" id="field_course_credit_type_id">
                    @foreach($field_course_credit_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('field_course_credit_type_id') ? old('field_course_credit_type_id') : $courseTopic->field_course_credit_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_course_credit_type'))
                    <span class="text-danger">{{ $errors->first('field_course_credit_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_course_credit_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_practice_type_id">{{ trans('cruds.courseTopic.fields.field_practice_type') }}</label>
                <select class="form-control select2 {{ $errors->has('field_practice_type') ? 'is-invalid' : '' }}" name="field_practice_type_id" id="field_practice_type_id">
                    @foreach($field_practice_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('field_practice_type_id') ? old('field_practice_type_id') : $courseTopic->field_practice_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_practice_type'))
                    <span class="text-danger">{{ $errors->first('field_practice_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_practice_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_armscode_id">{{ trans('cruds.courseTopic.fields.field_armscode') }}</label>
                <select class="form-control select2 {{ $errors->has('field_armscode') ? 'is-invalid' : '' }}" name="field_armscode_id" id="field_armscode_id">
                    @foreach($field_armscodes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('field_armscode_id') ? old('field_armscode_id') : $courseTopic->field_armscode->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_armscode'))
                    <span class="text-danger">{{ $errors->first('field_armscode') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_armscode_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_web_category_id">{{ trans('cruds.courseTopic.fields.field_web_category') }}</label>
                <select class="form-control select2 {{ $errors->has('field_web_category') ? 'is-invalid' : '' }}" name="field_web_category_id" id="field_web_category_id">
                    @foreach($field_web_categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('field_web_category_id') ? old('field_web_category_id') : $courseTopic->field_web_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_web_category'))
                    <span class="text-danger">{{ $errors->first('field_web_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_web_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_ad_service_id">{{ trans('cruds.courseTopic.fields.field_ad_service') }}</label>
                <select class="form-control select2 {{ $errors->has('field_ad_service') ? 'is-invalid' : '' }}" name="field_ad_service_id" id="field_ad_service_id">
                    @foreach($field_ad_services as $id => $entry)
                        <option value="{{ $id }}" {{ (old('field_ad_service_id') ? old('field_ad_service_id') : $courseTopic->field_ad_service->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_ad_service'))
                    <span class="text-danger">{{ $errors->first('field_ad_service') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_ad_service_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_media_provider_id">{{ trans('cruds.courseTopic.fields.field_media_provider') }}</label>
                <select class="form-control select2 {{ $errors->has('field_media_provider') ? 'is-invalid' : '' }}" name="field_media_provider_id" id="field_media_provider_id">
                    @foreach($field_media_providers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('field_media_provider_id') ? old('field_media_provider_id') : $courseTopic->field_media_provider->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_media_provider'))
                    <span class="text-danger">{{ $errors->first('field_media_provider') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_media_provider_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_media_provider_topic">{{ trans('cruds.courseTopic.fields.field_media_provider_topic') }}</label>
                <input class="form-control {{ $errors->has('field_media_provider_topic') ? 'is-invalid' : '' }}" type="number" name="field_media_provider_topic" id="field_media_provider_topic" value="{{ old('field_media_provider_topic', $courseTopic->field_media_provider_topic) }}" step="1">
                @if($errors->has('field_media_provider_topic'))
                    <span class="text-danger">{{ $errors->first('field_media_provider_topic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_media_provider_topic_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_aana_expiration_date">{{ trans('cruds.courseTopic.fields.field_aana_expiration_date') }}</label>
                <input class="form-control date {{ $errors->has('field_aana_expiration_date') ? 'is-invalid' : '' }}" type="text" name="field_aana_expiration_date" id="field_aana_expiration_date" value="{{ old('field_aana_expiration_date', $courseTopic->field_aana_expiration_date) }}">
                @if($errors->has('field_aana_expiration_date'))
                    <span class="text-danger">{{ $errors->first('field_aana_expiration_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_aana_expiration_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_expiration_date">{{ trans('cruds.courseTopic.fields.field_expiration_date') }}</label>
                <input class="form-control date {{ $errors->has('field_expiration_date') ? 'is-invalid' : '' }}" type="text" name="field_expiration_date" id="field_expiration_date" value="{{ old('field_expiration_date', $courseTopic->field_expiration_date) }}">
                @if($errors->has('field_expiration_date'))
                    <span class="text-danger">{{ $errors->first('field_expiration_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_expiration_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_price">{{ trans('cruds.courseTopic.fields.field_price') }}</label>
                <input class="form-control {{ $errors->has('field_price') ? 'is-invalid' : '' }}" type="number" name="field_price" id="field_price" value="{{ old('field_price', $courseTopic->field_price) }}" step="0.01">
                @if($errors->has('field_price'))
                    <span class="text-danger">{{ $errors->first('field_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseTopic.fields.field_price_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.course-topics.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $courseTopic->id ?? 0 }}');
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
