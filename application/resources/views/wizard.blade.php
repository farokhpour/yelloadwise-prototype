@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 2rem;">
    <h1>Vue.js Wizard Test</h1>
    <p>This page demonstrates selective Vue.js usage for interactive prototypes.</p>
    
    <div id="wizard-app">
        <!-- Vue will replace this content -->
        <div>Loading wizard...</div>
    </div>
</div>
@endsection

@push('vue-components')
@vite('resources/js/wizard.js')
@endpush

