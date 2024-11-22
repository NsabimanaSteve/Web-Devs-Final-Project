<?php
include 'fetch_data.php';
$pricing = fetchAll('pricing');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing</title>
    <link rel="stylesheet" href="HeroCSS.css">
</head>
<body>
    <header>
        <h1>Pricing Plans</h1>
    </header>
    <main>
        <div class="pricing">
            <?php foreach ($pricing as $plan): ?>
                <div class="pricing-card">
                    <h2><?= htmlspecialchars($plan['plan_name']); ?></h2>
                    <p>Price: <?= htmlspecialchars($plan['price']); ?> USD/month</p>
                    <p>Features: <?= htmlspecialchars($plan['features']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>
