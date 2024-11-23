<!-- classes.php -->
<?php
include '../api/fetch_data.php';

$classes = fetchAll('classes');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Classes | FitInspire</title>
    <link rel="stylesheet" href="HeroCSS.css">
    <style>
        .classes-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .classes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .class-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .class-card:hover {
            transform: translateY(-5px);
        }

        .class-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .class-content {
            padding: 1.5rem;
        }

        .class-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .class-info {
            margin-bottom: 0.5rem;
            color: #666;
        }

        .availability {
            margin-top: 1rem;
            padding: 0.5rem;
            background: #f5f5f5;
            border-radius: 5px;
            text-align: center;
        }

        .booking-button {
            display: block;
            width: 100%;
            padding: 0.8rem;
            margin-top: 1rem;
            background: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .booking-button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Our Fitness Classes</h1>
        <p>Join our expert-led classes designed to help you achieve your fitness goals</p>
    </header>

    <main class="classes-container">
        <div class="classes-grid">
            <?php foreach ($classes as $class): ?>
                <div class="class-card">
                    <?php if (!empty($class['image_url'])): ?>
                        <img 
                            src="<?= htmlspecialchars($class['image_url']); ?>" 
                            alt="<?= htmlspecialchars($class['image_description']); ?>"
                            class="class-image"
                        >
                    <?php endif; ?>
                    
                    <div class="class-content">
                        <h2 class="class-title"><?= htmlspecialchars($class['class_name']); ?></h2>
                        
                        <div class="class-info">
                            <p><strong>Time:</strong> <?= date('l, g:i A', strtotime($class['schedule_time'])); ?></p>
                            <p><strong>Trainer:</strong> <?= htmlspecialchars($class['trainer']); ?></p>
                            <?php if (!empty($class['specialization'])): ?>
                                <p><strong>Specialization:</strong> <?= htmlspecialchars($class['specialization']); ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="availability">
                            <?php 
                            $availablePercentage = ($class['available_slots'] / $class['max_slots']) * 100;
                            $availabilityStatus = $availablePercentage > 20 ? 'Available' : 'Limited Spots';
                            ?>
                            <p><strong><?= $availabilityStatus ?>:</strong> 
                               <?= $class['available_slots'] ?> out of <?= $class['max_slots'] ?> spots remaining</p>
                        </div>

                        <a href="booking.php?class_id=<?= $class['class_id'] ?>" class="booking-button">
                            Book Now
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>