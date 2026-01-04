@extends('layouts.app')

@section('content')
<div style="max-width: 1000px; margin: 0 auto; padding: 2rem;">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('epics.notifications.user.templates.index') }}" 
           style="display: inline-block; margin-bottom: 1rem; color: #007bff; text-decoration: none; font-weight: 500;">
            ← بازگشت به فهرست قالب‌ها
        </a>
        <h1 style="color: #333; margin-bottom: 0.5rem;">ایجاد قالب اعلان جدید</h1>
    </div>

    @if($errors->any())
        <div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            <ul style="margin: 0; padding-right: 1.5rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            {{ session('error') }}
        </div>
    @endif

    <!-- What is happening here -->
    <div style="background: #e3f2fd; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-right: 4px solid #2196f3;">
        <h3 style="color: #1565c0; margin-bottom: 0.75rem; font-size: 1.1rem;">📖 چه اتفاقی اینجا می‌افتد؟</h3>
        <p style="color: #1565c0; line-height: 1.8; margin: 0; font-size: 0.95rem;">
            شما در حال ایجاد یک قالب اعلان تراکنشی هستید. این فرآیند شامل انتخاب نوع قالب و سپس تعریف پارامترهای آن است. 
            قالب‌ها تحت محدودیت‌های سخت‌گیرانه‌ای هستند تا از سوء استفاده و مسدود شدن توسط اپراتور جلوگیری شود.
        </p>
    </div>

    <!-- Why this design exists -->
    <div style="background: #fff3e0; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-right: 4px solid #ff9800;">
        <h3 style="color: #e65100; margin-bottom: 0.75rem; font-size: 1.1rem;">🎯 چرا این طراحی وجود دارد؟</h3>
        <p style="color: #e65100; line-height: 1.8; margin: 0; font-size: 0.95rem;">
            محدودیت‌های سخت‌گیرانه در ایجاد قالب‌ها برای اطمینان از انطباق با مقررات مخابراتی و جلوگیری از سوء استفاده است. 
            برخی بخش‌های قالب قفل شده‌اند تا از تغییرات غیرمجاز جلوگیری شود.
        </p>
    </div>

    <form method="POST" action="{{ route('epics.notifications.user.templates.store') }}" id="template-form"
          style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem;">
        @csrf

        <!-- Step 1: Template Type Selection -->
        <div style="margin-bottom: 3rem;">
            <h2 style="color: #333; margin-bottom: 1rem; font-size: 1.5rem;">مرحله 1: انتخاب نوع قالب</h2>
            <p style="color: #666; margin-bottom: 1.5rem; font-size: 0.95rem;">
                لطفاً یکی از انواع قالب زیر را انتخاب کنید:
            </p>

            <div style="display: grid; gap: 1rem;">
                <label style="display: block; cursor: pointer;">
                    <input type="radio" name="type" value="OTP" required style="display: none;" onchange="handleTypeChange('OTP')">
                    <div id="otp-card" style="border: 2px solid #dee2e6; border-radius: 8px; padding: 1.5rem; transition: all 0.3s;"
                         onmouseover="this.style.borderColor='#007bff';"
                         onmouseout="if(!document.querySelector('input[name=type][value=OTP]').checked) this.style.borderColor='#dee2e6';">
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                            <span style="font-size: 1.5rem; font-weight: bold; color: #007bff;">OTP</span>
                            <span style="padding: 0.25rem 0.75rem; background: #dc3545; color: white; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">
                                فقط تراکنشی - غیر تبلیغاتی
                            </span>
                        </div>
                        <p style="color: #555; margin: 0; line-height: 1.6;">
                            قالب‌های تأیید هویت (One-Time Password) برای ارسال کدهای تأیید استفاده می‌شوند.
                        </p>
                    </div>
                </label>

                <label style="display: block; cursor: pointer;">
                    <input type="radio" name="type" value="WALLET" required style="display: none;" onchange="handleTypeChange('WALLET')">
                    <div id="wallet-card" style="border: 2px solid #dee2e6; border-radius: 8px; padding: 1.5rem; transition: all 0.3s;"
                         onmouseover="this.style.borderColor='#28a745';"
                         onmouseout="if(!document.querySelector('input[name=type][value=WALLET]').checked) this.style.borderColor='#dee2e6';">
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                            <span style="font-size: 1.5rem; font-weight: bold; color: #28a745;">WALLET</span>
                            <span style="padding: 0.25rem 0.75rem; background: #dc3545; color: white; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">
                                فقط تراکنشی - غیر تبلیغاتی
                            </span>
                        </div>
                        <p style="color: #555; margin: 0; line-height: 1.6;">
                            قالب‌های کیف پول برای اعلان‌های مربوط به عملیات‌های مالی استفاده می‌شوند.
                        </p>
                    </div>
                </label>

                <label style="display: block; cursor: pointer;">
                    <input type="radio" name="type" value="ORDER" required style="display: none;" onchange="handleTypeChange('ORDER')">
                    <div id="order-card" style="border: 2px solid #dee2e6; border-radius: 8px; padding: 1.5rem; transition: all 0.3s;"
                         onmouseover="this.style.borderColor='#ffc107';"
                         onmouseout="if(!document.querySelector('input[name=type][value=ORDER]').checked) this.style.borderColor='#dee2e6';">
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                            <span style="font-size: 1.5rem; font-weight: bold; color: #ffc107;">ORDER</span>
                            <span style="padding: 0.25rem 0.75rem; background: #dc3545; color: white; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">
                                فقط تراکنشی - غیر تبلیغاتی
                            </span>
                        </div>
                        <p style="color: #555; margin: 0; line-height: 1.6;">
                            قالب‌های سفارش برای اعلان‌های مربوط به وضعیت سفارشات استفاده می‌شوند.
                        </p>
                    </div>
                </label>
            </div>
        </div>

        <!-- Step 2: Template Definition (Dynamic) -->
        <div id="template-definition" style="display: none; margin-bottom: 3rem;">
            <h2 style="color: #333; margin-bottom: 1rem; font-size: 1.5rem;">مرحله 2: تعریف قالب</h2>
            
            <!-- OTP Template -->
            <div id="otp-template" style="display: none;">
                <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <h4 style="color: #333; margin-bottom: 0.75rem;">پیش‌نمایش (به‌روزرسانی خودکار):</h4>
                    <div id="otp-preview" style="background: white; padding: 1rem; border-radius: 6px; font-family: monospace; white-space: pre-wrap; border: 1px solid #ccc; min-height: 60px;">
                        پیش‌نمایش اینجا نمایش داده می‌شود...
                    </div>
                    <p style="color: #666; margin-top: 0.75rem; font-size: 0.875rem; margin-bottom: 0;">
                        قالب‌های OTP کاملاً کنترل می‌شوند تا از سوء استفاده و مسدود شدن توسط اپراتور جلوگیری شود.
                    </p>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">نام برند *</label>
                    <input type="text" name="config[brand_name]" id="otp-brand"
                           oninput="updateOtpPreview()"
                           style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
                </div>
            </div>

            <!-- WALLET Template -->
            <div id="wallet-template" style="display: none;">
                <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <h4 style="color: #333; margin-bottom: 0.75rem;">پیش‌نمایش (به‌روزرسانی خودکار):</h4>
                    <div id="wallet-preview" style="background: white; padding: 1rem; border-radius: 6px; font-family: monospace; white-space: pre-wrap; border: 1px solid #ccc; min-height: 60px;">
                        پیش‌نمایش اینجا نمایش داده می‌شود...
                    </div>
                    <p style="color: #666; margin-top: 0.75rem; font-size: 0.875rem; margin-bottom: 0;">
                        پیام‌های کیف پول بر اساس رویداد هستند و نمی‌توانند به صورت دستی ارسال شوند.
                    </p>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">نام برند *</label>
                    <input type="text" name="config[brand_name]" id="wallet-brand"
                           oninput="updateWalletPreview()"
                           style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">نوع عملیات *</label>
                    <select name="config[operation_type]" id="wallet-operation"
                            onchange="updateWalletPreview()"
                            style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
                        <option value="Credit">افزایش (Credit)</option>
                        <option value="Debit">کاهش (Debit)</option>
                    </select>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                        <input type="checkbox" name="config[show_balance]" id="wallet-balance" value="1"
                               onchange="updateWalletPreview()"
                               style="width: 20px; height: 20px; cursor: pointer;">
                        <span style="font-weight: 600; color: #333;">نمایش موجودی</span>
                    </label>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                        <input type="checkbox" name="config[show_amount]" id="wallet-amount" value="1"
                               onchange="updateWalletPreview()"
                               style="width: 20px; height: 20px; cursor: pointer;">
                        <span style="font-weight: 600; color: #333;">نمایش مبلغ تراکنش</span>
                    </label>
                </div>
            </div>

            <!-- ORDER Template -->
            <div id="order-template" style="display: none;">
                <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <h4 style="color: #333; margin-bottom: 0.75rem;">پیش‌نمایش (به‌روزرسانی خودکار):</h4>
                    <div id="order-preview" style="background: white; padding: 1rem; border-radius: 6px; font-family: monospace; white-space: pre-wrap; border: 1px solid #ccc; min-height: 60px;">
                        پیش‌نمایش اینجا نمایش داده می‌شود...
                    </div>
                    <p style="color: #666; margin-top: 0.75rem; font-size: 0.875rem; margin-bottom: 0;">
                        اعلان‌های سفارش به شدت به مرجع سفارش مرتبط هستند.
                    </p>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">رویداد سفارش *</label>
                    <select name="config[order_event]" id="order-event"
                            onchange="updateOrderPreview()"
                            style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
                        <option value="Created">ایجاد شد (Created)</option>
                        <option value="Paid">پرداخت شد (Paid)</option>
                        <option value="Shipped">ارسال شد (Shipped)</option>
                    </select>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">نام برند *</label>
                    <input type="text" name="config[brand_name]" id="order-brand"
                           oninput="updateOrderPreview()"
                           style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                        <input type="checkbox" name="config[show_amount]" id="order-amount" value="1"
                               onchange="updateOrderPreview()"
                               style="width: 20px; height: 20px; cursor: pointer;">
                        <span style="font-weight: 600; color: #333;">نمایش مبلغ</span>
                    </label>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                        <input type="checkbox" name="config[show_order_link]" id="order-link" value="1"
                               onchange="updateOrderPreview()"
                               style="width: 20px; height: 20px; cursor: pointer;">
                        <span style="font-weight: 600; color: #333;">نمایش لینک مشاهده سفارش</span>
                    </label>
                    <p style="color: #666; margin-top: 0.5rem; font-size: 0.875rem; margin-bottom: 0; padding-right: 1.5rem;">
                        لینک باید در فرمت HTTP باشد و از طریق API ارسال می‌شود.
                    </p>
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('epics.notifications.user.templates.index') }}" 
               style="display: inline-block; padding: 0.75rem 1.5rem; background: #6c757d; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
               onmouseover="this.style.background='#5a6268';"
               onmouseout="this.style.background='#6c757d';">
                انصراف
            </a>
            <button type="submit" id="submit-btn" disabled
                    style="padding: 0.75rem 1.5rem; background: #28a745; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; transition: all 0.3s; opacity: 0.5;"
                    onmouseover="if(!this.disabled) this.style.background='#218838';"
                    onmouseout="if(!this.disabled) this.style.background='#28a745';">
                ایجاد قالب
            </button>
        </div>
    </form>
