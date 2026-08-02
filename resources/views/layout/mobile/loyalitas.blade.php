@extends('layout.mobile.main')
@section('mobile')
    <link rel="stylesheet" href="../../../assets/css/mobile/loyalitas.css">
    <link rel="stylesheet" href="../../../assets/css/mobile/datepicker.css">

    <div class="standard-form-container loyalty-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="tab-menu-background-container">
                        <div class="tab-menu-container">
                            <a href="/loyalitas" data-active="true">
                                <i data-icon="benefit"
                                    style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/zoom-v2-beta/dark-turquoise/mobile/tabs/loyalty-reward.svg?v=20240813);--active-image-src: url(//d33egg70nrp50s.cloudfront.net/Images/zoom-v2-beta/dark-turquoise/mobile/tabs/loyalty-reward-active.svg?v=20240813);"></i>
                                Loyalty Reward
                            </a>
                        </div>
                    </div>
                    <div class="standard-form-content">
                        <div id="page_carousel" class="carousel slide page-carousel" data-ride="carousel"
                            data-interval="5000">
                            <ol class="carousel-indicators">
                                <li class="active" data-target="#page_carousel" data-slide-to="0"></li>
                                <li class="" data-target="#page_carousel" data-slide-to="1"></li>
                            </ol>

                            <div class="carousel-inner">
                                <div class="item active">
                                    <a href="-" target="_self">
                                        <img alt="Zoom Lucky Draw - Agustus" loading="lazy"
                                            src="https://api2-aj8.imgzm.com/images/aj8/en_cbd_68ba4391-24c0-4dc4-b3ca-00ad23593cb0_1722126093763.png">
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="https://hotelajaib.com/" target="_blank">
                                        <img alt="Loyalty" loading="lazy"
                                            src="https://api2-aj8.imgzm.com/images/aj8/en_cbd_bf82f794-8a3a-42c8-8642-efea2f8f9cc2_1721120913860.jpeg">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="loyalty-menu-container" id="loyalty_menu">
                            <a href="/missions" class="loyalty-menu-item" id="loyalty_menu_mission">
                                <div data-has-notification="false">
                                    <i class="fas fa-list-check"></i>
                                </div>
                                Misi
                            </a>
                            <a href="/penukaran" class="loyalty-menu-item" id="loyalty_menu_mission">
                                <div data-has-notification="false">
                                    <i class="fas fa-ticket-simple"></i>
                                </div>
                                penukaran
                            </a>
                        </div>
                        <div class="event-calendar-container" style="--event-text: 'Event'">
                            <input type="hidden" id="event_calendar">
                            <div class="calendar-container" id="calendar_container">
                                <div class="date-picker-wrapper single-date  no-shortcuts  inline-wrapper no-gap single-month"
                                    unselectable="on" style="user-select: none;">
                                    <div class="drp_top-bar">
                                        <div class="normal-top"><span class="selection-top">Selected: </span> <b
                                                class="start-day">...</b></div>
                                        <div class="error-top">error</div>
                                        <div class="default-top">Please select a date</div><input type="button"
                                            class="apply-btn disabled" value="Close" style="display: none;">
                                    </div>
                                    <div class="month-wrapper" style="width: 397px;">
                                        <table class="month1" cellspacing="0" border="0" cellpadding="0">
                                            <thead>
                                                <tr class="caption">
                                                    <th> <span class="prev">&lt; </span> </th>
                                                    <th colspan="5" class="month-name">
                                                        <div class="month-element">{{ $calendar['month_lower'] }}</div>
                                                        <div class="month-element">{{ $calendar['year'] }}</div>
                                                    </th>
                                                    <th><span class="next">&gt;</span> </th>
                                                </tr>
                                                <tr class="week-name">
                                                    <th>su</th>
                                                    <th>mo</th>
                                                    <th>tu</th>
                                                    <th>we</th>
                                                    <th>th</th>
                                                    <th>fr</th>
                                                    <th>sa</th>
                                                </tr>
                                            </thead>
            <tbody>
            @foreach ($calendar['rows'] as $row)
                <tr>
                    @foreach ($row as $c)
                        <td>
                            <div data-tooltip=""
                                class="day {{ $c['type'] }}  valid {{ !empty($c['today']) ? 'real-today' : '' }}">
                                <div class="" style="padding: 10px;">
                                    <span>{{ $c['n'] }}</span>
                                </div>
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
                                        </table>
                                        <div class="dp-clearfix"></div>
                                        <div class="time">
                                            <div class="time1"></div>
                                        </div>
                                        <div class="dp-clearfix"></div>
                                    </div>
                                    <div class="footer"></div>
                                    <div class="date-range-length-tip"></div>
                                </div>
                            </div>
                            <div class="event-list-container" id="event_list_container">
                                <div class="no-event">There are no events today</div>
                            </div>
                        </div>
                        <div class="event-legend-container">
                            <div data-legend="today">Today</div>
                            <div data-legend="event-available">Event Available</div>
                            <div data-legend="group-event-available">Group Event</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../../assets/js/mobile/loyalitas.js" defer></script>
@endsection

