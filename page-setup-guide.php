<?php
/**
 * Template Name: How to Whitelist
 * @package IOI
 */

get_header();

$wallet_address = '0x9d8bf0ffb39ea9fae4ea347369bf3c288f05877f';
?>

<main class="internal-page how-to-whitelist">
    <div class="page-header">
        <div class="container">
            <h1>How to Whitelist Our Address</h1>
            <p class="page-subtitle">Lock down your Binance withdrawals so funds can ONLY go to IOI - even if your API keys leak</p>
        </div>
    </div>

    <div class="page-content">
        <div class="container container-md">

            <!-- Hero Address Box -->
            <div class="address-hero">
                <div class="address-hero-label">
                    <span class="address-icon">🛡️</span>
                    <div>
                        <strong>IOI Payout Address</strong>
                        <small>BSC (BEP-20) - BNB Smart Chain</small>
                    </div>
                </div>
                <div class="address-hero-value">
                    <code id="ioi-address"><?php echo esc_html($wallet_address); ?></code>
                    <button type="button" class="copy-btn" onclick="copyAddress()">📋 Copy</button>
                </div>
                <div class="address-hero-note">
                    <strong>⚠️ Network must be BSC (BEP-20).</strong> Other networks wont work.
                </div>
            </div>

            <!-- Important Heads-Up -->
            <div class="info-box info-box-blue">
                <strong>Heads up: binance.com only.</strong>
                <p>IOI works exclusively with <a href="https://www.binance.com" target="_blank" rel="noopener">binance.com</a>.
                The withdrawal whitelist must be set up there - <strong>not</strong> on binance.us, and <strong>not</strong>
                in the Binance mobile app (which doesnt support whitelist management). Use binance.com in any browser -
                desktop or phone.</p>
            </div>

            <!-- Why Bother -->
            <section class="setup-step">
                <div class="step-header">
                    <div class="step-number">?</div>
                    <h2>Why bother?</h2>
                </div>
                <div class="step-content">
                    <p>Without the whitelist, an API key with withdrawal permission can move funds to <em>any</em> address.
                    With the whitelist enabled, withdrawals can <em>only</em> go to addresses youve pre-approved.
                    Even an attacker with your full API key and secret cannot bypass this.</p>

                    <div class="impact-grid">
                        <div class="impact-card impact-bad">
                            <div class="impact-icon">😱</div>
                            <h4>Without whitelist</h4>
                            <p>Stolen API keys = attacker drains your account to their wallet.</p>
                        </div>
                        <div class="impact-arrow">→</div>
                        <div class="impact-card impact-good">
                            <div class="impact-icon">🔒</div>
                            <h4>With whitelist</h4>
                            <p>Stolen API keys = attacker can do nothing useful. Funds can only flow to IOI.</p>
                        </div>
                    </div>

                    <p class="impact-summary">Adding new whitelist addresses also requires email confirmation plus a 24-72 hour cooldown,
                    so attackers cant just bypass it by adding their own address either.</p>
                </div>
            </section>

            <!-- Step-by-Step -->
            <section class="setup-step">
                <div class="step-header">
                    <div class="step-number">1</div>
                    <h2>Step-by-Step Walkthrough</h2>
                </div>
                <div class="step-content">
                    <p>Same flow on desktop and phone - both use binance.com in a browser.</p>

                    <ol class="setup-instructions">
                        <li>
                            <strong>Open <a href="https://www.binance.com" target="_blank" rel="noopener">binance.com</a></strong>
                            <p>Log in. If youre on mobile, dont use the Binance app - open binance.com in Chrome, Safari, or any browser.</p>
                        </li>
                        <li>
                            <strong>Navigate to Security</strong>
                            <p>Click your profile icon (top-right), select <em>Account</em>, then click <em>Security</em> in the left-hand menu.</p>
                        </li>
                        <li>
                            <strong>Find "Withdrawal Whitelist"</strong>
                            <p>Its at the top of the Security Checkup section. If currently OFF, toggle it ON and confirm with 2FA.</p>
                        </li>
                        <li>
                            <strong>Click "Manage"</strong>
                            <p>Either next to Withdrawal Whitelist in the Security Checkup, or scroll down to the Withdrawal Whitelist panel.</p>
                        </li>
                        <li>
                            <strong>Click "Add Address"</strong>
                            <p>This opens the address-add form.</p>
                        </li>
                        <li>
                            <strong>Coin: select USDC</strong>
                            <p>USDT also works - same address, same network.</p>
                        </li>
                        <li>
                            <strong>Network: select BSC (BEP-20)</strong>
                            <p><strong>Critical step.</strong> If you pick a different network (ERC-20, TRC-20, etc.), the address wont be valid for IOIs withdrawals.</p>
                        </li>
                        <li>
                            <strong>Paste the address</strong>
                            <div class="inline-address-box">
                                <code><?php echo esc_html($wallet_address); ?></code>
                            </div>
                            <p>Use the Copy button at the top of this page.</p>
                        </li>
                        <li>
                            <strong>Label it</strong>
                            <p>Name it something memorable like <em>IOI Payments</em> so you recognize it later.</p>
                        </li>
                        <li>
                            <strong>Tick "Add Address to Whitelist"</strong>
                            <p>Make sure this checkbox is ticked, then save.</p>
                        </li>
                        <li>
                            <strong>Confirm via 2FA and email</strong>
                            <p>Binance will send a confirmation link to your email - click it to finalize. There may be a 24-72 hour holding period before the address becomes fully active for withdrawals. This security cooldown is exactly what makes the whitelist effective.</p>
                        </li>
                    </ol>

                    <div class="success-box">
                        <strong>🎉 Youre done!</strong>
                        <p>The address is whitelisted. IOI can now collect commission/subscription payments,
                        and nothing else can leave your account. Your funds are locked down.</p>
                    </div>
                </div>
            </section>

            <!-- FAQ -->
            <section class="faq-section">
                <h2>Common Questions</h2>
                <div class="faq-list">

                    <div class="faq-item">
                        <button class="faq-question">Why cant I do this in the Binance app?</button>
                        <div class="faq-answer">
                            <p>Withdrawal whitelist management is a web-only feature on Binance. The mobile app shows
                            most security settings (2FA, anti-phishing code, app authorization, etc.) but not the whitelist.
                            For now, you have to use binance.com in a browser. You can do that on your phone too -
                            just open the website instead of the app.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">I have a binance.us account - does this work?</button>
                        <div class="faq-answer">
                            <p>No. IOI only works with binance.com. binance.us is a separate platform with separate accounts,
                            and our bot wont be able to connect or trade there. If you only have a binance.us account, IOI
                            isnt usable for you right now.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What if I dont enable the whitelist?</button>
                        <div class="faq-answer">
                            <p>The bot still works - withdrawal permission alone is enough for IOI to collect
                            commissions/subscription. But without the whitelist, your API key can withdraw to any address.
                            If those keys leak, the funds are at risk. The whitelist closes that gap entirely.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Can I whitelist multiple addresses?</button>
                        <div class="faq-answer">
                            <p>Yes. Binance allows multiple whitelisted addresses. You can add IOIs address and any of your
                            own external wallets. Withdrawals are restricted to whichever addresses are on the list.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">What if I want to remove IOIs address later?</button>
                        <div class="faq-answer">
                            <p>You can remove it anytime from the same Withdrawal Whitelist screen. Note that if youre on
                            the commission model or auto-renewal subscription, removing the address means IOI can no longer
                            collect what's owed - which will eventually pause your bots.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">Why BSC (BEP-20) and not Ethereum?</button>
                        <div class="faq-answer">
                            <p>BSC has much lower withdrawal fees than Ethereum. For commissions that are typically a few cents
                            to a few dollars per trade, ETH gas fees would eat the entire payment. BSC keeps transfers cheap.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">I added the wrong network. What now?</button>
                        <div class="faq-answer">
                            <p>The address is only valid on BSC. If you added it under a different network
                            (ERC-20, TRC-20, etc.), it wont work. Just remove that entry from your whitelist
                            and add it again under BSC (BEP-20).</p>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Need Help -->
            <section class="setup-help">
                <h2>Need Help?</h2>
                <p>If you get stuck or something looks different than described:</p>
                <div class="help-options">
                    <a href="https://discord.gg/cRMrrvHFYA" target="_blank" rel="noopener" class="btn btn-secondary">Ask on Discord</a>
                    <a href="mailto:support@getioi.app" class="btn btn-primary">Email Support</a>
                </div>
            </section>

        </div>
    </div>
