<?php
/**
 * Template Name: Tradable Tokens
 *
 * Public page showing the tokens IOI is currently allowed to trade.
 *
 * Data is fetched server-side from the IOI backend API and cached in a WP
 * transient for 5 minutes. The page renders without JavaScript.
 *
 * URL: https://getioi.app/tradable-tokens/
 */

get_header(); ?>

<?php
// ─── Configuration ──────────────────────────────────────────────
$api_url       = 'http://135.181.137.243:8001/api/v1/public/tradable-tokens';
$cache_key     = 'ioi_tradable_tokens_v1';
$cache_seconds = 300; // 5 minutes
$request_timeout = 8; // seconds

// ─── Fetch + cache ──────────────────────────────────────────────
$payload = get_transient( $cache_key );

if ( false === $payload ) {
    $response = wp_remote_get( $api_url, array(
        'timeout' => $request_timeout,
        'headers' => array( 'Accept' => 'application/json' ),
    ) );

    if ( ! is_wp_error( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) {
        $body = wp_remote_retrieve_body( $response );
        $decoded = json_decode( $body, true );
        if ( is_array( $decoded ) && isset( $decoded['tokens'] ) ) {
            $payload = $decoded;
            set_transient( $cache_key, $payload, $cache_seconds );
        }
    }
}

// ─── Helper: format number compactly ────────────────────────────
function ioi_format_compact( $value ) {
    if ( $value === null || $value === '' ) {
        return '-';
    }
    $num = (float) $value;
    if ( $num <= 0 ) {
        return '-';
    }
    if ( $num >= 1_000_000_000_000 ) {
        return '$' . number_format( $num / 1_000_000_000_000, 2 ) . 'T';
    }
    if ( $num >= 1_000_000_000 ) {
        return '$' . number_format( $num / 1_000_000_000, 2 ) . 'B';
    }
    if ( $num >= 1_000_000 ) {
        return '$' . number_format( $num / 1_000_000, 2 ) . 'M';
    }
    if ( $num >= 1_000 ) {
        return '$' . number_format( $num / 1_000, 2 ) . 'K';
    }
    return '$' . number_format( $num, 2 );
}

function ioi_format_price( $value ) {
    if ( $value === null || $value === '' ) {
        return '-';
    }
    $num = (float) $value;
    if ( $num < 0.01 ) {
        return '$' . number_format( $num, 6 );
    }
    if ( $num < 1 ) {
        return '$' . number_format( $num, 4 );
    }
    if ( $num < 100 ) {
        return '$' . number_format( $num, 3 );
    }
    return '$' . number_format( $num, 2 );
}

function ioi_format_change( $value ) {
    if ( $value === null || $value === '' ) {
        return array( '-', 'flat' );
    }
    $num  = (float) $value;
    $sign = $num >= 0 ? '+' : '';
    $cls  = $num > 0 ? 'up' : ( $num < 0 ? 'down' : 'flat' );
    return array( $sign . number_format( $num, 2 ) . '%', $cls );
}

// ─── Determine which tab is active ──────────────────────────────
$active_tab = isset( $_GET['quote'] ) && strtoupper( $_GET['quote'] ) === 'USDC' ? 'USDC' : 'USDT';
?>

<style>
.ioi-tokens-wrap {
    max-width: 1100px;
    margin: 0 auto;
    padding: 40px 20px;
    color: #f0f0f0;
}
.ioi-tokens-wrap h1 {
    font-size: 32px;
    margin-bottom: 8px;
    color: #D4A017;
}
.ioi-tokens-intro {
    font-size: 15px;
    color: #b8b8b8;
    margin-bottom: 24px;
    line-height: 1.6;
}
.ioi-tokens-intro strong {
    color: #f0f0f0;
}
.ioi-tokens-meta {
    display: flex;
    gap: 24px;
    flex-wrap: wrap;
    margin-bottom: 24px;
    padding: 14px 18px;
    background: #161616;
    border-radius: 8px;
    border: 1px solid #2a2a2a;
    font-size: 13px;
    color: #999;
}
.ioi-tokens-meta strong {
    color: #f0f0f0;
}
.ioi-tabs {
    display: flex;
    gap: 4px;
    margin-bottom: 0;
    border-bottom: 1px solid #2a2a2a;
}
.ioi-tab {
    padding: 12px 24px;
    background: transparent;
    border: none;
    color: #888;
    cursor: pointer;
    font-size: 15px;
    font-weight: 500;
    text-decoration: none;
    border-bottom: 2px solid transparent;
    transition: all 0.15s ease;
}
.ioi-tab:hover {
    color: #f0f0f0;
}
.ioi-tab.active {
    color: #D4A017;
    border-bottom-color: #D4A017;
}
.ioi-tab .count {
    color: #666;
    font-weight: 400;
    margin-left: 6px;
}
.ioi-tab.active .count {
    color: #D4A017;
}
.ioi-table-wrap {
    overflow-x: auto;
    background: #0C0C0C;
    border: 1px solid #2a2a2a;
    border-top: none;
    border-radius: 0 0 8px 8px;
}
.ioi-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}
.ioi-table thead th {
    text-align: left;
    padding: 14px 16px;
    background: #161616;
    color: #999;
    font-weight: 500;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid #2a2a2a;
    white-space: nowrap;
}
.ioi-table tbody td {
    padding: 12px 16px;
    border-bottom: 1px solid #1a1a1a;
    white-space: nowrap;
}
.ioi-table tbody tr:hover {
    background: #141414;
}
.ioi-table .ioi-symbol {
    font-weight: 600;
    color: #f0f0f0;
}
.ioi-table .ioi-base {
    color: #888;
    font-size: 12px;
    margin-left: 6px;
}
.ioi-table .ioi-num {
    text-align: right;
    font-variant-numeric: tabular-nums;
}
.ioi-table .ioi-rank {
    color: #666;
    font-size: 12px;
}
.up   { color: #4ade80; }
.down { color: #f87171; }
.flat { color: #888; }
.ioi-empty {
    padding: 60px 20px;
    text-align: center;
    color: #888;
}
.ioi-empty strong {
    display: block;
    color: #f0f0f0;
    margin-bottom: 8px;
    font-size: 16px;
}
.ioi-attribution {
    margin-top: 24px;
    font-size: 12px;
    color: #666;
    text-align: center;
}
.ioi-attribution a {
    color: #888;
    text-decoration: underline;
}
.ioi-data-note {
    margin: 16px auto 0;
    max-width: 820px;
    font-size: 12px;
    color: #888;
    line-height: 1.7;
    text-align: left;
    padding: 14px 18px;
    background: #121212;
    border: 1px solid #1f1f1f;
    border-radius: 6px;
}
.ioi-data-note strong {
    color: #D4A017;
    display: block;
    margin-bottom: 6px;
    font-size: 13px;
}
.ioi-data-note code {
    color: #c0c0c0;
    background: #1c1c1c;
    padding: 1px 5px;
    border-radius: 3px;
    font-size: 11px;
}
@media (max-width: 700px) {
    .ioi-tokens-wrap { padding: 20px 12px; }
    .ioi-tokens-wrap h1 { font-size: 24px; }
    .ioi-table thead th,
    .ioi-table tbody td { padding: 10px 10px; font-size: 13px; }
    .ioi-tab { padding: 10px 14px; font-size: 14px; }
}
</style>

<div class="ioi-tokens-wrap">
    <h1>Tradable Tokens</h1>

    <p class="ioi-tokens-intro">
        These are the tokens <strong>IOI is currently allowed to trade</strong> on Binance.
        The list is filtered to active USDT and USDC pairs and excludes any token Binance
        has scheduled for delisting. Stats refresh once per day.
    </p>

    <?php if ( ! is_array( $payload ) || empty( $payload['tokens'] ) ) : ?>

        <div class="ioi-table-wrap" style="border-radius: 8px;">
            <div class="ioi-empty">
                <strong>Token list temporarily unavailable</strong>
                We are having trouble loading the latest list. Please try again in a few minutes.
            </div>
        </div>

    <?php else :
        $usdt_tokens = isset( $payload['tokens']['USDT'] ) ? $payload['tokens']['USDT'] : array();
        $usdc_tokens = isset( $payload['tokens']['USDC'] ) ? $payload['tokens']['USDC'] : array();
        $counts      = isset( $payload['counts'] ) ? $payload['counts'] : array();
        $data_date   = isset( $payload['data_last_updated'] ) ? $payload['data_last_updated'] : null;

        $tokens = $active_tab === 'USDC' ? $usdc_tokens : $usdt_tokens;

        $page_url = strtok( $_SERVER['REQUEST_URI'], '?' );
    ?>

        <div class="ioi-tokens-meta">
            <span><strong><?php echo esc_html( $counts['total'] ?? 0 ); ?></strong> total pairs</span>
            <?php if ( $data_date ) : ?>
                <span>Stats last updated: <strong><?php echo esc_html( $data_date ); ?></strong></span>
            <?php else : ?>
                <span>Stats: <strong>Pending first daily fetch</strong></span>
            <?php endif; ?>
        </div>

        <div class="ioi-tabs" role="tablist">
            <a class="ioi-tab <?php echo $active_tab === 'USDT' ? 'active' : ''; ?>"
               href="<?php echo esc_url( $page_url . '?quote=USDT' ); ?>">
                USDT <span class="count"><?php echo esc_html( $counts['USDT'] ?? 0 ); ?></span>
            </a>
            <a class="ioi-tab <?php echo $active_tab === 'USDC' ? 'active' : ''; ?>"
               href="<?php echo esc_url( $page_url . '?quote=USDC' ); ?>">
                USDC <span class="count"><?php echo esc_html( $counts['USDC'] ?? 0 ); ?></span>
            </a>
        </div>

        <div class="ioi-table-wrap">
            <?php if ( empty( $tokens ) ) : ?>
                <div class="ioi-empty">No <?php echo esc_html( $active_tab ); ?> pairs available.</div>
            <?php else : ?>
                <table class="ioi-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Token</th>
                            <th class="ioi-num">Price</th>
                            <th class="ioi-num">24h</th>
                            <th class="ioi-num">Market Cap</th>
                            <th class="ioi-num">24h Volume</th>
                            <th class="ioi-num">7d Avg Volume</th>
                            <th class="ioi-num">24h Trades</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $tokens as $i => $token ) :
                            list( $change_str, $change_cls ) = ioi_format_change( $token['price_change_pct_24h'] ?? null );
                        ?>
                            <tr>
                                <td class="ioi-rank">
                                    <?php
                                    if ( ! empty( $token['market_cap_rank'] ) ) {
                                        echo esc_html( $token['market_cap_rank'] );
                                    } else {
                                        echo esc_html( $i + 1 );
                                    }
                                    ?>
                                </td>
                                <td>
                                    <span class="ioi-symbol"><?php echo esc_html( $token['base_asset'] ); ?></span>
                                    <span class="ioi-base"><?php echo esc_html( $token['symbol'] ); ?></span>
                                </td>
                                <td class="ioi-num"><?php echo esc_html( ioi_format_price( $token['last_price'] ?? null ) ); ?></td>
                                <td class="ioi-num <?php echo esc_attr( $change_cls ); ?>"><?php echo esc_html( $change_str ); ?></td>
                                <td class="ioi-num"><?php echo esc_html( ioi_format_compact( $token['market_cap_usd'] ?? null ) ); ?></td>
                                <td class="ioi-num"><?php echo esc_html( ioi_format_compact( $token['volume_24h_usd'] ?? null ) ); ?></td>
                                <td class="ioi-num"><?php echo esc_html( ioi_format_compact( $token['avg_volume_7d_usd'] ?? null ) ); ?></td>
                                <td class="ioi-num"><?php echo $token['trades_24h'] !== null ? esc_html( number_format( $token['trades_24h'] ) ) : '-'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <p class="ioi-attribution">
            Price &amp; volume data: Binance &nbsp;&middot;&nbsp;
            Market cap &amp; supply: <a href="https://www.coingecko.com" rel="nofollow noopener" target="_blank">CoinGecko</a>
        </p>

        <div class="ioi-data-note">
            <strong>Why some tokens show "-" for market cap</strong>
            A small number of tokens display "-" for market cap. This happens because CoinGecko, our supply data source, doesnt report circulating supply for them. Common reasons:
            tokens undergoing a rebrand or chain migration where supply data is in transition (e.g. <code>EOS→Vaulta</code>, <code>MKR→Sky</code>, <code>UTK</code>);
            fiat pairs that arent crypto (<code>EUR</code>);
            Binance "1000x" multiplier pairs where CoinGecko tracks the underlying token instead (<code>1000CHEEMS</code>, <code>1MBABYDOGE</code>);
            or meme tokens CoinGecko doesnt track at all (<code>BROCCOLI714</code>).
            Price, volume, and trade count for these tokens come directly from Binance and remain fully accurate - only the market cap field is affected.
        </div>

    <?php endif; ?>
</div>

<?php get_footer(); ?>