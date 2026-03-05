<?php
/**
 * Template Name: Bot Settings Guide
 * @package IOI
 */

get_header();
?>

<main class="internal-page bot-settings-guide">
    <div class="page-header">
        <div class="container">
            <h1>Bot Settings Guide</h1>
            <p class="page-subtitle">Master your trading bot configuration for optimal results</p>
        </div>
    </div>
    
    <div class="page-content">
        <div class="container container-md">
            
            <!-- Golden Rule -->
            <div class="golden-rule-box">
                <div class="rule-icon">🧪</div>
                <div class="rule-content">
                    <h2>The Golden Rule: Test Before You Trade</h2>
                    <p><strong>Always test new configurations with Dry Run (simulation) bots before using real money.</strong></p>
                    <p>Dry Run bots use real market data but execute simulated trades. This lets you see exactly how different settings perform without risking capital. Run multiple DR bots with different configurations simultaneously to compare results.</p>
                </div>
            </div>

            <!-- Quick Reference -->
            <section class="settings-quickref">
                <h2>Default Settings Overview</h2>
                <div class="quickref-grid">
                    <div class="quickref-item">
                        <span class="setting-name">Lookback Period</span>
                        <span class="setting-value">24 hours</span>
                    </div>
                    <div class="quickref-item">
                        <span class="setting-name">Max Positions</span>
                        <span class="setting-value">10</span>
                    </div>
                    <div class="quickref-item">
                        <span class="setting-name">Per Position</span>
                        <span class="setting-value">Budget ÷ Max</span>
                    </div>
                    <div class="quickref-item">
                        <span class="setting-name">Profit Target</span>
                        <span class="setting-value">3.0%</span>
                    </div>
                    <div class="quickref-item">
                        <span class="setting-name">Stop Loss</span>
                        <span class="setting-value">OFF</span>
                    </div>
                    <div class="quickref-item">
                        <span class="setting-name">Entry Threshold</span>
                        <span class="setting-value">1.0%</span>
                    </div>
                    <div class="quickref-item">
                        <span class="setting-name">Exit Threshold</span>
                        <span class="setting-value">40%</span>
                    </div>
                    <div class="quickref-item">
                        <span class="setting-name">Reinvestment</span>
                        <span class="setting-value">NONE</span>
                    </div>
                </div>
                <p class="quickref-note">These defaults are battle-tested and work well for most market conditions. Customize only after understanding each parameter.</p>
            </section>

            <!-- Trading Currency -->
            <section class="setting-section">
                <div class="setting-header">
                    <span class="setting-icon">💵</span>
                    <h3>Trading Currency</h3>
                    <span class="setting-default">Default: USDT</span>
                </div>
                <div class="setting-body">
                    <p class="setting-description">Which stablecoin to trade with. This is your base currency — the bot buys tokens paired with it and measures profits in it.</p>
                    
                    <div class="options-grid">
                        <div class="option-card">
                            <h4>USDT (Recommended)</h4>
                            <p>Most liquid stablecoin with the widest token selection. Best for finding trading opportunities across 700+ pairs.</p>
                        </div>
                        <div class="option-card">
                            <h4>USDC</h4>
                            <p>Regulated alternative backed by Circle. Slightly fewer trading pairs but considered more transparent.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Budget -->
            <section class="setting-section">
                <div class="setting-header">
                    <span class="setting-icon">💰</span>
                    <h3>Budget</h3>
                    <span class="setting-default">User-defined</span>
                </div>
                <div class="setting-body">
                    <p class="setting-description">Total amount the bot can use for trading. The bot divides this among your max positions.</p>
                    
                    <div class="example-box">
                        <strong>Example:</strong> $100 budget with 10 max positions = ~$10 per position
                    </div>
                    
                    <div class="tips-box">
                        <h4>💡 Tips</h4>
                        <ul>
                            <li><strong>Start small:</strong> Begin with $100-500 while learning</li>
                            <li><strong>Scale gradually:</strong> Increase budget as you gain confidence</li>
                            <li><strong>Commission users:</strong> Larger budgets spread the 0.065% commission more efficiently</li>
                            <li><strong>Subscription users:</strong> Stay within your tier's budget limit</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Lookback Period -->
            <section class="setting-section">
                <div class="setting-header">
                    <span class="setting-icon">🕐</span>
                    <h3>Lookback Period</h3>
                    <span class="setting-default">Default: 24 hours</span>
                </div>
                <div class="setting-body">
                    <p class="setting-description">How far back the bot looks to analyze price trends. The bot compares current prices to the average over this period to find buying opportunities.</p>
                    
                    <div class="comparison-cards">
                        <div class="compare-card">
                            <div class="compare-icon">⚡</div>
                            <h4>Short (3-6 hours)</h4>
                            <ul>
                                <li>Reacts to recent price moves</li>
                                <li>More trading opportunities</li>
                                <li>Catches quick dips</li>
                                <li>Higher trade frequency</li>
                            </ul>
                            <p class="compare-best">Best for: Active markets, scalping strategies</p>
                        </div>
                        <div class="compare-card recommended">
                            <div class="compare-icon">🔭</div>
                            <h4>Long (12-24 hours)</h4>
                            <ul>
                                <li>Smoother trend analysis</li>
                                <li>Fewer, higher-quality trades</li>
                                <li>Catches bigger trend reversals</li>
                                <li>Less noise, more signal</li>
                            </ul>
                            <p class="compare-best">Best for: Stable returns, less monitoring</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Max Positions -->
            <section class="setting-section">
                <div class="setting-header">
                    <span class="setting-icon">📊</span>
                    <h3>Max Positions</h3>
                    <span class="setting-default">Default: 10</span>
                </div>
                <div class="setting-body">
                    <p class="setting-description">Maximum number of tokens to hold at once. Your budget is spread across this many positions — more positions means more diversification but smaller individual trades.</p>
                    
                    <div class="comparison-cards">
                        <div class="compare-card">
                            <div class="compare-icon">🎯</div>
                            <h4>Fewer (3-5 positions)</h4>
                            <ul>
                                <li>Concentrated bets</li>
                                <li>Higher risk/reward per position</li>
                                <li>Bigger wins (and losses)</li>
                                <li>More volatile results</li>
                            </ul>
                            <p class="compare-best">Best for: Confident traders, larger budgets</p>
                        </div>
                        <div class="compare-card recommended">
                            <div class="compare-icon">🌐</div>
                            <h4>More (10-20 positions)</h4>
                            <ul>
                                <li>Diversified exposure</li>
                                <li>Lower individual risk</li>
                                <li>Steadier, more consistent returns</li>
                                <li>One bad trade won't hurt much</li>
                            </ul>
                            <p class="compare-best">Best for: Steady growth, risk management</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Min Profit Target -->
            <section class="setting-section">
                <div class="setting-header">
                    <span class="setting-icon">📈</span>
                    <h3>Min Profit Target (%)</h3>
                    <span class="setting-default">Default: 3.0%</span>
                </div>
                <div class="setting-body">
                    <p class="setting-description">The minimum profit percentage before the bot will sell a position. The bot won't sell until this target is reached, ensuring each trade covers fees and generates meaningful returns.</p>
                    
                    <div class="comparison-cards">
                        <div class="compare-card">
                            <div class="compare-icon">🔽</div>
                            <h4>Lower (1-2%)</h4>
                            <ul>
                                <li>Faster trade completion</li>
                                <li>More frequent profits</li>
                                <li>Smaller gains per trade</li>
                                <li>Higher turnover</li>
                            </ul>
                            <p class="compare-best">Best for: High-frequency, consistent small wins</p>
                        </div>
                        <div class="compare-card">
                            <div class="compare-icon">🔼</div>
                            <h4>Higher (5-10%)</h4>
                            <ul>
                                <li>Bigger profits per trade</li>
                                <li>Longer hold times</li>
                                <li>Fewer completed trades</li>
                                <li>More patience required</li>
                            </ul>
                            <p class="compare-best">Best for: Swing trading, less active monitoring</p>
                        </div>
                    </div>
                    
                    <div class="info-box">
                        <strong>Why 3% default?</strong>
                        <p>3% provides a good balance: enough profit to be meaningful after fees, but achievable within reasonable timeframes. Most positions reach 3% within hours to days.</p>
                    </div>
                </div>
            </section>

            <!-- Stop Loss - THE BIG ONE -->
            <section class="setting-section stop-loss-section">
                <div class="setting-header">
                    <span class="setting-icon">🛡️</span>
                    <h3>Stop Loss (%)</h3>
                    <span class="setting-default">Default: OFF</span>
                </div>
                <div class="setting-body">
                    <p class="setting-description">Emergency exit to limit losses. If a position drops by this percentage from your entry price, the bot sells immediately to prevent bigger losses.</p>
                    
                    <div class="stop-loss-warning">
                        <h4>⚠️ Important: Stop Loss is a Double-Edged Sword</h4>
                        <p>Stop loss protection sounds safe, but in crypto's volatile markets, it can actually <strong>hurt your overall profitability</strong>. Here's why we default to OFF:</p>
                    </div>
                    
                    <div class="pros-cons-grid">
                        <div class="pros-section">
                            <h4>✅ Pros of Stop Loss</h4>
                            <ul>
                                <li><strong>Limits maximum loss per trade</strong> — you know the worst-case scenario</li>
                                <li><strong>Protects against catastrophic drops</strong> — token crashes, delistings</li>
                                <li><strong>Emotional peace of mind</strong> — set it and don't worry</li>
                                <li><strong>Frees up capital faster</strong> — losing positions get cut, capital moves on</li>
                            </ul>
                        </div>
                        <div class="cons-section">
                            <h4>❌ Cons of Stop Loss</h4>
                            <ul>
                                <li><strong>Crypto is extremely volatile</strong> — 5-10% swings are NORMAL</li>
                                <li><strong>You sell at the worst moment</strong> — right before recovery bounces</li>
                                <li><strong>Asymmetric risk/reward</strong> — lose 5% vs gain 3% = need 2 wins per loss</li>
                                <li><strong>Whipsaws eat profits</strong> — dip triggers stop, then price recovers</li>
                                <li><strong>One stop loss can erase multiple winning trades</strong></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="real-example">
                        <h4>📊 Real Example: The Math Problem</h4>
                        <div class="example-scenario">
                            <p><strong>Setup:</strong> $10 per position, 3% profit target, 5% stop loss</p>
                            <ul>
                                <li>Each <span class="win">WIN</span> = +$0.30 profit (3% of $10)</li>
                                <li>Each <span class="loss">LOSS</span> = -$0.50 loss (5% of $10)</li>
                            </ul>
                            <p><strong>Result:</strong> You need <strong>2 winning trades</strong> just to recover from <strong>1 stop loss hit</strong>.</p>
                            <p>In volatile crypto markets where 5% dips happen regularly (even on ultimately profitable positions), stop losses can turn a winning strategy into a losing one.</p>
                        </div>
                    </div>
                    
                    <div class="recommendation-box">
                        <h4>🎯 Our Recommendation</h4>
                        <p><strong>Keep Stop Loss OFF</strong> unless you have a specific reason to enable it.</p>
                        <p>The IOI bot has other protective mechanisms:</p>
                        <ul>
                            <li><strong>Momentum monitoring</strong> — exits positions when buying momentum fades</li>
                            <li><strong>Diversification</strong> — 10+ positions means one bad trade doesn't hurt much</li>
                            <li><strong>Graceful shutdown</strong> — always waits for profit before selling (see below)</li>
                        </ul>
                        <p>If you DO enable stop loss, consider <strong>15-20%</strong> to give positions room to breathe through normal volatility.</p>
                    </div>
                    
                    <div class="stop-loss-options">
                        <div class="option-item">
                            <span class="option-value">OFF</span>
                            <span class="option-desc">No automatic loss protection — waits for recovery (recommended)</span>
                        </div>
                        <div class="option-item">
                            <span class="option-value">5-10%</span>
                            <span class="option-desc">Tight protection — may trigger frequently in volatile markets</span>
                        </div>
                        <div class="option-item">
                            <span class="option-value">15-20%</span>
                            <span class="option-desc">Loose protection — more room for recovery, catches true crashes</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Entry Threshold -->
            <section class="setting-section">
                <div class="setting-header">
                    <span class="setting-icon">➡️</span>
                    <h3>Entry Threshold (%)</h3>
                    <span class="setting-default">Default: 1.0%</span>
                </div>
                <div class="setting-body">
                    <p class="setting-description">How selective the bot is when buying. The bot looks for tokens that have dipped below their recent average — this setting controls how big the dip needs to be before the bot buys.</p>
                    
                    <div class="comparison-cards">
                        <div class="compare-card">
                            <div class="compare-icon">🔄</div>
                            <h4>Lower (0.5-1%)</h4>
                            <ul>
                                <li>Less selective</li>
                                <li>More trading opportunities</li>
                                <li>Catches smaller dips</li>
                                <li>Higher trade volume</li>
                            </ul>
                            <p class="compare-best">Best for: Active trading, more positions</p>
                        </div>
                        <div class="compare-card">
                            <div class="compare-icon">🎯</div>
                            <h4>Higher (3-5%)</h4>
                            <ul>
                                <li>Very selective</li>
                                <li>Only buys significant dips</li>
                                <li>Fewer but better entries</li>
                                <li>May miss opportunities</li>
                            </ul>
                            <p class="compare-best">Best for: Quality over quantity</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Exit Threshold -->
            <section class="setting-section">
                <div class="setting-header">
                    <span class="setting-icon">⬅️</span>
                    <h3>Exit Threshold (%)</h3>
                    <span class="setting-default">Default: 40%</span>
                </div>
                <div class="setting-body">
                    <p class="setting-description">When to sell based on fading momentum. After buying, the bot tracks the token's momentum. This setting determines when to sell based on how much momentum remains compared to entry.</p>
                    
                    <div class="comparison-cards">
                        <div class="compare-card">
                            <div class="compare-icon">💎</div>
                            <h4>Lower (30-35%)</h4>
                            <ul>
                                <li>"Diamond hands" approach</li>
                                <li>Hold longer through dips</li>
                                <li>Ride bigger waves</li>
                                <li>Risk of giving back gains</li>
                            </ul>
                            <p class="compare-best">Best for: Trending markets, bigger swings</p>
                        </div>
                        <div class="compare-card">
                            <div class="compare-icon">🏃</div>
                            <h4>Higher (50-60%)</h4>
                            <ul>
                                <li>Quick exit approach</li>
                                <li>Lock in smaller gains faster</li>
                                <li>Less exposure to reversals</li>
                                <li>May exit too early</li>
                            </ul>
                            <p class="compare-best">Best for: Choppy markets, risk-averse</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Reinvestment Strategy -->
            <section class="setting-section">
                <div class="setting-header">
                    <span class="setting-icon">🔄</span>
                    <h3>Reinvestment Strategy</h3>
                    <span class="setting-default">Default: NONE</span>
                </div>
                <div class="setting-body">
                    <p class="setting-description">What happens to your profits after the bot sells a position.</p>
                    
                    <div class="reinvest-options">
                        <div class="reinvest-card">
                            <h4>NONE (Default)</h4>
                            <p>Profits stay as cash in your Binance account. Your trading budget remains fixed at the original amount.</p>
                            <p class="reinvest-best">Best for: Capital preservation, predictable results</p>
                        </div>
                        <div class="reinvest-card">
                            <h4>INCREMENTAL</h4>
                            <p>Profits are added to the trading budget. Enables compound growth — your budget grows with each winning trade.</p>
                            <p class="reinvest-best">Best for: Long-term growth, maximizing returns</p>
                        </div>
                    </div>
                    
                    <div class="info-box">
                        <strong>💡 Compound Growth Example</strong>
                        <p>Starting with $100 and averaging 5% monthly returns:</p>
                        <ul>
                            <li><strong>NONE:</strong> $100 stays $100, profits accumulate separately</li>
                            <li><strong>INCREMENTAL:</strong> $100 → $105 → $110.25 → $115.76... (snowball effect)</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Simulation Mode -->
            <section class="setting-section">
                <div class="setting-header">
                    <span class="setting-icon">🧪</span>
                    <h3>Simulation Mode (Dry Run)</h3>
                    <span class="setting-default">Toggle</span>
                </div>
                <div class="setting-body">
                    <p class="setting-description">Practice trading without real money. When enabled, the bot executes simulated trades using real market data but doesn't place actual orders on Binance.</p>
                    
                    <div class="comparison-cards">
                        <div class="compare-card recommended">
                            <div class="compare-icon">🧪</div>
                            <h4>Simulation ON (Dry Run)</h4>
                            <ul>
                                <li>Uses real-time market data</li>
                                <li>Simulated trades only</li>
                                <li>No real money at risk</li>
                                <li>Perfect for testing strategies</li>
                                <li>Run multiple configs simultaneously</li>
                            </ul>
                            <p class="compare-best">Best for: Testing, learning, comparing strategies</p>
                        </div>
                        <div class="compare-card">
                            <div class="compare-icon">💰</div>
                            <h4>Simulation OFF (Real Trading)</h4>
                            <ul>
                                <li>Real orders on Binance</li>
                                <li>Actual profits and losses</li>
                                <li>Real money at stake</li>
                                <li>Commission/subscription applies</li>
                            </ul>
                            <p class="compare-best">Best for: Live trading after testing</p>
                        </div>
                    </div>
                    
                    <div class="success-box">
                        <strong>🎓 Best Practice</strong>
                        <p>Run a configuration as a Dry Run bot for at least a few days before switching to real trading. This lets you see actual performance without risk.</p>
                    </div>
                </div>
            </section>

            <!-- SHUTDOWN SECTION -->
            <section class="shutdown-section">
                <h2>Understanding Bot Shutdown</h2>
                <p class="section-intro">When you stop a bot, you have two options. Understanding the difference is crucial for protecting your capital.</p>
                
                <div class="shutdown-comparison">
                    <div class="shutdown-card graceful">
                        <div class="shutdown-header">
                            <span class="shutdown-icon">🕊️</span>
                            <h3>Graceful Stop</h3>
                            <span class="shutdown-tag recommended">RECOMMENDED</span>
                        </div>
                        <div class="shutdown-body">
                            <p class="shutdown-desc">The bot stops buying new positions and waits for all existing positions to reach profit before selling.</p>
                            
                            <h4>How it works:</h4>
                            <ol>
                                <li>Immediately stops looking for new buying opportunities</li>
                                <li>Continues monitoring existing positions</li>
                                <li>Sells each position only when it reaches your min profit target</li>
                                <li>Bot fully stops when all positions are sold profitably</li>
                            </ol>
                            
                            <h4>Timeline:</h4>
                            <ul>
                                <li><strong>Most positions:</strong> Close within hours to days</li>
                                <li><strong>Some positions:</strong> May take weeks if market is down</li>
                                <li><strong>Worst case:</strong> Could take months in a bear market</li>
                            </ul>
                            
                            <div class="shutdown-result positive">
                                <strong>Result:</strong> All positions close at profit. No losses from the shutdown itself.
                            </div>
                        </div>
                    </div>
                    
                    <div class="shutdown-card force">
                        <div class="shutdown-header">
                            <span class="shutdown-icon">⚡</span>
                            <h3>Force Stop</h3>
                            <span class="shutdown-tag danger">USE WITH CAUTION</span>
                        </div>
                        <div class="shutdown-body">
                            <p class="shutdown-desc">The bot immediately sells ALL open positions at market price, regardless of profit or loss.</p>
                            
                            <h4>How it works:</h4>
                            <ol>
                                <li>Immediately stops all bot activity</li>
                                <li>Sells every open position at current market price</li>
                                <li>Bot fully stops within seconds</li>
                            </ol>
                            
                            <h4>Why it causes losses:</h4>
                            <ul>
                                <li>Positions in temporary dips get sold at a loss</li>
                                <li>Positions that haven't reached profit target yet = loss</li>
                                <li>Market orders may get worse prices (slippage)</li>
                            </ul>
                            
                            <div class="shutdown-result negative">
                                <strong>Result:</strong> Fast but almost certainly causes losses. Open positions are sold regardless of current P&L.
                            </div>
                            
                            <div class="warning-box">
                                <strong>⚠️ When to use Force Stop:</strong>
                                <ul>
                                    <li>Emergency situations only</li>
                                    <li>You need capital immediately for another purpose</li>
                                    <li>You believe the market will crash further</li>
                                    <li>You accept the certain losses</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="shutdown-recommendation">
                    <h4>🎯 Our Strong Recommendation</h4>
                    <p><strong>Always use Graceful Stop</strong> unless you have an urgent reason to exit immediately.</p>
                    <p>The bot's strategy is designed around buying dips — which means open positions are often temporarily in the red before recovering to profit. Forcing a stop sells these positions at exactly the wrong time.</p>
                    <p>Patience pays. A graceful stop might take longer, but it protects your capital.</p>
                </div>
            </section>

            <!-- Testing Strategies -->
            <section class="testing-strategies">
                <h2>Testing Different Configurations</h2>
                <p>The best way to find your optimal settings is to run multiple Dry Run bots with different configurations.</p>
                
                <div class="strategy-examples">
                    <div class="strategy-card">
                        <h4>🐢 Conservative Setup</h4>
                        <ul>
                            <li>Lookback: 24 hours</li>
                            <li>Max Positions: 15-20</li>
                            <li>Profit Target: 2-3%</li>
                            <li>Entry Threshold: 1.5%</li>
                            <li>Stop Loss: OFF</li>
                        </ul>
                        <p>Lower risk, steady returns, many small positions</p>
                    </div>
                    
                    <div class="strategy-card">
                        <h4>⚖️ Balanced Setup (Default)</h4>
                        <ul>
                            <li>Lookback: 24 hours</li>
                            <li>Max Positions: 10</li>
                            <li>Profit Target: 3%</li>
                            <li>Entry Threshold: 1%</li>
                            <li>Stop Loss: OFF</li>
                        </ul>
                        <p>Good balance of risk and reward</p>
                    </div>
                    
                    <div class="strategy-card">
                        <h4>🚀 Aggressive Setup</h4>
                        <ul>
                            <li>Lookback: 6-12 hours</li>
                            <li>Max Positions: 5</li>
                            <li>Profit Target: 5%</li>
                            <li>Entry Threshold: 0.5%</li>
                            <li>Reinvestment: INCREMENTAL</li>
                        </ul>
                        <p>Higher risk, potentially bigger returns</p>
                    </div>
                </div>
                
                <div class="info-box">
                    <strong>💡 Pro Tip</strong>
                    <p>Create 2-3 Dry Run bots with different settings and let them run for a week. Compare their performance in the app's analytics — then apply the winning configuration to a real trading bot.</p>
                </div>
            </section>

            <!-- Need Help -->
            <section class="setup-help">
                <h2>Need Help?</h2>
                <p>Still have questions about bot configuration?</p>
                <div class="help-options">
                    <a href="<?php echo home_url('/faq/'); ?>" class="btn btn-secondary">View FAQ</a>
                    <a href="<?php echo home_url('/contact/'); ?>" class="btn btn-primary">Contact Support</a>
                </div>
            </section>

        </div>
    </div>
