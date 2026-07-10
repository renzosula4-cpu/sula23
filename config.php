<?php
/**
 * config.php
 * -----------------------------------------------------------------------
 * Everything you'd want to change about this site lives in this one file.
 * Edit the values below — index.php just loops over them and renders them.
 * -----------------------------------------------------------------------
 */

return [

    'site' => [
        'title'    => 'Ralph Sula — Software Developer',
        'name'     => 'Ralph Sula',
        'role'     => 'Full-Stack Developer',
        'tagline'  => 'I build fast, well-tested web applications — mostly PHP, ' .
                      'React, and whatever the problem actually needs.',
        'location' => 'Remote / Austin, TX',
        'status'   => 'available', // 'available' or 'booked'
    ],

    'about' => [
        "I'm a full-stack developer with 6 years of experience shipping " .
        "products for startups and small teams. I care more about a codebase " .
        "being boring and correct than clever.",
        "Lately I've been deep in PHP 8 + Laravel on the backend, React on " .
        "the frontend, and just enough DevOps to keep things deployed without " .
        "a 3am page.",
    ],

    'skills' => [
        'languages' => ['PHP', 'JavaScript', 'TypeScript', 'Python', 'SQL'],
        'frameworks' => ['Laravel', 'React', 'Node.js', 'Tailwind CSS'],
        'infra' => ['Docker', 'MySQL', 'Redis', 'AWS', 'GitHub Actions'],
    ],

    'projects' => [
        [
            'name'        => 'Ledgerly',
            'description' => 'Small-business invoicing tool with automatic recurring '.
                             'billing, PDF generation, and Stripe payouts.',
            'tags'        => ['PHP', 'Laravel', 'MySQL', 'Stripe'],
            'link'        => 'https://github.com/example/ledgerly',
            'status'      => 'active',
        ],
        [
            'name'        => 'Pathfinder CLI',
            'description' => 'A command-line project scaffolder that generates '.
                             'opinionated Laravel + React starter apps in seconds.',
            'tags'        => ['Node.js', 'TypeScript', 'CLI'],
            'link'        => 'https://github.com/example/pathfinder-cli',
            'status'      => 'active',
        ],
        [
            'name'        => 'Weekend Reads',
            'description' => 'A minimalist read-it-later app with full-text search '.
                             'and offline sync, built to learn service workers.',
            'tags'        => ['React', 'PWA', 'IndexedDB'],
            'link'        => 'https://github.com/example/weekend-reads',
            'status'      => 'archived',
        ],
    ],

    // Rendered as a git-log style timeline — most recent first.
    'experience' => [
        [
            'hash'    => '1',
            'role'    => 'Senior Backend Developer',
            'company' => 'Northline Software',
            'dates'   => '2023 — Present',
            'message' => 'Rebuilt billing pipeline, cut invoice errors by 40%',
        ],
        [
            'hash'    => '2',
            'role'    => 'Full-Stack Developer',
            'company' => 'Fernweh Labs',
            'dates'   => '2021 — 2023',
            'message' => 'Shipped v1-v3 of the client dashboard, 0 to 12k users',
        ],
        [
            'hash'    => '3',
            'role'    => 'Junior Developer',
            'company' => 'Bright Path Digital',
            'dates'   => '2019 — 2021',
            'message' => 'Maintained WordPress + custom PHP client sites',
        ],
    ],

    'contact' => [
        'email'    => 'Ralph@example.com',
        'github'   => 'https://github.com/example',
        'linkedin' => 'https://linkedin.com/in/example',
    ],

];
