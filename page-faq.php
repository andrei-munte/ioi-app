<?php
/**
 * Template Name: FAQ
 * @package IOI
 */

get_header();
?>

<main class="internal-page faq-page">
    <div class="page-header">
        <div class="container">
            <h1>Frequently Asked Questions</h1>
            <p class="page-subtitle">Find answers to common questions about IOI</p>
        </div>
    </div>
    
    <div class="page-content">
        <div class="container container-md">
            
            <!-- FAQ Categories Navigation -->
            <div class="faq-categories">
                <a href="#general" class="faq-cat-link active">General</a>
                <a href="#security" class="faq-cat-link">Security</a>
                <a href="#trading" class="faq-cat-link">Trading</a>
                <a href="#pricing" class="faq-cat-link">Pricing</a>
                <a href="#technical" class="faq-cat-link">Technical</a>
            </div>

            <!-- General Questions -->
            <section class="faq-section" id="general">
                <h2>General Questions</h2>
                <div class="faq-list">
                    
                    <div class="faq-item">
                        <button class="faq-question">What is IOI?</button>
                        <div class="faq-answer">
                            <p>IOI is an automated cryptocurrency trading application that connects to your Binance account via API. It uses algorithmic strategies to execute trades 24/7, capturing small profits across multiple positions while managing risk. You maintain full control of your funds on Binance - IOI only has permission to trade, never to withdraw.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">How does IOI make money for me?</button>
                        <div class="faq-answer">
                            <p>IOI's trading algorithm identifies short-term price movements across hundreds of cryptocurrency pairs. It buys tokens when conditions are favorable and sells when targets are reached, typically capturing small profits (0.5-2%) per trade. By executing many trades consistently, these small gains compound over time. The bot operates 24/7, taking advantage of opportunities you'd miss while sleeping or working.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What's the difference between Dry Run and Real Trading?</button>
                        <div class="faq-answer">
                            <p><strong>Dry Run (DR)</strong> is simulation mode. The bot tracks real market prices but doesn't execute actual trades. It's perfect for testing strategies without risking real money.</p>
                            <p><strong>Real Trading (RT)</strong> executes actual trades on your Binance account using your real balance. Only use this once you're comfortable with how the bot works.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Why isn't IOI on the Google Play Store?</button>
                        <div class="faq-answer">
                            <p>Google Play's policies prohibit apps that facilitate cryptocurrency trading. This is a policy decision by Google, not a reflection of our app's legitimacy or safety. Many reputable crypto apps face the same restriction. Our APK is digitally signed, and we're available on Samsung Galaxy Store and Huawei AppGallery for additional verification.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What exchanges does IOI support?</button>
                        <div class="faq-answer">
                            <p>Currently, IOI exclusively supports Binance (binance.com). Binance is the world's largest cryptocurrency exchange by trading volume, offering excellent liquidity and a wide selection of trading pairs. We may add support for additional exchanges in the future.</p>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Security Questions -->
            <section class="faq-section" id="security">
                <h2>Security</h2>
                <div class="faq-list">
                    
                    <div class="faq-item">
                        <button class="faq-question">Is IOI safe to use?</button>
                        <div class="faq-answer">
                            <p>Yes, IOI is designed with security as a top priority:</p>
                            <ul>
                                <li><strong>No withdrawal access:</strong> We only request trading permissions, never withdrawal permissions</li>
                                <li><strong>Zero-knowledge encryption:</strong> Your API keys are encrypted on your device with your PIN</li>
                                <li><strong>Your funds stay on Binance:</strong> We never hold or have access to your cryptocurrency</li>
                                <li><strong>IP whitelisting:</strong> You can restrict API access to only our server IPs</li>
                            </ul>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Can IOI withdraw my funds?</button>
                        <div class="faq-answer">
                            <p><strong>No, absolutely not.</strong> When creating your API key, you should NEVER enable withdrawal permissions. IOI only needs "Enable Reading" and "Enable Spot & Margin Trading" permissions. With withdrawals disabled at the API level, it's technically impossible for anyone (including IOI) to withdraw funds from your account using your API key.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What happens if I lose my phone?</button>
                        <div class="faq-answer">
                            <p>If you lose your phone:</p>
                            <ol>
                                <li>Log into Binance and delete the API key you created for IOI</li>
                                <li>This immediately revokes IOI's access to your account</li>
                                <li>Your funds remain safe on Binance</li>
                                <li>When you get a new phone, install IOI and create a new API key</li>
                            </ol>
                            <p>Since we can't withdraw funds, losing your phone doesn't put your assets at risk - just delete the API key as a precaution.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What is zero-knowledge encryption?</button>
                        <div class="faq-answer">
                            <p>Zero-knowledge means our servers never see your unencrypted API credentials. Here's how it works:</p>
                            <ol>
                                <li>You enter your API key and secret in the app</li>
                                <li>The app encrypts them using a key derived from your PIN</li>
                                <li>Only encrypted data is sent to our servers</li>
                                <li>We cannot decrypt your credentials without your PIN</li>
                                <li>If you forget your PIN, you must re-enter your API credentials (we can't recover them)</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Trading Questions -->
            <section class="faq-section" id="trading">
                <h2>Trading</h2>
                <div class="faq-list">
                    
                    <div class="faq-item">
                        <button class="faq-question">What's the minimum amount needed to start?</button>
                        <div class="faq-answer">
                            <p>We recommend starting with at least $100 USDT/USDC for meaningful results. The bot works better with more capital as it can diversify across more positions. However, you can technically start with any amount - just keep in mind that smaller amounts may result in fewer trading opportunities.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What returns can I expect?</button>
                        <div class="faq-answer">
                            <p>We cannot guarantee specific returns - cryptocurrency trading always involves risk. Historical performance has shown monthly returns in the range of 3-10%, with win rates typically between 75-90%. However, past performance does not guarantee future results. Market conditions vary, and losses are possible. Please read our <a href="<?php echo home_url('/risk-disclosure/'); ?>">Risk Disclosure</a> for more information.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Can I lose money?</button>
                        <div class="faq-answer">
                            <p><strong>Yes.</strong> While our algorithms are designed to minimize risk, cryptocurrency trading always carries the possibility of losses. You can lose some or all of your invested capital. Never trade with money you can't afford to lose. We strongly recommend starting with Dry Run mode and small amounts to understand the risks involved.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">How do I stop the bot?</button>
                        <div class="faq-answer">
                            <p>You have two options:</p>
                            <ul>
                                <li><strong>Graceful Shutdown:</strong> The bot will stop opening new positions and wait for existing positions to close profitably (or at stop-loss). This is the recommended method.</li>
                                <li><strong>Force Stop:</strong> Immediately sells all open positions at market price. Use this only if you need to exit immediately, as it may result in losses on open positions.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What tokens does the bot trade?</button>
                        <div class="faq-answer">
                            <p>IOI trades a curated selection of tokens on Binance, primarily against USDT and USDC pairs. We exclude low-liquidity tokens, newly listed tokens (until they prove stable), and tokens showing signs of potential delisting. The specific tokens traded depend on market conditions and our algorithm's analysis.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Does the bot trade 24/7?</button>
                        <div class="faq-answer">
                            <p>Yes! Once started, the bot monitors markets and executes trades around the clock, 7 days a week. This is one of the main advantages of automated trading - it captures opportunities even while you sleep. You can monitor performance and make adjustments anytime through the app.</p>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Pricing Questions -->
            <section class="faq-section" id="pricing">
                <h2>Pricing</h2>
                <div class="faq-list">
                    
                    <div class="faq-item">
                        <button class="faq-question">How much does IOI cost?</button>
                        <div class="faq-answer">
                            <p>IOI offers two pricing models:</p>
                            <ul>
                                <li><strong>Commission Model:</strong> 0.065% per trade (both buy and sell). No monthly fees, unlimited budget. Perfect if you want to start without upfront costs.</li>
                                <li><strong>Subscription Model:</strong> Monthly fee ($5-$1,000) with zero trading commissions. Better value for active traders. Each tier has a monthly trading budget limit.</li>
                            </ul>
                            <p>Visit our <a href="<?php echo home_url('/#pricing'); ?>">Pricing</a> section to compare options.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">How is the 0.065% commission calculated?</button>
                        <div class="faq-answer">
                            <p>The commission is calculated on the total trade value, charged on both buy and sell transactions. For example:</p>
                            <ul>
                                <li>You buy $1,000 of BTC → Commission: $0.65</li>
                                <li>You sell $1,020 of BTC → Commission: $0.66</li>
                                <li>Total commission for this round-trip: $1.31</li>
                            </ul>
                            <p>This is lower than Binance's standard trading fee of 0.1% (or 0.075% with BNB discount).</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">How are commissions collected?</button>
                        <div class="faq-answer">
                            <p>Commissions are collected automatically via Binance Universal Transfer from your spot wallet. This happens periodically (not after every trade) to minimize transaction overhead. You'll always see a clear record of commission transfers in your transaction history.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Can I switch between pricing models?</button>
                        <div class="faq-answer">
                            <p>Yes! You can switch between commission-based and subscription models at any time. When you upgrade to a subscription, commission charges stop immediately. If you cancel your subscription, you'll automatically revert to the commission model.</p>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Technical Questions -->
            <section class="faq-section" id="technical">
                <h2>Technical</h2>
                <div class="faq-list">
                    
                    <div class="faq-item">
                        <button class="faq-question">What are the system requirements?</button>
                        <div class="faq-answer">
                            <ul>
                                <li><strong>Android:</strong> Version 8.0 (Oreo) or higher</li>
                                <li><strong>iOS:</strong> Coming soon</li>
                                <li><strong>Storage:</strong> ~50MB free space</li>
                                <li><strong>Internet:</strong> Stable connection recommended (bot runs on our servers, not your phone)</li>
                            </ul>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Does my phone need to stay on?</button>
                        <div class="faq-answer">
                            <p>No! The trading bot runs on our servers, not your phone. Once configured, it continues trading even if your phone is off, in airplane mode, or uninstalled. Your phone is only needed to monitor performance and adjust settings. Think of the app as a remote control for your bot.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What happens during server maintenance?</button>
                        <div class="faq-answer">
                            <p>We schedule maintenance during low-volume periods and keep downtime minimal (typically under 30 minutes). During maintenance:</p>
                            <ul>
                                <li>No new trades are opened</li>
                                <li>Existing positions remain on Binance (unaffected)</li>
                                <li>Stop-losses continue to work (handled by Binance)</li>
                                <li>Trading resumes automatically when maintenance completes</li>
                            </ul>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">I forgot my PIN. What do I do?</button>
                        <div class="faq-answer">
                            <p>Due to our zero-knowledge security model, we cannot recover your PIN. If you forget it:</p>
                            <ol>
                                <li>Uninstall and reinstall the app</li>
                                <li>Re-enter your Binance API credentials</li>
                                <li>Create a new PIN</li>
                            </ol>
                            <p>Your bots on our server will continue running. The app will reconnect to them once you log back in.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">How do I update the app?</button>
                        <div class="faq-answer">
                            <p>If you installed from Galaxy Store or AppGallery, updates are automatic. For APK installs:</p>
                            <ol>
                                <li>Download the latest APK from getioi.app</li>
                                <li>Install it over your existing app (don't uninstall first)</li>
                                <li>Your settings and login will be preserved</li>
                            </ol>
                            <p>We recommend enabling notifications to be alerted about important updates.</p>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Still Have Questions -->
            <section class="faq-contact">
                <h2>Still Have Questions?</h2>
                <p>Can't find what you're looking for? Our support team is happy to help.</p>
                <a href="<?php echo home_url('/contact/'); ?>" class="btn btn-primary btn-lg">Contact Support</a>
            </section>

        </div>
    </div>
</main>

<script>
// FAQ Accordion
document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
        const item = button.parentElement;
        const isActive = item.classList.contains('active');
        
        // Close all items in the same section
        item.parentElement.querySelectorAll('.faq-item').forEach(i => {
            i.classList.remove('active');
        });
        
        // Toggle clicked item
        if (!isActive) {
            item.classList.add('active');
        }
    });
});

// Category navigation
document.querySelectorAll('.faq-cat-link').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelectorAll('.faq-cat-link').forEach(l => l.classList.remove('active'));
        link.classList.add('active');
        
        const target = document.querySelector(link.getAttribute('href'));
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});
</script>

<?php get_footer(); ?>
