<?php
/**
 * Template Name: Setup Guide
 * @package IOI
 */

get_header();
?>

<main class="internal-page setup-guide">
    <div class="page-header">
        <div class="container">
            <h1>Setup Guide</h1>
            <p class="page-subtitle">Get started with IOI in under 5 minutes</p>
        </div>
    </div>
    
    <div class="page-content">
        <div class="container container-md">
            
            <!-- Quick Overview -->
            <div class="setup-overview">
                <h2>What You'll Need</h2>
                <div class="requirements-grid">
                    <div class="requirement-item">
                        <span class="req-icon">📱</span>
                        <span class="req-text">IOI App installed</span>
                    </div>
                    <div class="requirement-item">
                        <span class="req-icon">🔐</span>
                        <span class="req-text">Verified Binance account</span>
                    </div>
                    <div class="requirement-item">
                        <span class="req-icon">💰</span>
                        <span class="req-text">USDT or USDC balance</span>
                    </div>
                    <div class="requirement-item">
                        <span class="req-icon">⏱️</span>
                        <span class="req-text">5 minutes of your time</span>
                    </div>
                </div>
            </div>

            <!-- Step 1 -->
            <section class="setup-step">
                <div class="step-header">
                    <div class="step-number">1</div>
                    <h2>Download & Install IOI</h2>
                </div>
                <div class="step-content">
                    <p>Download IOI from one of our official sources:</p>
                    <div class="download-options">
                        <a href="#" class="download-option">
                            <span class="option-icon">📥</span>
                            <span class="option-text">
                                <strong>Direct APK Download</strong>
                                <small>For all Android devices</small>
                            </span>
                        </a>
                        <a href="#" class="download-option">
                            <span class="option-icon">🌌</span>
                            <span class="option-text">
                                <strong>Samsung Galaxy Store</strong>
                                <small>For Samsung devices</small>
                            </span>
                        </a>
                        <a href="#" class="download-option">
                            <span class="option-icon">📦</span>
                            <span class="option-text">
                                <strong>Huawei AppGallery</strong>
                                <small>For Huawei devices</small>
                            </span>
                        </a>
                    </div>
                    <div class="info-box">
                        <strong>Why not Google Play?</strong>
                        <p>Google Play prohibits cryptocurrency trading apps. Our APK is safe, signed, and verified. <a href="<?php echo home_url('/why-not-playstore/'); ?>">Learn more</a></p>
                    </div>
                </div>
            </section>

            <!-- Step 2 -->
            <section class="setup-step">
                <div class="step-header">
                    <div class="step-number">2</div>
                    <h2>Create Your Binance API Key</h2>
                </div>
                <div class="step-content">
                    <p>Log into your Binance account and follow these steps:</p>
                    
                    <ol class="setup-instructions">
                        <li>
                            <strong>Go to API Management</strong>
                            <p>Click your profile icon → "API Management" or visit <a href="https://www.binance.com/en/my/settings/api-management" target="_blank" rel="noopener">binance.com/en/my/settings/api-management</a></p>
                        </li>
                        <li>
                            <strong>Create New API Key</strong>
                            <p>Click "Create API" and select "System generated" API key type. Name it something like "IOI Trading".</p>
                        </li>
                        <li>
                            <strong>Complete Security Verification</strong>
                            <p>Binance will require email, SMS, or authenticator verification.</p>
                        </li>
                        <li>
                            <strong>Configure Permissions</strong>
                            <p>Enable ONLY these permissions:</p>
                            <ul class="permission-list">
                                <li class="permission-yes">✅ Enable Reading</li>
                                <li class="permission-yes">✅ Enable Spot & Margin Trading</li>
                                <li class="permission-no">❌ Enable Withdrawals - NEVER enable this!</li>
                                <li class="permission-no">❌ Enable Internal Transfer - Not needed</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Set IP Restriction (Recommended)</strong>
                            <p>For maximum security, restrict API access to IOI's server IPs:</p>
                            <div class="ip-list">
                                <code>Coming soon - IPs will be displayed here</code>
                            </div>
                            <p><small>Or select "Unrestricted" if you prefer flexibility (still safe since withdrawals are disabled).</small></p>
                        </li>
                        <li>
                            <strong>Save Your Keys</strong>
                            <p>Copy both the <strong>API Key</strong> and <strong>Secret Key</strong>. The Secret Key is only shown once!</p>
                        </li>
                    </ol>

                    <div class="warning-box">
                        <strong>🔒 Security Warning</strong>
                        <p>NEVER enable withdrawal permissions. IOI only needs trading permissions. With withdrawals disabled, your funds cannot leave your Binance account even if your API key is compromised.</p>
                    </div>
                </div>
            </section>

            <!-- Step 3 -->
            <section class="setup-step">
                <div class="step-header">
                    <div class="step-number">3</div>
                    <h2>Connect API to IOI</h2>
                </div>
                <div class="step-content">
                    <ol class="setup-instructions">
                        <li>
                            <strong>Open IOI App</strong>
                            <p>Launch the app and tap "Connect Binance Account"</p>
                        </li>
                        <li>
                            <strong>Enter API Credentials</strong>
                            <p>Paste your API Key and Secret Key from Binance</p>
                        </li>
                        <li>
                            <strong>Create Your PIN</strong>
                            <p>Set a 6-digit PIN to encrypt your credentials. This PIN is used to secure your API keys locally on your device.</p>
                        </li>
                        <li>
                            <strong>Verify Connection</strong>
                            <p>IOI will test the connection and display your Binance balance if successful.</p>
                        </li>
                    </ol>

                    <div class="info-box">
                        <strong>🔐 Zero-Knowledge Security</strong>
                        <p>Your API credentials are encrypted on your device using your PIN. Our servers never have access to your unencrypted keys.</p>
                    </div>
                </div>
            </section>

            <!-- Step 4 -->
            <section class="setup-step">
                <div class="step-header">
                    <div class="step-number">4</div>
                    <h2>Start Your First Bot</h2>
                </div>
                <div class="step-content">
                    <ol class="setup-instructions">
                        <li>
                            <strong>Choose a Mode</strong>
                            <ul>
                                <li><strong>Dry Run (DR)</strong> - Simulated trading with fake money. Perfect for testing!</li>
                                <li><strong>Real Trading (RT)</strong> - Live trading with your actual balance.</li>
                            </ul>
                            <p><em>We recommend starting with Dry Run to understand how the bot works.</em></p>
                        </li>
                        <li>
                            <strong>Set Your Budget</strong>
                            <p>Enter how much USDT/USDC you want the bot to trade with. Start small!</p>
                        </li>
                        <li>
                            <strong>Configure Settings (Optional)</strong>
                            <p>Adjust trading pairs, position sizes, and other parameters. Defaults work well for beginners.</p>
                        </li>
                        <li>
                            <strong>Start the Bot</strong>
                            <p>Tap "Start New Bot" and watch it work! The bot will automatically find opportunities and execute trades 24/7.</p>
                        </li>
                    </ol>

                    <div class="success-box">
                        <strong>🎉 You're All Set!</strong>
                        <p>Your bot is now trading. Check back anytime to monitor performance, adjust settings, or start additional bots.</p>
                    </div>
                </div>
            </section>

            <!-- Tips Section -->
            <section class="setup-tips">
                <h2>Pro Tips for Success</h2>
                <div class="tips-grid">
                    <div class="tip-card">
                        <span class="tip-icon">🧪</span>
                        <h4>Test First</h4>
                        <p>Always start with Dry Run mode to understand how the bot behaves before using real money.</p>
                    </div>
                    <div class="tip-card">
                        <span class="tip-icon">📊</span>
                        <h4>Start Small</h4>
                        <p>Begin with a small budget ($100-500) and scale up as you gain confidence.</p>
                    </div>
                    <div class="tip-card">
                        <span class="tip-icon">⏰</span>
                        <h4>Be Patient</h4>
                        <p>Give the bot time to work. Performance is best measured over weeks, not hours.</p>
                    </div>
                    <div class="tip-card">
                        <span class="tip-icon">📱</span>
                        <h4>Keep App Updated</h4>
                        <p>We regularly release improvements. Enable auto-updates or check for new versions.</p>
                    </div>
                </div>
            </section>

            <!-- Need Help -->
            <section class="setup-help">
                <h2>Need Help?</h2>
                <p>If you encounter any issues during setup, we're here to help:</p>
                <div class="help-options">
                    <a href="<?php echo home_url('/faq/'); ?>" class="btn btn-secondary">View FAQ</a>
                    <a href="<?php echo home_url('/contact/'); ?>" class="btn btn-primary">Contact Support</a>
                </div>
            </section>

        </div>
    </div>
</main>

<?php get_footer(); ?>
