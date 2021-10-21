@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.apidocumentation') }}
                </div>

                <div class="card-body">
                    <iframe title="Swagger" style="border:0px; width:100%;" src="/api/documentation" onload="resizeSwagger(this)"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection
