# Digital Taxi Rooftop Campaign Management System

## Complete System Overview

This is a comprehensive campaign management system for digital taxi rooftop advertising with the following features:

## User Journey

### 1. Campaign Creation (`/campaigns/create`)
- **Vue.js Wizard** with 4 steps:
  - **Step 1:** Campaign name and video file upload
  - **Step 2:** Days, cars, and location selection (multi-select from 12 routes)
  - **Step 3:** Landing page link and UTM parameters
  - **Step 4:** Overview and submission
- Creates campaign with status: `waiting_admin_approval`

### 2. Admin Approval (`/admin/campaigns/{id}/edit`)
- Admin can view and edit all campaign data
- Admin sets `cost_per_day`
- Admin approves campaign → status: `waiting_payment`

### 3. Payment (`/campaigns/{id}/payment`)
- User views campaign summary and total cost
- User processes payment → status: `waiting_to_run`

### 4. Admin Run Campaign (`/admin/campaigns/{id}/edit`)
- Admin can run the campaign → status: `running`
- Campaign starts displaying on digital taxi rooftops

### 5. Integration Demo (`/integration/demo`)
- Visual explanation of how the system works
- Shows MinIO bucket structure
- Demonstrates API integration
- Shows request/response flow

## Database Schema

### Campaigns Table
- `id` - Primary key
- `name` - Campaign name
- `video_file` - Path to video in storage (MinIO)
- `days` - Number of days
- `cars` - Number of cars
- `locations` - JSON array of selected routes (12 available)
- `link` - Landing page URL
- `utms` - JSON object with UTM parameters
- `cost_per_day` - Set by admin
- `status` - Enum: draft, waiting_admin_approval, waiting_payment, waiting_to_run, running, completed, cancelled
- `approved_at`, `paid_at`, `started_at`, `ended_at` - Timestamps
- `created_at`, `updated_at` - Laravel timestamps

## Routes

### User Routes
- `GET /campaigns/create` - Create campaign (wizard)
- `POST /campaigns` - Store campaign
- `GET /campaigns/{id}` - View campaign
- `GET /campaigns/{id}/payment` - Payment page
- `POST /campaigns/{id}/payment` - Process payment

### Admin Routes
- `GET /admin/campaigns` - List all campaigns
- `GET /admin/campaigns/{id}/edit` - Edit campaign
- `PUT /admin/campaigns/{id}` - Update campaign
- `POST /admin/campaigns/{id}/approve` - Approve campaign
- `POST /admin/campaigns/{id}/run` - Run campaign

### API Routes (for Digital Taxi Devices)
- `GET /api/video?route_id=X&location=Y` - Get video for location

### Demo Route
- `GET /integration/demo` - Integration demonstration page

## Status Flow

```
draft → waiting_admin_approval → waiting_payment → waiting_to_run → running
```

## Available Locations (12 Routes)

1. Route 1 - Downtown Core
2. Route 2 - Financial District
3. Route 3 - Shopping District
4. Route 4 - Airport Corridor
5. Route 5 - University Area
6. Route 6 - Entertainment Zone
7. Route 7 - Business Park
8. Route 8 - Residential North
9. Route 9 - Residential South
10. Route 10 - Industrial Area
11. Route 11 - Waterfront
12. Route 12 - Suburban Hub

## API Integration

### How Digital Taxi Rooftop Devices Work

1. **Device calls API:** `GET /api/video?route_id=route-1&location=downtown`
2. **Backend processes:**
   - Finds running campaigns matching the route_id
   - Retrieves video file path from database
   - Gets video URL from MinIO storage
   - Returns JSON with video URL and campaign data
3. **Device displays:** Video on rooftop screen

### API Response Format

**Success:**
```json
{
  "success": true,
  "campaign_id": 1,
  "campaign_name": "Summer Campaign",
  "video_url": "https://minio.example.com/bucket/video.mp4",
  "link": "https://example.com/landing",
  "utms": {
    "utm_source": "taxi_rooftop",
    "utm_medium": "display"
  }
}
```

**No Campaign:**
```json
{
  "success": false,
  "message": "No active campaigns for this location"
}
```

## File Structure

```
application/
├── app/
│   ├── Http/Controllers/
│   │   ├── CampaignController.php (user operations)
│   │   ├── AdminCampaignController.php (admin operations)
│   │   ├── IntegrationDemoController.php (demo & API)
│   │   └── PaymentController.php
│   └── Models/
│       └── Campaign.php
├── database/migrations/
│   └── 2025_12_28_102514_create_campaigns_table.php
├── resources/
│   ├── js/
│   │   ├── components/
│   │   │   └── CampaignWizard.vue (4-step wizard)
│   │   └── campaign-wizard.js (Vue mounting)
│   └── views/
│       ├── campaigns/
│       │   ├── create.blade.php
│       │   ├── show.blade.php
│       │   └── payment.blade.php
│       ├── admin/campaigns/
│       │   ├── index.blade.php
│       │   └── edit.blade.php
│       └── integration/
│           └── demo.blade.php
└── routes/
    └── web.php
```

## Testing the System

1. **Create Campaign:**
   - Visit: `http://localhost:8080/campaigns/create`
   - Fill wizard and submit

2. **Admin Approval:**
   - Visit: `http://localhost:8080/admin/campaigns`
   - Click "Edit" on campaign
   - Set cost per day
   - Click "Approve Campaign"

3. **Payment:**
   - Visit campaign show page
   - Click "Proceed to Payment"
   - Process payment

4. **Run Campaign:**
   - Admin visits edit page
   - Clicks "Run Campaign"

5. **Test API:**
   - Visit: `http://localhost:8080/api/video?route_id=route-1`
   - Should return JSON with video URL

6. **View Integration Demo:**
   - Visit: `http://localhost:8080/integration/demo`
   - See visual explanation of system

## Notes

- **Video Storage:** Currently uses Laravel's public storage. In production, integrate with MinIO.
- **Payment:** Prototype simulates payment. In production, integrate with payment gateway.
- **Authentication:** Currently no auth. Add middleware as needed.
- **File Upload:** Max 100MB for videos (configurable in controller).

## Next Steps for Production

1. Add authentication (Laravel Breeze/Sanctum)
2. Integrate MinIO for video storage
3. Add payment gateway (Stripe, PayPal, etc.)
4. Add email notifications
5. Add campaign analytics
6. Add admin dashboard with statistics
7. Add video processing/transcoding
8. Add location-based targeting logic
9. Add scheduling system
10. Add reporting and analytics

