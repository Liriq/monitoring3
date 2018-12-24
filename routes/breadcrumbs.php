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

// Admin > Reports > Create
Breadcrumbs::for('admin-reports-create', function ($trail) {
    $trail->parent('admin-reports');
    $trail->push(_i('Create'), route('admin.reports.create'));
});

// Admin > Reports > Edit
Breadcrumbs::for('admin-reports-edit', function ($trail, $report) {
    $trail->parent('admin-reports');
    $trail->push(_i('Edit'), route('admin.reports.edit', $report->id));
});

// Admin > Templates
Breadcrumbs::for('admin-templates', function ($trail) {
    $trail->parent('admin-dashboard');
    $trail->push(_i('Templates'), route('admin.templates.index'));
});

// Admin > Templates > Create
Breadcrumbs::for('admin-templates-create', function ($trail) {
    $trail->parent('admin-templates');
    $trail->push(_i('Create'), route('admin.templates.create'));
});

// Admin > Templates > Edit
Breadcrumbs::for('admin-templates-edit', function ($trail, $template) {
    $trail->parent('admin-templates');
    $trail->push(_i('Edit'), route('admin.templates.edit', $template->id));
});

// Admin > Settings
Breadcrumbs::for('admin-settings', function ($trail) {
    $trail->parent('admin-dashboard');
    $trail->push(_i('Settings'), route('admin.settings.index'));
});

// Admin > Settings > Create
Breadcrumbs::for('admin-settings-create', function ($trail) {
    $trail->parent('admin-settings');
    $trail->push(_i('Create'), route('admin.settings.create'));
});

// Admin > Settings > Edit
Breadcrumbs::for('admin-settings-edit', function ($trail, $setting) {
    $trail->parent('admin-settings');
    $trail->push(_i('Edit'), route('admin.settings.edit', $setting->id));
});

