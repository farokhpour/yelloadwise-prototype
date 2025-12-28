# Testing Vue.js Component

## Quick Test Steps

1. **Rebuild assets** (if you made changes):
   ```bash
   docker compose exec nodejs npm run build
   ```

2. **Access the wizard page**:
   ```
   http://localhost:8080/wizard
   ```

3. **Open browser console** (F12) and check for:
   - "Wizard.js loaded, Vue: available"
   - "Vue wizard app mounted successfully!"
   - Any error messages

4. **What you should see**:
   - Heading: "Vue.js Wizard Test"
   - A gray box with: "Hello World from Vue.js!"
   - Message: "This is a simple Vue.js component for testing."
   - Message: "If you can see this, Vue.js is working correctly! 🎉"

## Troubleshooting

### If Vue component doesn't show:

1. **Check browser console for errors**
   ```javascript
   // Open DevTools (F12) → Console tab
   // Look for errors or the console.log messages
   ```

2. **Verify script is loading**:
   - Open DevTools → Network tab
   - Reload page
   - Look for `wizard-*.js` file (should be 200 OK)

3. **Check if element exists**:
   ```javascript
   // In browser console, run:
   document.getElementById('wizard-app')
   // Should return the div element
   ```

4. **Manually test Vue**:
   ```javascript
   // In browser console:
   import('http://localhost:8080/build/assets/wizard-*.js')
   // Check if it loads without errors
   ```

5. **Rebuild assets**:
   ```bash
   docker compose exec nodejs npm run build
   ```

6. **Clear browser cache** and reload

## Development Mode (with HMR)

For active development with hot reload:

```bash
docker compose exec nodejs npm run watch
```

This will rebuild automatically when you change Vue components.

