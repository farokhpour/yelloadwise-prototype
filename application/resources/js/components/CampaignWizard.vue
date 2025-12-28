<template>
    <div class="wizard-container">
        <div class="wizard-header">
            <h2>کمپین نمایشگر تاکسی دیجیتال</h2>
            <div class="step-indicator">
                <div 
                    v-for="(step, index) in steps" 
                    :key="index"
                    :class="['step-dot', { active: currentStep === index + 1, completed: currentStep > index + 1 }]"
                >
                    {{ index + 1 }}
                </div>
            </div>
            <p class="step-title">{{ steps[currentStep - 1] }}</p>
            
            <!-- Developer Notes Toggle -->
            <button 
                @click="showDeveloperNotes = !showDeveloperNotes" 
                class="dev-notes-toggle"
                type="button"
            >
                {{ showDeveloperNotes ? '🔒 مخفی کردن' : '👨‍💻 نمایش' }} یادداشت‌های توسعه‌دهنده
            </button>
        </div>

        <!-- Developer Notes Panel -->
        <div v-if="showDeveloperNotes" class="developer-notes">
            <h3>📋 یادداشت‌های توسعه‌دهنده - قوانین اعتبارسنجی</h3>
            <div class="notes-content">
                <div class="note-section">
                    <h4>مرحله 1: نام و ویدیو</h4>
                    <ul>
                        <li><strong>نام کمپین:</strong> الزامی، رشته، حداکثر 255 کاراکتر</li>
                        <li><strong>فایل ویدیو:</strong> الزامی، نوع فایل: mp4, avi, mov, wmv، حداکثر 500MB (100MB در اعتبارسنجی، اما سرور 500MB را مجاز می‌کند)</li>
                    </ul>
                </div>
                <div class="note-section">
                    <h4>مرحله 2: پارامترها</h4>
                    <ul>
                        <li><strong>روزها:</strong> الزامی، عدد صحیح، حداقل 1</li>
                        <li><strong>ماشین‌ها:</strong> الزامی، عدد صحیح، حداقل 1</li>
                        <li><strong>موقعیت‌ها:</strong> الزامی، آرایه، حداقل 1 موقعیت انتخاب شده (از 12 مسیر موجود)</li>
                    </ul>
                </div>
                <div class="note-section">
                    <h4>مرحله 3: لینک و UTM</h4>
                    <ul>
                        <li><strong>لینک فرود:</strong> الزامی، فرمت URL معتبر</li>
                        <li><strong>پارامترهای UTM:</strong> اختیاری، تمام فیلدها رشته‌های اختیاری هستند</li>
                        <li>فیلدهای UTM: utm_source, utm_medium, utm_campaign, utm_term, utm_content</li>
                    </ul>
                </div>
                <div class="note-section">
                    <h4>اعتبارسنجی بک‌اند (CampaignController@store)</h4>
                    <pre class="code-block">قوانین اعتبارسنجی:
- name: required|string|max:255
- video_file: required|file|mimes:mp4,avi,mov,wmv|max:102400
- days: required|integer|min:1
- cars: required|integer|min:1
- locations: required|string (JSON)
- link: required|url
- utms: nullable|string (JSON)

وضعیت پس از ایجاد: 'waiting_admin_approval'</pre>
                </div>
                <div class="note-section">
                    <h4>اعتبارسنجی فرانت‌اند</h4>
                    <ul>
                        <li><strong>مرحله 1:</strong> نام الزامی (غیر خالی)، فایل ویدیو الزامی</li>
                        <li><strong>مرحله 2:</strong> روزها >= 1، ماشین‌ها >= 1، حداقل 1 موقعیت انتخاب شده</li>
                        <li><strong>مرحله 3:</strong> فرمت URL معتبر برای لینک فرود، UTM اختیاری</li>
                        <li><strong>مرحله 4:</strong> تمام اعتبارسنجی‌های قبلی باید پاس شوند</li>
                    </ul>
                </div>
                <div class="note-section">
                    <h4>نقطه پایانی API</h4>
                    <pre class="code-block">POST /campaigns
Content-Type: multipart/form-data

بدنه درخواست (FormData):
- name: string
- video_file: File
- days: integer
- cars: integer
- locations: JSON string (array)
- link: URL string
- utms: JSON string (object)

پاسخ:
{
  "success": true,
  "campaign_id": 1,
  "message": "Campaign created successfully"
}</pre>
                </div>
                <div class="note-section">
                    <h4>جزئیات آپلود فایل</h4>
                    <ul>
                        <li><strong>حداکثر اندازه:</strong> 500MB (پیکربندی سرور)، 100MB (قانون اعتبارسنجی)</li>
                        <li><strong>فرمت‌های پذیرفته شده:</strong> MP4, AVI, MOV, WMV</li>
                        <li><strong>ذخیره‌سازی:</strong> public/campaigns/videos/ (ذخیره‌سازی Laravel)</li>
                        <li><strong>تولید:</strong> باید از ذخیره‌سازی شی MinIO استفاده کند</li>
                    </ul>
                </div>
                <div class="note-section">
                    <h4>فرمت داده</h4>
                    <pre class="code-block">موقعیت‌ها (رشته JSON):
