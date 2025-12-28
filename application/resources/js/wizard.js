import { createApp } from 'vue';
import CampaignWizard from './components/CampaignWizard.vue';

// Debug: Log that script loaded
console.log('🔵 Wizard.js script loaded');
console.log('🔵 Vue createApp available:', typeof createApp !== 'undefined');
console.log('🔵 CampaignWizard imported:', typeof CampaignWizard !== 'undefined');

// Function to initialize Vue app
function initVueApp() {
    console.log('🔵 initVueApp called');
    console.log('🔵 Document ready state:', document.readyState);
    
    const mountElement = document.getElementById('wizard-app');
    console.log('🔵 Mount element found:', mountElement !== null);
    
    if (!mountElement) {
        console.error('❌ Could not find #wizard-app element');
        console.log('🔵 Available elements with id:', Array.from(document.querySelectorAll('[id]')).map(el => el.id));
        return;
    }
    
    console.log('🔵 Mount element content before:', mountElement.innerHTML);
    
    try {
        console.log('🔵 Creating Vue app with CampaignWizard as root component...');
        
        // Create app with CampaignWizard as the root component
        const app = createApp(CampaignWizard);
        
        console.log('🔵 Mounting to #wizard-app...');
        // Mount the app - this will replace the content with the component
        app.mount('#wizard-app');
        
        console.log('✅ Vue wizard app mounted successfully!');
        
        // Check after a brief delay to see if content changed
        setTimeout(() => {
            const afterElement = document.getElementById('wizard-app');
            if (afterElement) {
                console.log('🔵 Mount element content after mount:', afterElement.innerHTML.substring(0, 200));
                console.log('🔵 Element has Vue data attribute:', afterElement.hasAttribute('data-v-'));
            } else {
                console.log('🔵 Element not found after mount');
            }
        }, 100);
    } catch (error) {
        console.error('❌ Error mounting Vue app:', error);
        console.error('❌ Error stack:', error.stack);
    }
}

// Try multiple approaches to ensure it runs
if (document.readyState === 'loading') {
    console.log('🔵 Document still loading, waiting for DOMContentLoaded');
    document.addEventListener('DOMContentLoaded', initVueApp);
} else {
    console.log('🔵 Document already ready, calling initVueApp immediately');
    initVueApp();
}

// Also try with a small delay as fallback
setTimeout(() => {
    const element = document.getElementById('wizard-app');
    if (element && !element.hasAttribute('data-v-')) {
        console.log('🔵 Fallback: Element found but Vue might not have mounted, retrying...');
        initVueApp();
    }
}, 500);