</main>

<style>
/* Bot Settings Guide Specific Styles */
.golden-rule-box {
    display: flex;
    gap: 1.5rem;
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.15), rgba(212, 175, 55, 0.05));
    border: 2px solid #D4AF37;
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 3rem;
}

.rule-icon {
    font-size: 3rem;
    flex-shrink: 0;
}

.rule-content h2 {
    color: #D4AF37;
    margin-bottom: 0.5rem;
}

.settings-quickref {
    margin-bottom: 3rem;
}

.quickref-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
    margin: 1.5rem 0;
}

.quickref-item {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 8px;
    padding: 1rem;
    text-align: center;
}

.quickref-item .setting-name {
    display: block;
    font-size: 0.8rem;
    color: #888;
    margin-bottom: 0.5rem;
}

.quickref-item .setting-value {
    display: block;
    font-size: 1.25rem;
    font-weight: 700;
    color: #D4AF37;
}

.quickref-note {
    color: #888;
    font-size: 0.9rem;
    text-align: center;
}

.setting-section {
    background: rgba(255,255,255,0.02);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
}

.setting-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.setting-icon {
    font-size: 1.5rem;
}

.setting-header h3 {
    margin: 0;
    color: #fff;
    flex-grow: 1;
}

.setting-default {
    background: rgba(212, 175, 55, 0.2);
    color: #D4AF37;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
}