</main>

<style>
/* ============================================================
   ADDRESS HERO - Top of page
   ============================================================ */
.address-hero {
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.15), rgba(212, 175, 55, 0.05));
    border: 1px solid rgba(212, 175, 55, 0.4);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
}

.address-hero-label {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.25rem;
}

.address-hero-label .address-icon {
    font-size: 2rem;
}

.address-hero-label strong {
    display: block;
    color: #fff;
    font-size: 1.1rem;
}

.address-hero-label small {
    display: block;
    color: #D4AF37;
    font-size: 0.85rem;
    font-weight: 600;
    margin-top: 0.25rem;
}

.address-hero-value {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 1rem;
}

.address-hero-value code {
    flex: 1;
    min-width: 280px;
    background: #0a0a0a;
    border: 1px solid rgba(212, 175, 55, 0.3);
    color: #fff;
    padding: 1rem 1.25rem;
    border-radius: 10px;
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
    word-break: break-all;
    line-height: 1.4;
}

.address-hero-value .copy-btn {
    background: linear-gradient(135deg, #D4AF37, #B8941F);
    color: #000;
    border: none;
    padding: 1rem 1.5rem;
    border-radius: 10px;
    font-weight: 700;
    cursor: pointer;
    font-size: 0.95rem;
    transition: transform 0.15s ease, box-shadow 0.15s ease;
    white-space: nowrap;
}

.address-hero-value .copy-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
}

