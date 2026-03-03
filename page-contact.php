<?php
/**
 * Template Name: Contact
 * @package IOI
 */

get_header();
?>

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
                    <a href="<?php echo home_url('/faq/'); ?>" class="quick-help-card">
                        <span class="help-icon">❓</span>
                        <h4>FAQ</h4>
                        <p>Answers to common questions</p>
                    </a>
                    <a href="<?php echo home_url('/risk-disclosure/'); ?>" class="quick-help-card">
                        <span class="help-icon">⚠️</span>
                        <h4>Risk Disclosure</h4>
                        <p>Understand the risks involved</p>
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

                    <!-- Priority Support -->
                    <div class="contact-method-card highlight">
                        <div class="method-icon">⚡</div>
                        <h3>Priority Support</h3>
                        <p>For subscribers on Pro tier and above</p>
                        <a href="mailto:priority@getioi.app" class="contact-link">priority@getioi.app</a>
                        <p class="response-time">Typical response: Within 4 hours</p>
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
                <h2>Follow Us</h2>
                <p>Stay updated with the latest news, tips, and announcements</p>
                <div class="social-links">
                    <a href="https://t.me/ioitrading" target="_blank" rel="noopener" class="social-link">
                        <span class="social-icon">💬</span>
                        <span>Telegram</span>
                    </a>
                    <a href="https://twitter.com/ioitrading" target="_blank" rel="noopener" class="social-link">
                        <span class="social-icon">🐦</span>
                        <span>Twitter</span>
                    </a>
                    <a href="https://discord.gg/ioitrading" target="_blank" rel="noopener" class="social-link">
                        <span class="social-icon">🎮</span>
                        <span>Discord</span>
                    </a>
                </div>
            </section>

        </div>
    </div>
</main>

<script>
// Simple form handling (you'll want to replace this with actual form submission)
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Here you would typically send the form data to your server
    // For now, just show success message
    
    this.style.display = 'none';
    document.getElementById('form-success').style.display = 'block';
});
</script>

<?php get_footer(); ?>
