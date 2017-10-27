@if(session()->has('success'))
    <div class="uk-alert uk-alert-success"><a class="uk-alert-close uk-close uk-icon">
            <svg version="1.1" role="presentation" width="17.857142857142858" height="17.857142857142858" viewBox="0 0 20 20" class="svg-icon active" style="font-size: 100em;"><path d="M16,16 L4,4" fill="none" stroke="#000"></path><path d="M16,4 L4,16" fill="none" stroke="#000"></path></svg>
        </a>
        {{session()->get('success')}}
    </div>
@endif

@if($errors->any())
    <div class="uk-alert uk-alert-danger"><a class="uk-alert-close uk-close uk-icon">
            <svg version="1.1" role="presentation" width="17.857142857142858" height="17.857142857142858" viewBox="0 0 20 20" class="svg-icon active" style="font-size: 100em;"><path d="M16,16 L4,4" fill="none" stroke="#000"></path><path d="M16,4 L4,16" fill="none" stroke="#000"></path></svg>
        </a>
        Por favor corrige los errores e intente nuevamente.
    </div>
@endif