.setting-description {
    color: #ccc;
    margin-bottom: 1.5rem;
    font-size: 1.05rem;
}

.comparison-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin: 1.5rem 0;
}

.compare-card {
    background: rgba(0,0,0,0.3);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 1.5rem;
}

.compare-card.recommended {
    border-color: #D4AF37;
    background: rgba(212, 175, 55, 0.05);
}

.compare-icon {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.compare-card h4 {
    color: #fff;
    margin-bottom: 1rem;
}

.compare-card ul {
    list-style: none;
    padding: 0;
    margin: 0 0 1rem 0;
}

.compare-card li {
    padding: 0.4rem 0;
    padding-left: 1.25rem;
    position: relative;
    color: #aaa;
    font-size: 0.9rem;
}

.compare-card li::before {
    content: "•";
    position: absolute;
    left: 0;
    color: #D4AF37;
}

.compare-best {
    font-size: 0.85rem;
    color: #D4AF37;
    font-style: italic;
    margin: 0;
}

/* Stop Loss Section - Special Styling */
.stop-loss-section {
    border-color: rgba(255, 150, 50, 0.3);
}

.stop-loss-warning {
    background: rgba(255, 100, 50, 0.1);
    border: 1px solid rgba(255, 100, 50, 0.3);
    border-radius: 8px;
    padding: 1.25rem;
    margin-bottom: 1.5rem;
}

.stop-loss-warning h4 {
    color: #ff9944;
    margin-bottom: 0.5rem;
}

.pros-cons-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin: 1.5rem 0;
}

