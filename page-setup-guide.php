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
                    <?php
                    // Get download URLs and visibility settings
                    $apk_url = get_option('ioi_apk_url', '#');
                    $galaxy_url = get_option('ioi_galaxy_url', '#');
                    $huawei_url = get_option('ioi_huawei_url', '#');
                    $show_galaxy = get_option('ioi_show_galaxy', 0);
                    $show_huawei = get_option('ioi_show_huawei', 0);
                    ?>
                    <div class="download-options">
                        <!-- APK Download - Always visible, highlighted -->
                        <a href="<?php echo esc_url($apk_url); ?>" 
                           class="download-option primary-download"
                           onclick="trackDownload('APK Direct')"
                           <?php echo ($apk_url && $apk_url !== '#') ? '' : 'style="pointer-events: none; opacity: 0.5;"'; ?>>
                            <span class="option-icon">📥</span>
                            <span class="option-text">
                                <strong>Direct APK Download</strong>
                                <small>For all Android devices</small>
                            </span>
                        </a>
                        
                        <?php if ($show_galaxy && $galaxy_url && $galaxy_url !== '#') : ?>
                        <!-- Galaxy Store - Conditional -->
                        <a href="<?php echo esc_url($galaxy_url); ?>" 
                           class="download-option"
                           target="_blank"
                           rel="noopener"
                           onclick="trackDownload('Galaxy Store')">
                            <span class="option-icon">🌌</span>
                            <span class="option-text">
                                <strong>Samsung Galaxy Store</strong>
                                <small>For Samsung devices</small>
                            </span>
                        </a>
                        <?php endif; ?>
                        
                        <?php if ($show_huawei && $huawei_url && $huawei_url !== '#') : ?>
                        <!-- Huawei AppGallery - Conditional -->
                        <a href="<?php echo esc_url($huawei_url); ?>" 
                           class="download-option"
                           target="_blank"
                           rel="noopener"
                           onclick="trackDownload('Huawei AppGallery')">
                            <span class="option-icon">📦</span>
                            <span class="option-text">
                                <strong>Huawei AppGallery</strong>
                                <small>For Huawei devices</small>
                            </span>
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="info-box">
                        <strong>Why not Google Play?</strong>
                        <p>Google Play prohibits cryptocurrency trading apps. Our APK is safe, signed, and verified. <a href="<?php echo home_url('/why-not-playstore/'); ?>">Learn more</a></p>
                    </div>
                </div>
            </section>

            <!-- Step 2 - Choose Payment Model -->
            <section class="setup-step">
                <div class="step-header">
                    <div class="step-number">2</div>
                    <h2>Choose Your Payment Model</h2>
                </div>
                <div class="step-content">
                    <p>Before creating your API key, decide how you want to pay for IOI:</p>
                    
                    <div class="payment-models-comparison">
                        <div class="payment-model-card">
                            <h4>💳 Commission Model</h4>
                            <div class="model-price">0.065% per trade</div>
                            <ul>
                                <li>No monthly subscription</li>
                                <li>Pay only when you trade</li>
                                <li>Unlimited trading budget</li>
                                <li>Commissions accumulate and are collected automatically when reaching the minimum threshold</li>
                            </ul>
                            <div class="model-api-note">
                                <strong>API Requirement:</strong> Withdrawal permission with whitelisted IOI address
                            </div>
                        </div>
                        
                        <div class="payment-model-card">
                            <h4>📅 Subscription Model</h4>
                            <div class="model-price">$5 - $1,000/month</div>
                            <ul>
                                <li>Zero trading fees</li>
                                <li>Fixed monthly cost</li>
                                <li>Budget limits per tier</li>
                                <li>Choose auto-pay or manual payment</li>
                            </ul>
                            <div class="model-api-note">
                                <strong>API Requirement:</strong> 
                                <br>• Auto-pay: Withdrawal permission with whitelisted IOI address
                                <br>• Manual pay: No withdrawal permission needed
                            </div>
                        </div>
                    </div>
                    
                    <p class="mt-lg">Your choice affects which API permissions you'll need in the next step. The IOI app will guide you through this during the Binance connection process.</p>
                </div>
            </section>

            <!-- Step 3 -->
            <section class="setup-step">
                <div class="step-header">
                    <div class="step-number">3</div>
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
                            <p>Enable the permissions based on your chosen payment model:</p>
                            
                            <div class="permissions-tabs">
                                <div class="permission-scenario">
                                    <h5>🅰️ Commission Model or Subscription with Auto-Pay</h5>
                                    <ul class="permission-list">
                                        <li class="permission-yes">✅ Enable Reading</li>
                                        <li class="permission-yes">✅ Enable Spot & Margin Trading</li>
                                        <li class="permission-yes">✅ Enable Withdrawals <span class="permission-note">— with whitelisted address only (see below)</span></li>
                                        <li class="permission-no">❌ Enable Internal Transfer — Not needed</li>
                                    </ul>
                                </div>
                                
                                <div class="permission-scenario">
                                    <h5>🅱️ Subscription with Manual Payment</h5>
                                    <ul class="permission-list">
                                        <li class="permission-yes">✅ Enable Reading</li>
                                        <li class="permission-yes">✅ Enable Spot & Margin Trading</li>
                                        <li class="permission-no">❌ Enable Withdrawals — Not needed</li>
                                        <li class="permission-no">❌ Enable Internal Transfer — Not needed</li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        
                        <li id="withdrawal-whitelist">
                            <strong>Set Up Withdrawal Whitelist (Commission & Auto-Pay Only)</strong>
                            <p>If you enabled withdrawals, you <strong>must</strong> set up address whitelisting for your security:</p>
                            <ol class="sub-instructions">
                                <li>In Binance, go to "Withdrawal" → "Address Management"</li>
                                <li>Enable "Whitelist" feature if not already enabled</li>
                                <li>Add IOI's official collection address:
                                    <div class="address-box">
                                        <code id="ioi-wallet-address">Will be displayed in the IOI app during setup</code>
                                    </div>
                                </li>
                                <li>Label it "IOI Payments" for easy identification</li>
                            </ol>
                            <p><strong>Important:</strong> With whitelisting enabled, withdrawals can ONLY go to addresses you've approved. This means even with withdrawal permission, funds can only be sent to IOI's verified address—nowhere else.</p>
                        </li>
                        
                        <li>
                            <strong>Set IP Restriction (Optional but Recommended)</strong>
                            <p>For additional security, you can restrict API access to IOI's server IPs:</p>
                            <div class="ip-list">
                                <code>Server IPs will be displayed in the IOI app</code>
                            </div>
                            <p><small>Or select "Unrestricted" if you prefer flexibility.</small></p>
                        </li>
                        <li>
                            <strong>Save Your Keys</strong>
                            <p>Copy both the <strong>API Key</strong> and <strong>Secret Key</strong>. The Secret Key is only shown once!</p>
                        </li>
                    </ol>

                    <!-- Trust & Transparency Section -->
                    <div class="trust-section">
                        <h4>🔒 Understanding Withdrawal Permissions</h4>
                        <p>We understand enabling withdrawal permissions requires trust. Here's why it's safe and how we handle it:</p>
                        
                        <div class="trust-points">
                            <div class="trust-point">
                                <span class="trust-icon">📋</span>
                                <div class="trust-content">
                                    <strong>Whitelisted Address Only</strong>
                                    <p>Binance's whitelist feature ensures withdrawals can ONLY go to IOI's verified address. No other destination is possible.</p>
                                </div>
                            </div>
                            
                            <div class="trust-point">
                                <span class="trust-icon">💰</span>
                                <div class="trust-content">
                                    <strong>Used Only for Payments You Owe</strong>
                                    <p>Withdrawals are used <em>exclusively</em> for:
                                    <br>• Commission payments (0.065% of each trade)
                                    <br>• Automatic subscription renewals
                                    <br>Nothing else. Ever.</p>
                                </div>
                            </div>
                            
                            <div class="trust-point">
                                <span class="trust-icon">📊</span>
                                <div class="trust-content">
                                    <strong>Full Transparency & Audit Trail</strong>
                                    <p>Every payment is logged with detailed reports available in the IOI app:
                                    <br>• Trade-by-trade commission breakdown
                                    <br>• Payment history with timestamps
                                    <br>• Running balance of accumulated fees
                                    <br>• Receipts for every collection</p>
                                </div>
                            </div>
                            
                            <div class="trust-point">
                                <span class="trust-icon">⏰</span>
                                <div class="trust-content">
                                    <strong>Collected at Thresholds</strong>
                                    <p>Commissions accumulate over time and are only collected when reaching the minimum threshold (shown in the app). You won't see tiny withdrawals after every trade.</p>
                                </div>
                            </div>
                            
                            <div class="trust-point">
                                <span class="trust-icon">🔄</span>
                                <div class="trust-content">
                                    <strong>You Can Switch Anytime</strong>
                                    <p>If you're not comfortable with withdrawal permissions, choose a subscription with manual payment instead. You can always change later.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-box">
                        <strong>💡 The App Guides You</strong>
                        <p>Don't worry about memorizing all this! The IOI app walks you through the entire Binance connection process step-by-step, showing you exactly which permissions to enable based on your chosen payment model.</p>
                    </div>
                </div>
            </section>

            <!-- Step 4 -->
            <section class="setup-step">
                <div class="step-header">
                    <div class="step-number">4</div>
                    <h2>Connect API to IOI</h2>
                </div>
                <div class="step-content">
                    <ol class="setup-instructions">
                        <li>
                            <strong>Open IOI App</strong>
                            <p>Launch the app and tap "Connect Binance Account"</p>
                        </li>
                        <li>
                            <strong>Select Payment Model</strong>
                            <p>Choose Commission (0.065% per trade) or Subscription ($5-$1k/month)</p>
                        </li>
                        <li>
                            <strong>Enter API Credentials</strong>
                            <p>Paste your API Key and Secret Key from Binance</p>
                        </li>
                        <li>
                            <strong>Create Your PIN</strong>
                            <p>Set a 6-digit PIN to encrypt your credentials. This PIN secures your API keys locally on your device.</p>
                        </li>
                        <li>
                            <strong>Verify Connection</strong>
                            <p>IOI will test the connection, verify permissions match your payment model, and display your Binance balance if successful.</p>
                        </li>
                    </ol>

                    <div class="info-box">
                        <strong>🔐 Zero-Knowledge Security</strong>
                        <p>Your API credentials are encrypted on your device using your PIN. Our servers never have access to your unencrypted keys.</p>
                    </div>
                </div>
            </section>

            <!-- Step 5 -->
            <section class="setup-step">
                <div class="step-header">
                    <div class="step-number">5</div>
                    <h2>Start Your First Bot</h2>
                </div>
                <div class="step-content">
                    <ol class="setup-instructions">
                        <li>
                            <strong>Choose a Mode</strong>
                            <ul>
                                <li><strong>Dry Run (DR)</strong> — Simulated trading with fake money. Perfect for testing!</li>
                                <li><strong>Real Trading (RT)</strong> — Live trading with your actual balance.</li>
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
                            <p>Tap "Start Bot" and watch it work! The bot will automatically find opportunities and execute trades 24/7.</p>
                        </li>
                    </ol>

                    <div class="success-box">
                        <strong>🎉 You're All Set!</strong>
                        <p>Your bot is now trading. Check back anytime to monitor performance, view payment history, adjust settings, or start additional bots.</p>
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

            <!-- Payment Summary -->
            <section class="setup-payment-summary">
                <h2>Payment Model Summary</h2>
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Commission</th>
                            <th>Subscription (Auto-Pay)</th>
                            <th>Subscription (Manual)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Cost</strong></td>
                            <td>0.065% per trade</td>
                            <td>$5-$1k/month</td>
                            <td>$5-$1k/month</td>
                        </tr>
                        <tr>
                            <td><strong>Trading Fees</strong></td>
                            <td>0.065%</td>
                            <td>0%</td>
                            <td>0%</td>
                        </tr>
                        <tr>
                            <td><strong>Budget Limit</strong></td>
                            <td>Unlimited</td>
                            <td>Per tier ($100-$25k)</td>
                            <td>Per tier ($100-$25k)</td>
                        </tr>
                        <tr>
                            <td><strong>Withdrawal Permission</strong></td>
                            <td>Required</td>
                            <td>Required</td>
                            <td>Not required</td>
                        </tr>
                        <tr>
                            <td><strong>How You Pay</strong></td>
                            <td>Auto-collected at threshold</td>
                            <td>Auto-deducted monthly</td>
                            <td>You send manually</td>
                        </tr>
                        <tr>
                            <td><strong>Best For</strong></td>
                            <td>Testing, occasional trading</td>
                            <td>Active traders, convenience</td>
                            <td>Maximum control</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <!-- Next Steps -->
            <section class="setup-next-steps">
                <h2>🎯 Next Steps</h2>
                <p>Now that your bot is running, learn how to optimize your settings:</p>
                <div class="next-step-card">
                    <div class="next-step-icon">⚙️</div>
                    <div class="next-step-content">
                        <h3>Bot Settings Guide</h3>
                        <p>Understand each configuration option, learn when to use stop-loss protection, and discover the difference between graceful and force shutdown.</p>
                        <a href="<?php echo home_url('/bot-settings-guide/'); ?>" class="btn btn-primary">Read Bot Settings Guide →</a>
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

