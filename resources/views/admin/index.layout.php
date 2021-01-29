@extends('layout/app')

@section('content')
ADMIN PANEL
-> liste des utilisateurs

<table>
<?php foreach ($users as $user): ?>
    <tr>
        <?php foreach ($user as $value): ?>
            <td><?= htmlspecialchars($value) ?></td>
        <?php endforeach; ?>
    </tr>
<?php endforeach; ?>
</table>
@endsection