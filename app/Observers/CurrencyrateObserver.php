<?php

namespace App\Observers;

use App\Currencyrate;
use App\Admin;
use Illuminate\Support\Facades\Mail;

class CurrencyrateObserver
{
    /**
     * Handle the currencyrate "created" event.
     *
     * @param  \App\Currencyrate  $currencyrate
     * @return void
     */
    public function created(Currencyrate $currencyrate)
    {
        // Mail::raw("Some custom message here", function ($message){
        //     $message->to(Admin::first()->email)->subject($message);
        // });
    }

    /**
     * Handle the currencyrate "updated" event.
     *
     * @param  \App\Currencyrate  $currencyrate
     * @return void
     */
    public function updated(Currencyrate $currencyrate)
    {
        //
    }

    /**
     * Handle the currencyrate "deleted" event.
     *
     * @param  \App\Currencyrate  $currencyrate
     * @return void
     */
    public function deleted(Currencyrate $currencyrate)
    {
        //
    }

    /**
     * Handle the currencyrate "restored" event.
     *
     * @param  \App\Currencyrate  $currencyrate
     * @return void
     */
    public function restored(Currencyrate $currencyrate)
    {
        //
    }

    /**
     * Handle the currencyrate "force deleted" event.
     *
     * @param  \App\Currencyrate  $currencyrate
     * @return void
     */
    public function forceDeleted(Currencyrate $currencyrate)
    {
        //
    }
}
