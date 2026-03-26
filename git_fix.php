<?php
// git_fix.php - One-time fix for 'Diverging branches' error in cPanel Git Manager
// Run once via: https://candyfandy.com/dev/git_fix.php

header('Content-Type: text/plain');

echo "Attempting to fix cPanel Git history...\n";

// Ensure we are in the repository root
// (assumed to be where git_fix.php is placed)
$repo_path = __DIR__;
chdir($repo_path);

echo "Working directory: " . getcwd() . "\n\n";

// Execute git commands
$commands = [
    'git status',
    'git fetch origin',
    'git reset --hard origin/main',
    'git status'
];

foreach ($commands as $cmd) {
    echo "Executing: $cmd\n";
    $output = shell_exec($cmd . ' 2>&1');
    echo $output . "\n";
    echo str_repeat('-', 20) . "\n";
}

echo "\nDone. Please delete this script and try the cPanel 'Deploy' button again.\n";
