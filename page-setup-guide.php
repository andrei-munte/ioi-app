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
                        <span class="req-text">At least $100 USDT or USDC</span>
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
                        
                        <!-- Sub-Account Option -->
                        <div class="subaccount-tip">
                            <h4>🛡️ Want Commission Trading Without Trusting Your Main Account?</h4>
                            <p><strong>Use a Binance Sub-Account.</strong> This gives you the best of both worlds: commission-based trading (no upfront costs) with complete isolation from your main holdings.</p>
                            
                            <div class="subaccount-steps">
                                <h5>How it works:</h5>
                                <ol>
                                    <li><strong>Create a sub-account on Binance</strong> — Free and takes about 2 minutes. Go to "Sub-Account" in your Binance dashboard.</li>
                                    <li><strong>Connect IOI to the sub-account</strong> — Create API keys for the sub-account (not your main account).</li>
                                    <li><strong>Fund only what you want to trade</strong> — Transfer USDT/USDC from your main account to the sub-account. Minimum is $100. Add some BNB if you want the 25% Binance fee discount.</li>
                                    <li><strong>Trade with complete peace of mind</strong> — Even with withdrawal permissions enabled, IOI can only access funds in the sub-account. Your main holdings are completely isolated.</li>
                                </ol>
                            </div>
                            
                            <div class="subaccount-benefits">
                                <h5>Benefits:</h5>
                                <ul>
                                    <li>✅ Pay-as-you-go commission model (0.065% per trade)</li>
                                    <li>✅ No upfront subscription costs</li>
                                    <li>✅ Your main account is never connected to IOI</li>
                                    <li>✅ You control exactly how much capital is at risk</li>
                                    <li>✅ Top up anytime by transferring more from your main account</li>
                                </ul>
                            </div>
                            
                            <p class="subaccount-note"><strong>This is our recommended approach</strong> for users who want commission-based trading but prefer maximum security and control.</p>
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
                        <strong>🔐 Client-Side Encryption</strong>
                        <p>Your API credentials are encrypted on your device using your PIN. Your PIN never leaves your device.</p>
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
                            <p>Enter how much USDT/USDC you want the bot to trade with. Minimum is $100 — the bot needs this to split across multiple positions while meeting Binance's minimum order sizes.</p>
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
                        <h4>Start at $100</h4>
                        <p>Begin with the minimum budget and scale up as you gain confidence in your settings.</p>
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

            <!-- BNB Fee Discount -->
            <section class="setup-bnb-discount">
                <h2>💎 Save 25% on Binance Fees with BNB</h2>
                <p>Binance offers a 25% discount on trading fees if you pay them with BNB (Binance Coin). This applies to Binance's own fees — separate from IOI's commission.</p>
                
                <div class="bnb-explanation">
                    <div class="fee-comparison">
                        <div class="fee-card">
                            <h4>Standard Binance Fee</h4>
                            <div class="fee-amount">0.10%</div>
                            <p>per trade</p>
                        </div>
                        <div class="fee-arrow">→</div>
                        <div class="fee-card highlighted">
                            <h4>With BNB Discount</h4>
                            <div class="fee-amount">0.075%</div>
                            <p>per trade (25% off)</p>
                        </div>
                    </div>
                </div>
                
                <div class="bnb-setup">
                    <h3>How to Enable BNB Fee Discount</h3>
                    <ol class="setup-instructions">
                        <li>
                            <strong>Buy Some BNB</strong>
                            <p>On Binance, go to "Trade" → "Convert" or "Spot" and buy a small amount of BNB. Even $5-10 worth is enough to start — fees are tiny per trade.</p>
                        </li>
                        <li>
                            <strong>Enable BNB Fee Payment</strong>
                            <p>Go to your Binance Dashboard → Click your profile icon → "Fee" or search for "Using BNB to pay for fees"</p>
                            <p>Toggle <strong>"Use BNB for Fees"</strong> to ON.</p>
                        </li>
                        <li>
                            <strong>Keep BNB Balance Topped Up</strong>
                            <p>Binance will automatically deduct fees from your BNB balance. If it runs out, fees revert to 0.10%. Check occasionally and top up when low.</p>
                        </li>
                    </ol>
                </div>
                
                <div class="bnb-math">
                    <h4>📊 How Much Does This Save?</h4>
                    <p>For every $1,000 in trading volume:</p>
                    <ul>
                        <li><strong>Without BNB:</strong> $1.00 Binance fee (0.10%)</li>
                        <li><strong>With BNB:</strong> $0.75 Binance fee (0.075%)</li>
                        <li><strong>Savings:</strong> $0.25 per $1,000 traded</li>
                    </ul>
                    <p>It adds up! Active traders can save hundreds over time.</p>
                </div>
                
                <div class="info-box">
                    <strong>💡 Note:</strong> The BNB discount applies to <em>Binance's</em> trading fees, not IOI's commission. Both fees are separate:
                    <br>• <strong>Binance fee:</strong> 0.075% with BNB (or 0.10% without)
                    <br>• <strong>IOI commission:</strong> 0.065% (or $0 with subscription)
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
                            <td>Testing, pay-as-you-go</td>
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
                    <a href="mailto:support@getioi.app" class="btn btn-primary">Contact Support</a>
                </div>
            </section>

        </div>
    </div>