.pros-section, .cons-section {
    padding: 1.5rem;
    border-radius: 12px;
}

.pros-section {
    background: rgba(50, 200, 100, 0.1);
    border: 1px solid rgba(50, 200, 100, 0.3);
}

.cons-section {
    background: rgba(255, 100, 50, 0.1);
    border: 1px solid rgba(255, 100, 50, 0.3);
}

.pros-section h4 {
    color: #32c864;
}

.cons-section h4 {
    color: #ff6432;
}

.pros-section ul, .cons-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.pros-section li, .cons-section li {
    padding: 0.5rem 0;
    color: #ccc;
    font-size: 0.95rem;
}

.real-example {
    background: rgba(255,255,255,0.03);
    border-radius: 12px;
    padding: 1.5rem;
    margin: 1.5rem 0;
}

.real-example h4 {
    color: #D4AF37;
    margin-bottom: 1rem;
}

.example-scenario {
    background: #1a1a1a;
    border-radius: 8px;
    padding: 1.25rem;
}

.example-scenario .win {
    color: #32c864;
    font-weight: bold;
}

.example-scenario .loss {
    color: #ff6432;
    font-weight: bold;
}

.recommendation-box {
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(212, 175, 55, 0.05));
    border: 1px solid rgba(212, 175, 55, 0.3);
    border-radius: 12px;
    padding: 1.5rem;
    margin: 1.5rem 0;
}

