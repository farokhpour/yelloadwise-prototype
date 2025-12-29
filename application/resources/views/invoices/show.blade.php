@extends('layouts.app')

@section('content')
<div style="max-width: 900px; margin: 0 auto; padding: 2rem;">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('epic.digital-taxi-rooftop.campaign.show', $campaign->id) }}" 
           style="display: inline-block; margin-bottom: 1rem; color: #007bff; text-decoration: none; font-weight: 600;">
            ← Back to Campaign
        </a>
        <h1 style="margin: 0; color: #333;">Invoice</h1>
        <p style="margin: 0.5rem 0 0 0; color: #666;">Campaign: {{ $campaign->name }}</p>
    </div>

    @include('campaigns.partials.invoice', ['campaign' => $campaign])
</div>
@endsection

