<div class="card card-cascade cascading-admin-card" style="height: 100%">
    <div class="admin-up">
        <i class="{{ isset($infoCardIcon) ? $infoCardIcon : 'fa fa-money' }} {{ isset($infoCardColor) ? $infoCardColor : 'bg-primary' }}"></i>
        <div class="data">
            <p>{{ isset($infoCardName) ? $infoCardName : 'Godown' }}</p>
            <h4 class="font-weight-bold dark-grey-text h5-responsive">
                {{ isset($infoCardTitle) ? ucfirst($infoCardTitle) : '2000$' }}
            </h4>
        </div>
    </div>
    <div class="card-body">
        <div class="progress">
            <div class="progress-bar {{ isset($infoCardColor) ? $infoCardColor : 'bg-primary' }}" role="progressbar" style="width: 100%"
                 aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <p class="card-text">
            {{ isset($infoCardSubTitle) ? $infoCardSubTitle : 'lets get this started' }}
        </p>
        {{ isset($slot) ? $slot : '' }}
    </div>
</div>