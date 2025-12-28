@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 2rem;">
    <!-- Header -->
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('home') }}" style="display: inline-block; margin-bottom: 1rem; color: #007bff; text-decoration: none;">
            ← بازگشت به اپیک‌ها
        </a>
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <span style="font-size: 3rem;">{{ $epic['icon'] }}</span>
            <h1 style="margin: 0; color: #333;">{{ $epic['name'] }}</h1>
        </div>
    </div>

    <!-- Description Section -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <h2 style="color: #007bff; margin-bottom: 1rem; border-bottom: 2px solid #007bff; padding-bottom: 0.5rem;">توضیحات</h2>
        <p style="color: #555; line-height: 1.8; font-size: 1.05rem;">
            {{ $epic['description'] }}
        </p>
    </div>

    <!-- How It Works Section -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <h2 style="color: #007bff; margin-bottom: 1rem; border-bottom: 2px solid #007bff; padding-bottom: 0.5rem;">نحوه کار</h2>
        <ol style="color: #555; line-height: 2; padding-right: 1.5rem; direction: rtl;">
            @foreach($epic['how_it_works'] as $step)
                <li style="margin-bottom: 0.5rem;">{{ $step }}</li>
            @endforeach
        </ol>
    </div>

    <!-- Purpose Section -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <h2 style="color: #007bff; margin-bottom: 1rem; border-bottom: 2px solid #007bff; padding-bottom: 0.5rem;">هدف</h2>
        <p style="color: #555; line-height: 1.8; font-size: 1.05rem;">
            {{ $epic['purpose'] }}
        </p>
    </div>

    <!-- Pages Section -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="color: #007bff; margin-bottom: 1.5rem; border-bottom: 2px solid #007bff; padding-bottom: 0.5rem;">صفحات موجود</h2>

        <!-- User Pages -->
        <div style="margin-bottom: 2rem;">
            <h3 style="color: #28a745; margin-bottom: 1rem; font-size: 1.3rem;">👤 صفحات کاربر</h3>
            <div style="display: grid; gap: 1rem;">
                @foreach($epic['pages']['user'] as $page)
                    <div style="border: 1px solid #dee2e6; border-radius: 8px; padding: 1.5rem; background: #f8f9fa; transition: all 0.3s;" 
                         onmouseover="this.style.borderColor='#28a745'; this.style.boxShadow='0 2px 8px rgba(40,167,69,0.2)';"
                         onmouseout="this.style.borderColor='#dee2e6'; this.style.boxShadow='none';">
                        <h4 style="margin: 0 0 0.5rem 0; color: #333;">{{ $page['name'] }}</h4>
                        <p style="margin: 0 0 0.75rem 0; color: #666; font-size: 0.95rem; line-height: 1.6;">{{ $page['description'] }}</p>
                        <p style="margin: 0 0 1rem 0; padding: 0.5rem 1rem; background: #e9ecef; border-radius: 4px; font-size: 0.875rem; color: #495057;">
                            <strong>نمای کلی:</strong> {{ $page['overview'] }}
                        </p>
                        <div style="display: flex; align-items: center; gap: 1rem; padding-top: 1rem; border-top: 1px solid #dee2e6;">
                            <a href="{{ $page['url'] }}" 
                               target="_blank"
                               style="display: inline-block; padding: 0.75rem 1.5rem; background: #28a745; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
                               onmouseover="this.style.background='#218838'; this.style.transform='translateY(-2px)';"
                               onmouseout="this.style.background='#28a745'; this.style.transform='translateY(0)';">
                                🚀 رفتن به صفحه
                            </a>
                            @if(isset($page['note']))
                                <span style="font-size: 0.875rem; color: #ffc107;">⚠️ {{ $page['note'] }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Admin Pages -->
        <div style="margin-bottom: 2rem;">
            <h3 style="color: #dc3545; margin-bottom: 1rem; font-size: 1.3rem;">🔧 صفحات ادمین</h3>
            <div style="display: grid; gap: 1rem;">
                @foreach($epic['pages']['admin'] as $page)
                    <div style="border: 1px solid #dee2e6; border-radius: 8px; padding: 1.5rem; background: #f8f9fa; transition: all 0.3s;" 
                         onmouseover="this.style.borderColor='#dc3545'; this.style.boxShadow='0 2px 8px rgba(220,53,69,0.2)';"
                         onmouseout="this.style.borderColor='#dee2e6'; this.style.boxShadow='none';">
                        <h4 style="margin: 0 0 0.5rem 0; color: #333;">{{ $page['name'] }}</h4>
                        <p style="margin: 0 0 0.75rem 0; color: #666; font-size: 0.95rem; line-height: 1.6;">{{ $page['description'] }}</p>
                        <p style="margin: 0 0 1rem 0; padding: 0.5rem 1rem; background: #e9ecef; border-radius: 4px; font-size: 0.875rem; color: #495057;">
                            <strong>نمای کلی:</strong> {{ $page['overview'] }}
                        </p>
                        <div style="display: flex; align-items: center; gap: 1rem; padding-top: 1rem; border-top: 1px solid #dee2e6;">
                            <a href="{{ $page['url'] }}" 
                               target="_blank"
                               style="display: inline-block; padding: 0.75rem 1.5rem; background: #dc3545; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
                               onmouseover="this.style.background='#c82333'; this.style.transform='translateY(-2px)';"
                               onmouseout="this.style.background='#dc3545'; this.style.transform='translateY(0)';">
                                🚀 رفتن به صفحه
                            </a>
                            @if(isset($page['note']))
                                <span style="font-size: 0.875rem; color: #ffc107;">⚠️ {{ $page['note'] }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Integration Pages -->
        <div>
            <h3 style="color: #6f42c1; margin-bottom: 1rem; font-size: 1.3rem;">🔌 صفحات یکپارچه‌سازی</h3>
            <div style="display: grid; gap: 1rem;">
                @foreach($epic['pages']['integration'] as $page)
                    <div style="border: 1px solid #dee2e6; border-radius: 8px; padding: 1.5rem; background: #f8f9fa; transition: all 0.3s;" 
                         onmouseover="this.style.borderColor='#6f42c1'; this.style.boxShadow='0 2px 8px rgba(111,66,193,0.2)';"
                         onmouseout="this.style.borderColor='#dee2e6'; this.style.boxShadow='none';">
                        <h4 style="margin: 0 0 0.5rem 0; color: #333;">{{ $page['name'] }}</h4>
                        <p style="margin: 0 0 0.75rem 0; color: #666; font-size: 0.95rem; line-height: 1.6;">{{ $page['description'] }}</p>
                        <p style="margin: 0 0 1rem 0; padding: 0.5rem 1rem; background: #e9ecef; border-radius: 4px; font-size: 0.875rem; color: #495057;">
                            <strong>نمای کلی:</strong> {{ $page['overview'] }}
                        </p>
                        <div style="display: flex; align-items: center; gap: 1rem; padding-top: 1rem; border-top: 1px solid #dee2e6;">
                            <a href="{{ $page['url'] }}" 
                               target="_blank"
                               style="display: inline-block; padding: 0.75rem 1.5rem; background: #6f42c1; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
                               onmouseover="this.style.background='#5a32a3'; this.style.transform='translateY(-2px)';"
                               onmouseout="this.style.background='#6f42c1'; this.style.transform='translateY(0)';">
                                🚀 رفتن به صفحه
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
