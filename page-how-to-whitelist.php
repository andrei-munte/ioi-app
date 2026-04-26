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
                This guide shows you how to add IOIs payout address to your Binance withdrawal whitelist.
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
                    Make sure to select this network when adding the address - other networks wont work.
                </div>
            </div>

            <!-- Important: binance.com only -->
            <div class="heads-up-box">
                <strong>Important:</strong> IOI works exclusively with <a href="https://www.binance.com" target="_blank" rel="noopener">binance.com</a>.
                The withdrawal whitelist must be set up there - not on binance.us, and not in the Binance mobile app
                (which doesnt currently support whitelist management). Use binance.com in any browser - desktop or phone.
            </div>

            <!-- Why section -->
            <section class="legal-section">
                <h2>Why bother?</h2>
                <p>
                    Without the whitelist, an API key with withdrawal permission can move funds to <em>any</em> address.
                    With the whitelist enabled, withdrawals can <em>only</em> go to addresses youve pre-approved.
                    Even an attacker with your full API key and secret cannot bypass this - and adding new addresses
                    requires email confirmation plus a cooldown period.
                </p>
                <p>
                    <strong>Net effect:</strong> the worst-case scenario goes from "attacker drains your account"
                    to "attacker can do nothing useful with stolen keys".
                </p>
            </section>

            <!-- Step-by-step -->
            <section class="legal-section">
                <h2>Step-by-step</h2>
                <p>The flow is the same on desktop and phone - both use binance.com in a browser.</p>

                <ol class="howto-steps">
                    <li>
                        <strong>Open <a href="https://www.binance.com" target="_blank" rel="noopener">binance.com</a></strong>
                        in your browser and log in. If youre on mobile, dont use the Binance app -
                        open binance.com in Chrome, Safari, or any browser.
                    </li>
                    <li>
                        <strong>Click your profile icon</strong> (top-right corner), select <em>Account</em>,
                        then click <em>Security</em> in the left-hand menu.
                    </li>
                    <li>
                        <strong>Find "Withdrawal Whitelist"</strong> at the top of the Security Checkup section.
                        If its currently OFF, toggle it ON and confirm with 2FA.
                    </li>
                    <li>
                        <strong>Click "Manage"</strong> next to Withdrawal Whitelist (or scroll to the
                        Withdrawal Whitelist panel further down the page).
                    </li>
                    <li>
                        <strong>Click "Add Address"</strong>.
                    </li>
                    <li>
                        <strong>Coin:</strong> select <strong>USDC</strong> (USDT also works - same address).
                    </li>
                    <li>
                        <strong>Network:</strong> select <strong>BSC (BEP-20)</strong>. This is critical -
                        if you pick a different network, the address wont be valid for IOIs withdrawals.
                    </li>
                    <li>
                        <strong>Address:</strong> paste
                        <div class="inline-address"><?php echo esc_html($wallet_address); ?></div>
                        (Use the Copy button at the top of this page.)
                    </li>
                    <li>
                        <strong>Label:</strong> name it something memorable like <em>IOI Payments</em>.
                    </li>
                    <li>
                        <strong>"Add Address to Whitelist":</strong> make sure this checkbox is ticked, then save.
                    </li>
                    <li>
                        <strong>Confirm via 2FA and email.</strong> Binance will send a confirmation link to your email -
                        click it to finalize. There may be a 24-72 hour holding period before the address becomes
                        fully active for withdrawals - this is the security cooldown that makes the whitelist effective.
                    </li>
                    <li>
                        <strong>Done.</strong> The address is whitelisted and IOI can collect commission/subscription
                        payments to it. Nothing else can leave your account.
                    </li>
                </ol>
            </section>

            <!-- Common questions -->
            <section class="legal-section">
                <h2>Common questions</h2>

                <h3>Why cant I do this in the Binance app?</h3>
                <p>
                    Withdrawal whitelist management is a web-only feature on Binance. The mobile app shows
                    most security settings (2FA, anti-phishing code, app authorization, etc.) but not the whitelist.
                    For now, you have to use binance.com in a browser. You can do that on your phone too -
                    just open the website instead of the app.
                </p>

                <h3>I have a binance.us account - does this work?</h3>
                <p>
                    No. IOI only works with binance.com. binance.us is a separate platform with separate accounts,
                    and our bot wont be able to connect or trade there. If you only have a binance.us account, IOI
                    isnt usable for you right now.
                </p>

                <h3>What if I dont enable the whitelist?</h3>
                <p>
                    The bot still works - withdrawal permission alone is enough for IOI to collect
                    commissions/subscription. But without the whitelist, your API key can withdraw to any address.
                    If those keys leak, the funds are at risk. The whitelist closes that gap entirely.
                </p>

                <h3>Can I whitelist multiple addresses?</h3>
                <p>
                    Yes. Binance allows multiple whitelisted addresses. You can add IOIs address and any of your
                    own external wallets. Withdrawals are restricted to whichever addresses are on the list.
                </p>

                <h3>What if I want to remove IOIs address later?</h3>
                <p>
                    You can remove it anytime from the same Withdrawal Whitelist screen. Note that if youre on
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
                    (ERC-20, TRC-20, etc.), it wont work. Just remove that entry from your whitelist
                    and add it again under BSC (BEP-20).
                </p>
            </section>

            <!-- Help cta -->
            <div class="back-cta">
                <p>Need help? Reach out on our <a href="https://discord.gg/cRMrrvHFYA" target="_blank" rel="noopener">Discord</a>.</p>
            </div>

        </div>
    </div>
</main>

<style>
.legal-page .container { max-width: 860px; margin: 0 auto; padding: 40px 20px; }
.legal-content h1 { color: #D4A017; font-size: 32px; margin-bottom: 16px; }
.legal-content .intro { font-size: 16px; line-height: 1.6; color: #ccc; margin-bottom: 24px; }
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

.heads-up-box {
    background: rgba(59, 130, 246, 0.08);
    border: 1px solid rgba(59, 130, 246, 0.3);
    border-left: 3px solid #3B82F6;
    border-radius: 8px;
    padding: 14px 16px;
    margin: 24px 0;
    color: #ccc;
    font-size: 14px;
    line-height: 1.6;
}
.heads-up-box strong { color: #3B82F6; }
.heads-up-box a { color: #D4A017; }

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
</script>

<?php get_footer(); ?>