@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 2rem;">
    <h1>ایجاد کمپین نمایشگر تاکسی دیجیتال</h1>
    <p>فرم زیر را پر کنید تا کمپین خود را ایجاد کنید.</p>
    
    <div id="wizard-app">
        <!-- Vue will replace this content -->
        <div>در حال بارگذاری ویزارد کمپین...</div>
    </div>
</div>
@endsection

@push('vue-components')
@vite('resources/js/wizard.js')
@endpush
