<?php
/**
 * Template Name: Terms of Service
 * @package IOI
 */

get_header();
$last_updated = 'March 3, 2026';
?>

<main class="internal-page">
    <div class="page-header">
        <div class="container">
            <h1>Terms of Service</h1>
            <p class="page-subtitle">Please read these terms carefully before using IOI</p>
        </div>
    </div>
    
    <div class="page-content">
        <div class="container container-md">
            <div class="legal-content">
                
                <section class="legal-section">
                    <h2>1. Acceptance of Terms</h2>
                    <p>By downloading, installing, or using the IOI application ("App") or accessing our services at getioi.app ("Services"), you agree to be bound by these Terms of Service ("Terms"). If you do not agree to these Terms, do not use our Services.</p>
                    <p>IOI is an automated trading software service ("we", "us", or "our"). These Terms constitute a legally binding agreement between you and IOI.</p>
                </section>

                <section class="legal-section">
                    <h2>2. Eligibility</h2>
                    <p>To use IOI, you must:</p>
                    <ul>
                        <li>Be at least 18 years of age (or the age of majority in your jurisdiction)</li>
                        <li>Have a valid Binance account in good standing</li>
                        <li>Not be located in a jurisdiction where cryptocurrency trading is prohibited</li>
                        <li>Not be on any sanctions list or prohibited from engaging in financial services</li>
                    </ul>
                    <p>By using our Services, you represent and warrant that you meet all eligibility requirements.</p>
                </section>

                <section class="legal-section">
                    <h2>3. Description of Services</h2>
                    <p>IOI provides automated cryptocurrency trading software that:</p>
                    <ul>
                        <li>Connects to your Binance account via API</li>
                        <li>Executes trades based on algorithmic strategies</li>
                        <li>Monitors market conditions 24/7</li>
                        <li>Provides portfolio tracking and analytics</li>
                    </ul>
                    <p>IOI does not hold, custody, or have access to your funds. All trading occurs on your Binance account, and you retain full control of your assets at all times.</p>
                </section>

                <section class="legal-section">
                    <h2>4. API Access and Security</h2>
                    <p>To use IOI, you must provide API credentials from your Binance account. You agree to:</p>
                    <ul>
                        <li>Only provide API keys with "Enable Trading" and "Enable Reading" permissions</li>
                        <li>Never enable withdrawal permissions on API keys used with IOI</li>
                        <li>Whitelist only IOI's designated IP addresses for API access</li>
                        <li>Keep your PIN and device secure</li>
                        <li>Notify us immediately of any unauthorized access</li>
                    </ul>
                    <p>Your API credentials are encrypted locally on your device using your PIN. We employ zero-knowledge architecture, meaning our servers never have access to your unencrypted API keys.</p>
                </section>

                <section class="legal-section">
                    <h2>5. Fees and Payment</h2>
                    <h3>5.1 Commission Model</h3>
                    <p>If you choose the commission-based model, you agree to pay 0.065% of each trade value (both buy and sell transactions). Commissions are collected via Binance Universal Transfer from your trading account.</p>
                    
                    <h3>5.2 Subscription Model</h3>
                    <p>Subscription tiers are available with the following terms:</p>
                    <ul>
                        <li>Subscriptions are billed monthly in USDT/USDC</li>
                        <li>Each tier has a maximum monthly trading budget</li>
                        <li>Subscribers pay zero trading commissions within their budget limit</li>
                        <li>Subscriptions can be upgraded or downgraded at any time</li>
                    </ul>
                    
                    <h3>5.3 Binance Fees</h3>
                    <p>IOI fees are separate from and in addition to any fees charged by Binance for trading. You are responsible for all Binance trading fees.</p>
                </section>

                <section class="legal-section">
                    <h2>6. Risk Disclosure</h2>
                    <p><strong>IMPORTANT:</strong> Cryptocurrency trading involves substantial risk of loss. Please read our full <a href="<?php echo home_url('/risk-disclosure/'); ?>">Risk Disclosure</a> document.</p>
                    <p>By using IOI, you acknowledge that:</p>
                    <ul>
                        <li>Past performance does not guarantee future results</li>
                        <li>You may lose some or all of your invested capital</li>
                        <li>Automated trading systems can malfunction or produce unexpected results</li>
                        <li>Market conditions can change rapidly and unpredictably</li>
                        <li>You are solely responsible for your trading decisions</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>7. Prohibited Uses</h2>
                    <p>You agree not to:</p>
                    <ul>
                        <li>Use IOI for any illegal purpose or in violation of any laws</li>
                        <li>Attempt to reverse engineer, decompile, or modify the App</li>
                        <li>Share your account credentials with third parties</li>
                        <li>Use IOI to manipulate markets or engage in wash trading</li>
                        <li>Circumvent any security measures or access restrictions</li>
                        <li>Use automated systems to access our Services beyond normal app usage</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>8. Intellectual Property</h2>
                    <p>The IOI App, including all content, features, algorithms, and functionality, is owned by IOI and protected by international copyright, trademark, and other intellectual property laws. You are granted a limited, non-exclusive, non-transferable license to use the App for personal trading purposes only.</p>
                </section>

                <section class="legal-section">
                    <h2>9. Disclaimer of Warranties</h2>
                    <p>THE SERVICES ARE PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED. WE DO NOT WARRANT THAT THE SERVICES WILL BE UNINTERRUPTED, ERROR-FREE, OR SECURE. WE MAKE NO WARRANTIES REGARDING TRADING PERFORMANCE, PROFITABILITY, OR RESULTS.</p>
                </section>

                <section class="legal-section">
                    <h2>10. Limitation of Liability</h2>
                    <p>TO THE MAXIMUM EXTENT PERMITTED BY LAW, IOI SHALL NOT BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES, INCLUDING BUT NOT LIMITED TO LOSS OF PROFITS, DATA, OR OTHER INTANGIBLE LOSSES, RESULTING FROM YOUR USE OF THE SERVICES.</p>
                    <p>OUR TOTAL LIABILITY SHALL NOT EXCEED THE AMOUNT OF FEES PAID BY YOU TO IOI IN THE TWELVE (12) MONTHS PRECEDING THE CLAIM.</p>
                </section>

                <section class="legal-section">
                    <h2>11. Indemnification</h2>
                    <p>You agree to indemnify and hold harmless IOI and its operators, employees, and agents from any claims, damages, losses, or expenses arising from your use of the Services or violation of these Terms.</p>
                </section>

                <section class="legal-section">
                    <h2>12. Termination</h2>
                    <p>We reserve the right to suspend or terminate your access to the Services at any time, with or without cause. Upon termination:</p>
                    <ul>
                        <li>All active bots will be gracefully shut down</li>
                        <li>Any pending commissions will be collected</li>
                        <li>Your API credentials will be deleted from our systems</li>
                    </ul>
                    <p>You may terminate your account at any time by stopping all bots and uninstalling the App.</p>
                </section>

                <section class="legal-section">
                    <h2>13. Governing Law</h2>
                    <p>These Terms shall be governed by and construed in accordance with applicable laws. Any disputes arising under these Terms shall be resolved through good faith negotiation, and if necessary, binding arbitration.</p>
                </section>

                <section class="legal-section">
                    <h2>14. Changes to Terms</h2>
                    <p>We reserve the right to modify these Terms at any time. We will notify you of material changes via the App or email. Your continued use of the Services after changes become effective constitutes acceptance of the new Terms.</p>
                </section>

                <section class="legal-section">
                    <h2>15. Contact Information</h2>
                    <p>For questions about these Terms, please contact us at:</p>
                    <p>Email: <a href="mailto:legal@getioi.app">legal@getioi.app</a></p>
                </section>

                <p class="last-updated">Last updated: <?php echo $last_updated; ?></p>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
