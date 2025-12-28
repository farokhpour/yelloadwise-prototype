<template>
    <div class="wizard-container">
        <div class="wizard-header">
            <h2>Campaign Wizard</h2>
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

        <!-- Step 1: Details -->
        <div v-if="currentStep === 1" class="wizard-step">
            <h3>Campaign Details</h3>
            <div class="form-group">
                <label for="campaign-name">Campaign Name *</label>
                <input 
                    id="campaign-name"
                    type="text" 
                    v-model="formData.campaignName" 
                    placeholder="Enter campaign name"
                    required
                />
            </div>
            <div class="form-group">
                <label for="campaign-details">Campaign Details *</label>
                <textarea 
                    id="campaign-details"
                    v-model="formData.campaignDetails" 
                    placeholder="Enter campaign details"
                    rows="5"
                    required
                ></textarea>
            </div>
        </div>

        <!-- Step 2: Demography -->
        <div v-if="currentStep === 2" class="wizard-step">
            <h3>Demography Filters</h3>
            <div class="form-group">
                <label for="province">Province</label>
                <select id="province" v-model="formData.province">
                    <option value="">Select Province</option>
                    <option value="ontario">Ontario</option>
                    <option value="quebec">Quebec</option>
                    <option value="british-columbia">British Columbia</option>
                    <option value="alberta">Alberta</option>
                    <option value="manitoba">Manitoba</option>
                </select>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input 
                    id="city"
                    type="text" 
                    v-model="formData.city" 
                    placeholder="Enter city"
                />
            </div>
            <div class="form-group">
                <label for="age">Age Range</label>
                <div class="age-range">
                    <input 
                        type="number" 
                        v-model.number="formData.ageMin" 
                        placeholder="Min"
                        min="0"
                        max="120"
                    />
                    <span>to</span>
                    <input 
                        type="number" 
                        v-model.number="formData.ageMax" 
                        placeholder="Max"
                        min="0"
                        max="120"
                    />
                </div>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" v-model="formData.gender">
                    <option value="">All</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="behavior">Behavior</label>
                <input 
                    id="behavior"
                    type="text" 
                    v-model="formData.behavior" 
                    placeholder="Enter behavior filters"
                />
            </div>
        </div>

        <!-- Step 3: Message -->
        <div v-if="currentStep === 3" class="wizard-step">
            <h3>Campaign Message</h3>
            <div class="form-group">
                <label for="message">Message *</label>
                <textarea 
                    id="message"
                    v-model="formData.message" 
                    placeholder="Enter your campaign message"
                    rows="8"
                    required
                ></textarea>
            </div>
        </div>

        <!-- Step 4: Time and Link -->
        <div v-if="currentStep === 4" class="wizard-step">
            <h3>Time and Link</h3>
            <div class="form-group">
                <label for="how-many">How Many *</label>
                <input 
                    id="how-many"
                    type="number" 
                    v-model.number="formData.howMany" 
                    placeholder="Enter number"
                    min="1"
                    required
                />
            </div>
            <div class="form-group">
                <label for="landing-link">Landing Page Link *</label>
                <input 
                    id="landing-link"
                    type="url" 
                    v-model="formData.landingLink" 
                    placeholder="https://example.com"
                    required
                />
            </div>
            <div class="form-group">
                <label for="campaign-date">Campaign Date *</label>
                <input 
                    id="campaign-date"
                    type="date" 
                    v-model="formData.campaignDate" 
                    required
                />
            </div>
        </div>

        <!-- Step 5: Overview -->
        <div v-if="currentStep === 5" class="wizard-step">
            <h3>Overview</h3>
            <div class="overview-section">
                <h4>Campaign Details</h4>
                <p><strong>Name:</strong> {{ formData.campaignName || 'Not provided' }}</p>
                <p><strong>Details:</strong> {{ formData.campaignDetails || 'Not provided' }}</p>
            </div>

            <div class="overview-section">
                <h4>Demography</h4>
                <p><strong>Province:</strong> {{ formData.province || 'Not specified' }}</p>
                <p><strong>City:</strong> {{ formData.city || 'Not specified' }}</p>
                <p><strong>Age Range:</strong> 
                    <span v-if="formData.ageMin || formData.ageMax">
                        {{ formData.ageMin || 'Any' }} - {{ formData.ageMax || 'Any' }}
                    </span>
                    <span v-else>Not specified</span>
                </p>
                <p><strong>Gender:</strong> {{ formData.gender || 'All' }}</p>
                <p><strong>Behavior:</strong> {{ formData.behavior || 'Not specified' }}</p>
            </div>

            <div class="overview-section">
                <h4>Message</h4>
                <p class="message-preview">{{ formData.message || 'Not provided' }}</p>
            </div>

            <div class="overview-section">
                <h4>Time and Link</h4>
                <p><strong>How Many:</strong> {{ formData.howMany || 'Not provided' }}</p>
                <p><strong>Landing Link:</strong> 
                    <a :href="formData.landingLink" target="_blank" v-if="formData.landingLink">
                        {{ formData.landingLink }}
                    </a>
                    <span v-else>Not provided</span>
                </p>
                <p><strong>Campaign Date:</strong> {{ formData.campaignDate || 'Not provided' }}</p>
            </div>

            <div class="form-group">
                <button type="button" @click="submitCampaign" class="btn-submit">
                    Submit Campaign
                </button>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="wizard-navigation">
            <button 
                v-if="currentStep > 1" 
                @click="prevStep" 
                class="btn btn-secondary"
            >
                Previous
            </button>
            <button 
                v-if="currentStep < 5" 
                @click="nextStep" 
                class="btn btn-primary"
                :disabled="!canProceed"
            >
                Next
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ExampleWizard',
    data() {
        return {
            currentStep: 1,
            steps: ['Details', 'Demography', 'Message', 'Time and Link', 'Overview'],
            formData: {
                // Step 1
                campaignName: '',
                campaignDetails: '',
                // Step 2
                province: '',
                city: '',
                ageMin: null,
                ageMax: null,
                gender: '',
                behavior: '',
                // Step 3
                message: '',
                // Step 4
                howMany: null,
                landingLink: '',
                campaignDate: ''
            }
        }
    },
    computed: {
        canProceed() {
            switch(this.currentStep) {
                case 1:
                    return this.formData.campaignName.trim() !== '' && 
                           this.formData.campaignDetails.trim() !== '';
                case 2:
                    return true; // All fields optional
                case 3:
                    return this.formData.message.trim() !== '';
                case 4:
                    return this.formData.howMany > 0 && 
                           this.formData.landingLink.trim() !== '' && 
                           this.formData.campaignDate !== '';
                default:
                    return true;
            }
        }
    },
    methods: {
        nextStep() {
            if (this.canProceed && this.currentStep < 5) {
                this.currentStep++;
            }
        },
        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
            }
        },
        submitCampaign() {
            // Validate required fields
            if (!this.formData.campaignName || !this.formData.campaignDetails || 
                !this.formData.message || !this.formData.howMany || 
                !this.formData.landingLink || !this.formData.campaignDate) {
                alert('Please fill in all required fields before submitting.');
                return;
            }

            // Here you would typically send data to your backend
            console.log('Campaign Data:', this.formData);
            alert('Campaign submitted successfully! (This is a prototype)');
            
            // Optionally reset the form
            // this.resetForm();
        },
        resetForm() {
            this.currentStep = 1;
            this.formData = {
                campaignName: '',
                campaignDetails: '',
                province: '',
                city: '',
                ageMin: null,
                ageMax: null,
                gender: '',
                behavior: '',
                message: '',
                howMany: null,
                landingLink: '',
                campaignDate: ''
            };
        }
    }
}
</script>

<style scoped>
.wizard-container {
    max-width: 800px;
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
.form-group input[type="date"],
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

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #0066cc;
}

.age-range {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.age-range input {
    flex: 1;
}

.age-range span {
    color: #666;
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

.message-preview {
    white-space: pre-wrap;
    background: white;
    padding: 1rem;
    border-radius: 4px;
    border-left: 4px solid #0066cc;
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

.btn-submit:hover {
    background: #45a049;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(76, 175, 80, 0.4);
}

.overview-section a {
    color: #0066cc;
    text-decoration: none;
}

.overview-section a:hover {
    text-decoration: underline;
}
</style>