.recommendation-box h4 {
    color: #D4AF37;
    margin-bottom: 0.75rem;
}

.stop-loss-options {
    margin-top: 1.5rem;
}

.option-item {
    display: flex;
    gap: 1rem;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.option-item:last-child {
    border-bottom: none;
}

.option-value {
    font-weight: 700;
    color: #D4AF37;
    min-width: 80px;
}

.option-desc {
    color: #aaa;
}

/* Reinvestment Options */
.reinvest-options {
    display: grid;
    gap: 1rem;
    margin: 1.5rem 0;
}

.reinvest-card {
    background: rgba(0,0,0,0.3);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 1.5rem;
}

.reinvest-card h4 {
    color: #D4AF37;
    margin-bottom: 0.5rem;
}

.reinvest-best {
    font-size: 0.85rem;
    color: #888;
    font-style: italic;
    margin-top: 0.5rem;
}

/* Shutdown Section */
.shutdown-section {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 2px solid rgba(212, 175, 55, 0.3);
}

.shutdown-section h2 {
    color: #D4AF37;
}

.section-intro {
    color: #ccc;
    margin-bottom: 2rem;
    font-size: 1.1rem;
}

.shutdown-comparison {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
    margin: 2rem 0;
}

.shutdown-card {
    border-radius: 16px;
    overflow: hidden;
}

.shutdown-card.graceful {
    background: rgba(50, 200, 100, 0.05);
    border: 2px solid rgba(50, 200, 100, 0.3);
}

.shutdown-card.force {
    background: rgba(255, 100, 50, 0.05);
    border: 2px solid rgba(255, 100, 50, 0.3);
}

.shutdown-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    background: rgba(0,0,0,0.2);
}