</main>

<style>
/* Payment Models Comparison */
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

/* Permissions Tabs */
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

.ip-list {
    background: #1a1a1a;
    border: 1px solid #333;
    border-radius: 6px;
    padding: 1rem;
    margin: 0.75rem 0;
    font-family: monospace;
}

/* Trust Section */
.trust-section {
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.05), rgba(212, 175, 55, 0.02));
    border: 1px solid rgba(212, 175, 55, 0.2);
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
}

.trust-section > h4 {
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

/* Sub-Account Tip Section */
.subaccount-tip {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(212, 175, 55, 0.2);
}

.subaccount-tip h4 {
    color: #64c896;
    margin-bottom: 1rem;
}

.subaccount-tip > p {
    color: #ccc;
    font-size: 1.05rem;
    margin-bottom: 1.5rem;
}

.subaccount-steps,
.subaccount-benefits {
    background: rgba(0,0,0,0.2);
    border-radius: 8px;
    padding: 1.25rem;
    margin-bottom: 1rem;
}

.subaccount-steps h5,
.subaccount-benefits h5 {
    color: #fff;
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
}

.subaccount-steps ol {
    padding-left: 1.25rem;
    margin: 0;
}

.subaccount-steps li {
    color: #aaa;
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
}

.subaccount-steps li strong {
    color: #fff;
}

.subaccount-benefits ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.subaccount-benefits li {
    color: #aaa;
    padding: 0.3rem 0;
    font-size: 0.9rem;
}

.subaccount-note {
    color: #64c896;
    font-size: 0.95rem;
    margin-top: 1rem;
    margin-bottom: 0;
}

/* Comparison Table */
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

/* Payment Summary */
.setup-payment-summary {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255,255,255,0.1);
}

/* Next Steps */
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

/* BNB Discount Section */
.setup-bnb-discount {
    margin-top: 3rem;
    padding: 2rem;
    background: linear-gradient(135deg, rgba(240, 185, 11, 0.08), rgba(240, 185, 11, 0.02));
    border: 1px solid rgba(240, 185, 11, 0.3);
    border-radius: 16px;
}

.setup-bnb-discount h2 {
    color: #F0B90B;
    margin-bottom: 0.5rem;
}

.setup-bnb-discount > p {
    color: #ccc;
    margin-bottom: 1.5rem;
}

.fee-comparison {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1.5rem;
    margin: 1.5rem 0;
    flex-wrap: wrap;
}

.fee-card {
    background: rgba(0,0,0,0.3);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 1.5rem 2rem;
    text-align: center;
    min-width: 150px;
}

.fee-card.highlighted {
    border-color: #F0B90B;
    background: rgba(240, 185, 11, 0.1);
}

.fee-card h4 {
    color: #888;
    font-size: 0.85rem;
    margin-bottom: 0.5rem;
    font-weight: normal;
}

.fee-card.highlighted h4 {
    color: #F0B90B;
}

.fee-amount {
    font-size: 2rem;
    font-weight: 700;
    color: #fff;
}

.fee-card.highlighted .fee-amount {
    color: #F0B90B;
}

.fee-card p {
    color: #666;
    font-size: 0.85rem;
    margin: 0;
}

.fee-arrow {
    font-size: 1.5rem;
    color: #F0B90B;
}

.bnb-setup {
    margin-top: 2rem;
}

.bnb-setup h3 {
    color: #fff;
    margin-bottom: 1rem;
}

.bnb-math {
    background: rgba(0,0,0,0.2);
    border-radius: 8px;
    padding: 1.25rem;
    margin-top: 1.5rem;
}

.bnb-math h4 {
    color: #F0B90B;
    margin-bottom: 0.75rem;
}

.bnb-math ul {
    list-style: none;
    padding: 0;
    margin: 0.75rem 0;
}

.bnb-math li {
    padding: 0.3rem 0;
    color: #ccc;
}

.bnb-math p {
    color: #aaa;
    margin: 0;
}

.bnb-math p:last-child {
    margin-top: 0.75rem;
    color: #F0B90B;
    font-weight: 500;
}

/* Responsive */
@media (max-width: 768px) {
    .next-step-card {
        flex-direction: column;
        text-align: center;
    }
    
    .comparison-table {
        display: block;
        overflow-x: auto;
    }
    
    .trust-point {
        flex-direction: column;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .fee-comparison {
        flex-direction: column;
    }
    
    .fee-arrow {
        transform: rotate(90deg);
    }
}
</style>

<?php get_footer(); ?>