["route-1", "route-2", "route-3"]

UTM (رشته JSON):
{
  "utm_source": "google",
  "utm_medium": "cpc",
  "utm_campaign": "summer_sale",
  "utm_term": "taxi",
  "utm_content": "video"
}</pre>
                </div>
            </div>
        </div>

        <!-- Step 1: Name and Video -->
        <div v-if="currentStep === 1" class="wizard-step">
            <h3>نام کمپین و ویدیو</h3>
            <div class="form-group">
                <label for="campaign-name">نام کمپین *</label>
                <input 
                    id="campaign-name"
                    type="text" 
                    v-model="formData.name" 
                    placeholder="نام کمپین را وارد کنید"
                    required
                />
            </div>
            <div class="form-group">
                <label for="video-file">فایل ویدیو *</label>
                <input 
                    id="video-file"
                    type="file" 
                    @change="handleVideoUpload"
                    accept="video/*"
                    required
                />
                <p v-if="formData.videoFile" class="file-info">
                    انتخاب شده: {{ formData.videoFile.name }} ({{ formatFileSize(formData.videoFile.size) }})
                </p>
            </div>
        </div>

        <!-- Step 2: Days, Cars, Locations -->
        <div v-if="currentStep === 2" class="wizard-step">
            <h3>پارامترهای کمپین</h3>
            <div class="form-group">
                <label for="days">چند روز *</label>
                <input 
                    id="days"
                    type="number" 
                    v-model.number="formData.days" 
                    placeholder="تعداد روزها را وارد کنید"
                    min="1"
                    required
                />
            </div>
            <div class="form-group">
                <label for="cars">چند ماشین *</label>
                <input 
                    id="cars"
                    type="number" 
                    v-model.number="formData.cars" 
                    placeholder="تعداد ماشین‌ها را وارد کنید"
                    min="1"
                    required
                />
            </div>
            <div class="form-group">
                <label for="locations">موقعیت‌ها * (چندتایی انتخاب کنید)</label>
                <select 
                    id="locations"
                    v-model="formData.locations" 
                    multiple
                    size="6"
                    required
                >
                    <option value="route-1">مسیر 1 - مرکز شهر</option>
                    <option value="route-2">مسیر 2 - منطقه مالی</option>
                    <option value="route-3">مسیر 3 - منطقه خرید</option>
                    <option value="route-4">مسیر 4 - کریدور فرودگاه</option>
                    <option value="route-5">مسیر 5 - منطقه دانشگاه</option>
                    <option value="route-6">مسیر 6 - منطقه تفریحی</option>
                    <option value="route-7">مسیر 7 - پارک تجاری</option>
                    <option value="route-8">مسیر 8 - مسکونی شمال</option>
                    <option value="route-9">مسیر 9 - مسکونی جنوب</option>
                    <option value="route-10">مسیر 10 - منطقه صنعتی</option>
                    <option value="route-11">مسیر 11 - ساحلی</option>
                    <option value="route-12">مسیر 12 - مرکز حومه</option>
                </select>
                <p class="help-text">برای انتخاب چند موقعیت، Ctrl (ویندوز) یا Cmd (مک) را نگه دارید</p>
                <p v-if="formData.locations.length > 0" class="selected-info">
                    انتخاب شده: {{ formData.locations.length }} موقعیت
                </p>
            </div>
        </div>

        <!-- Step 3: Link and UTMs -->
        <div v-if="currentStep === 3" class="wizard-step">
            <h3>لینک و پارامترهای UTM</h3>
            <div class="form-group">
                <label for="link">لینک صفحه فرود *</label>
                <input 
                    id="link"
                    type="url" 
                    v-model="formData.link" 
                    placeholder="https://example.com/landing"
                    required
                />
            </div>
            <div class="form-group">
                <label>پارامترهای UTM</label>
                <div class="utm-group">
                    <input 
                        type="text" 
                        v-model="formData.utms.utm_source" 
                        placeholder="utm_source (مثال: taxi_rooftop)"
                    />
                    <input 
                        type="text" 
                        v-model="formData.utms.utm_medium" 
                        placeholder="utm_medium (مثال: display)"
                    />
                    <input 
                        type="text" 
                        v-model="formData.utms.utm_campaign" 
                        placeholder="utm_campaign (مثال: summer_promo)"
                    />
                    <input 
                        type="text" 
                        v-model="formData.utms.utm_term" 
                        placeholder="utm_term (اختیاری)"
                    />
                    <input 
                        type="text" 
                        v-model="formData.utms.utm_content" 
                        placeholder="utm_content (اختیاری)"
                    />
                </div>
            </div>
        </div>

        <!-- Step 4: Overview -->
        <div v-if="currentStep === 4" class="wizard-step">
            <h3>نمای کلی کمپین</h3>
            <div class="overview-section">
                <h4>اطلاعات کمپین</h4>
                <p><strong>نام:</strong> {{ formData.name || 'ارائه نشده' }}</p>
                <p><strong>ویدیو:</strong> {{ formData.videoFile ? formData.videoFile.name : 'آپلود نشده' }}</p>
            </div>

            <div class="overview-section">
                <h4>پارامترهای کمپین</h4>
                <p><strong>روزها:</strong> {{ formData.days || 'مشخص نشده' }}</p>
                <p><strong>ماشین‌ها:</strong> {{ formData.cars || 'مشخص نشده' }}</p>
                <p><strong>موقعیت‌ها:</strong> 
                    <span v-if="formData.locations && formData.locations.length > 0">
                        {{ formData.locations.join('، ') }}
                    </span>
                    <span v-else>مشخص نشده</span>
                </p>
            </div>

            <div class="overview-section">
                <h4>لینک و ردیابی</h4>
                <p><strong>لینک فرود:</strong> 
                    <a :href="formData.link" target="_blank" v-if="formData.link">
                        {{ formData.link }}
                    </a>
                    <span v-else>ارائه نشده</span>
                </p>
                <p v-if="hasUtms()"><strong>پارامترهای UTM:</strong></p>
                <ul v-if="hasUtms()" class="utm-list">
                    <li v-for="(value, key) in formData.utms" :key="key" v-if="value">
                        <strong>{{ key }}:</strong> {{ value }}
                    </li>
                </ul>
            </div>

            <div class="form-group">
                <button type="button" @click="submitCampaign" class="btn-submit" :disabled="submitting">
                    {{ submitting ? 'در حال ایجاد کمپین...' : 'ایجاد کمپین' }}
                </button>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="wizard-navigation">
            <button 
                v-if="currentStep < 4" 
                @click="nextStep" 
                class="btn btn-primary"
                :disabled="!canProceed"
            >
                بعدی
            </button>
            <button 
                v-if="currentStep > 1" 
                @click="prevStep" 
                class="btn btn-secondary"
            >
                قبلی
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'CampaignWizard',
    data() {
        return {
            currentStep: 1,
            steps: ['نام و ویدیو', 'پارامترها', 'لینک و UTM', 'نمای کلی'],
            submitting: false,
            showDeveloperNotes: false,
            formData: {
                name: '',
                videoFile: null,
                days: null,
                cars: null,
                locations: [],
                link: '',
                utms: {
                    utm_source: '',
                    utm_medium: '',
                    utm_campaign: '',
                    utm_term: '',
                    utm_content: ''
                }
            }
        }
    },
    computed: {
        canProceed() {
            switch(this.currentStep) {
                case 1:
                    return this.formData.name.trim() !== '' && this.formData.videoFile !== null;
                case 2:
                    return this.formData.days > 0 && 
                           this.formData.cars > 0 && 
                           this.formData.locations.length > 0;
                case 3:
                    return this.formData.link.trim() !== '';
                default:
                    return true;
            }
        }
    },
    methods: {
        handleVideoUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.formData.videoFile = file;
            }
        },
        formatFileSize(bytes) {
            if (bytes === 0) return '0 بایت';
            const k = 1024;
            const sizes = ['بایت', 'کیلوبایت', 'مگابایت', 'گیگابایت'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        },
        hasUtms() {
            return Object.values(this.formData.utms).some(val => val && val.trim() !== '');
        },
        nextStep() {
            if (this.canProceed && this.currentStep < 4) {
                this.currentStep++;
            }
        },
        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
            }
        },
        async submitCampaign() {
            if (this.submitting) return;

            // Validate required fields
            if (!this.formData.name || !this.formData.videoFile || 
                !this.formData.days || !this.formData.cars || 
                this.formData.locations.length === 0 || !this.formData.link) {
                alert('لطفاً تمام فیلدهای الزامی را قبل از ارسال پر کنید.');
                return;
            }

            this.submitting = true;

            try {
                // Create FormData for file upload
                const formData = new FormData();
                formData.append('name', this.formData.name);
                formData.append('video_file', this.formData.videoFile);
                formData.append('days', this.formData.days);
                formData.append('cars', this.formData.cars);
                formData.append('locations', JSON.stringify(this.formData.locations));
                formData.append('link', this.formData.link);
                formData.append('utms', JSON.stringify(this.formData.utms));

                const response = await axios.post('/campaigns', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                if (response.data.success) {
                    alert('کمپین با موفقیت ایجاد شد! در حال هدایت به صفحه کمپین...');
                    window.location.href = `/campaigns/${response.data.campaign_id}`;
                } else {
                    alert('خطا در ایجاد کمپین: ' + (response.data.message || 'خطای ناشناخته'));
                }
            } catch (error) {
                console.error('Error submitting campaign:', error);
                alert('خطا در ایجاد کمپین. لطفاً دوباره تلاش کنید.');
            } finally {
                this.submitting = false;
            }
        }
    }
}
</script>