<style>
/* Additional styles for new sections */
.payment-models-comparison {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin: 1.5rem 0;
}

.payment-model-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(212, 175, 55, 0.2);
    border-radius: 12px;
    padding: 1.5rem;
}

.payment-model-card h4 {
    color: #D4AF37;
    margin-bottom: 0.5rem;
}

.payment-model-card .model-price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 1rem;
}

.payment-model-card ul {
    list-style: none;
    padding: 0;
    margin: 0 0 1rem 0;
}

.payment-model-card li {
    padding: 0.4rem 0;
    padding-left: 1.5rem;
    position: relative;
    color: #ccc;
    font-size: 0.9rem;
}

.payment-model-card li::before {
    content: "•";
    color: #D4AF37;
    position: absolute;
    left: 0;
}

.model-api-note {
    background: rgba(212, 175, 55, 0.1);
    padding: 0.75rem;
    border-radius: 6px;
    font-size: 0.85rem;
    color: #D4AF37;
}

/* Primary download button highlight */
.primary-download {
    border-color: #D4AF37 !important;
    background: rgba(212, 175, 55, 0.1) !important;
}

.permissions-tabs {
    display: grid;
    gap: 1.5rem;
    margin: 1rem 0;
}

.permission-scenario {
    background: rgba(255,255,255,0.02);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 8px;
    padding: 1.25rem;
}

