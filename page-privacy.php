<?php
/**
 * Template Name: Privacy Policy
 * @package IOI
 */

get_header();
$last_updated = 'March 3, 2026';
?>

<main class="internal-page">
    <div class="page-header">
        <div class="container">
            <h1>Privacy Policy</h1>
            <p class="page-subtitle">How we collect, use, and protect your information</p>
        </div>
    </div>
    
    <div class="page-content">
        <div class="container container-md">
            <div class="legal-content">
                
                <section class="legal-section">
                    <h2>1. Introduction</h2>
                    <p>IOI ("we", "us", or "our") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our mobile application and services.</p>
                    <p>Please read this policy carefully. By using IOI, you consent to the practices described herein.</p>
                </section>

                <section class="legal-section">
                    <h2>2. Information We Collect</h2>
                    
                    <h3>2.1 Information You Provide</h3>
                    <ul>
                        <li><strong>Account Information:</strong> Email address, username (optional)</li>
                        <li><strong>API Credentials:</strong> Binance API keys (encrypted locally on your device)</li>
                        <li><strong>Communication:</strong> Messages you send to our support team</li>
                    </ul>
                    
                    <h3>2.2 Information Collected Automatically</h3>
                    <ul>
                        <li><strong>Device Information:</strong> Device type, operating system, unique device identifiers</li>
                        <li><strong>Usage Data:</strong> App features used, bot configurations, trading statistics</li>
                        <li><strong>Performance Data:</strong> App crashes, errors, and diagnostic information</li>
                    </ul>
                    
                    <h3>2.3 Information We Do NOT Collect</h3>
                    <ul>
                        <li>Your unencrypted Binance API keys (zero-knowledge architecture)</li>
                        <li>Your Binance account password</li>
                        <li>Direct access to your funds or ability to withdraw</li>
                        <li>Personal financial information beyond trading activity</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>3. How We Use Your Information</h2>
                    <p>We use the collected information to:</p>
                    <ul>
                        <li>Provide and maintain our trading services</li>
                        <li>Execute trades on your behalf via Binance API</li>
                        <li>Monitor and improve app performance</li>
                        <li>Send important service notifications</li>
                        <li>Provide customer support</li>
                        <li>Detect and prevent fraud or abuse</li>
                        <li>Comply with legal obligations</li>
                        <li>Analyze usage patterns to improve our services</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>4. Zero-Knowledge Architecture</h2>
                    <p>IOI employs a zero-knowledge security model for your sensitive data:</p>
                    <ul>
                        <li>Your Binance API credentials are encrypted on your device using your PIN</li>
                        <li>Encryption keys are derived from your PIN and never leave your device</li>
                        <li>Our servers only receive encrypted credential packages during active trading sessions</li>
                        <li>We cannot decrypt or access your API keys without your PIN</li>
                        <li>If you forget your PIN, credentials must be re-entered (we cannot recover them)</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>5. Data Storage and Security</h2>
                    <p>We implement industry-standard security measures:</p>
                    <ul>
                        <li>All data transmitted between app and servers uses TLS 1.3 encryption</li>
                        <li>Sensitive data is encrypted at rest using AES-256</li>
                        <li>Servers are hosted in secure data centers with 24/7 monitoring</li>
                        <li>Regular security audits and testing</li>
                        <li>Access to user data is strictly limited and logged</li>
                    </ul>
                    
                    <h3>Data Retention</h3>
                    <ul>
                        <li>Trading history: Retained for the duration of your account plus 7 years for tax/legal purposes</li>
                        <li>Account data: Retained until account deletion</li>
                        <li>Support communications: Retained for 3 years</li>
                        <li>Analytics data: Aggregated and anonymized after 90 days</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>6. Information Sharing</h2>
                    <p>We do not sell your personal information. We may share information with:</p>
                    
                    <h3>6.1 Service Providers</h3>
                    <ul>
                        <li>Cloud hosting providers (for app infrastructure)</li>
                        <li>Analytics services (anonymized usage data only)</li>
                        <li>Customer support tools</li>
                    </ul>
                    
                    <h3>6.2 Legal Requirements</h3>
                    <p>We may disclose information if required by law, court order, or government request, or to protect our rights, property, or safety.</p>
                    
                    <h3>6.3 Business Transfers</h3>
                    <p>In the event of a merger, acquisition, or sale of assets, your information may be transferred as part of the transaction.</p>
                </section>

                <section class="legal-section">
                    <h2>7. Your Rights</h2>
                    <p>Depending on your location, you may have the following rights:</p>
                    <ul>
                        <li><strong>Access:</strong> Request a copy of your personal data</li>
                        <li><strong>Correction:</strong> Request correction of inaccurate data</li>
                        <li><strong>Deletion:</strong> Request deletion of your data (subject to legal retention requirements)</li>
                        <li><strong>Portability:</strong> Request your data in a portable format</li>
                        <li><strong>Objection:</strong> Object to certain processing activities</li>
                        <li><strong>Withdrawal:</strong> Withdraw consent at any time</li>
                    </ul>
                    <p>To exercise these rights, contact us at <a href="mailto:privacy@getioi.app">privacy@getioi.app</a></p>
                </section>

                <section class="legal-section">
                    <h2>8. International Data Transfers</h2>
                    <p>Your information may be transferred to and processed in countries other than your own. We ensure appropriate safeguards are in place, including:</p>
                    <ul>
                        <li>Standard contractual clauses approved by relevant authorities</li>
                        <li>Data processing agreements with all service providers</li>
                        <li>Compliance with applicable data transfer regulations</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>9. Children's Privacy</h2>
                    <p>IOI is not intended for users under 18 years of age. We do not knowingly collect personal information from children. If we discover that a child has provided us with personal information, we will delete it immediately.</p>
                </section>

                <section class="legal-section">
                    <h2>10. Third-Party Links</h2>
                    <p>Our app may contain links to third-party websites or services (such as Binance). We are not responsible for the privacy practices of these third parties. We encourage you to review their privacy policies.</p>
                </section>

                <section class="legal-section">
                    <h2>11. Cookies and Tracking</h2>
                    <p>Our website uses cookies for:</p>
                    <ul>
                        <li>Essential functionality (session management, preferences)</li>
                        <li>Analytics (anonymized usage statistics)</li>
                        <li>Performance optimization</li>
                    </ul>
                    <p>You can control cookie preferences through your browser settings.</p>
                </section>

                <section class="legal-section">
                    <h2>12. Changes to This Policy</h2>
                    <p>We may update this Privacy Policy periodically. We will notify you of material changes via the app or email. The "Last Updated" date at the bottom indicates when the policy was last revised.</p>
                </section>

                <section class="legal-section">
                    <h2>13. Contact Us</h2>
                    <p>For privacy-related questions or concerns:</p>
                    <p>Email: <a href="mailto:privacy@getioi.app">privacy@getioi.app</a></p>
                    <p>For data protection inquiries in the EU, you may also contact your local data protection authority.</p>
                </section>

                <p class="last-updated">Last updated: <?php echo $last_updated; ?></p>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
