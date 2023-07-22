<div class="deznav">
    <div class="deznav-scroll" style="overflow-y: auto;">
        <ul class="metismenu" id="menu">
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()"  >
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <ul >
                    <li><a href="{{ route('home') }}"><i class="fa-brands fa-uncharted"></i>Inicio</a></li>
                    <li class="d-none"><a href="page-review.html"><i class="fa-solid fa-sack-dollar"></i> Ver Cartera</a></li>
                    <li><a href="{{ route('consecutive.index') }}"><i class="fa-solid fa-hashtag"></i> Consecutivos</a></li>
                    <li><a href="{{ route('setting.index') }}"><i class="fa-solid fa-gears"></i>Otros</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false" >
                <i class="fa-solid fa-person"></i>
                <span class="nav-text">Estudiantes</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('view.student.index',7) }}"><i class="fa-solid fa-user-group"></i>Matricula</a></li>
                    <li><a href="{{ route('financiera') }}"><i class="fa-solid fa-money-bill"></i>Financiera</a></li>
                    <li><a href="{{ route('abonos') }}"><i class="fa-solid fa-money-bill"></i>Abono</a></li>
                    <li><a href="{{ route('otros.abonos') }}"><i class="fa-solid fa-money-bill-1-wave"></i>Otros Abonos</a></li>
                    <li><a href="{{ route('view.student.index',7) }}"><i class="fa-solid fa-clipboard-list"></i>Cartera</a></li>
                </ul>
            </li>

            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false" >
                <i class="flaticon-381-networking"></i>
                <span class="nav-text">Terceros</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('third.entry') }}"><i class="fa-solid fa-circle-plus"></i>Crear</a></li>
                    <li><a href="/receipts/third/entry/"><i class="fa-solid fa-receipt"></i>Recibo de Ingreso</a></li>
                    <li><a href="/receipts/third/discharge/"><i class="fa-solid fa-receipt"></i>Recibo de Egreso</a></li>
                </ul>

            </li>
        </ul>

    </div>
</div>