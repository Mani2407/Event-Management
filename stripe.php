<?php
require('stripe-php-master/init.php');

$publishableKey="pk_test_51JYDB1A1I7oZKiYe6G0gWloW3ESFjMQM9P7gS421WenqMJQAYQlSsmt5GAzY4uniAnakDH2PaQixMt66aI71MyoN004jvI7uOR";

$secretKey="sk_test_51JYDB1A1I7oZKiYemfrvhOl8a7XqtnRUNZQuhs9qexomFC3OjytOG4iFgKStxCGvVgOBFafGrjV2b1xSHi06LLtA00tWywwSj0";

\Stripe\Stripe::setApiKey($secretKey);
?>