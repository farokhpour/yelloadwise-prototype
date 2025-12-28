@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <h1 style="text-align: center; margin-bottom: 2rem;">Digital Taxi Rooftop Integration Demo</h1>
    <p style="text-align: center; color: #666; margin-bottom: 3rem;">
        This page demonstrates how the system integrates with digital taxi rooftop devices
    </p>

    <!-- System Architecture Diagram -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem;">System Architecture</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 2rem;">
            <div style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🚗</div>
                <h3>Digital Taxi Rooftop</h3>
                <p style="color: #666; font-size: 0.9rem;">Device requests video based on location</p>
            </div>
            <div style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🌐</div>
                <h3>Frontend Route</h3>
                <p style="color: #666; font-size: 0.9rem;">Receives API call with route_id</p>
            </div>
            <div style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">⚙️</div>
                <h3>Backend API</h3>
                <p style="color: #666; font-size: 0.9rem;">Processes request and matches campaign</p>
            </div>
            <div style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📦</div>
                <h3>MinIO Bucket</h3>
                <p style="color: #666; font-size: 0.9rem;">Stores and serves video files</p>
            </div>
        </div>
    </div>

    <!-- Flow Diagram -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem;">Request Flow</h2>
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-top: 2rem;">
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #e3f2fd; border-radius: 8px;">
                <strong>1. Taxi Device</strong><br>
                <span style="font-size: 0.875rem; color: #666;">Sends route_id & location</span>
            </div>
            <div style="font-size: 2rem; color: #0066cc;">→</div>
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #e8f5e9; border-radius: 8px;">
                <strong>2. API Endpoint</strong><br>
                <span style="font-size: 0.875rem; color: #666;">/api/video?route_id=X</span>
            </div>
            <div style="font-size: 2rem; color: #0066cc;">→</div>
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #fff3e0; border-radius: 8px;">
                <strong>3. Match Campaign</strong><br>
                <span style="font-size: 0.875rem; color: #666;">Find running campaign for location</span>
            </div>
            <div style="font-size: 2rem; color: #0066cc;">→</div>
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #f3e5f5; border-radius: 8px;">
                <strong>4. Get Video</strong><br>
                <span style="font-size: 0.875rem; color: #666;">Retrieve from MinIO</span>
            </div>
            <div style="font-size: 2rem; color: #0066cc;">→</div>
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #e0f2f1; border-radius: 8px;">
                <strong>5. Display</strong><br>
                <span style="font-size: 0.875rem; color: #666;">Show video on rooftop</span>
            </div>
        </div>
    </div>

    <!-- Running Campaigns -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem;">Currently Running Campaigns</h2>
        @if($campaigns->count() > 0)
            <div style="display: grid; gap: 1.5rem; margin-top: 1.5rem;">
                @foreach($campaigns as $campaign)
                    <div style="border: 2px solid #dee2e6; border-radius: 8px; padding: 1.5rem;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                            <div>
                                <strong>Campaign:</strong> {{ $campaign->name }}<br>
                                <strong>Locations:</strong> {{ implode(', ', $campaign->locations) }}
                            </div>
                            <div>
                                <strong>Video File:</strong><br>
                                <code style="background: #f8f9fa; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.875rem;">
                                    {{ $campaign->video_file }}
                                </code>
                            </div>
                            <div>
                                <strong>API Test:</strong><br>
                                <a href="/api/video?route_id={{ $campaign->locations[0] ?? 'route-1' }}" 
                                   target="_blank"
                                   style="display: inline-block; padding: 0.5rem 1rem; background: #007bff; color: white; text-decoration: none; border-radius: 4px; font-size: 0.875rem; margin-top: 0.5rem;">
                                    Test API Call
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p style="color: #666; text-align: center; padding: 2rem;">No campaigns are currently running.</p>
        @endif
    </div>

    <!-- MinIO Bucket Simulation -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem;">MinIO Bucket (Video Storage)</h2>
        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; border-left: 4px solid #0066cc;">
            <p style="margin-bottom: 1rem;"><strong>Bucket Path:</strong> <code>campaigns/videos/</code></p>
            <div style="background: white; padding: 1rem; border-radius: 4px; font-family: monospace; font-size: 0.875rem;">
                <div style="padding: 0.5rem; border-bottom: 1px solid #dee2e6;">
                    📁 campaigns/<br>
                    &nbsp;&nbsp;📁 videos/<br>
                    @foreach($campaigns as $campaign)
                        &nbsp;&nbsp;&nbsp;&nbsp;🎬 {{ basename($campaign->video_file) }}<br>
                    @endforeach
                </div>
            </div>
            <p style="margin-top: 1rem; color: #666; font-size: 0.9rem;">
                <strong>Note:</strong> In production, videos are stored in MinIO object storage. 
                The backend API retrieves video URLs from MinIO and serves them to the digital taxi devices.
            </p>
        </div>
    </div>

    <!-- API Documentation -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem;">API Endpoint Documentation</h2>
        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
            <h3 style="margin-bottom: 1rem;">GET /api/video</h3>
            <p><strong>Description:</strong> Digital taxi rooftop devices call this endpoint to get video content based on their location.</p>
            
            <div style="background: white; padding: 1rem; border-radius: 4px; margin: 1rem 0;">
                <strong>Parameters:</strong>
                <ul style="margin: 0.5rem 0; padding-left: 1.5rem;">
                    <li><code>route_id</code> (required) - The route identifier (e.g., route-1, route-2)</li>
                    <li><code>location</code> (optional) - Additional location data</li>
                </ul>
            </div>

            <div style="background: white; padding: 1rem; border-radius: 4px; margin: 1rem 0;">
                <strong>Response (Success):</strong>
                <pre style="background: #f8f9fa; padding: 1rem; border-radius: 4px; overflow-x: auto; font-size: 0.875rem;">{
  "success": true,
  "campaign_id": 1,
  "campaign_name": "Summer Campaign",
  "video_url": "https://minio.example.com/bucket/video.mp4",
  "link": "https://example.com/landing",
  "utms": {
    "utm_source": "taxi_rooftop",
    "utm_medium": "display"
  }
}</pre>
            </div>

            <div style="background: white; padding: 1rem; border-radius: 4px; margin: 1rem 0;">
                <strong>Response (No Campaign):</strong>
                <pre style="background: #f8f9fa; padding: 1rem; border-radius: 4px; overflow-x: auto; font-size: 0.875rem;">{
  "success": false,
  "message": "No active campaigns for this location"
}</pre>
            </div>

            <div style="margin-top: 1.5rem;">
                <strong>Example Request:</strong>
                <div style="background: white; padding: 1rem; border-radius: 4px; margin-top: 0.5rem;">
                    <code style="font-size: 0.875rem;">
                        GET /api/video?route_id=route-1&location=downtown
                    </code>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 3rem; border-radius: 12px; color: white; margin-top: 3rem;">
        <h2 style="margin-bottom: 1.5rem;">How The System Works</h2>
        <ol style="line-height: 2; padding-left: 1.5rem;">
            <li><strong>Campaign Creation:</strong> User creates campaign with video, selects locations, and sets parameters.</li>
            <li><strong>Admin Approval:</strong> Admin reviews, sets cost, and approves campaign.</li>
            <li><strong>Payment:</strong> User pays for the campaign.</li>
            <li><strong>Campaign Activation:</strong> Admin starts the campaign, changing status to "running".</li>
            <li><strong>Device Integration:</strong> Digital taxi rooftop devices call the API with their route_id.</li>
            <li><strong>Video Matching:</strong> Backend finds running campaigns matching the route_id.</li>
            <li><strong>Video Delivery:</strong> Backend retrieves video from MinIO and returns URL to device.</li>
            <li><strong>Display:</strong> Device displays video on the rooftop screen.</li>
        </ol>
    </div>
</div>
@endsection

