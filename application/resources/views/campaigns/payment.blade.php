@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 2rem;">
    <h1>Payment for Campaign: {{ $campaign->name }}</h1>
    
    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <h2>Campaign Summary</h2>
        <table style="width: 100%; margin-top: 1rem;">
            <tr>
                <td style="padding: 0.5rem 0;"><strong>Days:</strong></td>
                <td style="padding: 0.5rem 0;">{{ $campaign->days }}</td>
            </tr>
            <tr>
                <td style="padding: 0.5rem 0;"><strong>Cars:</strong></td>
                <td style="padding: 0.5rem 0;">{{ $campaign->cars }}</td>
            </tr>
            <tr>
                <td style="padding: 0.5rem 0;"><strong>Cost per Day:</strong></td>
                <td style="padding: 0.5rem 0;">${{ number_format($campaign->cost_per_day ?? 0, 2) }}</td>
            </tr>
            <tr style="border-top: 2px solid #ddd;">
                <td style="padding: 0.5rem 0;"><strong>Total Cost:</strong></td>
                <td style="padding: 0.5rem 0; font-size: 1.5rem; font-weight: bold; color: #28a745;">
                    ${{ number_format($campaign->total_cost, 2) }}
                </td>
            </tr>
        </table>
    </div>

    <form method="POST" action="{{ route('campaigns.payment.process', $campaign->id) }}" style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        @csrf
        
        <h2>Payment Information</h2>
        <p style="color: #666; margin-bottom: 1.5rem;">
            This is a prototype. In production, this would integrate with a payment gateway.
        </p>

        <div style="background: #f8f9fa; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem;">
            <p><strong>Prototype Payment:</strong> Clicking "Process Payment" will simulate a successful payment.</p>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" style="flex: 1; padding: 1rem; background: #28a745; color: white; border: none; border-radius: 6px; font-size: 1.1rem; font-weight: 600; cursor: pointer;">
                Process Payment
            </button>
            <a href="{{ route('campaigns.show', $campaign->id) }}" 
               style="flex: 1; padding: 1rem; background: #6c757d; color: white; text-decoration: none; border-radius: 6px; text-align: center; font-size: 1.1rem; font-weight: 600;">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

