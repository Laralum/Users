{!!
    \ConsoleTVs\Charts\Facades\Charts::multiDatabase('line', 'highcharts')
    ->title(__('laralum_users::general.last_users'))->dataset(__('laralum_users::general.new_users'), \Laralum\Users\Models\User::all())
    ->elementLabel(__('laralum_users::general.new_users'))->lastByDay(7, true)->render();
!!}
