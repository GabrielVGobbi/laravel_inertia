<div id="notifications">
    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item noti-icon waves-effect"
            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-bell"></i>
            <span class="bell"></span>
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
            aria-labelledby="page-header-notifications-dropdown">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0"> {{ __('Notificações') }} </h6>
                    </div>
                    <div class="col-auto">
                        <a href="#" class="small d-none" id="read-all"> {{ __('Marcar todas como lida') }}</a>
                    </div>
                </div>
            </div>
            <div data-simplebar style="max-height: 230px;" class="card-maximum-height" id="notification-rows"></div>
            <div class="p-2 border-top">
                <a class="btn btn-sm btn-link font-size-14 btn-block text-center"
                    href="{{ route('notifications.index') }}">
                    <i class="mdi mdi-arrow-right-circle mr-1"></i> {{ __('Ver todas') }}
                </a>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="{{ asset('panel/js/pages/notification.js') }}"></script>
@append