.address-hero-value .copy-btn.copied {
    background: linear-gradient(135deg, #32c864, #28a050);
    color: #fff;
}

.address-hero-note {
    background: rgba(245, 158, 11, 0.1);
    border-left: 3px solid #F59E0B;
    border-radius: 6px;
    padding: 0.75rem 1rem;
    color: #ccc;
    font-size: 0.9rem;
}

.address-hero-note strong {
    color: #F59E0B;
}

/* ============================================================
   INFO BOX - Blue variant for the "binance.com only" notice
   ============================================================ */
.info-box-blue {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.12), rgba(59, 130, 246, 0.04));
    border: 1px solid rgba(59, 130, 246, 0.3);
    border-left: 3px solid #3B82F6;
    border-radius: 12px;
    padding: 1.25rem 1.5rem;
    margin-bottom: 2rem;
}

.info-box-blue strong {
    color: #3B82F6;
    display: block;
    margin-bottom: 0.5rem;
    font-size: 1rem;
}

.info-box-blue p {
    color: #ccc;
    margin: 0;
    line-height: 1.6;
    font-size: 0.95rem;
}

.info-box-blue a {
    color: #D4AF37;
    font-weight: 600;
}

/* ============================================================
   IMPACT COMPARISON GRID (Why Bother section)
   ============================================================ */
.impact-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 1rem;
    align-items: center;
    margin: 2rem 0;
}

.impact-card {
    padding: 1.5rem;
    border-radius: 12px;
    text-align: center;
}

.impact-bad {
    background: rgba(255, 100, 50, 0.08);
    border: 1px solid rgba(255, 100, 50, 0.3);
}

.impact-good {
    background: rgba(50, 200, 100, 0.08);
    border: 1px solid rgba(50, 200, 100, 0.3);
}

.impact-icon {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

.impact-card h4 {
    color: #fff;
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

.impact-bad h4 { color: #ff6432; }
.impact-good h4 { color: #32c864; }

.impact-card p {
    color: #aaa;
    font-size: 0.9rem;
    margin: 0;
    line-height: 1.5;
}

.impact-arrow {
    font-size: 1.75rem;
    color: #D4AF37;
    font-weight: bold;
}

.impact-summary {
    background: rgba(212, 175, 55, 0.05);
    border-left: 3px solid #D4AF37;
    border-radius: 6px;
    padding: 1rem 1.25rem;
    color: #ccc;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-top: 1.5rem;
}

@media (max-width: 700px) {
    .impact-grid {
        grid-template-columns: 1fr;
    }
    .impact-arrow {
        transform: rotate(90deg);
        margin: 0 auto;
    }
}

/* ============================================================
   INLINE ADDRESS BOX (inside step instructions)
   ============================================================ */
.inline-address-box {
    background: #0a0a0a;
    border: 1px solid rgba(212, 175, 55, 0.3);
    border-radius: 8px;
    padding: 0.75rem 1rem;
    margin: 0.75rem 0;
    word-break: break-all;
}

.inline-address-box code {
    color: #D4AF37;
    font-family: 'Courier New', monospace;
    font-size: 0.85rem;
    background: transparent;
    padding: 0;
}
</style>

<script>
function copyAddress() {
    var address = document.getElementById('ioi-address').textContent;
    navigator.clipboard.writeText(address).then(function() {
        var btn = document.querySelector('.address-hero-value .copy-btn');
        var original = btn.innerHTML;
        btn.innerHTML = '✓ Copied!';
        btn.classList.add('copied');
        setTimeout(function() {
            btn.innerHTML = original;
            btn.classList.remove('copied');
        }, 2000);
    });
}
</script>

<?php get_footer(); ?>