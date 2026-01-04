@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="color: #333; margin: 0;">مدیریت ویدیوهای پیش‌فرض</h1>
        @if($canAddMore)
            <a href="{{ route('epic.digital-taxi-rooftop.default-videos.create') }}" 
               style="display: inline-block; padding: 0.75rem 1.5rem; background: #28a745; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
               onmouseover="this.style.background='#218838'; this.style.transform='translateY(-2px)';"
               onmouseout="this.style.background='#28a745'; this.style.transform='translateY(0)';">
                ➕ افزودن ویدیو پیش‌فرض
            </a>
        @else
            <span style="padding: 0.75rem 1.5rem; background: #6c757d; color: white; border-radius: 6px; font-weight: 600;">
                حداکثر {{ $maxVideos }} ویدیو
            </span>
        @endif
    </div>

    @if(session('success'))
        <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            {{ session('error') }}
        </div>
    @endif

    <div style="background: #e3f2fd; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border-right: 4px solid #2196f3;">
        <p style="margin: 0; color: #1565c0; font-weight: 500;">
            <strong>توجه:</strong> می‌توانید حداکثر {{ $maxVideos }} ویدیو پیش‌فرض اضافه کنید. 
            ویدیوهای پیش‌فرض زمانی نمایش داده می‌شوند که کمپینی برای دستگاه یافت نشود یا با احتمال 25% به جای کمپین نمایش داده شوند.
        </p>
    </div>

    @if($videos->isEmpty())
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 3rem; text-align: center;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">🎬</div>
            <p style="color: #666; font-size: 1.1rem;">هیچ ویدیو پیش‌فرضی ثبت نشده است</p>
            @if($canAddMore)
                <a href="{{ route('epic.digital-taxi-rooftop.default-videos.create') }}" 
                   style="display: inline-block; margin-top: 1rem; padding: 0.75rem 1.5rem; background: #007bff; color: white; text-decoration: none; border-radius: 6px; font-weight: 600;">
                    افزودن اولین ویدیو پیش‌فرض
                </a>
            @endif
        </div>
    @else
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
            @foreach($videos as $video)
                <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.2s;"
                     onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.15)';"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';">
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1rem; color: white;">
                        <h3 style="margin: 0; font-size: 1.1rem;">{{ $video->name }}</h3>
                    </div>
                    
                    <div style="padding: 1rem;">
                        <div style="margin-bottom: 1rem;">
                            <p style="margin: 0 0 0.5rem 0; color: #666; font-size: 0.9rem;">
                                <strong>نمایش در هر زمان:</strong> 
                                <span style="color: {{ $video->show_any_time ? '#28a745' : '#dc3545' }}; font-weight: 600;">
                                    {{ $video->show_any_time ? '✅ بله' : '❌ خیر' }}
                                </span>
                            </p>
                            <p style="margin: 0; color: #666; font-size: 0.9rem;">
                                <strong>ترتیب:</strong> {{ $video->order }}
                            </p>
                        </div>
                        
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                            <a href="{{ route('epic.digital-taxi-rooftop.default-videos.download', $video->id) }}" 
                               target="_blank"
                               style="flex: 1; padding: 0.5rem 1rem; background: #007bff; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; text-align: center; font-size: 0.875rem;">
                                📥 دانلود
                            </a>
                            
                            <form method="POST" action="{{ route('epic.digital-taxi-rooftop.default-videos.destroy', $video->id) }}" 
                                  style="flex: 1; margin: 0;"
                                  onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید این ویدیو را حذف کنید؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        style="width: 100%; padding: 0.5rem 1rem; background: #dc3545; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.875rem;">
                                    🗑️ حذف
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

