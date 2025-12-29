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
        </div>

        <!-- Step 1: Name and Video -->
        <div v-if="currentStep === 1" class="wizard-step">
            <h3>نام کمپین و ویدیو</h3>
            <div class="form-group">
                <label for="campaign-name" class="label-with-help">
                    نام کمپین *
                    <span class="help-icon" @mouseenter="showHelp = 'name'" @mouseleave="showHelp = null">ℹ️</span>
                </label>
                <div class="input-with-help">
                    <input 
                        id="campaign-name"
                        type="text" 
                        v-model="formData.name" 
                        placeholder="نام کمپین را وارد کنید"
                        minlength="2"
                        maxlength="100"
                        required
                    />
                    <div v-if="showHelp === 'name'" class="help-box">
                        <p><strong>نام کمپین:</strong> این فیلد الزامی است و می‌تواند شامل تمام کاراکترها باشد. حداقل 2 کاراکتر و حداکثر 100 کاراکتر.</p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="video-file" class="label-with-help">
                    فایل ویدیو (اختیاری)
                    <span class="help-icon" @mouseenter="showHelp = 'video'" @mouseleave="showHelp = null">ℹ️</span>
                </label>
                <div class="input-with-help">
                    <input 
                        id="video-file"
                        type="file" 
                        @change="handleVideoUpload"
                        accept="video/mp4,video/mkv,video/avi,video/mov,video/wmv"
                    />
                    <div v-if="showHelp === 'video'" class="help-box">
                        <p><strong>فایل ویدیو:</strong> این فیلد اختیاری است. در صورت آپلود، باید از انواع معتبر ویدیو باشد (mkv, mp4, avi, mov, wmv).</p>
                    </div>
                    <p v-if="formData.videoFile" class="file-info">
                        انتخاب شده: {{ formData.videoFile.name }} ({{ formatFileSize(formData.videoFile.size) }})
                    </p>
                </div>
            </div>
        </div>

        <!-- Step 2: Days, Cars, Locations -->
        <div v-if="currentStep === 2" class="wizard-step">
            <h3>پارامترهای کمپین</h3>
            <div class="form-group">
                <label for="days" class="label-with-help">
                    چند روز *
                    <span class="help-icon" @mouseenter="showHelp = 'days'" @mouseleave="showHelp = null">ℹ️</span>
                </label>
                <div class="input-with-help">
                    <input 
                        id="days"
                        type="number" 
                        v-model.number="formData.days" 
                        placeholder="تعداد روزها را وارد کنید"
                        min="1"
                        max="60"
                        required
                    />
                    <div v-if="showHelp === 'days'" class="help-box">
                        <p><strong>روزها:</strong> این فیلد یک ورودی عددی است. حداقل 1 روز و حداکثر 60 روز.</p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="cars" class="label-with-help">
                    چند ماشین *
                    <span class="help-icon" @mouseenter="showHelp = 'cars'" @mouseleave="showHelp = null">ℹ️</span>
                </label>
                <div class="input-with-help">
                    <input 
                        id="cars"
                        type="number" 
                        v-model.number="formData.cars" 
                        placeholder="تعداد ماشین‌ها را وارد کنید"
                        min="1"
                        max="100"
                        required
                    />
                    <div v-if="showHelp === 'cars'" class="help-box">
                        <p><strong>چند ماشین:</strong> این فیلد یک ورودی عددی است. حداقل 1 ماشین و حداکثر 100 ماشین.</p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="locations" class="label-with-help">
                    موقعیت‌ها (اختیاری) (اگر موقعیت برای شما مهم نیست انتخاب نکنید)
                    <span class="help-icon" @mouseenter="showHelp = 'locations'" @mouseleave="showHelp = null">ℹ️</span>
                </label>
                <div class="input-with-help">
                    <select 
                        id="locations"
                        v-model="formData.locations" 
                        multiple
                        size="6"
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
                    <div v-if="showHelp === 'locations'" class="help-box">
                        <p><strong>موقعیت‌ها:</strong> این فیلد یک ورودی چند انتخابی است و اختیاری می‌باشد. اگر موقعیت برای شما مهم نیست، انتخاب نکنید.</p>
                    </div>
                    <p class="help-text">برای انتخاب چند موقعیت، Ctrl (ویندوز) یا Cmd (مک) را نگه دارید</p>
                    <p v-if="formData.locations.length > 0" class="selected-info">
                        انتخاب شده: {{ formData.locations.length }} موقعیت
                    </p>
                </div>
            </div>
        </div>

        <!-- Step 3: Link and UTMs -->
        <div v-if="currentStep === 3" class="wizard-step">
            <h3>لینک و پارامترهای UTM</h3>
            <div class="form-group">
                <label for="link" class="label-with-help">
                    لینک صفحه فرود (اختیاری)
                    <span class="help-icon" @mouseenter="showHelp = 'link'" @mouseleave="showHelp = null">ℹ️</span>
                </label>
                <div class="input-with-help">
                    <input 
                        id="link"
                        type="url" 
                        v-model="formData.link" 
                        placeholder="https://example.com/landing"
                    />
                    <div v-if="showHelp === 'link'" class="help-box">
                        <p><strong>لینک صفحه فرود:</strong> این فیلد اختیاری است. در صورت وارد کردن، باید یک URL معتبر باشد.</p>
                    </div>
                </div>
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
            
            <!-- Acceptance Criteria -->
            <div class="acceptance-criteria">
                <div class="criteria-header">
                    <span class="criteria-icon">📋</span>
                    <h4>معیارهای پذیرش فرم</h4>
                    <span class="help-icon" @mouseenter="showHelp = 'criteria'" @mouseleave="showHelp = null">ℹ️</span>
                </div>
                <div v-if="showHelp === 'criteria'" class="help-box criteria-help">
                    <ul>
                        <li><strong>نام کمپین:</strong> باید وارد شود (حداقل 2 و حداکثر 100 کاراکتر)</li>
                        <li><strong>فایل ویدیو:</strong> اختیاری - در صورت آپلود باید از انواع معتبر باشد</li>
                        <li><strong>روزها:</strong> باید عددی بین 1 تا 60 باشد</li>
                        <li><strong>ماشین‌ها:</strong> باید عددی بین 1 تا 100 باشد</li>
                        <li><strong>موقعیت‌ها:</strong> اختیاری - می‌توانید انتخاب نکنید</li>
                        <li><strong>لینک فرود:</strong> اختیاری - در صورت وارد کردن باید URL معتبر باشد</li>
                        <li><strong>پارامترهای UTM:</strong> تماماً اختیاری</li>
                    </ul>
                </div>
            </div>
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
                    <span v-else>انتخاب نشده (اختیاری)</span>
                </p>
            </div>

            <div class="overview-section">
                <h4>لینک و ردیابی</h4>
                <p><strong>لینک فرود:</strong> 
                    <a :href="formData.link" target="_blank" v-if="formData.link && formData.link.trim() !== ''">
                        {{ formData.link }}
                    </a>
                    <span v-else>ارائه نشده (اختیاری)</span>
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
            showHelp: null,
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
                    const name = this.formData.name.trim();
                    return name.length >= 2 && name.length <= 100;
                case 2:
                    return this.formData.days >= 1 && 
                           this.formData.days <= 60 &&
                           this.formData.cars >= 1 && 
                           this.formData.cars <= 100;
                case 3:
                    // Link is optional, so step 3 can always proceed
                    return true;
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
            const name = this.formData.name.trim();
            if (!name || name.length < 2 || name.length > 100) {
                alert('لطفاً نام کمپین را وارد کنید (حداقل 2 و حداکثر 100 کاراکتر).');
                return;
            }
            
            if (!this.formData.days || this.formData.days < 1 || this.formData.days > 60) {
                alert('لطفاً تعداد روزها را وارد کنید (بین 1 تا 60).');
                return;
            }
            
            if (!this.formData.cars || this.formData.cars < 1 || this.formData.cars > 100) {
                alert('لطفاً تعداد ماشین‌ها را وارد کنید (بین 1 تا 100).');
                return;
            }
            
            // Validate link if provided
            if (this.formData.link && this.formData.link.trim() !== '') {
                try {
                    new URL(this.formData.link);
                } catch (e) {
                    alert('لینک وارد شده معتبر نیست. لطفاً یک URL معتبر وارد کنید.');
                    return;
                }
            }

            this.submitting = true;

            try {
                // Create FormData for file upload
                const formData = new FormData();
                formData.append('name', this.formData.name.trim());
                if (this.formData.videoFile) {
                    formData.append('video_file', this.formData.videoFile);
                }
                formData.append('days', this.formData.days);
                formData.append('cars', this.formData.cars);
                formData.append('locations', JSON.stringify(this.formData.locations || []));
                if (this.formData.link && this.formData.link.trim() !== '') {
                    formData.append('link', this.formData.link.trim());
                }
                formData.append('utms', JSON.stringify(this.formData.utms));

                const response = await axios.post('/epic/digital-taxi-rooftop/campaign', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                if (response.data.success) {
                    alert('کمپین با موفقیت ایجاد شد! در حال هدایت به صفحه کمپین...');
                    window.location.href = `/epic/digital-taxi-rooftop/campaign/${response.data.campaign_id}`;
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

.label-with-help {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    position: relative;
}

.help-icon {
    font-size: 1rem;
    cursor: help;
    color: #007bff;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #e3f2fd;
}

.help-icon:hover {
    background: #007bff;
    color: white;
    transform: scale(1.1);
}

.input-with-help {
    position: relative;
}

.help-box {
    position: absolute;
    right: 0;
    top: 100%;
    margin-top: 0.5rem;
    background: white;
    border: 2px solid #007bff;
    border-radius: 8px;
    padding: 1rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 1000;
    min-width: 300px;
    max-width: 400px;
    animation: fadeIn 0.3s ease-in;
}

.help-box::before {
    content: '';
    position: absolute;
    bottom: 100%;
    right: 20px;
    border: 8px solid transparent;
    border-bottom-color: #007bff;
}

.help-box p {
    margin: 0;
    color: #333;
    line-height: 1.6;
    font-size: 0.9rem;
}

.help-box strong {
    color: #007bff;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.acceptance-criteria {
    background: #f8f9fa;
    border: 2px solid #28a745;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    position: relative;
}

.criteria-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.criteria-header h4 {
    margin: 0;
    color: #28a745;
    font-size: 1.1rem;
}

.criteria-icon {
    font-size: 1.5rem;
}

.criteria-help {
    position: relative;
    margin-top: 1rem;
    background: white;
    border-color: #28a745;
}

.criteria-help::before {
    border-bottom-color: #28a745;
}

.criteria-help ul {
    margin: 0;
    padding-right: 1.5rem;
    list-style-type: disc;
}

.criteria-help li {
    margin: 0.5rem 0;
    line-height: 1.6;
    color: #333;
}

.criteria-help strong {
    color: #28a745;
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

