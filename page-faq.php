<?php
/**
 * Template Name: FAQ
 * @package IOI
 */

get_header();
?>

<style>
/* FAQ Page Styles */
.faq-page .page-header {
    padding: 80px 0 40px;
    text-align: center;
}

.faq-page .page-header h1 {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

.faq-page .page-subtitle {
    color: var(--text-muted, #888);
    font-size: 1.1rem;
}

/* Category Navigation */
.faq-categories {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    justify-content: center;
    margin-bottom: 3rem;
    padding: 1rem;
    background: rgba(255,255,255,0.03);
    border-radius: 12px;
}

.faq-cat-link {
    padding: 0.6rem 1.2rem;
    border-radius: 8px;
    color: var(--text-muted, #888);
    text-decoration: none;
    transition: all 0.2s ease;
    font-size: 0.95rem;
}

.faq-cat-link:hover {
    color: var(--ioi-gold, #D4A017);
    background: rgba(212, 160, 23, 0.1);
}

.faq-cat-link.active {
    background: var(--ioi-gold, #D4A017);
    color: #000;
    font-weight: 600;
}

/* FAQ Sections */
.faq-section {
    margin-bottom: 3rem;
    scroll-margin-top: 100px;
}

.faq-section h2 {
    color: var(--ioi-gold, #D4A017);
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid rgba(212, 160, 23, 0.3);
}

/* Contact Section */
.faq-contact {
    text-align: center;
    padding: 3rem;
    background: rgba(255,255,255,0.03);
    border-radius: 16px;
    margin-top: 3rem;
}

.faq-contact h2 {
    border: none;
    padding-bottom: 0;
    margin-bottom: 0.5rem;
}

.faq-contact p {
    color: var(--text-muted, #888);
    margin-bottom: 1.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .faq-categories {
        gap: 0.25rem;
    }
    
    .faq-cat-link {
        padding: 0.5rem 0.8rem;
        font-size: 0.85rem;
    }
}
</style>

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
                            IOI is an automated cryptocurrency trading application that connects to your Binance account via API. It uses a momentum-based strategy to execute trades 24/7, capturing profits across multiple positions while managing risk. Your funds always stay on Binance - IOI trades on your behalf and collects fees transparently.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">How does IOI make money for me?</button>
                        <div class="faq-answer">
                            IOI's momentum trading algorithm identifies tokens showing upward price movement. It buys tokens in uptrends and sells when profit targets are reached, typically capturing small profits per trade. By executing many trades consistently, these gains can compound over time. The bot operates 24/7, taking advantage of opportunities you'd miss while sleeping or working.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What's the difference between Dry Run and Real Trading?</button>
                        <div class="faq-answer">
                            <strong>Dry Run (DR)</strong> is simulation mode. The bot tracks real market prices but doesn't execute actual trades. It's perfect for testing strategies without risking real money.<br><br>
                            <strong>Real Trading (RT)</strong> executes actual trades on your Binance account using your real balance. Only use this once you're comfortable with how the bot works.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Why isn't IOI on the Google Play Store?</button>
                        <div class="faq-answer">
                            Google Play's policies restrict apps that facilitate cryptocurrency trading. This is a policy decision by Google, not a reflection of our app's legitimacy or safety. Many reputable crypto apps face the same restriction. Our APK is digitally signed, and we're working on availability through Samsung Galaxy Store and Huawei AppGallery.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What exchanges does IOI support?</button>
                        <div class="faq-answer">
                            Currently, IOI exclusively supports Binance (binance.com). Binance is the world's largest cryptocurrency exchange by trading volume, offering excellent liquidity and a wide selection of trading pairs. We may add support for additional exchanges in the future.
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
                            Yes, IOI is designed with security and transparency as top priorities:<br><br>
                            • <strong>Client-side encryption:</strong> Your API keys are encrypted on your device with your PIN before being sent to our servers<br>
                            • <strong>Your funds stay on Binance:</strong> We never hold or have access to your cryptocurrency<br>
                            • <strong>Withdrawal whitelisting:</strong> You can restrict withdrawals to only our wallet address shown in the app<br>
                            • <strong>Full transparency:</strong> Precise accounting of all fee withdrawals is available and can be requested at any time<br>
                            • <strong>IP whitelisting:</strong> You can restrict API access to only our server IPs for extra protection
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Does IOI need withdrawal permissions?</button>
                        <div class="faq-answer">
                            <strong>It depends on your pricing model:</strong><br><br>
                            • <strong>Commission-based trading:</strong> Yes, withdrawal permission is required so IOI can collect the 0.065% trading fees automatically<br>
                            • <strong>Subscription with auto-pay:</strong> Yes, withdrawal permission is required for automated monthly payments<br>
                            • <strong>Subscription with manual payment:</strong> No withdrawal permission needed - you pay manually each month and trade without granting withdrawal access<br><br>
                            <strong>Important security steps if enabling withdrawals:</strong><br>
                            1. Only whitelist the IOI wallet address shown in the app - no other addresses<br>
                            2. Set withdrawal limits on your API key if desired<br>
                            3. Precise accounting of all withdrawals is maintained and can be requested anytime
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">I want commission-based trading but don't trust withdrawal permissions. What can I do?</button>
                        <div class="faq-answer">
                            <strong>Use a Binance sub-account.</strong> This is the best solution for users who want the flexibility of commission-based trading but prefer extra security:<br><br>
                            1. Create a sub-account on Binance (free and takes 2 minutes)<br>
                            2. Connect IOI to the sub-account instead of your main account<br>
                            3. Transfer only the amount you want to trade into the sub-account<br>
                            4. Your main account remains completely isolated<br><br>
                            This way, even with withdrawal permissions enabled, IOI can only access funds in the sub-account - never your main holdings. You stay in full control of how much capital is at risk.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What happens if I lose my phone?</button>
                        <div class="faq-answer">
                            If you lose your phone:<br><br>
                            1. Log into Binance and delete the API key you created for IOI<br>
                            2. This immediately revokes IOI's access to your account<br>
                            3. Your funds remain safe on Binance<br>
                            4. When you get a new phone, install IOI and create a new API key<br><br>
                            Deleting your API key instantly stops all access - it's the fastest way to secure your account.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">How does IOI protect my API keys?</button>
                        <div class="faq-answer">
                            IOI uses client-side encryption to protect your credentials:<br><br>
                            1. You enter your API key and secret in the app<br>
                            2. The app encrypts them on your device using a key derived from your PIN<br>
                            3. Only the encrypted data is sent to our servers<br>
                            4. Your PIN never leaves your device<br>
                            5. When trading, our server decrypts temporarily to execute trades, then discards the keys from memory<br><br>
                            If you forget your PIN, you'll need to re-enter your API credentials - we cannot recover them for you.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">How can I verify what IOI withdraws?</button>
                        <div class="faq-answer">
                            Full transparency is a core principle:<br><br>
                            • Every withdrawal is logged with exact amounts, timestamps, and linked trades<br>
                            • You can view withdrawal history in the app at any time<br>
                            • Detailed accounting reports can be requested via support@getioi.app<br>
                            • All withdrawals go only to the wallet address displayed in the app<br>
                            • You can cross-reference with your Binance withdrawal history<br><br>
                            We believe in radical transparency - you should always know exactly where your money goes.
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
                            We recommend starting with at least $100 USDT/USDC for meaningful results. The bot works better with more capital as it can diversify across more positions. However, you can technically start with any amount - just keep in mind that smaller amounts may result in fewer trading opportunities due to Binance's minimum order sizes.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What returns can I expect?</button>
                        <div class="faq-answer">
                            The app has been in development and testing for over a year. Results vary significantly based on market conditions and your bot configuration.<br><br>
                            In our testing, we've seen anywhere from <strong>10% to 45% monthly returns</strong> during favorable market conditions. However, crypto markets are volatile - losses are possible, especially during downtrends or sideways markets.<br><br>
                            We strongly recommend:<br>
                            • Starting with dry-run mode to test different bot setups<br>
                            • Experimenting with multiple configurations to find what works best<br>
                            • Never investing more than you can afford to lose<br><br>
                            <strong>Past performance doesn't guarantee future results.</strong> Please read our <a href="<?php echo home_url('/risk-disclosure/'); ?>">Risk Disclosure</a> for more information.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Can I lose money?</button>
                        <div class="faq-answer">
                            <strong>Yes.</strong> While our algorithms are designed to minimize risk with features like automatic stop-loss, cryptocurrency trading always carries the possibility of losses. You can lose some or all of your invested capital. Never trade with money you can't afford to lose. We strongly recommend starting with Dry Run mode and small amounts to understand how the bot performs.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">How do I stop the bot?</button>
                        <div class="faq-answer">
                            You have two options:<br><br>
                            • <strong>Graceful Shutdown:</strong> The bot stops opening new positions and waits for existing positions to close at profit targets or stop-loss. This is the recommended method.<br>
                            • <strong>Force Stop:</strong> Immediately sells all open positions at market price. Use this only if you need to exit immediately, as it may result in losses on open positions.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What tokens does the bot trade?</button>
                        <div class="faq-answer">
                            IOI trades a curated selection of tokens on Binance, primarily against USDT pairs. We apply quality filters to exclude:<br><br>
                            • Low-liquidity tokens<br>
                            • Newly listed tokens (until they prove stable)<br>
                            • Tokens showing signs of potential issues<br><br>
                            The specific tokens traded depend on market conditions and momentum signals at any given time.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Does the bot trade 24/7?</button>
                        <div class="faq-answer">
                            Yes! Once started, the bot monitors markets and executes trades around the clock, 7 days a week. This is one of the main advantages of automated trading - it captures opportunities even while you sleep. You can monitor performance and make adjustments anytime through the app.
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
                            IOI offers two pricing models:<br><br>
                            • <strong>Commission Model:</strong> 0.065% per trade (both buy and sell). No monthly fees, unlimited budget. Requires withdrawal permission for automatic fee collection.<br>
                            • <strong>Subscription Model:</strong> Monthly fee ($5-$1,000) with zero trading commissions. Can be paid automatically (requires withdrawal permission) or manually (no withdrawal permission needed).<br><br>
                            Visit our <a href="<?php echo home_url('/#pricing'); ?>">Pricing</a> section to compare options.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">How is the 0.065% commission calculated?</button>
                        <div class="faq-answer">
                            The commission is calculated on the total trade value, charged on both buy and sell transactions. For example:<br><br>
                            • You buy $1,000 of BTC → Commission: $0.65<br>
                            • You sell $1,020 of BTC → Commission: $0.66<br>
                            • Total commission for this round-trip: $1.31<br><br>
                            This is lower than Binance's standard trading fee of 0.1% (or 0.075% with BNB discount).
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">How are commissions collected?</button>
                        <div class="faq-answer">
                            Commissions are collected automatically via Binance withdrawal to our platform wallet. This happens periodically when accumulated fees reach a threshold (not after every trade) to minimize transaction overhead.<br><br>
                            <strong>Important safeguards:</strong><br>
                            • Only whitelist our wallet address (shown in the app) when creating your API key<br>
                            • Every withdrawal is logged with full details<br>
                            • You can request a detailed accounting report at any time<br>
                            • All withdrawals are visible in your Binance history for verification
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Can I use IOI without giving withdrawal permission?</button>
                        <div class="faq-answer">
                            <strong>Yes!</strong> Choose a subscription plan and select manual payment. You'll pay your monthly subscription directly (via crypto or card), and your API key only needs trading permissions - no withdrawal access required.<br><br>
                            This is ideal for users who want maximum security and don't mind paying upfront for their subscription.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Can I switch between pricing models?</button>
                        <div class="faq-answer">
                            Yes! You can switch between commission-based and subscription models at any time. When you upgrade to a subscription, commission charges stop immediately. If you cancel your subscription, you'll automatically revert to the commission model (make sure withdrawal permissions are enabled if using commission-based).
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
                            • <strong>Android:</strong> Version 8.0 (Oreo) or higher<br>
                            • <strong>Storage:</strong> ~60MB free space<br>
                            • <strong>Internet:</strong> Stable connection recommended (bot runs on our servers, not your phone)
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Does my phone need to stay on?</button>
                        <div class="faq-answer">
                            No! The trading bot runs on our servers, not your phone. Once configured, it continues trading even if your phone is off, in airplane mode, or the app is uninstalled. Your phone is only needed to monitor performance and adjust settings. Think of the app as a remote control for your bot.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What happens during server maintenance?</button>
                        <div class="faq-answer">
                            We schedule maintenance during low-volume periods and keep downtime minimal. During maintenance:<br><br>
                            • No new trades are opened<br>
                            • Existing positions remain on Binance (unaffected)<br>
                            • Stop-losses continue to work (handled by Binance)<br>
                            • Trading resumes automatically when maintenance completes
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">I forgot my PIN. What do I do?</button>
                        <div class="faq-answer">
                            Due to our client-side encryption model, we cannot recover your PIN. If you forget it:<br><br>
                            1. Uninstall and reinstall the app<br>
                            2. Re-enter your Binance API credentials<br>
                            3. Create a new PIN<br><br>
                            Your bots on our server will continue running. The app will reconnect to them once you log back in with your API credentials.
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">How do I update the app?</button>
                        <div class="faq-answer">
                            For APK installs:<br><br>
                            1. Download the latest APK from getioi.app<br>
                            2. Install it over your existing app (don't uninstall first)<br>
                            3. Your settings and login will be preserved<br><br>
                            We recommend enabling notifications in the app to be alerted about important updates.
                        </div>
                    </div>

                </div>
            </section>

            <!-- Still Have Questions -->
            <section class="faq-contact">
                <h2>Still Have Questions?</h2>
                <p>Can't find what you're looking for? Our support team is happy to help.</p>
                <a href="mailto:support@getioi.app" class="btn btn-primary btn-lg">Contact Support</a>
            </section>

        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Category navigation with smooth scroll
    document.querySelectorAll('.faq-cat-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            document.querySelectorAll('.faq-cat-link').forEach(function(l) {
                l.classList.remove('active');
            });
            this.classList.add('active');
            
            var targetId = this.getAttribute('href');
            var target = document.querySelector(targetId);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
    
    // Highlight category on scroll
    var sections = document.querySelectorAll('.faq-section');
    window.addEventListener('scroll', function() {
        var scrollPos = window.scrollY + 150;
        
        sections.forEach(function(section) {
            if (section.offsetTop <= scrollPos && (section.offsetTop + section.offsetHeight) > scrollPos) {
                var id = section.getAttribute('id');
                document.querySelectorAll('.faq-cat-link').forEach(function(link) {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + id) {
                        link.classList.add('active');
                    }
                });
            }
        });
    });
});
</script>

<?php get_footer(); ?>