<?php
// Routes

$app->get('/api/photos', 'App\Action\PhotoAction:fetch');
$app->get('/api/photos/{slug}', 'App\Action\PhotoAction:fetchOne');