<style scoped>
.wizard-container {
    max-width: 900px;
    margin: 2rem auto;
    padding: 2rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.wizard-header {
    margin-bottom: 2rem;
    text-align: center;
}

.wizard-header h2 {
    color: #0066cc;
    margin-bottom: 1rem;
}

.step-indicator {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin: 1.5rem 0;
}

.step-dot {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e0e0e0;
    color: #666;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    transition: all 0.3s;
}

.step-dot.active {
    background: #0066cc;
    color: white;
    transform: scale(1.1);
}

.step-dot.completed {
    background: #4caf50;
    color: white;
}

.step-title {
    font-size: 1.2rem;
    color: #333;
    font-weight: 500;
}

.wizard-step {
    min-height: 400px;
    padding: 1rem 0;
}

.wizard-step h3 {
    color: #333;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid #0066cc;
    padding-bottom: 0.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: #333;
    font-weight: 500;
}

.form-group input[type="text"],
.form-group input[type="url"],
.form-group input[type="number"],
.form-group input[type="file"],
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #ddd;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.3s;
    box-sizing: border-box;
}

.form-group select[multiple] {
    min-height: 150px;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #0066cc;
}

.file-info, .help-text, .selected-info {
    margin-top: 0.5rem;
    font-size: 0.9rem;
    color: #666;
}

