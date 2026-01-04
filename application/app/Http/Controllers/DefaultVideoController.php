<?php

namespace App\Http\Controllers;

use App\Models\DefaultVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DefaultVideoController extends Controller
{
    public function index()
    {
        $videos = DefaultVideo::orderBy('order')->get();
        $maxVideos = 4;
        $canAddMore = $videos->count() < $maxVideos;
        
        return view('default-videos.index', compact('videos', 'maxVideos', 'canAddMore'));
    }

    public function create()
    {
        $videos = DefaultVideo::count();
        $maxVideos = 4;
        
        if ($videos >= $maxVideos) {
            return redirect()->route('epic.digital-taxi-rooftop.default-videos.index')
                ->with('error', 'حداکثر ' . $maxVideos . ' ویدیو پیش‌فرض می‌توانید اضافه کنید.');
        }
        
        return view('default-videos.create');
    }

    public function store(Request $request)
    {
        $videos = DefaultVideo::count();
        $maxVideos = 4;
        
        if ($videos >= $maxVideos) {
            return redirect()->route('epic.digital-taxi-rooftop.default-videos.index')
                ->with('error', 'حداکثر ' . $maxVideos . ' ویدیو پیش‌فرض می‌توانید اضافه کنید.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'video_file' => 'required|file|mimes:mp4,avi,mov,wmv,flv|max:102400', // 100MB max
            'show_any_time' => 'boolean',
        ]);

        $videoData = [
            'name' => $validated['name'],
            'show_any_time' => $request->has('show_any_time') ? true : false,
            'order' => DefaultVideo::max('order') + 1,
        ];

        // Handle video upload
        if ($request->hasFile('video_file')) {
            $videoData['video_file'] = $request->file('video_file')->store('default-videos', 'public');
        }

        DefaultVideo::create($videoData);

        return redirect()->route('epic.digital-taxi-rooftop.default-videos.index')
            ->with('success', 'ویدیو پیش‌فرض با موفقیت اضافه شد!');
    }

    public function destroy($id)
    {
        $video = DefaultVideo::findOrFail($id);
        
        // Delete video file
        if ($video->video_file && Storage::disk('public')->exists($video->video_file)) {
            Storage::disk('public')->delete($video->video_file);
        }
        
        $video->delete();

        return redirect()->route('epic.digital-taxi-rooftop.default-videos.index')
            ->with('success', 'ویدیو پیش‌فرض با موفقیت حذف شد!');
    }

    public function download($id)
    {
        $video = DefaultVideo::findOrFail($id);
        
        if (!$video->video_file || !Storage::disk('public')->exists($video->video_file)) {
            return back()->with('error', 'فایل ویدیو یافت نشد.');
        }
        
        return Storage::disk('public')->download($video->video_file);
    }
}

