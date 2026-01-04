@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="font-size: 2.5rem; color: #0066cc; margin-bottom: 1rem;">سیستم پروتوتایپ</h1>
        <p style="font-size: 1.2rem; color: #666;">سازماندهی ویژگی‌ها بر اساس اپیک</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">
        @foreach($epics as $epic)
            <a href="{{ route('epics.show', $epic['id']) }}" 
               style="text-decoration: none; display: block;">
                <div style="background: white; border: 2px solid #dee2e6; border-radius: 12px; padding: 2rem; transition: all 0.3s; height: 100%; display: flex; flex-direction: column; position: relative;"
                     onmouseover="this.style.borderColor='#007bff'; this.style.boxShadow='0 4px 12px rgba(0,123,255,0.2)';"
                     onmouseout="this.style.borderColor='#dee2e6'; this.style.boxShadow='none';">
                    <div style="position: absolute; top: 1rem; left: 1rem;">
                        <span style="padding: 0.35rem 0.75rem; background: #6c757d; color: white; border-radius: 6px; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px;">
                            {{ $epic['epic_id'] ?? 'EPIC_' . ($loop->index + 1) }}
                        </span>
                    </div>
                    <div style="font-size: 4rem; margin-bottom: 1rem; text-align: center;">
                        {{ $epic['icon'] }}
                    </div>
                    <h2 style="color: #333; margin-bottom: 1rem; text-align: center;">
                        {{ $epic['name'] }}
                    </h2>
                    <p style="color: #666; margin-bottom: 1.5rem; flex-grow: 1;">
                        {{ $epic['description'] }}
                    </p>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid #dee2e6;">
                        <span style="padding: 0.25rem 0.75rem; background: #28a745; color: white; border-radius: 4px; font-size: 0.875rem; font-weight: 600;">
                            {{ $epic['status'] === 'active' ? 'نمایش' : ucfirst($epic['status']) }}
                        </span>
                        <span style="color: #666; font-size: 0.875rem;">
                            {{ $epic['routes_count'] }} مسیر
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    @if(count($epics) === 0)
        <div style="text-align: center; padding: 3rem; background: #f8f9fa; border-radius: 8px;">
            <p style="color: #666; font-size: 1.1rem;">هنوز اپیکی در دسترس نیست.</p>
        </div>
    @endif
</div>
@endsection

