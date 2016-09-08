<div class="share">
    <span>Share :</span>
    <a href="{{ Share::load(request()->url(), '' )->facebook() }}" onclick="window.open(this.href,'targetWindow',
                           'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,height=420,width=550'); 
                           return false;"><img src="{{ asset(null) }}frontend/images/material/share_fb.png" ></a>
    <a href="{{ Share::load(request()->url(), '' )->twitter() }}" onclick="window.open(this.href,'targetWindow',
                           'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,height=420,width=550'); 
                           return false;"><img src="{{ asset(null) }}frontend/images/material/share_tw.png" ></a>
</div>