.shutdown-icon {
    font-size: 1.5rem;
}

.shutdown-header h3 {
    margin: 0;
    flex-grow: 1;
}

.shutdown-tag {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.shutdown-tag.recommended {
    background: rgba(50, 200, 100, 0.2);
    color: #32c864;
}

.shutdown-tag.danger {
    background: rgba(255, 100, 50, 0.2);
    color: #ff6432;
}

.shutdown-body {
    padding: 1.5rem;
}

.shutdown-desc {
    font-size: 1.05rem;
    color: #ccc;
    margin-bottom: 1.5rem;
}

.shutdown-body h4 {
    color: #fff;
    margin: 1.25rem 0 0.75rem;
}

.shutdown-body ol, .shutdown-body ul {
    padding-left: 1.25rem;
    color: #aaa;
}

.shutdown-body li {
    margin-bottom: 0.5rem;
}

.shutdown-result {
    padding: 1rem;
    border-radius: 8px;
    margin-top: 1.5rem;
}

.shutdown-result.positive {
    background: rgba(50, 200, 100, 0.15);
    color: #32c864;
}

.shutdown-result.negative {
    background: rgba(255, 100, 50, 0.15);
    color: #ff6432;
}

.shutdown-recommendation {
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(212, 175, 55, 0.05));
    border: 1px solid rgba(212, 175, 55, 0.3);
    border-radius: 12px;
    padding: 1.5rem;
    margin-top: 2rem;
}

