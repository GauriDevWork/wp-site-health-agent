<?php

use WSHA\Core\Constants;
use WSHA\Signals\SignalRegistry;

$score = (int) get_option(Constants::HEALTH_SCORE_OPTION, 0);
$trend = get_option(Constants::TREND_OPTION, 'stable');
$signals = SignalRegistry::active_signals();
?>

<div class="wrap">
    <h1>WordPress Site Health Agent</h1>

    <p><strong>Health Score:</strong> <?php echo esc_html($score); ?> / 100</p>
    <p><strong>Trend:</strong> <?php echo esc_html(ucfirst($trend)); ?></p>

    <h2>Top Risks</h2>

    <?php if (empty($signals)) : ?>
        <p>No active risk signals detected.</p>
    <?php else : ?>
        <ul>
            <?php foreach (array_slice($signals, 0, 3) as $signal) : ?>
                <li><?php echo esc_html($signal::key()); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <button id="wsha-explain" class="button button-primary">
        Explain with AI
    </button>

    <div id="wsha-ai-response" style="margin-top:15px;"></div>
</div>
<script>
document.getElementById('wsha-explain').addEventListener('click', function () {
    const output = document.getElementById('wsha-ai-response');
    output.innerText = 'Thinking...';

    fetch(ajaxurl + '?action=wsha_explain')
        .then(res => res.json())
        .then(data => {
            output.innerText = data.success ? data.data : 'Unable to explain.';
        });
});
</script>