.utm-group {
    display: grid;
    grid-template-columns: 1fr;
    gap: 0.75rem;
}

.overview-section {
    background: #f5f5f5;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.overview-section h4 {
    color: #0066cc;
    margin-bottom: 1rem;
    border-bottom: 1px solid #ddd;
    padding-bottom: 0.5rem;
}

.overview-section p {
    margin: 0.5rem 0;
    color: #333;
    line-height: 1.6;
}

.overview-section strong {
    color: #555;
    min-width: 150px;
    display: inline-block;
}

.utm-list {
    list-style: none;
    padding: 0;
    margin: 0.5rem 0;
}

.utm-list li {
    padding: 0.25rem 0;
    color: #333;
}

.wizard-navigation {
    display: flex;
    justify-content: space-between;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 2px solid #eee;
}

.btn {
    padding: 0.75rem 2rem;
    border: none;
    border-radius: 6px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-primary {
    background: #0066cc;
    color: white;
}

.btn-primary:hover:not(:disabled) {
    background: #0052a3;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 102, 204, 0.3);
}

.btn-primary:disabled {
    background: #ccc;
    cursor: not-allowed;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
}

.btn-submit {
    width: 100%;
    padding: 1rem;
    background: #4caf50;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    margin-top: 1rem;
}

.btn-submit:hover:not(:disabled) {
    background: #45a049;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(76, 175, 80, 0.4);
}

.btn-submit:disabled {
    background: #ccc;
    cursor: not-allowed;
}

.overview-section a {
    color: #0066cc;
    text-decoration: none;
}

.overview-section a:hover {
    text-decoration: underline;
}

.dev-notes-toggle {
    margin-top: 1rem;
    padding: 0.5rem 1rem;
    background: #6c757d;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s;
}

.dev-notes-toggle:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

.developer-notes {
    background: #f8f9fa;
    border: 2px solid #007bff;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    max-height: 600px;
    overflow-y: auto;
}

.developer-notes h3 {
    color: #007bff;
    margin-bottom: 1rem;
    border-bottom: 2px solid #007bff;
    padding-bottom: 0.5rem;
}

.notes-content {
    display: grid;
    gap: 1.5rem;
}

.note-section {
    background: white;
    padding: 1rem;
    border-radius: 6px;
    border-left: 4px solid #007bff;
}

.note-section h4 {
    color: #333;
    margin-bottom: 0.75rem;
    font-size: 1rem;
}

.note-section ul {
    margin: 0;
    padding-left: 1.5rem;
    color: #555;
}

.note-section li {
    margin: 0.5rem 0;
    line-height: 1.6;
}

.note-section strong {
    color: #007bff;
}

.code-block {
    background: #2d2d2d;
    color: #f8f8f2;
    padding: 1rem;
    border-radius: 4px;
    overflow-x: auto;
    font-family: 'Courier New', monospace;
    font-size: 0.875rem;
    line-height: 1.6;
    margin: 0.5rem 0;
}
</style>

