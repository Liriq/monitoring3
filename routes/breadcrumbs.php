<?php

// Admin
Breadcrumbs::for('admin-dashboard', function ($trail) {
    $trail->push(_i('Admin dashboard'), route('admin.index'));
});

// Admin > Users
Breadcrumbs::for('admin-users', function ($trail) {
    $trail->parent('admin-dashboard');
    $trail->push(_i('Users'), route('admin.users.index'));
});

// Admin > Users > Create
Breadcrumbs::for('admin-users-create', function ($trail) {
    $trail->parent('admin-users');
    $trail->push(_i('Create'), route('admin.users.create'));
});

// Admin > Users > Edit
Breadcrumbs::for('admin-users-edit', function ($trail, $user) {
    $trail->parent('admin-users');
    $trail->push(_i('Edit'), route('admin.users.edit', $user->id));
});

// Admin > Reports
Breadcrumbs::for('admin-reports', function ($trail) {
    $trail->parent('admin-dashboard');
    $trail->push(_i('Reports'), route('admin.reports.index'));
});

// Admin > Templates
Breadcrumbs::for('admin-templates', function ($trail) {
    $trail->parent('admin-dashboard');
    $trail->push(_i('Templates'), route('admin.templates.index'));
});

// Admin > Settings
Breadcrumbs::for('admin-settings', function ($trail) {
    $trail->parent('admin-dashboard');
    $trail->push(_i('Settings'), route('admin.settings.index'));
});

