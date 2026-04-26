<?php
/**
 * Template Name: How to Whitelist
 * 
 * Step-by-step guide for adding IOI's withdrawal address
 * to a user's Binance withdrawal whitelist.
 */

get_header();

$wallet_address = '0x9d8bf0ffb39ea9fae4ea347369bf3c288f05877f';
$network = 'BSC (BEP-20) - BNB Smart Chain';
?>

<main class="site-main legal-page">
    <div class="container">
        <div class="legal-content">
            
            <h1>How to Whitelist Our Address on Binance</h1>
            
            <p class="intro">
                This guide shows you how to add IOI's payout address to your Binance withdrawal whitelist. 
                Once added, withdrawals from your account can <strong>ONLY</strong> go to this address - 
                even if your API keys are compromised, attackers cant drain your funds.
            </p>

            <!-- Address box -->
            <div class="address-box">
                <div class="address-label"><?php echo esc_html($network); ?></div>
                <div class="address-value">
                    <code id="ioi-address"><?php echo esc_html($wallet_address); ?></code>
                    <button type="button" class="copy-btn" onclick="copyAddress()">Copy</button>
                </div>
                <div class="address-note">
                    <strong>Important:</strong> The network must be <strong>BSC (BEP-20)</strong>. 
                    Make sure to select this network when adding the address - other networks won't work.
                </div>
            </div>

            <!-- Why section -->
            <section class="legal-section">
                <h2>Why bother?</h2>
                <p>
                    Without the whitelist, an API key with withdrawal permission can move funds to <em>any</em> address. 
                    With the whitelist enabled, withdrawals can <em>only</em> go to addresses you've pre-approved. 
                    Even an attacker with your full API key and secret cannot bypass this - and adding new addresses 
                    requires email confirmation plus a cooldown period.
                </p>
                <p>
                    <strong>Net effect:</strong> the worst-case scenario goes from "attacker drains your account" 
                    to "attacker can do nothing useful with stolen keys".
                </p>
            </section>

            <!-- Tabs for desktop vs mobile -->
            <section class="legal-section">
                <h2>Step-by-step</h2>
                <p>Pick whichever you're using to set this up:</p>
                
                <div class="howto-tabs">
                    <button type="button" class="tab-btn active" onclick="showTab('mobile')">Binance Mobile App</button>
                    <button type="button" class="tab-btn" onclick="showTab('desktop')">Binance Website (Desktop)</button>
                </div>

                <!-- MOBILE INSTRUCTIONS -->
                <div id="tab-mobile" class="tab-content active">
                    <h3>Using the Binance Mobile App</h3>
                    <ol class="howto-steps">
                        <li>
                            <strong>Open the Binance app</strong> and log in.
                        </li>
                        <li>
                            <strong>Go to your profile</strong> (icon top-left), then tap 
                            <em>Security</em>.
                        </li>
                        <li>
                            <strong>Find "Withdrawal Whitelist"</strong> in the security settings list and tap it. 
                            If "Withdrawal Whitelist" is currently OFF, toggle it ON. You'll be asked for 
                            email/SMS verification to enable it.
                        </li>
                        <li>
                            <strong>Tap "Add Address"</strong> (or the + button).
                        </li>
                        <li>
                            <strong>Choose the coin:</strong> select <strong>USDC</strong> (or USDT - both work, 
                            same address).
                        </li>
                        <li>
                            <strong>Choose the network:</strong> select <strong>BSC (BEP-20)</strong>. 
                            This is critical - if you pick a different network, the address won't be valid.
                        </li>
                        <li>
                            <strong>Paste the address:</strong>
                            <div class="inline-address"><?php echo esc_html($wallet_address); ?></div>
                            (Copy it from the box at the top of this page.)
                        </li>
                        <li>
                            <strong>Label it:</strong> name it something obvious like 
                            <em>"IOI Payments"</em> so you'll recognize it later.
                        </li>
                        <li>
                            <strong>Confirm via email and 2FA</strong> when prompted. Binance requires this 
                            for security - the cooldown period after confirmation is what makes the whitelist 
                            effective.
                        </li>
                        <li>
                            <strong>You're done.</strong> Once the address shows up in your whitelist as 
                            "Active", IOI can collect payments and nothing else can leave your account.
                        </li>
                    </ol>
                </div>

                <!-- DESKTOP INSTRUCTIONS -->
                <div id="tab-desktop" class="tab-content">
                    <h3>Using binance.com on Desktop</h3>
                    <ol class="howto-steps">
                        <li>
                            <strong>Log in to <a href="https://www.binance.com" target="_blank" rel="noopener">binance.com</a></strong>.
                        </li>
                        <li>
                            <strong>Hover your profile icon</strong> (top-right) and click <em>Security</em>.
                        </li>
                        <li>
                            <strong>Scroll to "Withdrawal Whitelist"</strong> in the security settings. If it's OFF, 
                            click <em>Enable</em>. You'll need email/SMS verification to enable it.
                        </li>
                        <li>
                            <strong>Click "Withdrawal Address Management"</strong> (or "Address Management").
                        </li>
                        <li>
                            <strong>Click "Add Address"</strong>.
                        </li>
                        <li>
                            <strong>Coin:</strong> pick <strong>USDC</strong> (or USDT).
                        </li>
                        <li>
                            <strong>Network:</strong> pick <strong>BSC (BEP-20)</strong>. Do not pick anything else.
                        </li>
                        <li>
                            <strong>Address:</strong> paste 
                            <div class="inline-address"><?php echo esc_html($wallet_address); ?></div>
                        </li>
                        <li>
                            <strong>Label:</strong> use something memorable like <em>"IOI Payments"</em>.
                        </li>
                        <li>
                            <strong>Whitelist toggle:</strong> some Binance versions have a "Whitelist" toggle 
                            on the address itself - make sure it's ON.
                        </li>
                        <li>
                            <strong>Confirm via email and 2FA</strong>. There may be a 24-hour holding period 
                            before the address becomes fully active for withdrawals - this is the security cooldown.
                        </li>
                        <li>
                            <strong>Done.</strong> The address is now whitelisted and IOI can collect 
                            commission/subscription payments to it.
                        </li>
                    </ol>
                </div>
            </section>

            <!-- Common questions -->
            <section class="legal-section">
                <h2>Common questions</h2>
                
                <h3>What if I dont enable the whitelist?</h3>
                <p>
                    The bot still works - withdrawal permission alone is enough for IOI to collect 
                    commissions/subscription. But without the whitelist, your API key can withdraw to any address. 
                    If those keys leak, the funds are at risk. The whitelist closes that gap entirely.
                </p>

                <h3>Can I whitelist multiple addresses?</h3>
                <p>
                    Yes. Binance allows multiple whitelisted addresses. You can add IOI's address and any of your 
                    own external wallets. Withdrawals are restricted to whichever addresses are on the list.
                </p>

                <h3>What if I want to remove IOI's address later?</h3>
                <p>
                    You can remove it anytime from the same Withdrawal Whitelist screen. Note that if you're on 
                    the commission model or auto-renewal subscription, removing the address means IOI can no longer 
                    collect what's owed - which will eventually pause your bots.
                </p>

                <h3>Why BSC (BEP-20) and not Ethereum?</h3>
                <p>
                    BSC has much lower withdrawal fees than Ethereum. For commissions that are typically a few cents 
                    to a few dollars per trade, ETH gas fees would eat the entire payment. BSC keeps transfers cheap.
                </p>

                <h3>I added the wrong network. What now?</h3>
                <p>
                    The address is only valid on BSC. If you added it under a different network 
                    (ERC-20, TRC-20, etc.), it won't work. Just remove that entry from your whitelist 
                    and add it again under BSC (BEP-20).
                </p>
            </section>

            <!-- Back to app -->
            <div class="back-cta">
                <p>Need help? Reach out on our <a href="https://discord.gg/cRMrrvHFYA" target="_blank" rel="noopener">Discord</a>.</p>
            </div>

        </div>
    </div>