.permission-scenario h5 {
    color: #D4AF37;
    margin-bottom: 1rem;
    font-size: 1rem;
}

.permission-note {
    color: #888;
    font-size: 0.85rem;
    font-weight: normal;
}

.sub-instructions {
    margin: 1rem 0;
    padding-left: 1.5rem;
}

.sub-instructions li {
    margin-bottom: 0.75rem;
}

.address-box {
    background: #1a1a1a;
    border: 1px solid #333;
    border-radius: 6px;
    padding: 1rem;
    margin: 0.75rem 0;
    font-family: monospace;
    word-break: break-all;
}

.trust-section {
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.05), rgba(212, 175, 55, 0.02));
    border: 1px solid rgba(212, 175, 55, 0.2);
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
}

.trust-section h4 {
    color: #D4AF37;
    margin-bottom: 1rem;
}

.trust-points {
    display: grid;
    gap: 1.25rem;
    margin-top: 1.5rem;
}

.trust-point {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.trust-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
}

.trust-content strong {
    color: #fff;
    display: block;
    margin-bottom: 0.25rem;
}

.trust-content p {
    color: #aaa;
    font-size: 0.9rem;
    margin: 0;
}

.comparison-table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
    font-size: 0.9rem;
}

.comparison-table th,
.comparison-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.comparison-table th {
    background: rgba(212, 175, 55, 0.1);
    color: #D4AF37;
    font-weight: 600;
}

.comparison-table td:first-child {
    color: #888;
}

.comparison-table tbody tr:hover {
    background: rgba(255,255,255,0.02);
}

.setup-payment-summary {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255,255,255,0.1);
}

.setup-next-steps {
    margin-top: 3rem;
    padding: 2rem;
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(212, 175, 55, 0.03));
    border: 1px solid rgba(212, 175, 55, 0.3);
    border-radius: 16px;
}

.setup-next-steps h2 {
    color: #D4AF37;
    margin-bottom: 0.5rem;
}

.next-step-card {
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
    margin-top: 1.5rem;
    padding: 1.5rem;
    background: rgba(0,0,0,0.3);
    border-radius: 12px;
}

.next-step-icon {
    font-size: 2.5rem;
    flex-shrink: 0;
}

.next-step-content h3 {
    color: #fff;
    margin-bottom: 0.5rem;
}

.next-step-content p {
    color: #aaa;
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .next-step-card {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 768px) {
    .comparison-table {
        display: block;
        overflow-x: auto;
    }
    
    .trust-point {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>

<?php get_footer(); ?>