.shutdown-recommendation h4 {
    color: #D4AF37;
    margin-bottom: 0.75rem;
}

/* Testing Strategies */
.testing-strategies {
    margin-top: 3rem;
}

.strategy-examples {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin: 1.5rem 0;
}

.strategy-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 1.5rem;
}

.strategy-card h4 {
    color: #D4AF37;
    margin-bottom: 1rem;
}

.strategy-card ul {
    list-style: none;
    padding: 0;
    margin: 0 0 1rem 0;
}

.strategy-card li {
    padding: 0.3rem 0;
    color: #ccc;
    font-size: 0.9rem;
}

.strategy-card > p {
    color: #888;
    font-size: 0.9rem;
    font-style: italic;
    margin: 0;
}

/* Boxes */
.example-box, .tips-box, .info-box, .warning-box, .success-box {
    border-radius: 8px;
    padding: 1.25rem;
    margin: 1rem 0;
}

.example-box {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
}

.tips-box {
    background: rgba(212, 175, 55, 0.05);
    border: 1px solid rgba(212, 175, 55, 0.2);
}

.tips-box h4 {
    color: #D4AF37;
    margin-bottom: 0.5rem;
}

.tips-box ul {
    margin: 0;
    padding-left: 1.25rem;
}

.tips-box li {
    color: #ccc;
    margin-bottom: 0.5rem;
}