</main>

<style>
.legal-page .container { max-width: 860px; margin: 0 auto; padding: 40px 20px; }
.legal-content h1 { color: #D4A017; font-size: 32px; margin-bottom: 16px; }
.legal-content .intro { font-size: 16px; line-height: 1.6; color: #ccc; margin-bottom: 32px; }
.legal-content h2 { color: #D4A017; font-size: 22px; margin-top: 36px; margin-bottom: 12px; }
.legal-content h3 { color: #fff; font-size: 17px; margin-top: 20px; margin-bottom: 8px; }
.legal-content p { color: #ccc; line-height: 1.6; margin-bottom: 12px; }
.legal-content em { color: #D4A017; font-style: normal; }
.legal-content strong { color: #fff; }

.address-box {
    background: #131313;
    border: 1px solid rgba(212, 160, 23, 0.3);
    border-radius: 12px;
    padding: 20px;
    margin: 24px 0;
}
.address-box .address-label {
    color: #F59E0B;
    font-size: 12px;
    font-weight: bold;
    margin-bottom: 8px;
    letter-spacing: 0.5px;
}
.address-box .address-value {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}
.address-box code {
    color: #fff;
    background: #0c0c0c;
    padding: 10px 14px;
    border-radius: 8px;
    font-family: 'Courier New', monospace;
    font-size: 13px;
    word-break: break-all;
    flex: 1;
    min-width: 280px;
}
.address-box .copy-btn {
    background: #D4A017;
    color: #000;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    font-size: 13px;
}
.address-box .copy-btn:hover { background: #E8C547; }
.address-box .copy-btn.copied { background: #22C55E; color: #fff; }
.address-box .address-note {
    margin-top: 14px;
    padding: 10px 12px;
    background: rgba(245, 158, 11, 0.08);
    border-left: 3px solid #F59E0B;
    color: #ccc;
    font-size: 13px;
}

.howto-tabs {
    display: flex;
    gap: 8px;
    margin: 20px 0 0 0;
    border-bottom: 1px solid rgba(212, 160, 23, 0.2);
}
.tab-btn {
    background: transparent;
    border: none;
    color: #999;
    padding: 12px 20px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    border-bottom: 2px solid transparent;
    margin-bottom: -1px;
}
.tab-btn:hover { color: #ccc; }
.tab-btn.active { color: #D4A017; border-bottom-color: #D4A017; }

.tab-content { display: none; padding-top: 20px; }
.tab-content.active { display: block; }

.howto-steps { padding-left: 24px; }
.howto-steps li { color: #ccc; line-height: 1.7; margin-bottom: 14px; }
.howto-steps li strong { color: #fff; }

.inline-address {
    display: inline-block;
    background: #0c0c0c;
    border: 1px solid rgba(212, 160, 23, 0.3);
    border-radius: 6px;
    padding: 6px 10px;
    font-family: 'Courier New', monospace;
    color: #D4A017;
    font-size: 12px;
    margin: 6px 0;
    word-break: break-all;
}

.back-cta {
    margin-top: 48px;
    padding: 20px;
    background: rgba(212, 160, 23, 0.05);
    border-radius: 12px;
    text-align: center;
}
.back-cta p { margin: 0; }
.back-cta a { color: #D4A017; font-weight: 600; }
</style>

<script>
function copyAddress() {
    var address = document.getElementById('ioi-address').textContent;
    navigator.clipboard.writeText(address).then(function() {
        var btn = document.querySelector('.address-box .copy-btn');
        var original = btn.textContent;
        btn.textContent = 'Copied!';
        btn.classList.add('copied');
        setTimeout(function() {
            btn.textContent = original;
            btn.classList.remove('copied');
        }, 2000);
    });
}

function showTab(name) {
    document.querySelectorAll('.tab-btn').forEach(function(btn) { btn.classList.remove('active'); });
    document.querySelectorAll('.tab-content').forEach(function(c) { c.classList.remove('active'); });
    event.target.classList.add('active');
    document.getElementById('tab-' + name).classList.add('active');
}
</script>

<?php get_footer(); ?>