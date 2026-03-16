<?php
/**
 * Template Name: Contact
 * @package IOI
 */

get_header();
?>

<style>
/* Contact Page Styles */
.contact-page .page-header {
    padding: 80px 0 40px;
    text-align: center;
}

.contact-page .page-header h1 {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

.contact-page .page-subtitle {
    color: var(--text-muted, #888);
    font-size: 1.1rem;
}

/* Quick Help Section */
.contact-quick-help {
    margin-bottom: 4rem;
}

.contact-quick-help h2 {
    text-align: center;
    margin-bottom: 0.5rem;
}

.contact-quick-help > p {
    text-align: center;
    color: var(--text-muted, #888);
    margin-bottom: 2rem;
}

.quick-help-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
}

.quick-help-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    text-decoration: none;
    transition: all 0.3s ease;
}

.quick-help-card:hover {
    border-color: var(--ioi-gold, #D4A017);
    background: rgba(212, 160, 23, 0.05);
    transform: translateY(-2px);
}

.quick-help-card .help-icon {
    font-size: 2rem;
    display: block;
    margin-bottom: 0.75rem;
}

.quick-help-card h4 {
    color: #fff;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.quick-help-card p {
    color: var(--text-muted, #888);
    font-size: 0.9rem;
    margin: 0;
}

/* Contact Options */
.contact-options {
    margin-bottom: 4rem;
}

.contact-options h2 {
    text-align: center;
    margin-bottom: 2rem;
}

.contact-methods {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.contact-method-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
}

.contact-method-card .method-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.contact-method-card h3 {
    color: #fff;
    margin-bottom: 0.5rem;
}

.contact-method-card > p {
    color: var(--text-muted, #888);
    margin-bottom: 1rem;
    font-size: 0.95rem;
}

.contact-link {
    display: inline-block;
    color: var(--ioi-gold, #D4A017);
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    margin-bottom: 0.75rem;
}

.contact-link:hover {
    color: #fff;
    text-decoration: underline;
}

.response-time {
    color: var(--text-muted, #666);
    font-size: 0.85rem;
    margin: 0;
}

/* Contact Form */
.contact-form-section {
    margin-bottom: 4rem;
    background: rgba(255,255,255,0.02);
    border-radius: 16px;
    padding: 2.5rem;
}

.contact-form-section h2 {
    text-align: center;
    margin-bottom: 0.5rem;
}

.contact-form-section > p {
    text-align: center;
    color: var(--text-muted, #888);
    margin-bottom: 2rem;
}

.contact-form {
    max-width: 600px;
    margin: 0 auto;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

@media (max-width: 600px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-group label {
    display: block;
    color: #fff;
    font-weight: 500;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 0.875rem 1rem;
    background: rgba(0,0,0,0.3);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 8px;
    color: #fff;
    font-size: 1rem;
    transition: border-color 0.2s ease;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--ioi-gold, #D4A017);
}

.form-group input::placeholder,
.form-group textarea::placeholder {
    color: #666;
}

.form-group select {
    cursor: pointer;
}

.form-group select option {
    background: #1a1a1a;
    color: #fff;
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    cursor: pointer;
    color: var(--text-muted, #888);
    font-size: 0.9rem;
}

.checkbox-label input[type="checkbox"] {
    width: auto;
    margin-top: 0.2rem;
}

.btn-block {
    width: 100%;
}

/* Form Success */
.form-success {
    text-align: center;
    padding: 3rem 2rem;
}

.form-success .success-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.form-success h3 {
    color: var(--ioi-gold, #D4A017);
    margin-bottom: 0.5rem;
}

.form-success p {
    color: var(--text-muted, #888);
}

/* Specific Contacts */
.specific-contacts {
    margin-bottom: 4rem;
}

.specific-contacts h2 {
    text-align: center;
    margin-bottom: 2rem;
}

.specific-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
}

.specific-item {
    text-align: center;
    padding: 1.5rem;
    background: rgba(255,255,255,0.02);
    border-radius: 12px;
}

.specific-item h4 {
    color: #fff;
    margin-bottom: 0.5rem;
    font-size: 1rem;
}

.specific-item p {
    color: var(--text-muted, #888);
    font-size: 0.85rem;
    margin-bottom: 0.75rem;
}

.specific-item a {
    color: var(--ioi-gold, #D4A017);
    text-decoration: none;
    font-size: 0.9rem;
}

.specific-item a:hover {
    text-decoration: underline;
}

/* Social Section */
.social-section {
    text-align: center;
    padding: 3rem;
    background: rgba(255,255,255,0.02);
    border-radius: 16px;
}

.social-section h2 {
    margin-bottom: 0.5rem;
}

.social-section > p {
    color: var(--text-muted, #888);
    margin-bottom: 2rem;
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.social-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 8px;
    color: #fff;
    text-decoration: none;
    transition: all 0.2s ease;
}

.social-link:hover {
    border-color: var(--ioi-gold, #D4A017);
    background: rgba(212, 160, 23, 0.1);
}

.social-link .social-icon {
    font-size: 1.25rem;
}
</style>

<main class="internal-page contact-page">
    <div class="page-header">
        <div class="container">
            <h1>Contact & Support</h1>
            <p class="page-subtitle">We're here to help you succeed</p>
        </div>
    </div>
    
    <div class="page-content">
        <div class="container container-md">
            
            <!-- Quick Help -->
            <section class="contact-quick-help">
                <h2>Before You Contact Us</h2>
                <p>Many questions can be answered quickly through our resources:</p>
                <div class="quick-help-grid">
                    <a href="<?php echo home_url('/setup-guide/'); ?>" class="quick-help-card">
                        <span class="help-icon">📖</span>
                        <h4>Setup Guide</h4>
                        <p>Step-by-step instructions to get started</p>
                    </a>
                    <a href="<?php echo home_url('/bot-settings-guide/'); ?>" class="quick-help-card">
                        <span class="help-icon">⚙️</span>
                        <h4>Bot Settings Guide</h4>
                        <p>Configure your bot for best results</p>
                    </a>
                    <a href="<?php echo home_url('/faq/'); ?>" class="quick-help-card">
                        <span class="help-icon">❓</span>
                        <h4>FAQ</h4>
                        <p>Answers to common questions</p>
                    </a>
                </div>
            </section>

            <!-- Contact Options -->
            <section class="contact-options">
                <h2>Get in Touch</h2>
                
                <div class="contact-methods">
                    
                    <!-- Email Support -->
                    <div class="contact-method-card">
                        <div class="method-icon">📧</div>
                        <h3>Email Support</h3>
                        <p>For general inquiries and technical support</p>
                        <a href="mailto:support@getioi.app" class="contact-link">support@getioi.app</a>
                        <p class="response-time">Typical response: Within 24 hours</p>
                    </div>

                    <!-- Telegram -->
                    <div class="contact-method-card">
                        <div class="method-icon">💬</div>
                        <h3>Telegram Community</h3>
                        <p>Join our community for tips, updates, and peer support</p>
                        <a href="https://t.me/ioitrading" target="_blank" rel="noopener" class="contact-link">t.me/ioitrading</a>
                        <p class="response-time">Community support available 24/7</p>
                    </div>

                    <!-- Discord -->
                    <div class="contact-method-card">
                        <div class="method-icon">🎮</div>
                        <h3>Discord Server</h3>
                        <p>Chat with other traders and get real-time help</p>
                        <a href="https://discord.gg/cRMrrvHFYA" target="_blank" rel="noopener" class="contact-link">Join Discord</a>
                        <p class="response-time">Active community discussions</p>
                    </div>

                </div>
            </section>

            <!-- Contact Form -->
            <section class="contact-form-section">
                <h2>Send Us a Message</h2>
                <p>Fill out the form below and we'll get back to you as soon as possible.</p>
                
                <form class="contact-form" id="contact-form" action="#" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" required placeholder="John Doe">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required placeholder="john@example.com">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" required>
                            <option value="">Select a category...</option>
                            <option value="setup">Setup & Installation</option>
                            <option value="trading">Trading & Bot Issues</option>
                            <option value="billing">Billing & Subscriptions</option>
                            <option value="security">Security Concerns</option>
                            <option value="feature">Feature Request</option>
                            <option value="bug">Bug Report</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" required placeholder="Brief description of your inquiry">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="6" required placeholder="Please provide as much detail as possible..."></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="include_device" value="1">
                            <span>Include device/app information (helps us debug issues faster)</span>
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Send Message</button>
                </form>
                
                <div class="form-success" id="form-success" style="display: none;">
                    <div class="success-icon">✅</div>
                    <h3>Message Sent!</h3>
                    <p>Thank you for contacting us. We'll respond to your inquiry within 24 hours.</p>
                </div>
            </section>

            <!-- Specific Contacts -->
            <section class="specific-contacts">
                <h2>Specific Inquiries</h2>
                <div class="specific-grid">
                    <div class="specific-item">
                        <h4>Security Issues</h4>
                        <p>Report vulnerabilities or security concerns</p>
                        <a href="mailto:security@getioi.app">security@getioi.app</a>
                    </div>
                    <div class="specific-item">
                        <h4>Legal & Compliance</h4>
                        <p>Legal inquiries and compliance matters</p>
                        <a href="mailto:legal@getioi.app">legal@getioi.app</a>
                    </div>
                    <div class="specific-item">
                        <h4>Privacy Requests</h4>
                        <p>Data access, deletion, or privacy inquiries</p>
                        <a href="mailto:privacy@getioi.app">privacy@getioi.app</a>
                    </div>
                    <div class="specific-item">
                        <h4>Business & Partnerships</h4>
                        <p>Partnership and business development</p>
                        <a href="mailto:business@getioi.app">business@getioi.app</a>
                    </div>
                </div>
            </section>

            <!-- Social Links -->
            <section class="social-section">
                <h2>Join Our Community</h2>
                <p>Connect with other traders and stay updated</p>
                <div class="social-links">
                    <a href="https://t.me/ioitrading" target="_blank" rel="noopener" class="social-link">
                        <span class="social-icon">💬</span>
                        <span>Telegram</span>
                    </a>
                    <a href="https://discord.gg/cRMrrvHFYA" target="_blank" rel="noopener" class="social-link">
                        <span class="social-icon">🎮</span>
                        <span>Discord</span>
                    </a>
                </div>
            </section>

        </div>
    </div>
</main>

<script>
// Simple form handling - replace with actual backend submission
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // TODO: Send form data to your backend (AWS SES, etc.)
    // For now, just show success message
    
    this.style.display = 'none';
    document.getElementById('form-success').style.display = 'block';
});
</script>

<?php get_footer(); ?>