.info-box {
    background: rgba(100, 150, 255, 0.1);
    border: 1px solid rgba(100, 150, 255, 0.3);
}

.info-box strong {
    color: #6496ff;
}

.warning-box {
    background: rgba(255, 150, 50, 0.1);
    border: 1px solid rgba(255, 150, 50, 0.3);
}

.warning-box strong {
    color: #ff9932;
}

.success-box {
    background: rgba(50, 200, 100, 0.1);
    border: 1px solid rgba(50, 200, 100, 0.3);
}

.success-box strong {
    color: #32c864;
}

.options-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin: 1rem 0;
}

.option-card {
    background: rgba(0,0,0,0.2);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 8px;
    padding: 1.25rem;
}

.option-card h4 {
    color: #D4AF37;
    margin-bottom: 0.5rem;
}

.option-card p {
    color: #aaa;
    margin: 0;
    font-size: 0.9rem;
}

/* Help Section */
.setup-help {
    text-align: center;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255,255,255,0.1);
}

.help-options {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .golden-rule-box {
        flex-direction: column;
        text-align: center;
    }
    
    .setting-header {
        flex-direction: column;
        text-align: center;
    }
    
    .shutdown-comparison {
        grid-template-columns: 1fr;
    }
    
    .help-options {
        flex-direction: column;
    }
}
</style>

<?php get_footer(); ?>