</div>

<script>
    function handleTypeChange(type) {
        // Hide all template definitions
        document.getElementById('otp-template').style.display = 'none';
        document.getElementById('wallet-template').style.display = 'none';
        document.getElementById('order-template').style.display = 'none';
        
        // Remove required attributes from all fields
        document.querySelectorAll('#otp-template input[required], #otp-template select[required]').forEach(field => {
            field.removeAttribute('required');
        });
        document.querySelectorAll('#wallet-template input[required], #wallet-template select[required]').forEach(field => {
            field.removeAttribute('required');
        });
        document.querySelectorAll('#order-template input[required], #order-template select[required]').forEach(field => {
            field.removeAttribute('required');
        });
        
        // Show selected template
        document.getElementById('template-definition').style.display = 'block';
        const selectedTemplate = document.getElementById(type.toLowerCase() + '-template');
        selectedTemplate.style.display = 'block';
        
        // Add required attributes to visible fields
        if (type === 'OTP') {
            document.getElementById('otp-brand').setAttribute('required', 'required');
        } else if (type === 'WALLET') {
            document.getElementById('wallet-brand').setAttribute('required', 'required');
            document.getElementById('wallet-operation').setAttribute('required', 'required');
        } else if (type === 'ORDER') {
            document.getElementById('order-brand').setAttribute('required', 'required');
            document.getElementById('order-event').setAttribute('required', 'required');
        }
        
        // Update card borders
        document.querySelectorAll('[id$="-card"]').forEach(card => {
            card.style.borderColor = '#dee2e6';
            card.style.borderWidth = '2px';
        });
        const selectedCard = document.getElementById(type.toLowerCase() + '-card');
        if (selectedCard) {
            selectedCard.style.borderColor = type === 'OTP' ? '#007bff' : type === 'WALLET' ? '#28a745' : '#ffc107';
            selectedCard.style.borderWidth = '3px';
        }
        
        // Enable submit button
        document.getElementById('submit-btn').disabled = false;
        document.getElementById('submit-btn').style.opacity = '1';
        
        // Initialize preview if needed
        if (type === 'OTP') updateOtpPreview();
        if (type === 'WALLET') updateWalletPreview();
        if (type === 'ORDER') updateOrderPreview();
    }

    function updateOtpPreview() {
        const brand = document.getElementById('otp-brand')?.value || 'نام برند';
        document.getElementById('otp-preview').textContent = brand + '\nکد تأیید شما: ' + '{' + '{' + 'otp_code' + '}' + '}';
    }

    function updateWalletPreview() {
        const brand = document.getElementById('wallet-brand')?.value || 'نام برند';
        const operation = document.getElementById('wallet-operation')?.value || 'Credit';
        const showBalance = document.getElementById('wallet-balance')?.checked || false;
        const showAmount = document.getElementById('wallet-amount')?.checked || false;
        
        const operationText = operation === 'Credit' ? 'افزایش' : 'کاهش';
        const balanceText = showBalance ? '\nموجودی: ' + '{' + '{' + 'balance' + '}' + '}' : '';
        const amountText = showAmount ? '\nمبلغ: ' + '{' + '{' + 'amount' + '}' + '}' : '';
        
        document.getElementById('wallet-preview').textContent = brand + '\nعملیات ' + operationText + ' انجام شد.' + amountText + balanceText;
    }

    function updateOrderPreview() {
        const brand = document.getElementById('order-brand')?.value || 'نام برند';
        const event = document.getElementById('order-event')?.value || 'Created';
        const showAmount = document.getElementById('order-amount')?.checked || false;
        const showOrderLink = document.getElementById('order-link')?.checked || false;
        
        const eventText = event === 'Created' ? 'ایجاد شد' : event === 'Paid' ? 'پرداخت شد' : 'ارسال شد';
        const amountText = showAmount ? '\nمبلغ: ' + '{' + '{' + 'amount' + '}' + '}' : '';
        const linkText = showOrderLink ? '\nلینک مشاهده سفارش: ' + '{' + '{' + 'order_link' + '}' + '}' : '';
        
        document.getElementById('order-preview').textContent = brand + '\nسفارش شما ' + eventText + ' شد.' + amountText + linkText;
    }

    // Handle card clicks
    document.querySelectorAll('label').forEach(label => {
        label.addEventListener('click', function(e) {
            if (e.target.tagName !== 'INPUT' && e.target.tagName !== 'BUTTON') {
                const radio = this.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = true;
                    handleTypeChange(radio.value);
                }
            }
        });
    });

    // Prevent form submission if no type is selected
    document.getElementById('template-form').addEventListener('submit', function(e) {
        const selectedType = document.querySelector('input[name="type"]:checked');
        if (!selectedType) {
            e.preventDefault();
            alert('لطفاً نوع قالب را انتخاب کنید');
            return false;
        }
        
        // Validate required fields based on type
        if (selectedType.value === 'OTP') {
            const brandName = document.getElementById('otp-brand')?.value;
            if (!brandName || brandName.trim() === '') {
                e.preventDefault();
                alert('لطفاً نام برند را وارد کنید');
                return false;
            }
        }
        
        if (selectedType.value === 'WALLET') {
            const brandName = document.getElementById('wallet-brand')?.value;
            if (!brandName || brandName.trim() === '') {
                e.preventDefault();
                alert('لطفاً نام برند را وارد کنید');
                return false;
            }
        }
        
        if (selectedType.value === 'ORDER') {
            const brandName = document.getElementById('order-brand')?.value;
            if (!brandName || brandName.trim() === '') {
                e.preventDefault();
                alert('لطفاً نام برند را وارد کنید');
                return false;
            }
        }
    });
</script>
@endsection


